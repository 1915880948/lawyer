<?php
/**
 * Created by PhpStorm.
 * User: jun
 * Date: 2019/3/19
 * Time: 上午12:12
 */

namespace app\common\helpers;


use Yii;

class SmsHelper {
    /**
     * @param $phone
     * @param $params
     * @param $template
     * @throws \Exception
     */
    public static function sendCode($phone, $params, $template) {
        $config = Yii::$app->params['sms'];
        $random = mt_rand(100000, 999999);
        $time = time();
        $sig = hash('sha256', "appkey={$config['app_key']}&random=$random&time=$time&mobile=$phone");
        $post = [
            "ext"    => "",
            "extend" => "",
            "params" => $params,
            "sig"    => $sig,
            "sign"   => $config['sign'],
            "tel"    => [
                "mobile"     => $phone,
                "nationcode" => "86"
            ],
            "time"   => $time,
            "tpl_id" => $config['template'][$template]
        ];
        $url = "https://yun.tim.qq.com/v5/tlssmssvr/sendsms?sdkappid={$config['app_id']}&random=$random";
        $ret = GuzzleHelper::post($url, $post);
        Yii::error($ret);
    }

}