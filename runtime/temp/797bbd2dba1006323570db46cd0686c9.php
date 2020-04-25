<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:82:"D:\phpstudy_pro\WWW\qingkaoedu\public/../application/admin\view\user\addmoney.html";i:1581220868;s:65:"D:\phpstudy_pro\WWW\qingkaoedu\application\admin\view\iframe.html";i:1581220658;}*/ ?>
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

<form action="<?php echo request()->url(); ?>" class="layui-form mt50 mr50" method="post">
    <div class="layui-form-item">
        <label class="layui-form-label">用户名</label>
        <div class="layui-input-block">
            <input type="text" name="username" value="<?php echo (isset($data['username']) && ($data['username'] !== '')?$data['username']:''); ?>" autocomplete="off"  readonly = "readonly" class="layui-input">
            <input type="hidden" name="__token__" value="<?php echo \think\Request::instance()->token(); ?>" />
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">金额</label>
        <div class="layui-input-block">
            <input type="text" name="yue" class="layui-input">
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>"  class="layui-input">
        </div>
    </div>
    <div class="layui-form-item mt50">
        <div class="layui-input-block">
            <button class="layui-btn" lay-filter="i" lay-submit="">保存</button>
            <button class="layui-btn layui-btn-primary" type="reset">重置</button>
        </div>
    </div>
</form>

<script src="/static/libs/layui/layui.all.js"></script>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/layui.base.js"></script>

</body>
</html>
