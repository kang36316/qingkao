<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:90:"D:\phpstudy_pro\WWW\qingkaoedu\public/../application/admin\view\classroom\xueyuanList.html";i:1581221382;s:65:"D:\phpstudy_pro\WWW\qingkaoedu\application\admin\view\iframe.html";i:1581220658;}*/ ?>
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
            <a href="<?php echo url('admin/classroom/import',['cid'=>$cid]); ?>" class="layui-btn ajax-iframe"  data-width="600px" data-height="300px"><i class="fa fa-plus-circle"></i> 批量导入</a>
            <a href="<?php echo url('admin/classroom/export',['cid'=>$cid]); ?>" class="layui-btn layui-btn-primary"><i class="fa fa-file-excel-o"></i> 导出学员</a>
        </div>
        <table class="layui-table layui-form">
            <thead>
            <tr>
                <th style="width:180px;">学员姓名</th>
                <th >学习进度</th>
                <th style="width:40px;">操作</th>
            </tr>
            </thead>
            <tbody id="material-list">
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "$empty" ;else: foreach($list as $key=>$v): ?>
            <tr>
                <th ><?php echo getUserName($v['uid']); ?></th>
                <th ><div class="layui-progress" lay-showPercent="yes">
                         <div class="layui-progress-bar layui-bg-green" lay-percent="<?php echo $v['progress']; ?>%"></div>
                    </div>
                </th>
                <th >
                    <div class="layui-btn-group mb0">
                        <a href="<?php echo url('admin/classroom/detach', ['uid' => $v['uid'],'cid'=>$cid]); ?>" class="layui-btn layui-btn-xs layui-btn-danger ajax-delete"> <i class="layui-icon">&#xe640;</i></a>
                    </div>
                </th>
            </tr>
            <?php endforeach; endif; else: echo "$empty" ;endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="/static/libs/layui/layui.all.js"></script>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/layui.base.js"></script>

</body>
</html>
