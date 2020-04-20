<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:91:"D:\phpstudy_pro\WWW\qingkao\public/../application/admin\view\mobileterminal\downMobile.html";i:1581221348;s:62:"D:\phpstudy_pro\WWW\qingkao\application\admin\view\iframe.html";i:1581220658;}*/ ?>
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

<div class="layui-container">
    <div class="update-progress layui-hide">
        <div class="layui-progress layui-progress-big " lay-filter="progress" lay-showPercent="yes">
            <div class="layui-progress-bar layui-bg-blue" lay-percent="0%"></div>
        </div>
    </div>
    <div class="layui-row layui-word-aux update-info mt10">
        <?php echo $notes; ?>
    </div>
    <div class="update-message layui-word-aux layui-hide mt10 c-studied"></div>
    <div class="update-bottom">
        <button class="layui-btn upbutton" id="upbutton"
                checkUrl="<?php echo url('admin/Mobileterminal/checkEnvironment'); ?>"
                downLoadFile="<?php echo url('admin/Mobileterminal/downLoadFile'); ?>"
                delFile="<?php echo url('admin/Mobileterminal/delFile'); ?>"
                clearCache="<?php echo url('admin/Mobileterminal/clearCache'); ?>"
                finish="<?php echo url('admin/Mobileterminal/finish',['h5version' =>$newversion]); ?>"
        >下载</button>
        <button class="layui-btn  layui-btn-disabled doing layui-hide">升级中...</button>
        <button class="layui-btn  layui-hide finish">升级完成</button>
    </div>
</div>

<script src="/static/libs/layui/layui.all.js"></script>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/layui.base.js"></script>

<script src="/static/js/uph5.js"></script>

</body>
</html>
