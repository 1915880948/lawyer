<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%news}}".
 *
 * @property int $id
 * @property string $title
 * @property string $img_url
 * @property string $desc
 * @property string $content
 * @property string $time
 * @property int $sort
 * @property int $shelf_status
 * @property int $status
 * @property string $create_time
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%news}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['sort', 'shelf_status', 'status'], 'integer'],
            [['create_time'], 'safe'],
            [['title', 'img_url', 'desc'], 'string', 'max' => 100],
            [['time'], 'string', 'max' => 20],
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
            'desc' => 'Desc',
            'content' => 'Content',
            'time' => 'Time',
            'sort' => 'Sort',
            'shelf_status' => 'Shelf Status',
            'status' => 'Status',
            'create_time' => 'Create Time',
        ];
    }
}
