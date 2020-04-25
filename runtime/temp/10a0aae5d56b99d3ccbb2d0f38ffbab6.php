<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:34:"../template/pc/classroom\info.html";i:1581221382;s:52:"D:\phpstudy_pro\WWW\qingkaoedu\template\pc\base.html";i:1586588300;}*/ ?>
<!DOCTYPE html><html lang="zh-cn"><head>    <meta charset="utf-8">    <title><?php echo config('website.site_title'); ?></title>    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">    <meta name="keywords" content="<?php echo config('website.site_keywords'); ?>">    <meta name="description" content="<?php echo config('website.site_description'); ?>">    <link rel="stylesheet" href="//at.alicdn.com/t/font_24081_qs69ykjbea.css">    <link rel="stylesheet" type="text/css" href="/static/libs/layui/css/layui.css">    <link rel="stylesheet" type="text/css" href="/static/css/home.base.css" media="all">    <link rel="stylesheet" type="text/css" href="/static/css/base.css" media="all">    <link rel="shortcut icon" href="<?php echo config('website.icon'); ?>" />    <link rel="bookmark"href="<?php echo config('website.icon'); ?>" />    </head><body><div class="layui-layout ">    <div class="layui-header header ">        <a class="logo" href="/"> <img src="<?php echo config('website.logo'); ?>" alt="<?php echo config('website.site_title'); ?>"> </a>        <ul class="layui-nav layui-layout-left" lay-filter="">            <li class="layui-nav-item"><a href="/">首页</a></li>            <?php if(is_array($nav) || $nav instanceof \think\Collection || $nav instanceof \think\Paginator): if( count($nav)==0 ) : echo "" ;else: foreach($nav as $key=>$vo): ?>            <li class="layui-nav-item">                <a href="<?php echo $vo['url']; ?>"><?php echo $vo['name']; ?></a>                <?php if($vo['childNav']): ?>                <dl class="layui-nav-child">                    <?php if(is_array($vo['childNav']) || $vo['childNav'] instanceof \think\Collection || $vo['childNav'] instanceof \think\Paginator): if( count($vo['childNav'])==0 ) : echo "" ;else: foreach($vo['childNav'] as $key=>$voo): ?>                    <dd><a href="<?php echo $voo['url']; ?>"><?php echo $voo['name']; ?></a></dd>                    <?php endforeach; endif; else: echo "" ;endif; ?>                </dl>                <?php endif; ?>            </li>            <?php endforeach; endif; else: echo "" ;endif; ?>        </ul>        <form class="layui-form" action="<?php echo url('index/course/search'); ?>" style="position: absolute;top: 18px; right:330px;" >            <div class="layui-form-item">                <div class="layui-input-inline" style="width:250px;">                    <input type="text" name="keywords"   placeholder="请输入课程关键字"  class="layui-input search-input" >                    <button type="submit" class="layui-btn  layui-btn-position"><i class="layui-icon layui-icon-search"></i></button>                </div>            </div>        </form>        <?php if($islogin): ?>        <ul class="layui-nav layui-layout-right">            <?php if($userInfo['is_teacher'] == 1): ?>            <li class="layui-nav-item ">                <a href="<?php echo url('admin/index/index'); ?>">教师中心</a>            </li>            <?php else: ?>            <li class="layui-nav-item ">                <a href="<?php echo url('index/user/cooperate'); ?>">教师入驻</a>            </li>            <?php endif; ?>            <li class="layui-nav-item ">                <a href="<?php echo url('index/user/index'); ?>">个人中心</a>            </li>            <li class="layui-nav-item">                <a href=""><img src="<?php echo defaultAvatar($userInfo['avatar']); ?>" class="layui-nav-img"></a>                <dl class="layui-nav-child">                    <dd><a href="<?php echo url('index/user/index'); ?>">个人中心</a></dd>                    <!--<dd><a href="javascript:;">安全管理</a></dd>-->                    <dd><a href="<?php echo url('index/user/logout'); ?>">退了</a></dd>                </dl>            </li>        </ul>        <?php else: ?>        <ul class="layui-nav fly-nav-user">            <li class="layui-nav-item"> <a class="iconfont icon-touxiang layui-hide-xs" style="font-size:25px;margin-right:-25px;margin-top:-4px" href="<?php echo url('index/user/login'); ?>"></a> </li>            <li class="layui-nav-item"> <a href="<?php echo url('index/user/login'); ?>"  style="margin-right:-15px">登入</a> </li>            <li class="layui-nav-item"> <a href="<?php echo url('index/user/reg'); ?>"　style="margin-right:-15px">注册</a> </li>            <!-- <li class="layui-nav-item layui-hide-xs"> <a href="/app/qq/" style="font-size:25px;margin-right:-10px;margin-top:-4px" onclick="layer.msg('正在通过QQ登入', {icon:16, shade: 0.1, time:0})" title="QQ登入" class="iconfont icon-qq"></a> </li>             <li class="layui-nav-item layui-hide-xs"> <a href="/app/weibo/" style="font-size:25px;margin-top:-4px" onclick="layer.msg('正在通过微博登入', {icon:16, shade: 0.1, time:0})" title="微博登入" class="iconfont icon-weibo"></a> </li>-->            <span class="layui-nav-bar" style="left: 0px; top: 55px; width: 0px; opacity: 0;"></span>        </ul>        <?php endif; ?>    </div></div>
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
<div class="copyright">    <h4 class="title">合作伙伴</h4>    <div class="cooperation">        <a class="mlm" href="https://www.newlogo.cn" target="_blank">清考软件</a>    </div>    <h4 class="title">相关备案及证件号</h4>    <div class="cooperation">        <a class="mlm" href="javascript:void(0);" target="_blank">Copyright © 2018 - 2019 <?php echo config('website.site_copyright'); ?> 版权所有</a>        <a class="mlm" href="http://www.miibeian.gov.cn/" target="_blank"><?php echo config('website.site_icp'); ?></a>        <a class="mlm" href="javascript:void(0);" target="_blank"><?php echo config('website.site_code'); ?></a>    </div></div><script src="/static/libs/layui/layui.all.js"></script><script src="/static/js/jquery.min.js"></script><script src="/static/js/layui.base.js"></script>
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
</body></html>