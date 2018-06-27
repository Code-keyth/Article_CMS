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

        <button class="layui-btn" onclick="x_admin_show('添加用户','/admin/Column/add',800,800)"><i class="layui-icon"></i>添加</button>
        <span class="x-right" style="line-height:40px">共有数据：<?php echo e(count($columns)); ?> 条</span>
      </xblock>
      <table class="layui-table">
        <thead>
          <tr>
            <th>
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>ID</th>
            <th>栏目名称</th>
            <th>栏目类型</th>
            <th>上级栏目</th>
            <th>栏目权重</th>
            <th>操作</th></tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <td>
              <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td><?php echo e($itme->id); ?></td>
            <td><?php echo e($itme->title); ?></td>
            <td><?php if($itme->mod_id==1): ?>首页<?php elseif($itme->mod_id==2): ?>最终栏目<?php elseif($itme->mod_id==3): ?>文章列表<?php endif; ?></td>
            <td><?php if($itme->top_id==0): ?>顶级栏目<?php else: ?><?php echo e($itme->getColumn($itme->top_id)); ?><?php endif; ?></td>
            <td><?php echo e($itme->weight); ?></td>
            <td class="td-manage">

              <a title="编辑"  onclick="x_admin_show('编辑','/admin/Column/add?id=<?php echo e($itme->id); ?>',800,800)" href="javascript:;">
                <i class="layui-icon">&#xe642;</i>
              </a>

              <a title="删除" onclick="column_del(this,'<?php echo e($itme->id); ?>')" href="javascript:;">
                <i class="layui-icon">&#xe640;</i>
              </a>
            </td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
      
        
          
          
          
          
          
          
        
      

    </div>
    <script>
      layui.use('laydate', function(){
        var laydate = layui.laydate;
        
        //执行一个laydate实例
        laydate.render({
          elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
          elem: '#end' //指定元素
        });
      });

      /*-删除*/
      function column_del(obj,id){
          layer.confirm('确认要删除吗？',function(index){
              //发异步删除数据
              $.get('/admin/Column/del?id='+id,function (data) {
                  if(data==0){
                      $(obj).parents("tr").remove();
                      layer.msg('已删除!',{icon:1,time:2000});
                  }else if(data==1){
                      layer.msg('删除失败!',{icon:2,time:2000});
                  }else if(data==2){
                      layer.msg('该栏目拥有子栏目!不能被删除！',{icon:2,time:2000});
                  }
                  else{
                      layer.msg('该栏目不存在或已被删除!',{icon:2,time:2000});
                  }

              })

          });
      }


    </script>

  </body>

</html>