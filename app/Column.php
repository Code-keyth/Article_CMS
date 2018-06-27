<?php
/**
 * Created by PhpStorm.
 * User: keyth
 * Date: 18-6-23
 * Time: 下午4:36
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    protected $table='Column';
    public $timestamps = false;
    public function getColumn($id){

        $column=self::find($id);
        return $column->title;
    }
    public function article()
    {
        return $this->hasMany('App\Article','title_id');
    }

}