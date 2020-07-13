<?php
/**
 * Created by PhpStorm.
 * User: jun
 * Date: 2019/3/19
 * Time: 上午12:23
 */

namespace app\common\helpers;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class GuzzleHelper {
    /**
     * @param $url
     * @param $data
     * @param array $headers
     * @param string $type
     * @return mixed
     * @throws \Exception
     */
    public static function post($url, $data, $headers = [], $type = 'json'){
        $client = new Client();
        try{
            if($type === 'json'){
                $data = [
                    'headers' => $headers,
                    'json' => $data
                ];
            }else{
                $data = [
                    'headers' => $headers,
                    'body' => $data
                ];
            }
            $response = $client->post($url, $data);
            $response_code = $response->getStatusCode();
            $ret = \GuzzleHttp\json_decode($response->getBody()->getContents(), true);
            return $ret;
        }catch (RequestException $e){
            throw new \Exception($e->getMessage());
        }
    }

}