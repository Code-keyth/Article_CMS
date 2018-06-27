<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/public/Admin/css/font.css">
    <link rel="stylesheet" href="/public/Admin/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="/public/Admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/public/Admin/js/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">演示</a>
        <a>
          <cite>导航元素</cite></a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">

      <xblock>


          <div class="layui-form-item">
            <label class="layui-form-label">还原到</label>
            <div class="layui-input-inline">
              <select id="title_id" class="layui-select">
                @foreach($columns as $item)
                <option value="{{$item->id}}">{{$item->title}}</option>
                  @endforeach
              </select>
            </div>
            <div class="layui-form-mid layui-word-aux"><button class="layui-btn " onclick="article_re()" href="javascript:;">开始还原</button> </div>
          </div>

        <span class="x-right" style="line-height:40px">共有数据：{{count($articles)}} 条</span>
      </xblock>
      <table class="layui-table">
        <thead>
          <tr>
            <th>
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>ID</th>
            <th>标题</th>
            <th>作者</th>
            <th>缩略图</th>
            <th>修改时间</th>
            <th>所属栏目</th>
            <th>点击数</th>
              <th>权重</th>
            <th>操作</th></tr>
        </thead>
        <tbody>

        @foreach ($articles as $item)
          <tr>
            <td>
              <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='{{$item->id}}'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td>{{$item->id}}</td>
            <td>{{$item->title}}</td>
            <td>{{$item->author}}</td>
            <td>@if ($item->is_img == 1)<img width=50 src="{{$item->thumbnail}}">@else 无缩略图@endif</td>
            <td>{{$item->updated_at}}</td>
            <td>@if ($item->is_img == 0) 选择文章分类 @else {{$item->getColumn($item->title_id)}}@endif</td>
            <td>{{$item->click}}</td>
            <td>{{$item->weight}}</td>

            <td class="td-manage">
              <a title="编辑"  onclick="" href="javascript:;">
                <i class="layui-icon">&#xe65c;</i>
              </a>

            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
      <div class="page">
        <div>
          {{$articles->links()}}
        </div>
      </div>

    </div>
    <script>
        function article_re(){

            var column=$('#title_id option:selected').text();
            var column_id=$('#title_id option:selected').val();
            var Checkdata = tableCheck.getData();


            layer.confirm('确认要还原到['+column+']吗？',function(index){
                for(var index11 in Checkdata){
                    $.get('/admin/Article/Recycle_c?column='+column_id+'&id='+Checkdata[index11],function (returndata) {
                        if(returndata==0){
                            layer.msg('已恢复!',{icon:1,time:2000});
                        }else{
                            layer.msg('恢复失败!',{icon:2,time:2000});
                        }
                    });
                }
                });


        }

      // function article_re(){
      //
      //     layer.confirm('还原到'+column+'栏目下?',function(index){
      //
      //
      //
      //     });
      // }
      // $.get('/admin/Article/del?id='+id,function (data) {
      //     if(data==0){
      //         $(obj).parents("tr").remove();
      //         layer.msg('已删除!',{icon:1,time:2000});
      //     }else if(data==1){
      //         layer.msg('删除失败!',{icon:2,time:2000});
      //     }else{
      //         layer.msg('该栏目不存在或已被删除!',{icon:2,time:2000});
      //     }
      //
      // })

    </script>

  </body>

</html>