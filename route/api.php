<?php
use think\facade\Route;

Route::group('api', function () {
    Route::group('v1', function () {
        Route::group('parse', function () {
            Route::get('get_file_list', '\\app\\controller\\Parse@getFileList');
            //TODO: apikey
            Route::get('parse_file', '\\app\\controller\\Parse@parseFile');
        })->middleware('parse');
    });
    //管理员系统
    //需要校验登录，中间件完成
    Route::group('admin', function () {
        // 认证与登录
        Route::group('auth', function () {
            Route::post('login', '\\app\\controller\\Admin@login');
        });
        // API密钥管理
        Route::group('api_keys', function () {
            Route::get('generate', '\\app\\controller\\Admin@generateApiKey');
            Route::get('', '\\app\\controller\\Admin@getApiKey');
        })->middleware(['auth']);
        // SVIP管理
        Route::group('svips', function () {
            Route::post('add', '\\app\\controller\\Admin@addSvip');
            Route::post('delete', '\\app\\controller\\Admin@deleteSvip');
            Route::post('update', '\\app\\controller\\Admin@updateSvip');
            Route::get('list', '\\app\\controller\\Admin@getSvipList');
        })->middleware(['auth']);
        Route::group('notices', function () {
            Route::get('all', '\\app\\controller\\Admin@getAllNotice');
            Route::post('add', '\\app\\controller\\Admin@addNotice');
            Route::post('update', '\\app\\controller\\Admin@updateNotice');
            Route::post('delete', '\\app\\controller\\Admin@deleteNotice');
            Route::post('use', '\\app\\controller\\Admin@useNotice');
        })->middleware(['auth']);
        Route::group('systems', function () {
            Route::get('all', '\\app\\controller\\Admin@getAllSystem');
            Route::post('add', '\\app\\controller\\Admin@addSystem');
            Route::post('update', '\\app\\controller\\Admin@updateSystem');
            Route::post('delete', '\\app\\controller\\Admin@deleteSystem');
            Route::post('use', '\\app\\controller\\Admin@useSystem');
        })->middleware(['auth']);
    });
    //公共接口
    Route::group('public', function () {
        //TODO: 后台统计
        Route::get('get_status', '\\app\\controller\\Common@getStatus');
        Route::get('get_system', '\\app\\controller\\Common@getSystem');
        Route::get('get_notice', '\\app\\controller\\Common@getNotice');
        Route::get('get_parse_key', '\\app\\controller\\Common@getParseKey');
        Route::get('use_parse_key', '\\app\\controller\\Common@useParseKey');
    });
    Route::group('web_api', function () {
        Route::get('get_qrcode', '\\app\\controller\\WebApi@getQrcode');
        Route::get('unicast', '\\app\\controller\\WebApi@unicast');
        Route::get('qrcode_login', '\\app\\controller\\WebApi@qrcodeLogin');
    });
});
Route::post('install', '\\app\\controller\\Install@index');
Route::miss('\\app\\controller\\Error@index');