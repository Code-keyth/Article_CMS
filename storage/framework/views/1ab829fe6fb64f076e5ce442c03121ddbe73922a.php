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
    <div class="x-body">
        <form method="post" enctype="multipart/form-data" class="layui-form">
          <div class="layui-form-item">
              <label for="L_email" class="layui-form-label">
                  <span class="x-red">*</span>标题
              </label>
              <div class="layui-input-inline">
                  <input type="text" value="<?php echo e($Article->title); ?>" name="title"class="layui-input">
              </div>
          </div>
          <div class="layui-form-item">
              <label class="layui-form-label">
                  <span class="x-red">*</span>所属栏目
              </label>
              <div class="layui-input-inline">
                  <select name="title_id" class="layui-select">
                        <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option <?php if($item->id == $Article->title_id): ?> selected <?php endif; ?> value="<?php echo e($item->id); ?>"><?php echo e($item->title); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
              </div>
          </div>



            <input hidden name="id" value="<?php echo e($Article->id); ?>">
            <?php echo e(csrf_field()); ?>

          <div class="layui-form-item">
              <label  class="layui-form-label">
                  <span class="x-red">*</span>作者
              </label>
              <div class="layui-input-inline">
                  <input type="text" value="<?php echo e($Article->author); ?>" name="author" class="layui-input">
              </div>

          </div>
          <div class="layui-form-item">
              <label class="layui-form-label">
                  <span class="x-red">*</span>权重
              </label>
              <div class="layui-input-inline">
                  <input type="text" value="<?php echo e($Article->weight); ?>" name="weight" class="layui-input">
              </div>
          </div>
            <div class="layui-form-item">
                <label class="layui-form-label">
                    <span class="x-red">*</span>点击数
                </label>
                <div class="layui-input-inline">
                    <input type="text" value="<?php echo e($Article->click); ?>" name="click" class="layui-input">
                </div>
            </div>


            <div class="layui-form-item">
                <label class="layui-form-label">
                    <span class="x-red">*</span>点击数
                </label>
                <div class="layui-input-inline">
                    <button type="button" class="layui-btn" id="test1">
                        <i class="layui-icon">&#xe67c;</i>上传图片
                    </button>

                    <input type="file" name="test123">
                </div>
            </div>


            <div id="test001" class="layui-form-item">
                <label for="L_repass" class="layui-form-label">
                    <span class="x-red"></span>栏目内容
                </label>
                <div class="layui-input-block">
                    <script style="min-height:500px;max-width: 800px;min-width: 450px;" id="content" name="content" type="text/plain"><?php echo $Article->content; ?></script>
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
    <script type="text/javascript" src="/public/common/UE/ueditor.config.js"></script>
    <script type="text/javascript" src="/public/common/UE/ueditor.all.js"></script>
    <script type="text/javascript">
        var ue = UE.getEditor('content');

        layui.use('upload', function(){
            var upload = layui.upload;

            //执行实例
            var uploadInst = upload.render({
                elem: '#test1' //绑定元素
                ,data:{
                    "_token":"<?php echo e(csrf_token()); ?>"
                }
                ,url: '/admin/Article/upload '
                ,done: function(res){
                    alert(res);
                }
                ,error: function(){
                    //请求异常回调
                }
            });
        });
    </script>

  </body>

</html>