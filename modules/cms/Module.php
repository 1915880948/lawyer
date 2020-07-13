<?php

namespace app\modules\cms;
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
    public $controllerNamespace = 'app\modules\cms\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        Yii::$app->setComponents([
            // /** @see ErrorHandler */
            'errorHandler' => [
                'class'       => ErrorHandler::className(),
                'errorAction' => '/backend/site/error'
            ],
            'user' => [
                'class'           => User::className(),
                'identityClass'   => AdminUser::className(),
                'idParam'         => "__admin",
                'enableAutoLogin' => true,
                'loginUrl'        => ['/cms/site/login'],
                // 'identityCookie'  => [
                //     'name'     => "___backend_identity",
                //     'httpOnly' => true,
                //     'domain'   => isset($params['cookie']['domain']) ? $params['cookie']['domain'] : null,
                // ],
//                'authTimeout'     => 20,
            ],
        ]);
        parent::init();

        // custom initialization code goes here
    }

    public function createController($route)
    {
        return parent::createController($route);
    }
}
