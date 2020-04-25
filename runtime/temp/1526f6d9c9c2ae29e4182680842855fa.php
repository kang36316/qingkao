<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:30:"../template/pc/user\index.html";i:1581221010;s:56:"D:\phpstudy_pro\WWW\qingkaoedu\template\pc\userbase.html";i:1586588300;}*/ ?>
<!DOCTYPE html>
<div class="fly-panel fly-panel-user" pad20="">
    <div class="layui-tab layui-tab-brief" lay-filter="user-btn">
        <div class="layui-tab-content layui-sign layui-clear" style="padding:20px 0;">
            <div class="fly-home"><img src="<?php echo defaultAvatar($userInfo['avatar']); ?>" alt="<?php echo $userInfo['username']; ?>"><h1><?php echo $userInfo['username']; ?></h1><p class="fly-home-info">
                <span >账户余额：<i class="layui-icon layui-icon-rmb" style="color:#ea4335;"></i><span style="color:#ea4335;"><?php echo $userInfo['yue']; ?></span></span>
                <i class="ics cs-time"></i><span><?php echo $userInfo['create_time']; ?> 加入</span></p><hr>
                <ul class="layui-clear">
                    <li><a href="<?php echo url('index/user/myinfo'); ?>"><i class="layui-icon layui-icon-set-sm"></i><p>基本设置</p></a></li>
                    <li><a href="<?php echo url('index/user/card'); ?>"><i class="layui-icon layui-icon-rmb"></i><p>点卡充值</p></a></li>
                    <li><a href="<?php echo url('index/user/repass'); ?>"><i class="layui-icon layui-icon-password"></i><p>修改密码</p></a></li>
                    <li><a href="<?php echo url('index/user/logout'); ?>"><i class="layui-icon layui-icon-return"></i><p>退出登录</p></a></li>
                </ul>
                <blockquote class="layui-elem-quote">欢迎，您上次登录是在（<?php echo stampTodata($userInfo['last_login_time']); ?>），登录IP：（<?php echo $userInfo['last_login_ip']; ?>），如非本人操作，请检查账号安全状态！</blockquote>
            </div>
        </div>
    </div>
</div>
