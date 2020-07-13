<?php
/**
 * Created by PhpStorm.
 * User: jun
 * Date: 2019/3/19
 * Time: 下午1:03
 */

namespace app\common\helpers;


use Yii;
use yii\helpers\Json;

class AuthHelper {
    public static function isAdmin() {
        return Yii::$app->controller->module->user->identity->role === 0;
    }

    public static function getAgencyId(){
        return Yii::$app->controller->module->user->identity->agency_id;
    }

    public static function getRole() {
        return Yii::$app->controller->module->user->identity->role;
    }

    public static function getPermission() {
        $permission = Yii::$app->controller->module->user->identity->agency_permission;
        return $permission ? Json::decode($permission) : [];
    }

}