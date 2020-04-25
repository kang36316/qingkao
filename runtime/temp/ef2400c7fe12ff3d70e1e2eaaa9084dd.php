<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:36:"../template/pc/user\myclassroom.html";i:1581221382;s:56:"D:\phpstudy_pro\WWW\qingkaoedu\template\pc\userbase.html";i:1586588300;}*/ ?>
<!DOCTYPE html>
<div class="fly-panel fly-panel-user" pad20="">
    <div class="content-header mb20">
        <ul class="header-item-container">
            <li class="header-item active"><a href="javascript:;"> 我的班级</a></li>
        </ul>
    </div>
    <?php if(is_array($myclassroom) || $myclassroom instanceof \think\Collection || $myclassroom instanceof \think\Paginator): if( count($myclassroom)==0 ) : echo "$empty" ;else: foreach($myclassroom as $key=>$vo): ?>
    <div class="layui-row  mycourse">
        <div class="layui-col-md3 mycourse-left">
            <div class="mycourse-pic">
                <a href="<?php echo url('index/classroom/info',['id'=>hashids_encode($vo['courseInfo']['id'])]); ?>"><img src="<?php echo $vo['courseInfo']['picture']; ?>"></a>
            </div>
        </div>
        <div class="layui-col-md7 mycourse-detail mt10">
            <div class="layui-row mt10">
                <div class="mycourse-title font18"><?php echo $vo['courseInfo']['title']; ?></div>
            </div>
            <div class="layui-row mt15">
                <div class="layui-col-md3 mycourse-title c-61">课程数：<?php echo getClassroomCourseNum($vo['courseInfo']['id']); ?></div>
                <div class="layui-col-md5 mycourse-title c-61">有效期剩余：<?php echo $vo['remain']; ?></div>
                <div class="layui-col-md3 mycourse-title c-61">班主任：<?php echo getTeacherName($vo['courseInfo']['headteacher']); ?></div>
            </div>
            <div class="layui-row mt10">
                <div class="mycourse-title c-61 mr20">学习总进度：
                    <div class="layui-progress" lay-showPercent="true">
                        <div class="layui-progress-bar layui-bg-green" lay-percent="<?php echo $vo['progress']; ?>%"></div>
                    </div>
                </div>

            </div>
        </div>
        <?php if($vo['isDaoQi']): ?>
        <div class="layui-col-md2 " style="margin-top:90px;">
            <a href="<?php echo url('index/Course/creatorder',['id'=>hashids_encode($vo['courseInfo']['id']),'type'=>hashids_encode($vo['courseInfo']['type'])]); ?>"
               class="layui-btn layui-btn-danger layui-btn-sm layui-btn-fluid  layui-layout-right mt10" >班级到期请重新购买</a>
        </div>
        <?php endif; ?>
    </div>
    <?php endforeach; endif; else: echo "$empty" ;endif; ?>
</div>

<script>
    $(function() {
        $('.circle').each(function(index, el) {
            var num = $(this).find('span').text() * 3.6;
            if (num<=180) {
                $(this).find('.right').css('transform', "rotate(" + num + "deg)");
            } else {
                $(this).find('.right').css('transform', "rotate(180deg)");
                $(this).find('.left').css('transform', "rotate(" + (num - 180) + "deg)");
            };
        });
    });
</script>
