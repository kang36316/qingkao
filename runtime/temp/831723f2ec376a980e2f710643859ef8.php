<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:80:"D:\phpstudy_pro\WWW\qingkaoedu\public/../application/admin\view\index\index.html";i:1587039400;s:63:"D:\phpstudy_pro\WWW\qingkaoedu\application\admin\view\base.html";i:1586589108;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?php if($userInfo['is_teacher'] == 1): ?>
    <title>课程管理系统</title>
    <?php else: ?>
    <title>后台管理系统</title>
    <?php endif; ?>
    <link rel="stylesheet" href="/static/libs/layui/css/layui.css">
    <link rel="stylesheet" href="/static/css/base.css">
    <link rel="stylesheet" href="/static/css/fonts.css">
    
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
    <div class="layui-header layui-bg-green">
        <?php if($userInfo['is_teacher'] == 1): ?>
        <div class="layui-logo">课程管理系统</div>
        <?php else: ?>
        <div class="layui-logo">后台管理系统</div>
        <?php endif; ?>
        <ul class="layui-nav layui-layout-left">
            <?php if(is_array($navbar) || $navbar instanceof \think\Collection || $navbar instanceof \think\Paginator): if( count($navbar)==0 ) : echo "" ;else: foreach($navbar as $key=>$v): ?>
            <li class="layui-nav-item <?php if(isset($breadcrumb['0']) and $breadcrumb['0'] == $v['name']): ?>layui-this<?php endif; ?>">
                <a href="<?php echo \think\Request::instance()->root(true); ?>/<?php if(empty($v['url'])): ?><?php echo $v['children']['0']['url']; else: ?><?php echo $v['url']; endif; ?>"><i class="<?php echo $v['icon']; ?>"></i> <?php echo $v['name']; ?></a>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item"><a href="/" target="_blank"><i class="fa fa-home"></i> 首页</a></li>
            <li class="layui-nav-item"><a href="<?php echo url('admin/index/clear'); ?>" class="ajax-action"><i class="fa fa-trash"></i> 清除缓存</a></li>
            <?php if($userInfo['is_teacher'] != 1): ?>
            <li class="layui-nav-item">
                <a href="javascript:;"><i class="fa fa-user"></i> <?php echo session('admin_auth.username'); ?></a>
                <dl class="layui-nav-child">
                    <dd><a href="<?php echo url('admin/index/editPassword'); ?>">修改密码</a></dd>
                    <dd><a href="<?php echo url('admin/index/logout'); ?>">退出登录</a></dd>
                </dl>
            </li>
            <?php endif; ?>
        </ul>
    </div>
    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <ul class="layui-nav layui-nav-tree">
                <li class="layui-nav-item"><a href="<?php echo url('admin/index/index'); ?>"><i class="fa fa-home fa-fw"></i> 控制台</a></li>
                <?php if(is_array($navbar) || $navbar instanceof \think\Collection || $navbar instanceof \think\Paginator): if( count($navbar)==0 ) : echo "" ;else: foreach($navbar as $key=>$n0): if(isset($n0['children']) and isset($breadcrumb['0']) and $breadcrumb['0'] == $n0['name']): if(is_array($n0['children']) || $n0['children'] instanceof \think\Collection || $n0['children'] instanceof \think\Paginator): if( count($n0['children'])==0 ) : echo "" ;else: foreach($n0['children'] as $key=>$n1): ?>
                <li class="layui-nav-item <?php if(isset($breadcrumb['1']) and $breadcrumb['1'] == $n1['name']): if(isset($n1['children'])): ?>layui-nav-itemed<?php else: ?>layui-this<?php endif; endif; ?>">
                    <a href="<?php if(isset($n1['children'])): ?>javascript:;<?php else: ?><?php echo \think\Request::instance()->root(true); ?>/<?php echo $n1['url']; endif; ?>"><i class="<?php echo $n1['icon']; ?> fa-fw"></i> <?php echo $n1['name']; ?></a>
                    <?php if(isset($n1['children'])): ?>
                    <dl class="layui-nav-child">
                        <?php if(is_array($n1['children']) || $n1['children'] instanceof \think\Collection || $n1['children'] instanceof \think\Paginator): if( count($n1['children'])==0 ) : echo "" ;else: foreach($n1['children'] as $key=>$n2): ?>
                        <dd<?php if(isset($breadcrumb['2']) and $breadcrumb['2'] == $n2['name']): ?> class="layui-this"<?php endif; ?>><a href="<?php echo \think\Request::instance()->root(true); ?>/<?php echo $n2['url']; ?>"><?php echo $n2['name']; ?></a></dd>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </dl>
                    <?php endif; ?>
                </li>
                <?php endforeach; endif; else: echo "" ;endif; endif; endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
    <div class="layui-breadcrumb">
        <?php if(isset($breadcrumb)): if(is_array($breadcrumb) || $breadcrumb instanceof \think\Collection || $breadcrumb instanceof \think\Paginator): if( count($breadcrumb)==0 ) : echo "" ;else: foreach($breadcrumb as $key=>$v): ?>
        <a><cite><?php echo $v; ?></cite></a>
        <?php endforeach; endif; else: echo "" ;endif; endif; ?>
    </div>
    <div class="layui-body">
        
