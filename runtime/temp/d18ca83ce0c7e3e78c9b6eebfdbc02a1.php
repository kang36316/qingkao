<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:91:"D:\phpstudy_pro\WWW\qingkao\public/../application/admin\view\educloud\addvideocategory.html";i:1559286258;s:62:"D:\phpstudy_pro\WWW\qingkao\application\admin\view\iframe.html";i:1581220658;}*/ ?>
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
    <div class="layui-card-body">
        <form action="<?php echo request()->url(); ?>" class="layui-form" method="post">
            <div class="layui-form-item">
                <label class="layui-form-label">* 分类名称</label>
                <div class="layui-input-block">
                    <input type="text" lay-verify="required" name="name" autocomplete="off" placeholder="请输入分类名称" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-filter="i" lay-submit="">保存</button>
                    <button class="layui-btn layui-btn-primary" type="reset">重置</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="/static/libs/layui/layui.all.js"></script>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/layui.base.js"></script>

</body>
</html>
