<?php
/**
 * Created by PhpStorm.
 * User: jun
 * Date: 2019/3/19
 * Time: 下午5:44
 */

namespace app\common\helpers;


class CryptHelper {
    /**
     * from discuz
     * @param string $string 原文或者密文
     * @param string $operation 操作(ENCODE | DECODE), 默认为 DECODE
     * @param string $key 密钥
     * @param int    $expiry 密文有效期, 加密时候有效， 单位 秒，0 为永久有效
     * @param int    $ckey_length 指定key的长度，用于混淆和再加密
     * @return string 处理后的 原文或者 经过 base64_encode 处理后的密文
     * @example
     * $a = authcode('abc', 'ENCODE', 'key');
     * $b = authcode($a, 'DECODE', 'key');  // $b(abc)
     * $a = authcode('abc', 'ENCODE', 'key', 3600);
     * $b = authcode('abc', 'DECODE', 'key'); // 在一个小时内，$b(abc)，否则 $b 为空
     */
    static function authcode($string, $operation = 'DECODE', $key = '', $expiry = 3600, $ckey_length = 4) {

        // 随机密钥长度 取值 0-32;
        // 加入随机密钥，可以令密文无任何规律，即便是原文和密钥完全相同，加密结果也会每次不同，增大破解难度。
        // 取值越大，密文变动规律越大，密文变化 = 16 的 $ckey_length 次方
        // 当此值为 0 时，则不产生随机密钥
        $key = md5($key ? $key : 'key'); //这里可以填写默认key值
        $keya = md5(substr($key, 0, 16));
        $keyb = md5(substr($key, 16, 16));
        $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length) : substr(md5(microtime()), -$ckey_length)) : '';

        $cryptkey = $keya . md5($keya . $keyc);
        $key_length = strlen($cryptkey);

        $string = $operation == 'DECODE' ? self::safeBase64Decode(substr($string, $ckey_length))
            : sprintf('%010d', $expiry ? $expiry + time() : 0) . substr(md5($string . $keyb), 0, 16) . $string;
        $string_length = strlen($string);

        $result = '';
        $box = range(0, 255);

        $rndkey = [];
        for($i = 0; $i <= 255; $i++){
            $rndkey [$i] = ord($cryptkey [$i % $key_length]);
        }

        for($j = $i = 0; $i < 256; $i++){
            $j = ($j + $box [$i] + $rndkey [$i]) % 256;
            $tmp = $box [$i];
            $box [$i] = $box [$j];
            $box [$j] = $tmp;
        }

        for($a = $j = $i = 0; $i < $string_length; $i++){
            $a = ($a + 1) % 256;
            $j = ($j + $box [$a]) % 256;
            $tmp = $box [$a];
            $box [$a] = $box [$j];
            $box [$j] = $tmp;
            $result .= chr(ord($string [$i]) ^ ($box [($box [$a] + $box [$j]) % 256]));
        }

        if($operation == 'DECODE'){
            if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) &&
                substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16)){
                return substr($result, 26);
            } else{
                return '';
            }
        } else{
            return $keyc . self::safeBase64Encode($result);
        }
    }

    public static function safeBase64Encode($data) {
        $find = ['+', '/'];
        $replace = ['-', '_'];

        return rtrim(str_replace($find, $replace, base64_encode($data)), '=');
    }

}