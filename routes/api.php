<?php

use Illuminate\Http\Request;


$api = app('Dingo\Api\Routing\Router'); //用於註冊dingo路由

$api->version('v1', function($api) {  //定義第一版本
    $api->get('/hi', function() {      //定義當路由為http://laravel.test/api/hi時執行
        return response('this is version v1');
    });
});

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api'    //我們增加了一個參數namespace，使v1版本的路由都會指向App\Http\Controllers\Api，方便我們書寫路由。
], function($api) {
    $api->group([  //限制API調用次數
        'middleware' => 'api.throttle',
        'limit' => config('api.rate_limits.sign.limit'),  //數值寫於config/api裡面
        'expires' => config('api.rate_limits.sign.expires'),
        ] , function($api) {
    // 短信验证码
    $api->post('verificationCodes', 'VerificationCodesController@store') //若沒設定NAMESPACE的話這裡要App\Http\Controllers\Api\VerificationCodesController@store
        ->name('api.verificationCodes.store');
    // 用户注册
    $api->post('users', 'UsersController@store')
        ->name('api.users.store');
    // 图片验证码
    $api->post('captchas', 'CaptchasController@store')
        ->name('api.captchas.store');

        });
});
