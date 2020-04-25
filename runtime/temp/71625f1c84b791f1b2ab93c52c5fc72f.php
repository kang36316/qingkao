<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:81:"D:\phpstudy_pro\WWW\qingkaoedu\public/../application/admin\view\user\details.html";i:1587545727;s:65:"D:\phpstudy_pro\WWW\qingkaoedu\application\admin\view\iframe.html";i:1581220658;}*/ ?>
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
    <table class="layui-table">
        <colgroup>
            <col width="150">
            <col>
        </colgroup>
        <tbody>
        <tr>
            <td>教师姓名</td>
            <td><?php echo $details['username']; ?></td>
        </tr>
        <tr>
            <td>联系方式</td>
            <td><?php echo $details['mobile']; ?></td>
        </tr>
        <tr>
            <td>性别</td>
            <td><?php echo $details['sex']; ?></td>
        </tr>
        <tr>
            <td>出生年月</td>
            <td><?php echo $details['birth_y']; ?><?php echo $details['birth_m']; ?><?php echo $details['birth_d']; ?></td>
        </tr>
        <tr>
            <td>地址</td>
            <td><?php echo $details['provid']; ?><?php echo $details['cityid']; ?><?php echo $details['areaid']; ?></td>
        </tr>
        <tr>
            <td>身份证号</td>
            <td><?php echo $details['identity']; ?></td>
        </tr>
        <tr>
            <td>身份证正面</td>
            <td><img src="<?php echo $details['identity_z']; ?>"></td>
        </tr>
        <tr>
            <td>身份证号反面</td>
            <td><img src="<?php echo $details['identity_f']; ?>"></td>
        </tr>
        <tr>
            <td>个人简介</td>
            <td><?php echo $details['brief']; ?></td>
        </tr>
        <tr>
            <td>申请时间</td>
            <td><?php echo $details['addtime']; ?></td>
        </tr>
        </tbody>
    </table>
</div>

<script src="/static/libs/layui/layui.all.js"></script>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/layui.base.js"></script>

</body>
</html>
