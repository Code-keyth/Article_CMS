<?php
/**
 * Created by PhpStorm.
 * User: keyth
 * Date: 18-6-22
 * Time: 下午8:33
 */

namespace App\Http\Controllers;


use App\Article;
use App\Column;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function index(){
        return view('Admin/Index');
    }
    public function welcome(){
        return view('Admin/Welcome');
    }
    public function Column(){
        $Column= new Column();
        $columns=$Column->where('state',0)->orderBy('weight','asc')->get();
        return view('Admin/ColumnList',['columns'=>$columns]);
    }
    public function ColumnAdd(Request $request){
        $getid=$request->get('id');
        $Column=new Column();

        if(!empty($request->get('id')||$request->get('id')===0)){
            $Column=$Column->find($getid);
            $columns=$Column->where([['mod_id','<>',1],['top_id','=',0],['id','<>',$getid]])->get();
        }else{
            $Column->title='';
            $Column->weight='';
            $Column->content='';
            $Column->mod_id=0;
            $Column->top_id=0;
            $columns=$Column->where([['mod_id','<>',1],['top_id','=',0]])->get();
        }
        return view('Admin/ColumnAdd',['Column'=>$Column,'columns'=>$columns]);
    }
    public function ColumnAdd_C(Request $request){
        $postdata=$request->post();
        if(!empty($postdata['id'])){
            $column=Column::find($postdata['id']);
            $operation='更新';
        }else{
            $column=new Column();
            $operation='添加';
        }
        $column->title=$postdata['title'];
        $column->weight=$postdata['weight'];
        $column->mod_id=$postdata['mod_id'];
        if(!empty($postdata['top_id'])){
            $column->top_id=$postdata['top_id'];
        }
        if(!empty($postdata['content'])){
            $column->content=$postdata['content'];
        }
        $state=$column->save();
        if($state){
            $remind='成功！';
        }else{
            $remind='失败！';
        }
        return $this->alertjs($operation.$remind,'/admin/Column/add');
    }
    /**
     *@rutuen -1--不存在 0--成功 1--删除失败 2--拥有子栏目不能被删除
     *
    **/
    public function ColumnDel(Request $request){
        $getid=$request->get('id');

        $column=Column::find($getid);
        if(!$column){
            $state= -1;
        }else{
            $lowers=Column::where('top_id',$column->id)->get();
            if($lowers->first()){
                $state= 2;
            }else{
                $artis=$column->article;
                foreach ($artis as $item){
                    Article::where('id',$item->id)->update(['state' => 1,'title_id'=>0]);
                }
                $column->state=-1;
                if($column->save()){
                    $state= 0;
                }else{
                    $state= 1;
                }
            }
        }
        return $state;
    }
    public function Article(){
        $Article=new Article();
        $articles=$Article->where('state','=',0)->orderBy('updated_at','decs')->paginate(15);
        return view('Admin/ArticleList',['articles'=>$articles]);
    }
    public function ArticleAdd(Request $request){
        $getid=$request->id;
        if(!empty($getid)){
            $Article=Article::find($getid);
        }else{
            $Article=new Article();
            $Article->id='';
            $Article->title='';
            $Article->title_id='';
            $Article->author='';
            $Article->content='';
            $Article->weight='';
            $Article->thumbnail='';
        }
        $Column=new Column();
        $columns=$Column->where('mod_id','=',3)->get();
        return view('Admin/ArticleAdd',['columns'=>$columns,'Article'=>$Article]);
    }
    public function ArticleAdd_C(Request $request){
        $postdata=$request->post();
        if(!empty($postdata['id'])){
            $article=Article::find($postdata['id']);
            $operation='更新';
        }else{
            $article=new Article();
            $operation='添加';
        }
//        dump($postdata);
//        $img = $request->file('test123');
//        // 获取后缀名
//        $ext = $img->extension();
////        // 新文件名
////        $saveName =time().rand().".".$ext;
////        $path = $img->store(date('Ymd'));
////        $aa=back()->withInput(['url'=>'upload/'.$path]);


        $path = $request->file('test123')->store('test123');

        return $path;
//        dump($img);
//        return 1;


        $article->title=$postdata['title'];
        $article->weight=$postdata['weight'];
        $article->title_id=$postdata['title_id'];
        $article->content=$postdata['content'];
        $article->click=$postdata['click'];
        if(!empty($postdata['thumbnail'])){
            $article->thumbnail=$postdata['thumbnail'];
            $article->is_img=1;
        }
        $article->author=$postdata['author'];

        $state=$article->save();
        if($state){
            $remind='成功！';
        }else{
            $remind='失败！';
        }
        return $this->alertjs($operation.$remind,'/admin/Article/add');
    }

    public function ArticleDel(Request $request){
        $getid=$request->get('id');
        $Article=Article::find($getid);
        if(!$Article){
            $state= -1;
        }else{
            $Article->state=1;
            if($Article->save()){
                $state= 0;
            }else{
                $state= 1;
            }
        }
        return $state;

    }

    public function ArticleRecycle(){
        $Article=new Article();
        $articles=$Article->where('state','=',1)->orderBy('updated_at','decs')->paginate(15);
        $Column=new Column();
        $columns=$Column->where('mod_id','=',3)->get();
        return view('Admin/ArticleRecycle',['articles'=>$articles,'columns'=>$columns]);
    }
    public function ArticleRecycle_c(Request $request){
        if(empty($request->id)||$request->column){
            $article=Article::find($request->id);
            $article->title_id=$request->column;
            $article->state=0;
            if($article->save()){
                return 0;
            }
        }
        return 1;
    }
    public function Articleupload(Request $request){
        if(!$request->hasFile('img')){
            $request->session()->flash('error_msg','文件不存在');
            return back();
        }
        $img = $request->file('test1');
        // 获取后缀名
        $ext = $img->extension();
        // 新文件名
        $saveName =time().rand().".".$ext;
        $path = $img->store(date('Ymd'));
        $aa=back()->withInput(['url'=>'upload/'.$path]);
        return 1;

    }



}