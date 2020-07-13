<?php

return [
    'adminEmail' => 'admin@example.com',
    'wechat' => [
        'WECHAT_OPEN_URL' => '',
        'wechat_open_pay' => '',
        'WECHAT_DEBUG' => true,
        'WECHAT_APP_KEY' => '',
        'WECHAT_APP_SECRET' => '',
        'WECHAT_APP_TOKEN' => '',
        'WECHAT_AES_KEY' => null,

        // 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
        'response_type' => 'array',
    ],
    'qiniu' => [
        'app_key' => '',
        'app_secret' => '',
        'bucket' => '',
        'domain' => ''
    ],
    'sms' => [
        'app_id' => '',
        'app_key' => '',
        'sign' => '',
        'template' => [
            'login' => '',
            'reserve' => ''
        ]
    ]
];
