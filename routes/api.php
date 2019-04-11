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
    // 短信验证码
    $api->post('verificationCodes', 'VerificationCodesController@store')
        ->name('api.verificationCodes.store');
});
