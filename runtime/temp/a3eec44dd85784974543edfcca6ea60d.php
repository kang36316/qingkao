<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:34:"../template/pc/classroom/info.html";i:1581221382;s:42:"/www/wwwroot/qingkao/template/pc/base.html";i:1586588300;}*/ ?>
<!DOCTYPE html>
<div class="layui-layout bg-f8fafc">
    <div class="layui-layout">
        <div class="layui-row yxt-courseinfo">
            <div class="CoursePage_Banner">
                <div class="CoursePage_Banner_Img">
                    <div class="CoursePage_Banner_Mask"></div>
                    <img src="<?php echo $info['picture']; ?>" alt="<?php echo $info['title']; ?>">
                </div>
                <div class="layui-container yxt-course-container">
                    <span class="yxt-breadcrumb layui-breadcrumb" lay-separator="—" style="visibility: visible;">
                      <a href="/">首页</a><span lay-separator="">—</span>
                      <a href=""><?php echo $info['title']; ?></a>
                    </span>
                    <div class="yxt-course-before layui-row">
                        <div class="pic layui-col-md5 layui-col-xs12">
                            <img  src="<?php echo $info['picture']; ?>" alt="<?php echo $info['title']; ?>">
                            <div class="classroom-tag hz-triangle tl0"><span>班级</span></div>
                        </div>
                        <div class="info layui-col-md7 layui-col-xs12 pdl30 pdr20 pdt10 ">
                            <div class="layui-col-md12 mb20">
                                <span class="course-title c-666"><?php echo $info['title']; ?></span>
                            </div>
                            <div class="layui-col-md12  c-666 mb20 border-bottom pdb15">
                                <i class="layui-icon layui-icon-user mr10"></i><span class="mr30">学员人数:<span class="ml10"><?php echo getUserNum($info['id'],3); ?></span></span>
                                <i class="layui-icon layui-icon-table mr10"></i><span class="mr30">课程数:<span class="ml10"><?php echo getClassroomCourseNum($info['id']); ?></span></span>
                            </div>
                            <div class="layui-col-md12 mb20">
                                <div class="layui-col-md12 c-666 mb20">
                                    <span class="course-teacher">班主任：<?php echo getTeacherName($info['headteacher']); ?></span>
                                </div>
                                <div class="layui-col-md12 c-666 mb20 mt10">
                                    <span class="course-teacher">师资团队：
                                    <?php if(is_array($teacherIds) || $teacherIds instanceof \think\Collection || $teacherIds instanceof \think\Paginator): if( count($teacherIds)==0 ) : echo "" ;else: foreach($teacherIds as $key=>$vo): ?> <a href="<?php echo url('index/teacher/centert',['id'=>$vo]); ?>" alt="<?php echo getTeacherName($vo); ?>"><img src="<?php echo defaultAvatar(getAvatar($vo)); ?>" class="layui-nav-img tips" tips="<?php echo getTeacherName($vo); ?>"></a><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </span>
                                </div>
                                <?php if($isBuy): ?>
                                <div class="layui-col-md9 c-666 mb20 mt10">
                                    <span class="course-teacher">学习总进度：<?php echo $progress; ?>%</span>
                                </div>
                                <?php endif; if(!$isBuy): ?>
                                <div class="layui-col-md9 c-666 mb20 mt10">
                                    <span class="course-teacher">价格： <span class="price mr20"><?php echo isFree($info['price']); ?></span>
                                          <?php echo flashsale($info['id'],3,$info['price'],1); ?>
                                    </span>
                                </div>
                                <?php endif; ?>
                                <div class="layui-col-md3 mt10">
                                    <?php if($isBuy): ?>
                                    <a href="javascript:void(0)" class="layui-btn layui-layout-right mt5">已经购买</a>
                                    <?php elseif($info['status']==0): ?>
                                    <a class="layui-btn layui-layout-right layui-btn-disabled">班级已关闭</a>
                                    <?php else: ?>
                                    <a href="<?php echo url('index/Course/creatorder',['id'=>hashids_encode($info['id']),'type'=>hashids_encode(3)]); ?>" class="layui-btn layui-layout-right">加入班级</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="layui-container mt30 pdb40">
        <div class="layui-row">
            <div class="yxt_teacher-list">
                <div class="layui-row layui-col-space20">
                    <div class="layui-col-md9 ">
                        <div class="bg-fff layui-tab layui-tab-brief shadow " lay-filter="tab">
                            <ul class="yxt-course-tab-title layui-tab-title">
                                <li class="layui-this" lay-id="1">班级简介</li>
                                <li lay-id="2">课程列表</li>
                                <li lay-id="3">课程评论</li>
                                <li lay-id="4">师资团队</li>
                            </ul>
                            <div class="layui-tab-content">
                                <div class="yxt-course-brief layui-tab-item layui-show">
                                    <?php echo $info['brief']; ?>
                                </div>
                                <div class="layui-tab-item">
                                    <div class="class-course-list">
                                        <?php if(is_array($liveCourse) || $liveCourse instanceof \think\Collection || $liveCourse instanceof \think\Paginator): if( count($liveCourse)==0 ) : echo "" ;else: foreach($liveCourse as $key=>$vo): ?>
                                        <div class="course-item">
                                            <div class="media">
                                                <?php if($isBuy): ?>
                                                <a class="media-left" href="<?php echo url('index/user/mylearn',array('id'=>hashids_encode($vo['id']),'type'=>hashids_encode($vo['type']))); ?>">
                                                    <img src="<?php echo $vo['picture']; ?>" alt="<?php echo $vo['title']; ?>" class="">
                                                    <div class="classroom-tag hz-triangle classroom-live-tag"><span>直播</span></div>
                                                </a>
                                                <?php else: ?>
                                                <a class="media-left" href="<?php echo url('index/course/info',array('id'=>hashids_encode($vo['id']),'type'=>hashids_encode($vo['type']))); ?>">
                                                    <img src="<?php echo $vo['picture']; ?>" alt="<?php echo $vo['title']; ?>" class="">
                                                    <div class="classroom-tag hz-triangle classroom-live-tag"><span>直播</span></div>
                                                </a>
                                                <?php endif; ?>
                                                <div class="media-body">
                                                    <div class="title">
                                                        <a href="<?php echo url('index/course/info',array('id'=>hashids_encode($vo['id']),'type'=>hashids_encode($vo['type']))); ?>">
                                                            <?php echo $vo['title']; ?>
                                                        </a>
                                                    </div>
                                                    <div class="class-course-price">
                                                        原价：
                                                        <span class="course-price-widget">
                                                            ¥<span class="origin-price"><?php echo $vo['price']; ?></span>
                                                        </span>
                                                    </div>
                                                    <?php if($isBuy): ?>
                                                    <div class="class-course-price">
                                                        <div class="layui-progress mt15" lay-showPercent="yes">
                                                            <div class="layui-progress-bar" lay-percent="<?php echo $liveProgress[$vo['id']]; ?>%"></div>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                                <?php if($isBuy): ?>
                                                <div class=" study-button">
                                                    <a href="<?php echo url('index/course/info',array('id'=>hashids_encode($vo['id']),'type'=>hashids_encode($vo['type']))); ?>" type="button" class="layui-btn layui-btn-sm">开始学习</a>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php endforeach; endif; else: echo "" ;endif; if(is_array($videoCourse) || $videoCourse instanceof \think\Collection || $videoCourse instanceof \think\Paginator): if( count($videoCourse)==0 ) : echo "" ;else: foreach($videoCourse as $key=>$vo): ?>
                                        <div class="course-item">
                                            <div class="media">
                                                <?php if($isBuy): ?>
                                                <a class="media-left" href="<?php echo url('index/user/mylearn',array('id'=>hashids_encode($vo['id']),'type'=>hashids_encode($vo['type']))); ?>">
                                                    <img src="<?php echo $vo['picture']; ?>" alt="<?php echo $vo['title']; ?>" class="">
                                                </a>
                                                <?php else: ?>
                                                <a class="media-left" href="<?php echo url('index/course/info',array('id'=>hashids_encode($vo['id']),'type'=>hashids_encode($vo['type']))); ?>">
                                                    <img src="<?php echo $vo['picture']; ?>" alt="<?php echo $vo['title']; ?>" class="">
                                                </a>
                                                <?php endif; ?>
                                                <div class="media-body">
                                                    <div class="title">
                                                        <a href="<?php echo url('index/course/info',array('id'=>hashids_encode($vo['id']),'type'=>hashids_encode($vo['type']))); ?>">
                                                            <?php echo $vo['title']; ?>
                                                        </a>
                                                    </div>
                                                    <div class="class-course-price">
                                                        原价：
                                                        <span class="course-price-widget">
                                                            ¥<span class="origin-price"><?php echo $vo['price']; ?></span>
                                                        </span>
                                                    </div>
                                                    <?php if($isBuy): ?>
                                                    <div class="class-course-price">
                                                        <div class="layui-progress mt15" lay-showPercent="yes">
                                                            <div class="layui-progress-bar" lay-percent="<?php echo $videoProgress[$vo['id']]; ?>%"></div>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                                <?php if($isBuy): ?>
                                                <div class=" study-button">
                                                    <a href="<?php echo url('index/course/info',array('id'=>hashids_encode($vo['id']),'type'=>hashids_encode($vo['type']))); ?>" type="button" class="layui-btn layui-btn-sm">开始学习</a>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </div>
                                </div>
                                <div class="layui-tab-item">
                                    <?php if(is_array($comment) || $comment instanceof \think\Collection || $comment instanceof \think\Paginator): if( count($comment)==0 ) : echo "$empty" ;else: foreach($comment as $key=>$vo): ?>
                                    <div class="yxt-card-teacher layui-row border-bottom mt10 ml20">
                                        <div class="pic">
                                            <a  href="#" title=""><img  src="<?php echo defaultAvatar(getAvatar($vo['uid'])); ?>"></a>
                                        </div>
                                        <div class="comment ">
                                            <div class="user-name c-blue"><?php echo getUserName($vo['uid']); ?><span class="c-999">&nbsp;&nbsp;评论：</span></div>
                                            <div class="comments c-666"><?php echo $vo['contents']; ?>
                                            </div>
                                        </div>
                                        <div class="of">
                                            <span class="fr mb10">
                                                <font class="fsize12 c-999 ml20"><?php echo $vo['addtime']; ?></font>
                                            </span>
                                        </div>
                                    </div>
                                    <?php endforeach; endif; else: echo "$empty" ;endif; ?>
                                    <div class="page"><?php echo $comment->render(); ?></div>
                                </div>
                                <div class="layui-tab-item">
                                    <div class="yxt_teacher-list ml20">
                                        <div class="layui-row layui-col-space20">
                                            <?php if(is_array($teachersInfo) || $teachersInfo instanceof \think\Collection || $teachersInfo instanceof \think\Paginator): if( count($teachersInfo)==0 ) : echo "" ;else: foreach($teachersInfo as $key=>$vo): ?>
                                            <div class="layui-col-md3 ">
                                                <div class="yxt_teacher-item">
                                                    <div class="teacher-pic" style="cursor: pointer;height:200px">
                                                        <div class="img-box" style="width:110px;height:110px;">
                                                            <a href="<?php echo url('index/teacher/centert',['id'=>$vo['id']]); ?>">
                                                                <img src="<?php echo defaultAvatar(getAvatar($vo['uid'])); ?>" alt="<?php echo $vo['username']; ?>" width="110" height="110">
                                                            </a>
                                                        </div>
                                                        <p class="teacher-name"><?php echo $vo['username']; ?></p>
                                                    </div>
                                                    <p><?php echo $vo['sign']; ?></p>
                                                </div>
                                            </div>
                                            <?php endforeach; endif; else: echo "" ;endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="layui-col-md3">
                        <!--<div class="bg-fff layui-card shadow">
                            <div class="layui-card-header c-666">班主任</div>
                            <div class="yxt-card-teacher layui-card-body">
                                <div class="layui-row">
                                    <div class="pic">
                                        <a  href="<?php echo url('index/teacher/centert',['id'=>$teacherInfo['id']]); ?>" title=""><img  src="<?php echo defaultAvatar(getAvatar($teacherInfo['uid'])); ?>"></a>
                                    </div>
                                    <div class="name">
                                        <a class="c-666" href="<?php echo url('index/teacher/centert',['id'=>$teacherInfo['id']]); ?>"><?php echo $teacherInfo['username']; ?></a>
                                    </div>
                                </div>
                                <div class="layui-row">
                                    <div class="brief c-666">
                                        <?php echo $teacherInfo['brief']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>-->
                        <div class="bg-fff layui-card shadow">
                            <div class="layui-card-header c-666">班级学员</div>
                            <div class="layui-card-body">
                                <div class="layui-row  xueyuan-list pdt10">
                                    <?php if(is_array($classroomUser) || $classroomUser instanceof \think\Collection || $classroomUser instanceof \think\Paginator): if( count($classroomUser)==0 ) : echo "" ;else: foreach($classroomUser as $key=>$vo): ?>
                                    <div class="layui-col-md2 mb20">
                                        <div class="pic">
                                            <a href="javascript:avoid(0)" title="<?php echo getUserName($vo['uid']); ?>"><img src="<?php echo defaultAvatar(getAvatar($vo['uid'])); ?>"></a>
                                        </div>
                                    </div>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    layui.use('util', function(){
        var util = layui.util;
        var endTime = new Date($('#endTime').val()).getTime()
            ,serverTime = new Date($('#nowTime').val()).getTime();
        util.countdown(endTime, serverTime, function(date, serverTime, timer){
            var str= '<span class="layui-badge countdown">'+date[0]+'天</span>';
            str=str+'<span class="layui-badge countdown" >'+date[1]+'时</span>';
            str=str+'<span class="layui-badge countdown" >'+date[2]+'分</span>';
            str=str+'<span class="layui-badge countdown" >'+date[3]+'秒</span>';
            lay('#remain').html(str);
        });
    });
</script>
