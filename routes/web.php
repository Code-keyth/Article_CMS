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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/admin','AdminCotrollers@index');
Route::get('/admin/Column','AdminCotrollers@Column');
Route::get('/admin/Column/add','AdminCotrollers@ColumnAdd');
Route::get('/admin/Column/del','AdminCotrollers@ColumnDel');
Route::get('/admin/Article','AdminCotrollers@Article');
Route::get('/admin/Article/add','AdminCotrollers@ArticleAdd');
Route::get('/admin/Article/del','AdminCotrollers@ArticleDel');
