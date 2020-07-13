<?php

namespace app\modules\en;
use app\modules\cms\models\AdminUser;
use Yii;
use yii\web\ErrorHandler;
use yii\web\User;

/**
 * cms module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\en\controllers';
//    public $layoutPath = $viewPath().'/layouts';
//    public $layout = 'application/modules/en/views/layouts/main.blade.php';

//public $layout = "en.views.layouts.main";//xxx为模块的id;
    /**
     * {@inheritdoc}
     */
    public function init()
    {
//        print_r($this->layout );
//        print_r($this->layoutPath ); die;
//        Yii::$app->setComponents([
//            // /** @see ErrorHandler */
//            'errorHandler' => [
//                'class'       => ErrorHandler::className(),
//                'errorAction' => '/backend/site/error'
//            ],
//            'user' => [
//                'class'           => User::className(),
//                'identityClass'   => AdminUser::className(),
//                'idParam'         => "__admin",
//                'enableAutoLogin' => true,
//                'loginUrl'        => ['/cms/site/login'],
//                // 'identityCookie'  => [
//                //     'name'     => "___backend_identity",
//                //     'httpOnly' => true,
//                //     'domain'   => isset($params['cookie']['domain']) ? $params['cookie']['domain'] : null,
//                // ],
//            ],
//        ]);
        parent::init();

        // custom initialization code goes here
    }

    public function createController($route)
    {
        return parent::createController($route);
    }
}
