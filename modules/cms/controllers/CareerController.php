<?php
/**
 * Created by PhpStorm.
 * User: Daisy
 * Date: 2020-06-15
 * Time: 21:04
 */

namespace app\modules\cms\controllers;
use app\models\Career;
use Yii;


class CareerController extends BaseController
{
    public function actionDevelop() {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = 'json';
            $post = Yii::$app->request->post();
            $data = [];
            $model = Career::findOne(['id'=>1]);
            $model->time = date('Y-m-d:H:i:s');
            $model->setAttributes($data,false);
            $model->content = str_replace(Yii::$app->params['qiniu']['domain'],'%domain%',$post['content']);
            if( $model->save() ){
                return ['code' => 200,'message'=>'提交成功！'];
            }
            return ['code' => 500, 'message' => '提交失败！！'];
        }
        return $this->render('develop');
    }

    public function actionDetail(){
        Yii::$app->response->format = 'json';
        $data = Career::findOne(['id'=>1]);
        $data['content'] = str_replace('%domain%',Yii::$app->params['qiniu']['domain'],$data['content']);
        return ['code'=>200,'data'=>$data];
    }
}
