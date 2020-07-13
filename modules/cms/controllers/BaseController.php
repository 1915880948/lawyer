<?php
/**
 * Created by PhpStorm.
 * User: jun
 * Date: 2018/7/11
 * Time: 下午4:19
 */

namespace app\modules\cms\controllers;


use app\modules\cms\models\AdminUser;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\User;

class BaseController extends Controller {
    public $enableCsrfValidation = false;
    public $layout = "@app/modules/cms/views/layouts/main";

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

    public function init() {
        Yii::$app->setComponents([
            // /** @see ErrorHandler */
//            'errorHandler' => [
//                'class'       => ErrorHandler::class,
//                'errorAction' => '/backend/site/error'
//            ],
            'user' => [
                'class'           => User::class,
                'identityClass'   => AdminUser::class,
                'idParam'         => "__admin",
                'enableAutoLogin' => true,
                'loginUrl'        => ['/cms/site/login'],
                // 'identityCookie'  => [
                //     'name'     => "___backend_identity",
                //     'httpOnly' => true,
                //     'domain'   => isset($params['cookie']['domain']) ? $params['cookie']['domain'] : null,
                // ],
            ],
        ]);
        parent::init();
    }

    // 大写、小写字母，数字，符号至少三种
    public function checkPassword($password){
        $pattern = "/^(?![a-zA-Z]+$)(?![A-Z0-9]+$)(?![A-Z\W_!@#$%^&*`~()-+=]+$)(?![a-z0-9]+$)(?![a-z\W_!@#$%^&*`~()-+=]+$)(?![0-9\W_!@#$%^&*`~()-+=]+$)[a-zA-Z0-9\W_!@#$%^&*`~()-+=]{10,30}$/";
        if( preg_match($pattern,$password) ){
            return true;
        }
        return false;
    }
}
