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
      <style>
          #edui1{
              z-index: 2 !important;
          }
      </style>
  </head>
  
  <body>
    <div class="x-body">
        <form method="post" class="layui-form">
          <div class="layui-form-item">
              <label class="layui-form-label">
                  <span class="x-red">*</span>栏目名称
              </label>
              <div class="layui-input-inline">
                  <input type="text" value="<?php echo e($Column->title); ?>" name="title" class="layui-input">
              </div>
          </div>
            <input name="id" hidden value="<?php echo e($Column->id); ?>">
          <div class="layui-form-item">
              <label for="L_username" class="layui-form-label">
                  <span class="x-red">*</span>栏目类型
              </label>
              <div class="layui-input-inline">
                  <select  lay-filter='mod_id' name="mod_id" class="layui-select">
                      <option  value="0">请选择</option>
                      <option <?php if($Column->mod_id == 1): ?> selected <?php endif; ?> value="1">首页</option>
                      <option <?php if($Column->mod_id == 2): ?> selected <?php endif; ?> value="2">最终栏目</option>
                      <option <?php if($Column->mod_id == 3): ?> selected <?php endif; ?> value="3">文章列表</option>
                  </select>
              </div>
          </div>

            <?php echo e(csrf_field()); ?>

          <div class="layui-form-item">
              <label  class="layui-form-label">
                  <span class="x-red">*</span>权重
              </label>
              <div class="layui-input-inline">
                  <input type="text" value="<?php echo e($Column->weight); ?>" name="weight" class="layui-input">
              </div>
          </div>
            <div  id="test002" class="layui-form-item">
                <label class="layui-form-label">
                    <span class="x-red">*</span>上级栏目
                </label>
                <div class="layui-input-inline">
                    <select lay-filter='top_id' name="top_id" class="layui-select">
                        <option  value="0">顶级栏目</option>
                        <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option <?php if($Column->mod_id == $item->id): ?> selected <?php endif; ?> value="<?php echo e($item->id); ?>"><?php echo e($item->title); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div id="test001" class="layui-form-item">
                <label class="layui-form-label">
                    <span class="x-red"></span>栏目内容
                </label>
                <div class="layui-input-block">
                    <script style="min-height:500px;max-width: 800px;min-width: 450px;" id="content" name="content" type="text/plain"><?php echo $Column->content; ?></script>
                </div>
            </div>
          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button  class="layui-btn" type="submit">
                  增加
              </button>
          </div>
      </form>
    </div>

    <!-- 配置文件 -->
    <script type="text/javascript" src="/public/common/UE/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="/public/common/UE/ueditor.all.js"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('content');
        if ("<?php echo e($Column->mod_id); ?>" == '1'){
            $('#test002').hide();
            $('#test001').hide();
        }
        if("<?php echo e($Column->mod_id); ?>" == '3'){
            $('#test001').hide();
        }
        layui.use('form', function(){
            var form = layui.form;
            form.on('select(mod_id)', function(data){
                if(data.value==2){
                    $('#test001').show();
                }else{
                    $('#test001').hide();
                    }
                if(data.value==1){
                    $('#test002').hide();
                }else{
                    $('#test002').show();
                }
            });
        });


    </script>

  </body>

</html>