<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest'], function () {
      Route::get('/', 'App\Http\Controllers\LoginController@index')->name('index');

      Route::group(['middleware' => 'ajax'], function () {
            Route::post('/login', 'App\Http\Controllers\LoginController@login')->name('login');
            Route::post('/forgpass', 'App\Http\Controllers\LoginController@forgpass')->name('forgpass');

      });
});

Route::group(['middleware' => 'auth', 'prefix' => '/account'], function () {
      Route::get('/', 'App\Http\Controllers\AccountController@index')->name('account');
      Route::get('/logout', 'App\Http\Controllers\LoginController@logout')->name('logout');
      Route::get('/presentations', 'App\Http\Controllers\AccountController@presentations')->name('presentations');

      Route::get('/educations', 'App\Http\Controllers\AccountController@educations')->name('educations');
      Route::get('/questions/{id}', 'App\Http\Controllers\AccountController@questions')->name('questions');

      Route::get('/questions/json/{id}', 'App\Http\Controllers\AccountController@questionsajax')->name('questionsajax');
      
      Route::group(['middleware' => 'ajax'], function () {
            Route::get('/notify/json/{id}', 'App\Http\Controllers\AccountController@notificationsajax')->name('notificationsajax');
      });

      Route::group(['prefix' => '/list', 'as' => 'modal.'], function () {
            Route::get('/posm', 'App\Http\Controllers\ModalController@showleaders')->name('leaders');

        });
      // Route::get('/presentations', 'App\Http\Controllers\UsersTaskController@index')->name('index');


      Route::group(['prefix' => 'consumer', 'as' => 'consumer.'], function () {
            Route::get('/language', 'App\Http\Controllers\ConsumerController@language')->name('language');
            Route::get('/language/{locale}', 'App\Http\Controllers\ConsumerController@setlocale')->name('setlocale');
            Route::get('/registration', 'App\Http\Controllers\ConsumerController@registration')->name('registration_view');
            Route::get('/verify', 'App\Http\Controllers\ConsumerController@sms_view')->name('sms_view');
            
            Route::get('/qest/{level}', 'App\Http\Controllers\ConsumerController@qest_view')->name('qest_view');
            Route::get('/wheel', 'App\Http\Controllers\WheelController@index')->name('wheel_view');
            Route::get('/wheel/json', 'App\Http\Controllers\WheelController@wheel_ajax')->name('wheel_ajax');
            Route::post('/wheel/json', 'App\Http\Controllers\WheelController@wheel_ajax_post')->name('wheel_ajax_post');


            Route::group(['middleware' => 'ajax'], function () {
                  Route::post('/registration/check', 'App\Http\Controllers\ConsumerController@registration_check')->name('check');
                  Route::post('/verify/reset', 'App\Http\Controllers\ConsumerController@sms_reset')->name('sms_reset');
                  Route::post('/verify/check', 'App\Http\Controllers\ConsumerController@sms_check')->name('sms_check');
            });
      });
});
