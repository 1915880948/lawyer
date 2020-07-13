<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%basic}}".
 *
 * @property int $id
 * @property string $brand_title 品牌
 * @property string $brand_title2
 * @property string $brand_desc
 * @property string $brand_url
 * @property string $strength_title 实力
 * @property string $strength_title2
 * @property string $strength_desc
 * @property string $strength_desc2
 * @property string $position_title 地位
 * @property string $position_title2
 * @property string $position_desc
 */
class Basic extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%basic}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['brand_title', 'brand_title2', 'brand_url', 'strength_title', 'strength_title2', 'position_title', 'position_title2'], 'string', 'max' => 100],
            [['brand_desc', 'strength_desc', 'strength_desc2', 'position_desc'], 'string', 'max' => 300],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'brand_title' => 'Brand Title',
            'brand_title2' => 'Brand Title2',
            'brand_desc' => 'Brand Desc',
            'brand_url' => 'Brand Url',
            'strength_title' => 'Strength Title',
            'strength_title2' => 'Strength Title2',
            'strength_desc' => 'Strength Desc',
            'strength_desc2' => 'Strength Desc2',
            'position_title' => 'Position Title',
            'position_title2' => 'Position Title2',
            'position_desc' => 'Position Desc',
        ];
    }
}
