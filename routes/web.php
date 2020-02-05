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


Route::prefix('/')->middleware('Token')->group(function () {
    Route::post('/b', 'TestController@b');
});

Route::post('api/test', 'TestController@test');
