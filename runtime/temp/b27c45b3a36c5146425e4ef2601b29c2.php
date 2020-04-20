<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:81:"/www/wwwroot/qingkao/public/../application/admin/view/educloud/videocategory.html";i:1581221312;s:55:"/www/wwwroot/qingkao/application/admin/view/iframe.html";i:1581220658;}*/ ?>
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
        <div class="layui-btn-group">
            <a href="<?php echo url('admin/educloud/addvideocategory'); ?>" class="layui-btn ajax-iframe" data-width="400px" data-height="250px"><i class="fa fa-plus-circle"></i> 添加分类</a>
        </div>
        <input type="hidden" id="count" value="<?php echo $SubTotal; ?>">
        <input type="hidden" id="PageSize" value="<?php echo $PageSize; ?>">
        <input type="hidden" id="curr" value="<?php echo $curr; ?>">
        <input type="hidden" id="url" value="/admin/educloud/videocategory/page/">
        <table class="layui-table layui-form">
            <thead>
            <tr>
                <th>ID</th>
                <th>分类名称</th>
                <th width="50">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "$empty" ;else: foreach($list as $key=>$v): ?>
            <tr>
                <td><?php echo $v['CateId']; ?></td>
                <td><?php echo $v['CateName']; ?></td>
                <td><a href="<?php echo url('admin/educloud/delvideocategory', ['id' => $v['CateId']]); ?>" class="layui-btn layui-btn-xs layui-btn-danger ajax-delete"><i class="fa fa-trash-o"></i> 删除</a></td>
            </tr>
            <?php endforeach; endif; else: echo "$empty" ;endif; ?>
            </tbody>
        </table>
        <div class="page" id="page"></div>
    </div>
</div>

<script src="/static/libs/layui/layui.all.js"></script>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/layui.base.js"></script>

</body>
</html>
