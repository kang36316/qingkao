<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:89:"D:\phpstudy_pro\WWW\qingkaoedu\public/../application/admin\view\classroom\courseList.html";i:1581221382;s:65:"D:\phpstudy_pro\WWW\qingkaoedu\application\admin\view\iframe.html";i:1581220658;}*/ ?>
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

<div id="courseList" class="demo-transfer ml30"></div>
<div class="layui-form-item mt50">
    <div class="layui-input-block" style="text-align: center;margin-left: 0px;">
        <input type="hidden" id="id"  value="<?php echo $data['id']; ?>">
        <button class="layui-btn" lay-transferactive="getData" data-url="<?php echo url('admin/classroom/editPost'); ?>" >保存</button>
    </div>
</div>

<script src="/static/libs/layui/layui.all.js"></script>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/layui.base.js"></script>

<script>
    layui.use(['transfer', 'util'], function(){
        var transfer = layui.transfer,util = layui.util;
        transfer.render({
            elem: '#courseList'
            , title: ['选择课程', '已选课程']
            , data:<?php echo $course; ?>
            , width: 314
            , height:290
            , id: 'course'
            , value:<?php echo $selectCourse; ?>
        });
        util.event('lay-transferactive', {
            getData: function(othis){
                var obj = {};
                var url=$(this).data('url');
                obj['id'] =$("#id").val();
                obj['course'] =transfer.getData('course');
                var index = layer.msg('请求中，请稍候', {
                    icon: 16,
                    time: false,
                    shade: 0.3
                });
                $.ajax({
                    url: url,
                    type: 'post',
                    dataType: 'json',
                    data:obj,
                    success: function (result) {
                        if (result.code === 0) {
                            setTimeout(function () {
                                parent.location.reload();
                            }, 1000);
                        }
                        layer.msg(result.msg);
                        layer.close(index);
                    },
                    error: function (xhr, state, errorThrown) {
                        layer.close(index);
                        layer.msg(state + '：' + errorThrown);
                    }
                });
            }
        })
    });
</script>

</body>
</html>
