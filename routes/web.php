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

/*
 * 练手用的,与UserController.php.bak对应
 *
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
*/



Route::group(['prefix'=>'admin','namespace'=>'admin'],function (){
    //后台登录路由
    Route::get('login','LoginController@login');

    Route::post('dologin','LoginController@dologin');
    //加密算法路由
    Route::get('jiami','LoginController@jiami');

});

//验证码路由
Route::get('/code/captcha/{tmp}','admin\LoginController@captcha');


Route::get('noaccess','admin\LoginController@noaccess');

Route::group(['prefix'=>'admin','namespace'=>'admin','middleware'=>['hasRole','isLogin']],function (){

    //后台首页路由
    Route::get('index','LoginController@index');
    //后台欢迎页路由
    Route::get('welcome','LoginController@welcome');
    //后台退出登录路由
    Route::get('logout','LoginController@logout');


    //后台用户模块相关路由
    \Illuminate\Support\Facades\Route::post('/user/del','UserController@delAll');
    \Illuminate\Support\Facades\Route::resource('user','UserController');
    Route::get('user/auth/{id}','UserController@auth');
    Route::post('user/doauth','UserController@doAuth');


    //角色模块
    //角色授权路由
    \Illuminate\Support\Facades\Route::post('/role/del','RoleController@delAll');
    Route::get('role/auth/{id}','RoleController@auth');
    Route::post('role/doauth','RoleController@doAuth');
    \Illuminate\Support\Facades\Route::resource('role','RoleController');


    //权限模块
    \Illuminate\Support\Facades\Route::post('permission/del','PermissionController@delAll');
    \Illuminate\Support\Facades\Route::resource('permission','PermissionController');

    //分类路由
    //修改排序
    Route::post('cate/changeorder','CateController@changeOrder');
    \Illuminate\Support\Facades\Route::resource('cate','CateController');

    //文章模块路由
    //上传路由
    Route::post('article/upload','ArticleController@upload');
    Route::resource('article','ArticleController');

    //网站配置模块路由
    Route::post('config/changecontent','ConfigController@changeContent');
    Route::get('config/putcontent','ConfigController@putContent');
    Route::resource('config','ConfigController');

});