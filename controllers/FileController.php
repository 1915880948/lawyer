<?php
/**
 * Created by PhpStorm.
 * User: jun
 * Date: 2018/5/8
 * Time: 上午12:04
 */

namespace app\controllers;


use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\UploadedFile;

class FileController extends Controller {
    public $enableCsrfValidation = false;

    public function actionUpload() {
        $params = Yii::$app->params['qiniu'];
        $accessKey =$params['accessKey'];
        $secretKey = $params['secretKey'];
        $bucket = $params['bucket'];
        $key = uniqid();
        $action = Yii::$app->request->get('action');
        $callback = Yii::$app->request->get('callback');
        if($action == 'config'){
            echo $callback.'('.json_encode(json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents($_SERVER['DOCUMENT_ROOT']. '/ueditor/php/config.json'))), true).')';die;
        } else{
            $auth = new Auth($accessKey, $secretKey);
            $token = $auth->uploadToken($bucket, $key);

            $file = UploadedFile::getInstanceByName('file');

            $uploadMgr = new UploadManager();

            list($ret, $err) = $uploadMgr->putFile($token, $key, $file->tempName);
            if ($err !== null) {
                return ['code'=> 500, 'data'=> $err];
            } else {
                return Json::encode([
                    "state" => 'SUCCESS',
                    "url" => $params['domain'].$ret['key'],
                    "title" => $file->name,
                    "original" => $ret['key'],
                    "type" => '.jpg',
                    "size" => $file->size
                ]);
            }
        }
    }

    public function actionToken() {
        Yii::$app->response->format = 'json';
        $config = Yii::$app->params['qiniu'];
        $auth = new Auth($config['accessKey'], $config['secretKey']);
        $token = $auth->uploadToken($config['bucket']);
        return ['code'=> 200, 'data'=> $token];
    }

}