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

Route::prefix('/')->namespace('Home')->group(function (){
    Route::get('/','PostController@index');
    Route::get('/posts/{post}/delete','PostController@delete');
    Route::post('/posts/{post}/comment','PostController@comment');
    Route::get('/posts/{post}/zan','PostController@zan');
    Route::get('/posts/{post}/cancel','PostController@cancel');



    Route::resource('/posts','PostController');

    Route::get('/register','RegisterController@index');
    Route::post('/register','RegisterController@register');
    Route::get('/login','LoginController@index');
    Route::post('/login','LoginController@dologin');
    Route::get('/logout','LoginController@logout');

    Route::get('/user/{user}/setting','UserController@index');
//个人主页
    Route::get('/user/{user}', 'UserController@show');

    Route::post('/user/{user}/fan', 'UserController@fan');
    Route::post('/user/{user}/unfan', 'UserController@unfan');




    Route::post('/user/{user}/setting','UserController@setting');

    Route::get('/topic/{topic}', 'TopicController@show');
    Route::post('/topic/{topic}','TopicController@submit');



});
