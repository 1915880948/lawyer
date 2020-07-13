<?php

namespace app\modules\en\models;

use Yii;

/**
 * This is the model class for table "career".
 *
 * @property int $id
 * @property string $content
 * @property string $time
 */
class Career extends DBModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'career';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
            'time' => 'Time',
        ];
    }
}
