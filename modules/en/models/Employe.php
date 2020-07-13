<?php

namespace app\modules\en\models;

use Yii;

/**
 * This is the model class for table "{{%employe}}".
 *
 * @property int $id
 * @property string $name
 * @property string $img_url
 * @property string $desc
 * @property int $sort
 * @property int $shelf_status
 * @property int $status
 * @property string $create_time
 */
class Employe extends DBModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%employe}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['desc'], 'string'],
            [['sort', 'shelf_status', 'status'], 'integer'],
            [['create_time'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['img_url'], 'string', 'max' => 100],
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
            'img_url' => 'Img Url',
            'desc' => 'Desc',
            'sort' => 'Sort',
            'shelf_status' => 'Shelf Status',
            'status' => 'Status',
            'create_time' => 'Create Time',
        ];
    }
}
