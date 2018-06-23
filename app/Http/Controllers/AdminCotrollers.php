<?php
/**
 * Created by PhpStorm.
 * User: keyth
 * Date: 18-6-22
 * Time: 下午8:33
 */

namespace App\Http\Controllers;


class AdminCotrollers
{
    public function index(){
        return view('Admin/Index');
    }
    public function welcome(){
        return view('Admin/Welcome');
    }
    public function Article(){
        return view('Admin/ArticleList');
    }
    public function ArticleAdd(){
        return view('Admin/ArticleAdd');
    }
    public function ArticleDel(){

    }


    public function Column(){
        return view('Admin/ColumnList');
    }
    public function ColumnAdd(){
        return view('Admin/ColumnAdd');
    }
    public function ColumnDel(){

    }

}