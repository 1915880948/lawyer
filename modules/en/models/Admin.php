<?php

namespace app\modules\en\models;

use app\modules\en\models\DBModel;
use Yii;

/**
 * This is the model class for table "{{%admin}}".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $phone
 * @property int $role 0:超级管理员，1：子账户
 * @property int $status
 * @property string $create_time
 * @property string $update_time
 */
class Admin extends DBModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%admin}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role', 'times', 'status'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['username'], 'string', 'max' => 30],
            [['password', 'phone'], 'string', 'max' => 50],
            [['auth_key'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'phone' => 'Phone',
            'role' => 'Role',
            'times' => 'Times',
            'status' => 'Status',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'auth_key' => 'Auth Key',
        ];
    }
}
