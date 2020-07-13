<?php
/**
 * Created by PhpStorm.
 * User: jun
 * Date: 2018/7/10
 * Time: 上午11:44
 */

namespace app\common\helpers;


class AttributeHelper {
    public static function filter($attributes, $filterArray = null){
        if(!$filterArray){
            $filterArray = ['id', 'create_time','status'];
        }
        foreach ($attributes as $key=>$list){
            if(in_array($list, $filterArray)){
                unset($attributes[$key]);
            }
        }
        return array_merge($attributes, []);
    }

}