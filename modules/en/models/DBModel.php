<?php
/**
 * Created by PhpStorm.
 * User: Daisy
 * Date: 2020-06-22
 * Time: 21:39
 */


namespace app\modules\en\models;


class DBModel extends \yii\db\ActiveRecord
{
    public static function getDb()
    {
        return \Yii::$app->db2;
    }

}
