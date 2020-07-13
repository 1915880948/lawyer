<?php

namespace app\modules\cms\models;

use app\models\Admin;
use Yii;
use yii\db\ActiveRecord;

class AdminUser extends ActiveRecord implements \yii\web\IdentityInterface {
//    public $id;
//    public $username;
//    public $password;
//    public $phone;
//    public $role;
//    public $agency_id;
//    public $agency_permission;
//    public $disable_status;
//    public $status;
//    public $create_time;
//    public $update_time;
//
//    private static $users = [
//
//    ];


    public static function tableName()
    {
        return 'admin';
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
//        $admin = Admin::findOne(['id'=> $id, 'status'=> 1]);
//        return new static($admin);
        return static::findOne(['id' => $id,'status'=>1]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param $username
     * @return static|null
     */
    public static function findByUsername($username) {
        $user = Admin::findOne(['username'=> $username, 'status'=> 1]);
//        return new static($user);
//        print_r( $user );  die;
        return static::findOne(['username' => $username,'status'=>1]);

    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password) {
        return $this->password === $password;
    }

//    public function beforeSave($insert)
//    {
//        if (parent::beforeSave($insert)) {
//            if ($this->isNewRecord) {
//                $this->auth_key = Yii::$app->security->generateRandomString(32);
//            }
//            return true;
//        }
//        return false;
//    }
}