<div class="layui-row layui-col-space15">
    <?php if(!empty($index)): ?>
    <div class="layui-col-md12">
        <div class="layui-card">
            <div class="layui-card-header">快捷方式</div>
            <div class="layui-card-body">
                <div class="index-nav layui-clear">
                    <?php if(is_array($index) || $index instanceof \think\Collection || $index instanceof \think\Paginator): if( count($index)==0 ) : echo "" ;else: foreach($index as $key=>$v): ?>
                    <a class="layui-col-md1 mb10" href="<?php echo \think\Request::instance()->root(true); ?>/<?php echo $v['url']; ?>"><i class="<?php echo $v['icon']; ?>"></i> <?php echo $v['name']; ?></a>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; if($userInfo['is_teacher'] == 1): ?>
    <div class="layui-col-md6">
        <div class="layui-card">
            <div class="layui-card-header">教师信息</div>
            <div class="layui-card-body">
                <form action="<?php echo url('admin/index/teacherInfoSave'); ?>" class="layui-form mt20 layui-form-pane" method="post">
                    <div class="layui-form-item ">
                        <label class="layui-form-label">真实姓名</label>
                        <div class="layui-input-inline">
                            <input type="text" name="username" disabled  value="<?php echo $teacherInfo['username']; ?>" class="layui-input" >
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">手机号码</label>
                        <div class="layui-input-inline">
                            <input type="text" name="mobile" disabled   value="<?php echo $teacherInfo['mobile']; ?>"  class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">性别</label>
                        <div class="layui-input-block">
                            <input type="radio" name="sex" value="保密" title="保密" checked>
                            <input type="radio" name="sex" value="男" title="男">
                            <input type="radio" name="sex" value="女" title="女" >
                        </div>
                    </div>
                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">个人简介</label>
                        <div class="layui-input-block">
                            <textarea name="brief" lay-verify="required" class="layui-textarea"><?php echo $teacherInfo['brief']; ?></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">个人签名</label>
                        <div class="layui-input-block">
                            <textarea name="sign" class="layui-textarea"><?php echo $teacherInfo['sign']; ?></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <input type="hidden" name="id" value="<?php echo $teacherInfo['id']; ?>"  class="layui-input">
                            <button class="layui-btn" lay-filter="*" lay-submit="">修改</button>
                            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="layui-col-md6">
        <div class="layui-card">
            <div class="layui-card-header">个人账户</div>
            <div class="layui-card-body">
                <div class="layui-row">
                    <div class="layui-col-md6">
                        账户总金额：<?php echo $profit; ?>元
                    </div>
                    <div class="layui-col-md4">
                        可提现金额：<?php echo $profit; ?>元
                    </div>
                    <div class="layui-col-md2">
                        <a href="<?php echo url('admin/user/tixian'); ?>" type="button" class="layui-btn  layui-btn-xs ajax-iframe"
                           data-width="500px" data-height="400px">提现</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="layui-card">
            <div class="layui-card-header">提现明细</div>
            <div class="layui-card-body">
                <div class="layui-row">
                    <div class="layui-col-md12">
                        <table class="layui-table">
                            <tbody>
                            <tr>
                                <td >提现金额</td>
                                <td >提现途径</td>
                                <td >状态</td>
                                <td >日期</td>
                            </tr>
                            <?php if(is_array($tixianList) || $tixianList instanceof \think\Collection || $tixianList instanceof \think\Paginator): if( count($tixianList)==0 ) : echo "" ;else: foreach($tixianList as $key=>$v): ?>
                            <tr>
                                <td ><?php echo $v['money']; ?>元</td>
                                <td ><?php echo $v['type']; ?></td>
                                <td ><?php echo get_tixian_status($v['status']); ?></td>
                                <td ><?php echo $v['addtime']; ?></td>
                            </tr>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="page"><?php echo $tixianList->render(); ?></div>
            </div>
        </div>
    </div>
    <?php endif; if($userInfo['is_teacher'] != 1): ?>
