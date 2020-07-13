<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%active}}".
 *
 * @property int $id
 * @property string $title
 * @property string $img_url
 * @property int $sort
 * @property int $shelf_status
 * @property int $status
 * @property string $create_time
 */
class Active extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%active}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sort', 'shelf_status', 'status'], 'integer'],
            [['create_time'], 'safe'],
            [['title', 'img_url'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'img_url' => 'Img Url',
            'sort' => 'Sort',
            'shelf_status' => 'Shelf Status',
            'status' => 'Status',
            'create_time' => 'Create Time',
        ];
    }
}
