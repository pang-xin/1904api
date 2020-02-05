<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;

class ApiHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $_SERVER['HTTP_TOKEN'];
        if(isset($token)){
            $current_url=$_SERVER['REQUEST_URI'];
            $redis_key='str:count:u:'.$token.':url:'.md5($current_url);

            $count=Redis::get($redis_key);
            if($count > 10){
                $time = 60;
                echo json_encode(['msg'=>'访问次数已上限，请停'.$time.'秒在试','error'=>203],JSON_UNESCAPED_UNICODE);
                Redis::expire($redis_key,60);
                die;
            }

            Redis::incr($redis_key);
        }else{
            echo json_encode(['msg'=>'token不能为空','error'=>201],JSON_UNESCAPED_UNICODE);
        }

        return $next($request);
    }
}
