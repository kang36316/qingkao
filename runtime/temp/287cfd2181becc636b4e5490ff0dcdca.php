<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:83:"D:\phpstudy_pro\WWW\qingkaoedu\public/../application/admin\view\config\setting.html";i:1581221422;s:63:"D:\phpstudy_pro\WWW\qingkaoedu\application\admin\view\base.html";i:1586589108;}*/ ?>
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
        
<div class="layui-card">
    <div class="layui-card-body">
        <div class="layui-tab layui-tab-brief" lay-filter="group">
            <ul class="layui-tab-title">
                <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $k=>$v): ?>
                <li <?php if($k == 'website'): ?>class="layui-this"<?php endif; ?> lay-id="<?php echo $k; ?>"><?php echo $v['name']; ?></li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
            <div class="layui-tab-content">
                <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $k=>$v): ?>
                <div class="layui-tab-item <?php if($k == 'website'): ?>layui-show<?php endif; ?>">
                    <form action="<?php echo url('admin/config/setting'); ?>" class="layui-form" method="post">
                        <?php if(is_array($v['config']) || $v['config'] instanceof \think\Collection || $v['config'] instanceof \think\Paginator): if( count($v['config'])==0 ) : echo "" ;else: foreach($v['config'] as $key=>$config): ?>
                        <div class="layui-form-item">
                            <label class="layui-form-label"><?php echo $config['title']; ?></label>
                            <div class="layui-input-block">
                                <?php if($config['type'] == 'input'): ?>
                                <input type="text" name="<?php echo hashids_encode($config['id']); ?>" value="<?php echo (isset($config['value']) && ($config['value'] !== '')?$config['value']:''); ?>" placeholder="请输入<?php echo $config['title']; ?>" class="layui-input">
                                <?php endif; if($config['type'] == 'textarea'): ?>
                                <textarea name="<?php echo hashids_encode($config['id']); ?>" placeholder="请输入<?php echo $config['title']; ?>" class="layui-textarea"><?php echo (isset($config['value']) && ($config['value'] !== '')?$config['value']:''); ?></textarea>
                                <?php endif; if($config['type'] == 'select'): ?>
                                <select name="<?php echo hashids_encode($config['id']); ?>">
                                    <?php $_5e984b3aad542=parse_attr($config['options']); if(is_array($_5e984b3aad542) || $_5e984b3aad542 instanceof \think\Collection || $_5e984b3aad542 instanceof \think\Paginator): if( count($_5e984b3aad542)==0 ) : echo "" ;else: foreach($_5e984b3aad542 as $i=>$j): ?>
                                    <option value="<?php echo $i; ?>" <?php if($config['value'] == $i): ?>selected="selected"<?php endif; ?>><?php echo $j; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                                <?php endif; if($config['type'] == 'radio'): $_5e984b3aad520=parse_attr($config['options']); if(is_array($_5e984b3aad520) || $_5e984b3aad520 instanceof \think\Collection || $_5e984b3aad520 instanceof \think\Paginator): if( count($_5e984b3aad520)==0 ) : echo "" ;else: foreach($_5e984b3aad520 as $i=>$j): ?>
                                <input type="radio" name="<?php echo hashids_encode($config['id']); ?>" value="<?php echo $i; ?>" title="<?php echo $j; ?>" <?php if($config['value'] == $i): ?>checked="checked"<?php endif; ?>>
                                <?php endforeach; endif; else: echo "" ;endif; endif; if($config['type'] == 'image'): ?>
                                <input type="text" name="<?php echo hashids_encode($config['id']); ?>" value="<?php echo (isset($config['value']) && ($config['value'] !== '')?$config['value']:''); ?>" autocomplete="off" placeholder="请上传<?php echo $config['title']; ?>" class="layui-input">
                                <button type="button" class="layui-btn layui-btn-primary layui-btn-position ajax-file"><i class="fa fa-file-image-o"></i> 选择图片</button>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <button class="layui-btn" lay-filter="i" lay-submit="">保存</button>
                                <button class="layui-btn layui-btn-primary" type="reset">重置</button>
                            </div>
                        </div>
                    </form>
                </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
    </div>
</div>

    </div>
</div>
<script src="/static/libs/layui/layui.all.js"></script>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/layui.base.js"></script>

<script>
var layid = location.hash.replace(/^#group=/, '');
element.tabChange('group', layid);

element.on('tab(group)', function (elem) {
    location.hash = 'group=' + $(this).attr('lay-id');
});
</script>

</body>
</html>