<?php

namespace App\Http\Middleware;

use App\Model\ApiUser;
use Closure;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redis;

class Token
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        print_r($_SERVER);die;
        //要求用户 传token
        $token = $_SERVER['HTTP_TOKEN'];
        $user_id = $_SERVER['HTTP_UID'];
        if(empty($token) || empty($user_id)){
            echo json_encode(['mag'=>'对不起，您没有登陆','error'=>'203'],JSON_UNESCAPED_UNICODE);
            die;
        }

        //鉴权
        $url = "1905passport.com/user/auth";

        $client = new Client();

        $response = $client->request('post',$url,[
            'form_params'=>['token'=>$token,'user_id'=>$user_id]
        ]);

        $json_data = $response->getBody();
        dd($json_data);
        $info = json_decode($json_data,true);

        if($info['error']){
            echo '错误信息：'.$info['msg'];
        }
        echo '个人中心';


        return $next($request);
    }
}
