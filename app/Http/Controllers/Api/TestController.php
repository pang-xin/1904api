<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Common;
use Illuminate\Http\Request;
use App\Model\User;
use Illuminate\Support\Facades\Redis;

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
}
