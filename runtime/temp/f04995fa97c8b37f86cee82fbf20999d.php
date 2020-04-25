<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:85:"D:\phpstudy_pro\WWW\qingkaoedu\public/../application/admin\view\classroom\import.html";i:1581221382;s:65:"D:\phpstudy_pro\WWW\qingkaoedu\application\admin\view\iframe.html";i:1581220658;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>网站后台管理系统</title>
    <link rel="stylesheet" href="/static/libs/layui/css/layui.css">
    <link rel="stylesheet" href="/static/css/base.css">
    <link rel="stylesheet" href="/static/css/fonts.css">
    
</head>
<body class="layui-layout-iframe">

<div class="layui-card">
    <form action="<?php echo url('admin/classroom/import'); ?>" class="layui-form" method="post" enctype="multipart/form-data">
        <div class="layui-form-item">
            <label class="layui-form-label">上传文件</label>
            <div class="layui-input-block">
                <input type="text" autocomplete="off" placeholder="请上传导入的文件" class="layui-input">
                <input type="hidden" name="classroomId" value="<?php echo $classroomId; ?>" id="classroomId">
                <button type="button" class="layui-btn layui-btn-primary layui-btn-position ajax-import"><i class="fa fa-file-image-o"></i> 选择文件</button>
            </div>
        </div>
    </form>
</div>

<script src="/static/libs/layui/layui.all.js"></script>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/layui.base.js"></script>

</body>
</html>
