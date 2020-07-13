<?php
/**
 * Created by PhpStorm.
 * User: jun
 * Date: 2019/3/10
 * Time: 下午3:25
 */

namespace app\common\helpers;


use EasyWeChat\Foundation\Application;
use Yii;

class WechatHelper {
    const WECHAT_TOKEN_CACHE_KEY = 'cache:wechat_token';

    /**
     * @return Application
     */
    public static function getApp() {
        $weixin = new Application(self::getOptions());
        self::getAccessToken($weixin);
        return $weixin;
    }

    private static function getOptions() {
        $config = Yii::$app->params['wechat'];
        return [
            'debug'       => $config['WECHAT_DEBUG'],
            'app_id'      => $config['WECHAT_APP_KEY'],
            'secret'      => $config['WECHAT_APP_SECRET'],
            'token'       => $config['WECHAT_APP_TOKEN'],
            'aes_key'     => $config['WECHAT_AES_KEY'], // ]选
            'log'         => [
                'level' => 'debug',
                'file'  => \Yii::getAlias('@runtime') . '/easywechat_survey.hivct.org.log', // XXX: 绝对路径！！！！
            ],
            'payment' => [
                'merchant_id' =>  $config['Weixin_Payment'],
                'key'         =>  $config['Weixin_Payment_key'],
                // 如需使用敏感接口（如退款、发送红包等）需要配置 API 证书路径(登录商户平台下载 API 证书)
                'cert_path'          => \Yii::getAlias('@cert'), // XXX: 绝对路径！！！！
                'key_path'           => \Yii::getAlias('@key'),      // XXX: 绝对路径！！！！

            ],
            'guzzle'      => [
                'timeout' => 30,
            ],
            'max_retries' => 3

        ];
    }

    /**
     * @param $weixin
     * @return mixed
     * @throws \EasyWeChat\Core\Exceptions\HttpException
     */
    private static function getAccessToken($weixin) {
        if($weixin === null || !($weixin instanceof Application)){
            $weixin = new Application(self::getOptions());
        }

        $wxToken = \Yii::$app->cache->get(self::WECHAT_TOKEN_CACHE_KEY);
        if(!$wxToken || (time() > $wxToken['expires_in'])){//获取
            $wxToken = $weixin->access_token->getTokenFromServer();
            Yii::error($wxToken);
            $wxToken['expires_in'] = time() + $wxToken['expires_in'] - 1200;
            \Yii::$app->cache->set(self::WECHAT_TOKEN_CACHE_KEY, $wxToken);
        }
        $weixin->access_token->setToken($wxToken['access_token']);
        return $wxToken['access_token'];
    }


}