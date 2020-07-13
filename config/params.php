<?php

use yii\helpers\ArrayHelper;

$params = [
    'adminEmail' => 'admin@example.com',
    'wechat'     => [
        'WECHAT_OPEN_URL'   => 'http://wechat.open.hivct.com',
        'wechat_open_pay'   => 'http://wechat.open.hivct.com/pay/',
        'WECHAT_DEBUG'      => true,
        'WECHAT_APP_KEY'    => 'wx6ae2594ba50776b1',
        'WECHAT_APP_SECRET' => '7af031a9e0ca7bee7cd3bca5000ed6fb',
        'WECHAT_APP_TOKEN'  => 'survey.hivct.com',
        'WECHAT_AES_KEY'    => null,

        'Weixin_Payment'     => '1290330301',
        'Weixin_Payment_key' => 'fcd1b113f3f5a66dd6005a24f2b1ea4a',

        // 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
        'response_type'      => 'array',
    ],
    'qiniu' =>[
        'domain' => 'http://web.cdn.athenaca.com/',
        'accessKey' => 'fnBP25AxCvrMeHVCYK_LWh8PwarBZwC01ow1paPi',
        'secretKey' => 'J8w5ENvT3DouOS_OEWO6Q75aa_eOCnsE5Cz1gbtd',
        'bucket' => 'athenaca'
    ],
    'sms'        => [
        'app_id'   => '1400185492',
        'app_key'  => 'ac98fb025c186a53ef86617831490702',
        'sign'     => '爱易检',
        'template' => [
            'login'   => '287147',
            'reserve' => '282050'
        ]
    ]
];

if(file_exists(__DIR__ . "/params-local.php")){
    $params = ArrayHelper::getValue($params, (array) require __DIR__ . "/params-local.php");
}
return $params;
