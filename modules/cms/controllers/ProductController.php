<?php
/**
 * Created by PhpStorm.
 * User: jun
 * Date: 2018/7/11
 * Time: 下午6:09
 */

namespace app\modules\cms\controllers;


use app\common\helpers\AttributeHelper;
use app\models\Product;
use Yii;

class ProductController extends BaseController {
    public function actionList() {
        if( Yii::$app->request->isAjax ){
            Yii::$app->response->format = 'json';
            $page = intval(Yii::$app->request->get('page'));
            $size = intval(Yii::$app->request->get('size', 10));
            $search = Yii::$app->request->get('search');
            $start = ($page - 1) * $size;

            $query = Product::find()->andWhere(['status' => 1]);

            if ($search) {
                $query = $query->andWhere(['like', 'title', "{$search}"]);
            }

            $result = $query->orderBy(['sort'=>SORT_DESC,'id'=>SORT_DESC])->limit((int)$size)->offset($start)->asArray()->all();
            $count = $query->count('id');

            return [
                "recordsTotal" => $count,
                "recordsFiltered" => $count,
                "data" => $result
            ];
        }
        return $this->render('list');
    }

    public function actionEdit() {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = 'json';
            $post = Yii::$app->request->post();
            $data = [];
            $attributes = AttributeHelper::filter((new Product())->attributes());
            foreach ($attributes as $list){
                $data[$list] = isset($post[$list]) ? $post[$list] : '';
            }
            if( $post['id'] ){
                $model = Product::findOne(['id'=>(int)$post['id']]);
            }else{
                $model = new Product();
                $model->create_time = date('Y-m-d:H:i:s');
            }
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
        $data = Product::find()->andWhere(['id' => $id])->one();
        return ['code' => 200, 'data' => $data];
    }

    public function actionOperate() {
        Yii::$app->response->format = 'json';
        $id = Yii::$app->request->post('id');
        $model = Product::findOne(['id'=>(int)$id]);
        $method = Yii::$app->request->post('method');
        $value = Yii::$app->request->post('value');
        switch ($method){
            case 'delete': $model->status = 0; break;
            case 'shelf': $model->shelf_status = (int)$value; break;
        }
        $model->save();
        return ['code' => 200,'message'=>'操作成功'];
    }

}