<?php

namespace app\modules\en\models;

use Yii;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property int $id
 * @property int $is_experience 是否是体验产品
 * @property string $title
 * @property string $title2
 * @property string $img_url
 * @property string $desc
 * @property int $sort
 * @property int $is_top 是否置顶
 * @property int $shelf_status
 * @property int $status
 * @property string $create_time
 */
class Product extends DBModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_experience', 'sort', 'is_top', 'shelf_status', 'status'], 'integer'],
            [['create_time'], 'safe'],
            [['title', 'title2'], 'string', 'max' => 50],
            [['img_url', 'desc'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'is_experience' => 'Is Experience',
            'title' => 'Title',
            'title2' => 'Title2',
            'img_url' => 'Img Url',
            'desc' => 'Desc',
            'sort' => 'Sort',
            'is_top' => 'Is Top',
            'shelf_status' => 'Shelf Status',
            'status' => 'Status',
            'create_time' => 'Create Time',
        ];
    }
}
