<?php

namespace app\modules\en\controllers;

use app\controllers\WebBaseController;
use app\modules\en\models\IUser;
use Yii;
use yii\base\Theme;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Response;

class SiteController extends WebBaseController {
    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
//    public $layout = 'en.views.layouts';//xxx为模块的id
//    public $layout="/layouts/main";
    public function actionIndex() {
        if( $this->IsMobile() ){
            return $this->render('/wap/index');
        }
        return $this->render('index');
    }

    public function actionAbstract() {
        if( $this->IsMobile() ){
            return $this->render('/wap/abstract');
        }
        return $this->render('abstract');
    }
    public function actionNews() {
        if( $this->IsMobile() ){
            return $this->render('/wap/news');
        }

        return $this->render('news');
    }
    public function actionNdetail() {
        if( $this->IsMobile() ){
            return $this->render('/wap/ndetail');
        }

        return $this->render('ndetail');
    }
    public function actionExperience(){
        if( $this->IsMobile() ){
            return $this->render('/wap/experience');
        }

        return $this->render('experience');
    }
    public function actionProducts(){
        if( $this->IsMobile() ){
            return $this->render('/wap/products');
        }

        return $this->render('products');
    }
    public function actionDevelop(){
        if( $this->IsMobile() ){
            return $this->render('/wap/develop');
        }
        return $this->render('develop');
    }
    public function actionRecruit(){
        if( $this->IsMobile() ){
            return $this->render('/wap/recruit');
        }

        return $this->render('recruit');
    }

    public function IsMobile()
    {
        $user_agent = $_SERVER ['HTTP_USER_AGENT'];
        $mobile_browser = Array(
            "mqqbrowser", // 手机QQ浏览器
            "opera mobi", // 手机opera
            "juc",
            "iuc", // uc浏览器
            "fennec",
            "ios",
            "applewebKit/420",
            "applewebkit/525",
            "applewebkit/532",
            "ipad",
            "iphone",
            "ipaq",
            "ipod",
            "iemobile",
            "windows ce", // windows phone
            "240×320",
            "480×640",
            "acer",
            "android",
            "anywhereyougo.com",
            "asus",
            "audio",
            "blackberry",
            "blazer",
            "coolpad",
            "dopod",
            "etouch",
            "hitachi",
            "htc",
            "huawei",
            "jbrowser",
            "lenovo",
            "lg",
            "lg-",
            "lge-",
            "lge",
            "mobi",
            "moto",
            "nokia",
            "phone",
            "samsung",
            "sony",
            "symbian",
            "tablet",
            "tianyu",
            "wap",
            "xda",
            "xde",
            "zte"
        );
        $is_mobile = false;
        foreach ($mobile_browser as $device) {
            if (stristr($user_agent, $device)) {
                $is_mobile = true;
                break;
            }
        }
        return $is_mobile;
    }

}
