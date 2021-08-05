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

//Route::get('/', function () {
//    return view('welcome');
//});

//用户添加路由
Route::get('user/add','UserController@add');
//用户执行添加路由
Route::post('user/store','UserController@store');
//用户列表页路由
Route::get('user/index','UserController@index');
//用户修改路由
Route::get('user/edit/{id}','UserController@edit');
//
Route::post('user/update','UserController@update');
//用户删除路由
Route::get('user/del/{id}','UserController@destroy');




Route::group(['prefix'=>'admin','namespace'=>'admin'],function (){
    //后台登录路由
    Route::get('login','LoginController@login');

    Route::post('dologin','LoginController@dologin');
    //加密算法路由
    Route::get('jiami','LoginController@jiami');

});

//验证码路由
Route::get('/code/captcha/{tmp}','admin\LoginController@captcha');


Route::group(['prefix'=>'admin','namespace'=>'admin','middleware'=>'islogin'],function (){
    //后台首页路由
    Route::get('index','LoginController@index');
    //后台欢迎页路由
    Route::get('welcome','LoginController@welcome');
    //后台退出登录路由
    Route::get('logout','LoginController@logout');
});



