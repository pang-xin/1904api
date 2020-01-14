<?php

namespace App\Http\Middleware;

use App\Model\ApiUser;
use Closure;
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
        //要求用户 传token
//        $token = request()->input('token');
//        if (empty($token)) {
//            echo json_encode(['find' => 'token不能为空', 'code' => '201'], JSON_UNESCAPED_UNICODE);
//            die;
//        }
//        //效验token(根据token查数据库)
//        $info = Redis::get('token');
//        if ($token != $info) {
//            echo json_encode(['find' => 'token有误', 'code' => '202'], JSON_UNESCAPED_UNICODE);
//            die;
//        }
//
////        $request['userData'] = $info;
//        return $next($request);
    }
}
