<?php
/**
 * Created by PhpStorm.
 * User: jun
 * Date: 2017/8/10
 * Time: 下午3:16
 */

namespace app\modules\cms\controllers;


use app\common\helpers\AuthHelper;
use app\models\Admin;
use app\models\Agency;
use app\modules\cms\models\AdminUser;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Json;

class AdminController extends BaseController {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['logout','list','create','edit','method', 'detail'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?']
                    ]
                ],
            ]
        ];
    }

    public function actionLogin(){
        Yii::$app->response->format = 'json';
        $username = Yii::$app->request->post('username');
        $password = Yii::$app->request->post('password');
        $admin = AdminUser::findByUsername($username);
        $date = date('Y-m-d h:i:s',time());
        if( !$admin ){
            return ['code'=>500, 'message'=> '用户错误'];
        }
        $dateDelay24 =  date('Y-m-d h:i:s',(time()-3600*24) );
        if( $admin->times >= 5  && $admin->create_time >$dateDelay24 ){ // 24小时内最多5次登录
            $time1 = strtotime($admin->create_time);
            $time2 = strtotime($dateDelay24);
            if( ($time1-$time2) > 86400 ){ // 超过24小时再次登录
                $admin->times = 1;
                $admin->create_time = $date ;
                $admin->save();
                return ['code'=>500, 'message'=> '密码错误，还有'.(5-$admin->times).'次机会'];
            }
            return ['code'=>500,'message'=>'对不起，当前账号锁定，24小时后自动解锁'];
        }

        if($admin->password !== md5($password)){
            //子账户查询禁用状态
//            if($admin->role === 2 && $admin->disable_status === 1){
//                return ['code'=>500, 'message'=> '用户名或密码错误'];
//            }
            $admin->times = $admin->times+1;
            $admin->create_time = $date ;

            $admin->save();

            return ['code'=>500, 'message'=> '密码错误，还有'.(5-$admin->times).'次机会'];
        }

        $dateDelay3M =  date('Y-m-d h:i:s',(time()-86400*90) );
        Yii::error("1".$admin->update_time );
        Yii::error("2".$dateDelay3M );

        if( $admin->update_time < $dateDelay3M){
            return ['code'=>302,'message'=>'密码已使用三个月，请修改！！'];
//            Yii::$app->controller->redirect("/cms/site/edit");
        }

        $admin->times = 0 ;
        $admin->create_time = $date;
        $admin->save();
        Yii::$app->user->login($admin,8*3600);
        return ['code'=>200,'message'=>'登录成功！！'];

    }

    public function actionLogout(){
        if(Yii::$app->user->logout()){
            return $this->redirect(['site/login']);
        }
    }

    public function actionList(){
        if(Yii::$app->request->isAjax){
            Yii::$app->response->format = 'json';
            $page = intval(Yii::$app->request->get('page'));
            $size = intval(Yii::$app->request->get('length',10));
            $search = Yii::$app->request->get('search');
            $start = ($page-1)*$size;

            $query = Admin::find()->andWhere(['status'=>1]);

            if($search){
                $query->andWhere(['like', 'username', "{$search}"]);
            }
            $result = $query->orderBy('id desc')->limit((int)$size)->offset($start)->asArray()->all();
            $count = $query->count('id');

            return [
                "recordsTotal" => $count,
                "recordsFiltered" => $count,
                "data" => $result,
                "list" =>[]
            ];
        }
        return $this->render('list');
    }

    public function actionCreate(){
        if(Yii::$app->request->isPost){
            Yii::$app->response->format = 'json';
            $data = [
                'username' => Yii::$app->request->post('username'),
                'password' => md5(Yii::$app->request->post('password')),
                'role' => Yii::$app->request->post('role', 1)
            ];
            $proxy = new Admin();
            $proxy->setAttributes($data, false);
            if($proxy->save()){
                return ['code'=>200];
            }
            return ['code'=>5000,'data'=>$proxy->errors];
        }
        return $this->render('edit', [
            'data' => []
        ]);
    }

    public function actionEdit(){
        if(Yii::$app->request->isPost){
            Yii::$app->response->format = 'json';
            $id = Yii::$app->request->post('id');
            $password = Yii::$app->request->post('password');

            $data = [
                'username' => Yii::$app->request->post('username'),
//                'role' => Yii::$app->request->post('role', 1),
            ];
            $proxy = Admin::find()->andWhere(['id'=>$id])->one();
            $proxy->setAttributes($data);

            if(($proxy->password != md5($password)) && $password){
                $proxy->setAttribute('password', md5($password));
            }
            if($proxy->save()){
                return ['code'=>200];
            }
            return ['code'=>5000,'data'=>$proxy->errors];
        }
        return $this->render('edit');
    }

    public function actionMethod(){
        Yii::$app->response->format = 'json';
        $id = Yii::$app->request->post('id');
        $method = Yii::$app->request->post('method');
        $model = Admin::findOne(['id'=>$id]);
        switch ($method){
            case 'up':
                $model->disable_status = 1;
                break;
            case 'down':
                $model->disable_status = 0;
                break;
            case 'delete':
                $model->status = 0;
                break;
        }
        if($model->save()){
            return ['code'=>200];
        }
        return ['code'=>400, 'error' => $model->errors];
    }

    public function actionDetail(){
        Yii::$app->response->format = 'json';
        $id = Yii::$app->request->post('id');
        $data = Admin::find()->where('id=:id', [':id'=>$id])->asArray()->one();
        if($data){
            $data['permission'] = $data['agency_permission'] ? Json::decode($data['agency_permission']) : [];
        }
        return ['code'=>200, 'data'=> $data];
    }
}