<!--    <div class="layui-col-md6">-->
<!--        <div class="layui-card">-->
<!--            <div class="layui-card-header">域名授权信息</div>-->
<!--            <div class="layui-card-body">-->
<!--                <table class="layui-table">-->
<!--                    <tbody>-->
<!--                    <tr>-->
<!--                        <td style="width:50%;">授权域名：<?php echo get_domain(); ?></td>-->
<!--                        <?php if($authoInfo['authorcode']): ?>-->
<!--                        <td style="width:50%;">授权码：<?php echo $authoInfo['authorcode']; ?></td>-->
<!--                        <?php else: ?>-->
<!--                        <td>授权码：<input style="width:170px" type="text" name="author_code"  class="layui-input ajax-update layui-input-inline" data-url="<?php echo url('admin/config/addAuthorCode'); ?>"></td>-->
<!--                        <?php endif; ?>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <td style="width:50%;">授权到期：<?php echo $authoInfo['endtime']; ?></td>-->
<!--                        <?php if($authoInfo['authorcode']): ?>-->
<!--                        <td style="width:50%;">剩余时间：<?php echo $authoInfo['yu']; ?> <a  href='<?php echo $url; ?>' target="_blank" class="layui-btn layui-btn-sm ml10">续费</a></td>-->
<!--                        <?php else: ?>-->
<!--                        <td style="width:50%;">剩余时间：<a  href="<?php echo $authoInfo['server']; ?>/authorize"  target="_blank" class="layui-btn layui-btn-sm">去授权</a></td>-->
<!--                        <?php endif; ?>-->
<!--                    </tr>-->
<!--                    </tbody>-->
<!--                </table>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="layui-col-md6">-->
<!--        <div class="layui-card">-->
<!--            <div class="layui-card-header">版本信息</div>-->
<!--            <div class="layui-card-body">-->
<!--                <table class="layui-table">-->
<!--                    <tbody>-->
<!--                    <tr>-->
<!--                        <td style="width:50%;">当前版本：<?php echo $version; ?></td>-->
<!--                        <td style="width:50%;">最新版本：<?php echo $lastVersion['version']; ?></td>-->
<!--						<input type="hidden" id="lastVersion" value="<?php echo $lastVersion['version']; ?>">-->
<!--                        <input type="hidden" id="nowVesion" value="<?php echo $version; ?>">-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <td colspan="2" style="width:50%;">在线升级：<a  url="<?php echo url('admin/update/Version'); ?>" upurl="<?php echo url('admin/update/index'); ?>"  class="layui-btn layui-btn-sm upversion">一键升级</a></td>-->
<!--                    </tr>-->
<!--                    </tbody>-->
<!--                </table>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
    <?php if(!empty($server)): ?>
    <div class="layui-col-md12">
        <div class="layui-card">
            <div class="layui-card-header">服务器信息</div>
            <div class="layui-card-body">
                <table class="layui-table">
                    <tbody>
                    <tr>
                        <td style="width:50%;">服务器操作系统：<?php echo $server['os']; ?></td>
                        <td style="width:50%;">服务器软件：<?php echo $server['sapi']; ?></td>
                    </tr>
                    <tr>
                        <td>PHP版本：<?php echo $server['version']; ?></td>
                        <td>MySQL版本：<?php echo $server['mysql']['0']['version']; ?></td>
                    </tr>
                    <tr>
                        <td>根目录：<?php echo $server['root']; ?></td>
                        <td>最大执行时间：<?php echo $server['max_execution_time']; ?></td>
                    </tr>
                    <tr>
                        <td>文件上传限制：<?php echo $server['upload_max_filesize']; ?></td>
                        <td>允许内存大小：<?php echo $server['memory_limit']; ?></td>
                    </tr>
                    <tr>
                        <td>服务器时间：<?php echo $server['date']; ?></td>
                        <td>官方网站：<a href="http://www.qingkaojy.com/" target="_blank">清考教育</a></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php endif; endif; ?>
</div>

    </div>
</div>
<script src="/static/libs/layui/layui.all.js"></script>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/layui.base.js"></script>

<script src="/static/js/upversion.js"></script>

</body>
</html>