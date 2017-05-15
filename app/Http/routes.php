<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });




/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

//登录注册
Route::group(['middleware' => ['web','after.login'],'namespace'=>'Index'], function () {
    //index
    Route::get('/','IndexController@index');
    Route::get('/login','IndexController@login');
    Route::get('/regist','IndexController@regist');

    //do login/regist
    Route::post('/login','IndexController@login');    
    Route::post('/regist','IndexController@regist');

    // Route::get('/test','IndexController@test');

});





Route::group(['middleware' => ['web','before.login'],'namespace'=>'Main'], function () {
    // 登出
    Route::get('/logout',function(){
        session()->forget('login_user');
        return view('index.index');
    });
    
    // 展示数据   以及   更新数据
    Route::get('/main','MainController@index');
    Route::post('/main','MainController@up');
    //删除数据
    Route::get('/del','MainController@del');

    // 详情
    Route::get('/detail/{id}','DetailController@detail');
    Route::get('/test','MainController@test');
    // 添加留言
    Route::post('/detail/{id}','DetailController@leaveMessage');
    


    //查看所有blogs    
    Route::get('/allBlogs','AllController@index');
    Route::get('/allBlogs/{id}','AllController@author');
    

    
});
