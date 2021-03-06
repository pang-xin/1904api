<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('alipay/test','TestController@alipay');

Route::get('/test/alipay/return','Alipay\PayController@aliReturn');
Route::post('/test/alipay/notify','Alipay\PayController@notify');

Route::prefix('/api')->middleware('Token')->group(function () {
    Route::get('/sign1', 'TestController@sign1');
});

Route::post('api/login', 'Api\ApiController@login');
Route::post('api/reg', 'Api\ApiController@reg');
Route::get('api/getData', 'Api\ApiController@getData');


Route::prefix('/')->middleware('ApiHeader','Token')->group(function () {
    Route::post('/b', 'TestController@b');//防刷测试
});

Route::post('api/test', 'TestController@test');


Route::get('test/sign', 'Api\TestController@sign');//签名
Route::get('test/sign2', 'Api\TestController@sign2');//post签名
Route::get('test/sign3', 'Api\TestController@key_sign');//公钥签名

Route::get('test/encrypt', 'Api\TestController@encrypt');//对称加密
Route::get('test/encrypt2', 'Api\TestController@key_encrypt');//非对称加密

