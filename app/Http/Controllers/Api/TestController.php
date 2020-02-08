<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class TestController extends Controller{
    public function sign()
    {
        //验签
        $data = "hello";
        $key = '1905';

        //计算签名
        $sign = md5($data . $key);

        echo '数据:'.$data;
        echo '<br>';
        echo '签名:'.$sign;

        //发送数据
        $url = 'http://1905passport.com/test/sign?data='.$data.'&sign='.$sign;

        $res = file_get_contents($url);
        echo $res;
        echo '<hr>';
    }

    public function sign2()
    {
        $key = "ljx";

        //签名数据
        $data = [
            'user_id'=>rand(11111,99999),
            'name'=>'zhangsan',
            'pwd'=>'123'
        ];

        $data_json = json_encode($data);

        //计算签名
        $sign = md5($data_json.$key);

        //post验签
        $client = new Client();
        $url = "http://1905passport.com/test/sign2";
        $res = $client->request('POST',$url,[
            "form_params"=>[
                "data"=>$data_json,
                "sign"=>$sign
            ]
        ]);

        $res_data = $res->getBody();
        echo $res_data;
    }

    public function key_sign()
    {
        $data = 'hello';

        //使用私钥加密
        $priv_key = storage_path('keys/priv.key');
        $pkeyid = openssl_pkey_get_private("file://" . $priv_key);
        openssl_sign($data, $signature, $pkeyid);
        openssl_free_key($pkeyid);
        //base64编码签名

        $sign = base64_encode($signature);
        echo '签名：' . $sign;
        echo '<br>';

        $url = "http://1905passport.com/test/sign3?" . 'data=' . $data . '&sign=' . urlencode($sign);
        echo $url;
    }

    public function encrypt()
    {
        $data = 'hello word';

        $method = "AES-256-CBC";
        $key = "1905api";
        $iv = "WUSD8796IDjhkchd";

        $enc_data = openssl_encrypt($data, $method, $key, OPENSSL_RAW_DATA, $iv);
        echo '加密：' . $enc_data;
        echo "<br>";
        //发送加密数据
        $url = "http://1905passport.com/test/decrypt?data=" . urlencode(base64_encode($enc_data));
        $res = file_get_contents($url);
        echo $res;
    }
}
