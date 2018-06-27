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

Route::group(['middleware' => ['AdminLogin']], function () {
    Route::get('/admin', 'AdminController@index');
    Route::get('/admin/welcome', 'AdminController@welcome');
    Route::get('/admin/Column', 'AdminController@Column');
    Route::get('/admin/Column/add', 'AdminController@ColumnAdd');
    Route::post('/admin/Column/add', 'AdminController@ColumnAdd_C');
    Route::get('/admin/Column/del', 'AdminController@ColumnDel');
    Route::get('/admin/Article', 'AdminController@Article');
    Route::get('/admin/Article/add', 'AdminController@ArticleAdd');
    Route::post('/admin/Article/add', 'AdminController@ArticleAdd_C');
    Route::get('/admin/Article/del', 'AdminController@ArticleDel');
    Route::get('/admin/Article/Recycle', 'AdminController@ArticleRecycle');
    Route::get('/admin/Article/Recycle_c', 'AdminController@ArticleRecycle_c');
    Route::post('/admin/Article/upload', 'AdminController@Articleupload');
});

//登录模块
Route::get('/admin/login','LoginController@index');
Route::post('/admin/login','LoginController@login');
Route::get('/admin/logout','LoginController@logout');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
