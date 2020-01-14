<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Common extends Model
{
    public static function curlPost($url, $data)
    {
        //初始化
        $ch = curl_init();

        //设置请求参数
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        //开启会话
        $response = curl_exec($ch);

        //获取错误信息
        $error = curl_error($ch);
        if($error){
            var_dump($error);
        }
        //关闭会话
        curl_close($ch);

        return json_decode($response,true);
    }

    public static function curlGet($url,$header)
    {
        //初始化
        $ch = curl_init();

        //设置请求参数
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$header);

        //开启会话
        $response = curl_exec($ch);

        //获取错误信息
        $error = curl_error($ch);
        if($error){
            var_dump($error);
        }
        //关闭会话
        curl_close($ch);

        return json_decode($response,true);
    }
}
