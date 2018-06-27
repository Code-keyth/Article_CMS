<?php
/**
 * Created by PhpStorm.
 * User: keyth
 * Date: 18-6-23
 * Time: 下午4:38
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table='Article';
    public function getColumn($id){
        $column=Column::find($id);
        return $column->title;
    }
}