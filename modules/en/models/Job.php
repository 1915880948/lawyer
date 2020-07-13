<?php

namespace app\modules\en\models;

use Yii;

/**
 * This is the model class for table "{{%job}}".
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $targent
 * @property string $duty
 * @property string $require
 * @property string $other
 * @property string $email
 * @property int $sort
 * @property int $shelf_status
 * @property int $status
 * @property string $create_time
 */
class Job extends DBModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%job}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['targent', 'duty', 'require'], 'string'],
            [['sort', 'shelf_status', 'status'], 'integer'],
            [['create_time'], 'safe'],
            [['name', 'address', 'email'], 'string', 'max' => 50],
            [['other'], 'string', 'max' => 300],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'address' => 'Address',
            'targent' => 'Targent',
            'duty' => 'Duty',
            'require' => 'Require',
            'other' => 'Other',
            'email' => 'Email',
            'sort' => 'Sort',
            'shelf_status' => 'Shelf Status',
            'status' => 'Status',
            'create_time' => 'Create Time',
        ];
    }
}
