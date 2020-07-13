<?php
/**
 * Created by PhpStorm.
 * User: jun
 * Date: 2018/7/11
 * Time: 下午6:09
 */

namespace app\modules\cms\controllers;


use app\models\Basic;
use Yii;

class BasicController extends BaseController {
    public function actionIndex() {
        return $this->render('index');
    }

    public function actionEdit() {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = 'json';
            $post = Yii::$app->request->post();
            $data = [
                'brand_title' => $post['brand_title'],
                'brand_title2' => $post['brand_title2'],
                'brand_desc' => $post['brand_desc'],
                'brand_url' => $post['brand_url'],
                'strength_title' => $post['strength_title'],
                'strength_title2' => $post['strength_title2'],
                'strength_desc' => $post['strength_desc'],
                'strength_desc2' => $post['strength_desc2'],
                'position_title' => $post['position_title'],
                'position_title2' => $post['position_title2'],
                'position_desc' => $post['position_desc']
            ];
            $model = Basic::findOne(['id'=>1]);
            $model->setAttributes($data,false);
            if( $model->save() ){
                return ['code' => 200,'message'=>'提交成功！'];
            }
            return ['code' => 500, 'message' => '提交失败！！'];
        }
        return $this->render('edit');
    }

    /**
     * @return array|string
     */
    public function actionDetail() {
        Yii::$app->response->format = 'json';
        $id = Yii::$app->request->get('id');
        $data = Basic::find()->andWhere(['id' => 1])->one();
        return ['code' => 200, 'data' => $data];
    }



}