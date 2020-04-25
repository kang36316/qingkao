<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:85:"D:\phpstudy_pro\WWW\qingkaoedu\public/../application/admin\view\course\videoList.html";i:1587788204;s:65:"D:\phpstudy_pro\WWW\qingkaoedu\application\admin\view\iframe.html";i:1581220658;}*/ ?>
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
        <input name="title" type="text" placeholder="标题" style="width:300px;"><br><br>
        <input name="video" type="file" id="files"><br><br>
        <input type="hidden" id="uploadAuth" value="">
        <input type="hidden" id="uploadAddress" value="">
        <input type="hidden" id="videoId" value="">
        <!--<input  id="categoryid" type="text" class="layui-hide"  value="1000129265"/>-->
        <!--<input type="hidden" id="count" value="<?php echo $count; ?>">-->
        <!--<input type="hidden" id="PageSize" value="<?php echo $PageSize; ?>">-->
        <!--<input type="hidden" id="curr" value="<?php echo $curr; ?>">-->
        <!--<input type="hidden" id="url" value="/admin/course/videoList/page/">-->
        <div style="width:0%;height:30px;background-color:red;" id="jindu"></div>
        <div class="ml20 mb10">
            <span class="layui-breadcrumb categoryList" id="categoryList" lay-separator="|">
            	 <!--<a class="active" cid="1000129265">测试1</a>-->
                <!-- <a <?php if($v['CateId'] == $categoryid): ?>class="active"<?php endif; ?> href="<?php echo url('admin/course/videoList'); ?>">全部</a>-->
                <!--<?php if(is_array($categoryList) || $categoryList instanceof \think\Collection || $categoryList instanceof \think\Paginator): if( count($categoryList)==0 ) : echo "" ;else: foreach($categoryList as $key=>$v): ?>-->
                <!-- <a href="<?php echo url('admin/course/videoList', ['categoryId'=>$v['CateId']]); ?>"-->
                <!--    <?php if($v['CateId'] == $categoryid): ?>class="active"<?php endif; ?> cid="<?php echo $v['CateId']; ?>"><?php echo $v['CateName']; ?></a>-->
                <!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
            </span>
        </div>
        <!--<ul>-->
        <!--    <li class="layui-col-xs3 layui-col-sm3 layui-col-md3 pd10" onclick="jiance()">-->
        <!--        <div class="video-pic">-->
        <!--            <i class="fa fa-plus"></i>-->
        <!--            <div class="video-title">点击选择上传的视频</div>-->
        <!--            <div class="shadow"></div>-->
        <!--        </div>-->
        <!--    </li>-->
        <!--</ul>-->
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
        <button class="layui-btn " onclick="jiance()" id="button-start"><i class="fa fa-cloud-upload"></i>  开始上传</button>
    </div>
</div>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/aliyun/es6-promise.min.js"></script>
<script src="/static/js/aliyun/aliyun-oss-sdk-5.3.1.min.js"></script>
<script src="/static/js/aliyun/aliyun-upload-sdk-1.4.0.min.js"></script>
<script>
    var accessKeyId = "LTAIcnQuDKBFNsNU";
    var accessKeySecret = "dRWGflyAfXJob4wtrc8fgIO5879GwV";var uploader = new AliyunUpload.Vod({
        //阿里账号ID，必须有值 ，值的来源https://help.aliyun.com/knowledge_detail/37196.html
        userId:"1633611861416361",
        //分片大小默认1M，不能小于100K
        partSize: 1048576,
        //并行上传分片个数，默认5
        parallel: 5,
        //网络原因失败时，重新上传次数，默认为3
        retryCount: 3,
        //网络原因失败时，重新上传间隔时间，默认为2秒
        retryDuration: 2,
        //是否上报上传日志到点播，默认为true
        enableUploadProgress: true,
        // 开始上传
        'onUploadstarted': function (uploadInfo) {
            var uploadAuth = document.getElementById("uploadAuth").value;
            var uploadAddress = document.getElementById("uploadAddress").value;
            var videoId = document.getElementById("videoId").value;
            uploader.setUploadAuthAndAddress(uploadInfo, uploadAuth, uploadAddress,videoId);
        },
        // 文件上传成功
        'onUploadSucceed': function (uploadInfo) {
            console.log("onUploadSucceed: " + uploadInfo.file.name + ", endpoint:" + uploadInfo.endpoint + ", bucket:" + uploadInfo.bucket + ", object:" + uploadInfo.object);
            $('input[name=videoid]', window.parent.document).val($("#videoId").val());
            var index = parent.layer.getFrameIndex(window.name);
            parent.layer.close(index);
        },
        // 文件上传失败
        'onUploadFailed': function (uploadInfo, code, message) {
            console.log("onUploadFailed: file:" + uploadInfo.file.name + ",code:" + code + ", message:" + message);
        },
        // 文件上传进度，单位：字节
        'onUploadProgress': function (uploadInfo, totalSize, loadedPercent) {
            $("#jindu").css("width",(loadedPercent * 100.00).toFixed(2) + "%");
            console.log("onUploadProgress:file:" + uploadInfo.file.name + ", fileSize:" + totalSize + ", percent:" + Math.ceil(loadedPercent * 100) + "%");
        },
        // 上传凭证超时
        'onUploadTokenExpired': function (uploadInfo) {
            console.log("onUploadTokenExpired");
            //实现时，根据uploadInfo.videoId调用刷新视频上传凭证接口重新获取UploadAuth
            //https://help.aliyun.com/document_detail/55408.html
            //从点播服务刷新的uploadAuth,设置到SDK里
            uploader.resumeUploadWithAuth(uploadAuth);
        },
        //全部文件上传结束
        'onUploadEnd':function(uploadInfo){
            console.log("onUploadEnd: uploaded all the files");
        }
    });


    function jiance(){
        var f = document.getElementById("files").files;

        $.post("/admin/quan/createUploadVideo",{"title":$('input[name=title]').val(),name:f[0].name},function(data){
            // console.log(data.UploadAuth)
            document.getElementById("uploadAuth").value=data.UploadAuth;
            document.getElementById("uploadAddress").value=data.UploadAddress;
            document.getElementById("videoId").value=data.VideoId;
            var userData = '{"Vod":{"StorageLocation":"","UserData":{"IsShowWaterMark":"false","Priority":"7"}}}';
            uploader.addFile(f[0], null, null, null, userData);
            uploader.startUpload();
        },"json")
    }


</script>


<script src="/static/libs/layui/layui.all.js"></script>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/layui.base.js"></script>

</body>
</html>
