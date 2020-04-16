<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:85:"D:\phpstudy_pro\WWW\qingkaoedu\public/../application/admin\view\course\videoList.html";i:1581221312;s:65:"D:\phpstudy_pro\WWW\qingkaoedu\application\admin\view\iframe.html";i:1581220658;}*/ ?>
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

<style type="text/css">
    #categoryList .active{line-height:30px;color:#009688 !important;}
</style>
<div class="layui-container">
    <div class="layui-row mt10">
        <input  id="files" type="file" name="myFile" multiple="multiple" class="layui-hide"/>
        <input  id="userId" type="text" name="userId" class="layui-hide" value="<?php echo $userId; ?>"/>
        <input  id="categoryid" type="text" class="layui-hide"  value="<?php echo $categoryid; ?>"/>
        <input type="hidden" id="count" value="<?php echo $count; ?>">
        <input type="hidden" id="PageSize" value="<?php echo $PageSize; ?>">
        <input type="hidden" id="curr" value="<?php echo $curr; ?>">
        <input type="hidden" id="url" value="/admin/course/videoList/page/">
        <div class="ml20 mb10">
            <span class="layui-breadcrumb categoryList" id="categoryList" lay-separator="|">
               <a <?php if($v['CateId'] == $categoryid): ?>class="active"<?php endif; ?> href="<?php echo url('admin/course/videoList'); ?>">全部</a>
              <?php if(is_array($categoryList) || $categoryList instanceof \think\Collection || $categoryList instanceof \think\Paginator): if( count($categoryList)==0 ) : echo "" ;else: foreach($categoryList as $key=>$v): ?>
               <a href="<?php echo url('admin/course/videoList', ['categoryId'=>$v['CateId']]); ?>"
                  <?php if($v['CateId'] == $categoryid): ?>class="active"<?php endif; ?> cid="<?php echo $v['CateId']; ?>"><?php echo $v['CateName']; ?></a>
              <?php endforeach; endif; else: echo "" ;endif; ?>
            </span>
        </div>
        <ul>
            <li class="layui-col-xs3 layui-col-sm3 layui-col-md3 pd10" onclick="ToSelectFile()">
                <div class="video-pic">
                    <i class="fa fa-plus"></i>
                    <div class="video-title">点击选择上传的视频</div>
                    <div class="shadow"></div>
                </div>
            </li>
        </ul>
        <ul class="radio">
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$v): ?>
            <li class="layui-col-xs3 layui-col-sm3 layui-col-md3 pd10">
                <div class="video-pic">
                    <img src="<?php echo defaultVideoPic($v['CoverURL']); ?>">
                    <input type="hidden" value="<?php echo $v['VideoId']; ?>">
                    <div class="video-title"><?php echo $v['Title']; ?></div>
                    <div class="shadow"></div>
                </div>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
    <div class="page" id="page" style="margin-left: 10Px;"></div>
    <div class="upvideo-btn mt30">
        <button class="layui-btn layui-hide" onclick="start()" id="button-start"><i class="fa fa-cloud-upload"></i>  开始上传</button>
    </div>
</div>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/libs/layui/layui.all.js"></script>
<script src="/static/js/layui.base.js"></script>
<script src="/static/js/aliyun/es6-promise.min.js"></script>
<script src="/static/js/aliyun/aliyun-oss-sdk-5.3.1.min.js"></script>
<script src="/static/js/aliyun/aliyun-upload-sdk-1.5.0.min.js"></script>
<script src="/static/js/aliyun/md5.js"></script>
<script src="/static/js/aliyun/upvideo-addsection.js"></script>

<script src="/static/libs/layui/layui.all.js"></script>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/layui.base.js"></script>

</body>
</html>
