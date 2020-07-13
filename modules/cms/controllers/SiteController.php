<?php
/**
 * Created by PhpStorm.
 * User: jun
 * Date: 2018/7/11
 * Time: 下午5:15
 */

namespace app\modules\cms\controllers;


use app\models\Admin;
use Yii;
use yii\filters\AccessControl;

class SiteController extends BaseController {
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow'   => true,
                        'roles'   => ['@'],
                        'actions' => ['index']
                    ],
                    [
                        'actions' => ['login','edit'],
                        'allow'   => true,
                        'roles'   => ['?'],
                    ],
                ],
            ]
        ];
    }

    public function actionLogin(){
        return $this->render('login');
    }

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionEdit(){
        if (Yii::$app->request->isAjax ) {
            Yii::$app->response->format = 'json';
            $username = trim(Yii::$app->request->post('username'));
            $password = trim(Yii::$app->request->post('password'));
            $password2 = trim(Yii::$app->request->post('password2'));
            if( $password !== $password2){
                return ['code'=>500,'message'=>'两次密码不一致！'];
            }
            if (!$this->checkPassword($password)) {
                return ['code' => 500, 'message' => '密码不符号要求:大写字母,小写字母,数字,符号中的至少三种'];
            }
            $admin = Admin::findOne(['username'=>$username,'status'=>1]);
            if( !$admin ){
                return ['code'=>500,'message'=>'用户不存在！！'];
            }
            if ($admin->password == md5($password) ){
                return ['code'=>500,'message'=>'此密码不能再次使用'];
            }
            $admin->password = md5($password);
            $admin->update_time = date('Y-m-d H:i:s');
            if( $admin->save() ){
                return ['code' => 200, 'message' => '修改成功'];
            }
            return ['code' => 500, 'message' => '修改失败！！'];
        }

        return $this->render('edit');
    }
}
