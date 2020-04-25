<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:85:"D:\phpstudy_pro\WWW\qingkaoedu\public/../application/admin\view\course\paperList.html";i:1560940942;s:65:"D:\phpstudy_pro\WWW\qingkaoedu\application\admin\view\iframe.html";i:1581220658;}*/ ?>
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
        <table class="layui-table layui-form">
            <thead>
            <tr>
                <th >资料名称</th>
                <th style="width:140px;">创建时间</th>
                <th style="width:60px;">操作</th>
            </tr>
            </thead>
            <tbody id="exam-list">
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "$empty" ;else: foreach($list as $key=>$v): ?>
            <tr>
                <th ><?php echo $v['exam']; ?></th>
                <th ><?php echo $v['addtime']; ?></th>
                <th >
                    <div class="layui-btn-group mb0 exam-list">
                        <a eid="<?php echo $v['id']; ?>" ename="<?php echo $v['exam']; ?>" class="layui-btn layui-btn-xs"> <i class="layui-icon">&#xe654;</i></a>
                    </div>
                </th>
            </tr>
            <?php endforeach; endif; else: echo "$empty" ;endif; ?>
            </tbody>
        </table>
        <div class="page"><?php echo $list->render(); ?></div>
    </div>
</div>

<script src="/static/libs/layui/layui.all.js"></script>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/layui.base.js"></script>

</body>
</html>
