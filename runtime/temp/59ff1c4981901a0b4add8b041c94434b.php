<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:75:"/www/wwwroot/qingkao/public/../application/admin/view/educloud/quan.html";i:1558966648;s:55:"/www/wwwroot/qingkao/application/admin/view/iframe.html";i:1581220658;}*/ ?>
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

<div class="layui-card upvideo-body">
    <div class="layui-card-body">
        <input  id="files" type="file" name="myFile" multiple="multiple" class="layui-hide"/>
        <input  id="userId" type="text" value="<?php echo $aliUid; ?>" class="layui-hide"/>
        <table class="layui-table layui-form">
            <thead>
            <tr><th >视频名称</th><th style="width:100px;">大小</th><th style="width:200px;">进度</th><th style="width:80px;">状态</th></tr>
            </thead>
            <tbody id="video-list">

            </tbody>
        </table>
    </div>
</div>
<div class="upvideo-btn">
    <form class="layui-form" action="" style="float:left;margin:0px;">
    <div class="layui-form-item">
        <label class="layui-form-label">视频分类</label>
        <div class="layui-input-inline">
            <select id="categoryId" name="category" lay-filter="category">
                <option value="">请选择视频分类</option>
                <?php if(is_array($videocategory) || $videocategory instanceof \think\Collection || $videocategory instanceof \think\Paginator): if( count($videocategory)==0 ) : echo "" ;else: foreach($videocategory as $key=>$v): ?>
                <option value="<?php echo $v['CateId']; ?>"><?php echo $v['CateName']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>
    </form>
    <button class="layui-btn layui-hide" onclick="start()" id="button-start"><i class="fa fa-cloud-upload"></i>  开始上传</button>
    <button class="layui-btn layui-btn-primary" onclick="ToSelectFile()" id="button-insert"><i class="fa fa-plus-circle"></i>  添加视频</button>
    <button class="layui-btn layui-btn-primary" onclick="shut()"id="button-shut"><i class="fa fa-times-circle"></i> 关闭</button>
</div>
<script src="/static/js/aliyun/es6-promise.min.js"></script>
<script src="/static/js/aliyun/aliyun-oss-sdk-5.3.1.min.js"></script>
<script src="/static/js/aliyun/aliyun-upload-sdk-1.5.0.min.js"></script>
<script src="/static/js/aliyun/md5.js"></script>
<script src="/static/js/aliyun/upvideo.js"></script>

<script src="/static/libs/layui/layui.all.js"></script>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/layui.base.js"></script>

</body>
</html>
