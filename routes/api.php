<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// 以下接口需要识别用户登陆态，因此添加api认证中间件
Route::group(['middleware' => 'auth:api'], function () {
    // 视频解析接口
    Route::post('video-parse', 'VideoParseController@parse')->name('video.parse');
// 当前用户解析记录总数
    Route::get('records/total', 'RecordController@getTotalNum');
 // 当前用户解析记录列表接口
    Route::resource('records', 'RecordController');
});

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    Route::post('login', 'LoginController@login')->name('login');
    Route::post('logout', 'LoginController@logout')->name('logout');
});

Route::group([], function () {
    Route::post('log/notice', 'RecordController@notice');
});


