<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:36:"../template/pc/user\myclassroom.html";i:1581221382;s:56:"D:\phpstudy_pro\WWW\qingkaoedu\template\pc\userbase.html";i:1586588300;}*/ ?>
<!DOCTYPE html><html lang="zh-cn"><head>    <meta charset="utf-8">    <title><?php echo config('website.site_title'); ?></title>    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">    <meta name="keywords" content="<?php echo config('website.site_keywords'); ?>">    <meta name="description" content="<?php echo config('website.site_description'); ?>">    <link rel="stylesheet" href="//at.alicdn.com/t/font_24081_qs69ykjbea.css">    <link rel="stylesheet" type="text/css" href="/static/libs/layui/css/layui.css">    <link rel="stylesheet" type="text/css" href="/static/css/home.base.css" media="all">    <link rel="stylesheet" type="text/css" href="/static/css/base.css" media="all">    <link rel="stylesheet" type="text/css" href="/static/css/user.css" media="all">    <link rel="shortcut icon" href="<?php echo config('website.icon'); ?>" />    <link rel="bookmark"href="<?php echo config('website.icon'); ?>" />        <style type="text/css">html {background-color: #F2F2F2;}</style>    </head><body><div class="layui-layout ">    <div class="layui-header header ">        <a class="logo" href="/"> <img src="<?php echo config('website.logo'); ?>" alt="<?php echo config('website.site_title'); ?>"> </a>        <ul class="layui-nav layui-layout-left" lay-filter="">            <li class="layui-nav-item"><a href="/">首页</a></li>            <?php if(is_array($nav) || $nav instanceof \think\Collection || $nav instanceof \think\Paginator): if( count($nav)==0 ) : echo "" ;else: foreach($nav as $key=>$vo): ?>            <li class="layui-nav-item">                <a href="<?php echo $vo['url']; ?>"><?php echo $vo['name']; ?></a>                <?php if($vo['childNav']): ?>                <dl class="layui-nav-child">                    <?php if(is_array($vo['childNav']) || $vo['childNav'] instanceof \think\Collection || $vo['childNav'] instanceof \think\Paginator): if( count($vo['childNav'])==0 ) : echo "" ;else: foreach($vo['childNav'] as $key=>$voo): ?>                    <dd><a href="<?php echo url($voo['url']); ?>"><?php echo $voo['name']; ?></a></dd>                    <?php endforeach; endif; else: echo "" ;endif; ?>                </dl>                <?php endif; ?>            </li>            <?php endforeach; endif; else: echo "" ;endif; ?>        </ul>        <form class="layui-form" action="<?php echo url('index/course/search'); ?>" style="position: absolute;top: 18px; right:330px;" >            <div class="layui-form-item">                <div class="layui-input-inline" style="width:250px;">                    <input type="text" name="keywords"   placeholder="请输入课程关键字"  class="layui-input search-input" >                    <button type="submit" class="layui-btn  layui-btn-position"><i class="layui-icon layui-icon-search"></i></button>                </div>            </div>        </form>        <?php if($islogin): ?>        <ul class="layui-nav layui-layout-right">            <?php if($userInfo['is_teacher'] == 1): ?>            <li class="layui-nav-item ">                <a  href="<?php echo url('admin/index/index'); ?>">教师中心</a>            </li>            <?php else: ?>            <li class="layui-nav-item ">                <a href="<?php echo url('index/user/cooperate'); ?>">教师入驻</a>            </li>            <?php endif; ?>            <li class="layui-nav-item ">                <a href="<?php echo url('index/user/index'); ?>">个人中心</a>            </li>            <li class="layui-nav-item">                <a href=""><img src="<?php echo defaultAvatar($userInfo['avatar']); ?>" class="layui-nav-img"></a>                <dl class="layui-nav-child">                    <dd><a href="<?php echo url('index/user/index'); ?>">个人中心</a></dd>                    <!--<dd><a href="javascript:;">安全管理</a></dd>-->                    <dd><a href="<?php echo url('index/user/logout'); ?>">退了</a></dd>                </dl>            </li>        </ul>        <?php else: ?>        <ul class="layui-nav fly-nav-user">            <li class="layui-nav-item"> <a class="iconfont icon-touxiang layui-hide-xs" style="font-size:25px;margin-right:-25px;margin-top:-4px" href="<?php echo url('index/user/login'); ?>"></a> </li>            <li class="layui-nav-item"> <a href="<?php echo url('index/user/login'); ?>"  style="margin-right:-15px">登入</a> </li>            <li class="layui-nav-item"> <a href="<?php echo url('index/user/reg'); ?>"　style="margin-right:-15px">注册</a> </li>            <span class="layui-nav-bar" style="left: 0px; top: 55px; width: 0px; opacity: 0;"></span>        </ul>        <?php endif; ?>    </div></div><div class="personalCTop">    <div class="center">        <div class="teacher_Banner">            <div class="teacher_Banner_Img">                <div class="teacher_Banner_Mask"></div>                <img src="<?php echo defaultAvatar($userInfo['avatar']); ?>" alt="<?php echo $info['title']; ?>">            </div>            <div class="img"><img src="<?php echo defaultAvatar($userInfo['avatar']); ?>" alt="<?php echo $userInfo['username']; ?>"></div>            <div class="fl c-fff font14 font">                <p class="font26 mt10"><?php echo $userInfo['username']; ?></p>                <p class="mt10"><?php if($userInfo['is_teacher'] == 1): ?>教师身份<?php else: ?>普通用户<?php endif; ?></p>            </div>        </div>    </div></div><div class="layui-container mt20 mb20">    <div class="layui-container fly-marginTop fly-user-main">        <ul class="layui-nav layui-nav-tree layui-bg-white">            <li class="layui-nav-item"><a href="<?php echo url('index/user/index'); ?>"><i class="layui-icon layui-icon-home"></i>个人主页</a></li>            <li class="layui-nav-item"><a href="<?php echo url('index/user/mycourse'); ?>"><i class="layui-icon layui-icon-video"></i>我的课程</a></li>            <li class="layui-nav-item"><a href="<?php echo url('index/user/myclassroom'); ?>"><i class="layui-icon layui-icon-video"></i>我的班级</a></li>            <li class="layui-nav-item"><a href="<?php echo url('index/user/myfavourite'); ?>"><i class="layui-icon layui-icon-star"></i>我的收藏</a></li>            <li class="layui-nav-item"><a href="<?php echo url('index/user/myorder'); ?>"><i class="layui-icon layui-icon-form"></i></i>我的订单</a></li>            <li class="layui-nav-item"><a href="<?php echo url('index/user/mycoupon'); ?>"><i class="layui-icon layui-icon-layer"></i></i>我的优惠卡</a></li>            <li class="layui-nav-item"><a href="<?php echo url('index/user/myinfo'); ?>"><i class="layui-icon layui-icon-set"></i>基本资料</a></li>            <li class="layui-nav-item"><a href="<?php echo url('index/user/card'); ?>"><i class="layui-icon layui-icon-rmb"></i>点卡充值</a></li>            <li class="layui-nav-item"><a href="<?php echo url('index/user/binding'); ?>"><i class="layui-icon layui-icon-video"></i>绑定手机</a></li>        </ul>        
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
    </div></div><div class="copyright">    <h4 class="title">合作伙伴</h4>    <div class="cooperation">        <a class="mlm" href="http://www.newlogo.cn" target="_blank">清考软件</a>    </div>    <h4 class="title">相关备案及证件号</h4>    <div class="cooperation">        <a class="mlm" href="javascript:void(0);" target="_blank">Copyright © 2018 - 2019 <?php echo config('website.site_copyright'); ?> 版权所有</a>        <a class="mlm" href="http://www.miibeian.gov.cn/" target="_blank"><?php echo config('website.site_icp'); ?></a>        <a class="mlm" href="javascript:void(0);" target="_blank"><?php echo config('website.site_code'); ?></a>    </div></div><script src="/static/libs/layui/layui.all.js"></script><script src="/static/js/jquery.min.js"></script><script src="/static/js/layui.base.js"></script><script type='text/javascript'>    $(document).ready(function (){        $("li").each(function(index){            $(this).click(function(){                $("li").removeClass("active");                $("li").eq(index).addClass("active");            });        });    });</script>
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
</body></html>