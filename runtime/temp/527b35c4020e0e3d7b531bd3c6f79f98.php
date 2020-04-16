<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"D:\phpstudy_pro\WWW\qingkao\public/../application/admin\view\index\login.html";i:1553060366;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>登录 - 网站后台管理系统</title>
    <link rel="stylesheet" href="/static/libs/layui/css/layui.css">
    <link rel="stylesheet" href="/static/css/adminlogin.css">
    <link rel="stylesheet" href="/static/css/fonts.css">
</head>
<body>
<div class="login">
    <h1>网站后台管理系统</h1>
    <form class="layui-form" action="<?php echo url('admin/index/login'); ?>" method="post">
        <div class="layui-form-item">
            <i class="fa fa-user"></i>
            <input type="text" name="username" lay-verify="required" autocomplete="off" placeholder="请输入账号" class="layui-input layui-input-lg">
        </div>
        <div class="layui-form-item">
            <i class="fa fa-lock"></i>
            <input type="password" name="password" lay-verify="required" autocomplete="off" placeholder="请输入密码" class="layui-input layui-input-lg">
        </div>
        <div class="layui-form-item captcha">
            <i class="fa fa-shield"></i>
            <input type="text" name="captcha" lay-verify="required" autocomplete="off" placeholder="验证码" class="layui-input layui-input-lg">
            <img src="<?php echo url('admin/index/captcha'); ?>" onclick="this.src='<?php echo url('admin/index/captcha'); ?>?rand='+Math.random()" />
        </div>
        <button class="layui-btn layui-btn-lg" lay-submit="" lay-filter="login">登 录</button>
    </form>
</div>
<script src="/static/libs/layui/layui.js"></script>
<script>
layui.use(['layer', 'form', 'jquery'], function(){
    var layer = layui.layer,
        form  = layui.form,
        $     = layui.jquery;
    form.on('submit(login)', function(data) {
        var index = layer.msg('登录中，请稍候', {
            icon: 16,
            time: false,
            shade: 0.3
        });
        $.ajax({
            url: data.form.action,
            type: data.form.method,
            dataType: 'json',
            data: $(data.form).serialize(),
            success: function(result) {
                if (result.code === 1) {
                    location.href = result.url;
                } else {
                    $('.captcha img').attr('src', '<?php echo url("admin/index/captcha"); ?>?rand='+Math.random());
                    layer.close(index);
                    layer.msg(result.msg);
                }
            },
            error: function (xhr, state, errorThrown) {
                layer.close(index);
                layer.msg(state + '：' + errorThrown);
            }
        });
        return false;
    });
});
</script>
</body>
</html>