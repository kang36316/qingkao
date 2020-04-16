<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:80:"D:\phpstudy_pro\WWW\qingkao\public/../application/admin\view\auth\saveGroup.html";i:1547447008;s:60:"D:\phpstudy_pro\WWW\qingkao\application\admin\view\base.html";i:1581221312;}*/ ?>
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
    
<link rel="stylesheet" href="/static/libs/ztree/css/zTreeStyle/zTreeStyle.css">

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
           <!-- <li class="layui-nav-item"><a href="/" target="_blank"><i class="fa fa-home"></i> 首页</a></li>-->
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
    <div class="layui-card-header">编辑数据</div>
    <div class="layui-card-body">
        <form action="<?php echo request()->url(); ?>" class="layui-form" method="post">
            <div class="layui-form-item">
                <label class="layui-form-label">用户组</label>
                <div class="layui-input-block">
                    <input type="text" name="name" value="<?php echo (isset($data['name']) && ($data['name'] !== '')?$data['name']:''); ?>" autocomplete="off" placeholder="请输入用户组" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">描述</label>
                <div class="layui-input-block">
                    <textarea name="description" placeholder="请输入描述" class="layui-textarea"><?php echo (isset($data['description']) && ($data['description'] !== '')?$data['description']:''); ?></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">授权</label>
                <div class="layui-input-block">
                    <input type="hidden" name="rules" value="<?php echo (isset($data['rules']) && ($data['rules'] !== '')?$data['rules']:''); ?>" id="rules">
                    <div  class="ztree" id="authRule"></div>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-filter="*" lay-submit="">保存</button>
                    <button class="layui-btn layui-btn-primary" type="reset">重置</button>
                </div>
            </div>
        </form>
    </div>
</div>

    </div>
</div>
<script src="/static/libs/layui/layui.all.js"></script>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/layui.base.js"></script>

<script src="/static/libs/ztree/js/jquery.ztree.all.min.js"></script>
<script>
$.fn.zTree.init($("#authRule"), {
    check: {
        enable: true,
        chkboxType: {'Y': 'ps', 'N': 's'},
    },
    view: {
        dblClickExpand: false,
        showLine: true,
        showIcon: false,
        selectedMulti: false
    },
    edit: {
        enable: true,
        editNameSelectAll: true,
        showRemoveBtn: false,
        showRenameBtn: false
    },
    data: {
        simpleData: {
            enable: true
        }
    },
    callback: {
        onCheck: function () {
            var zTree = $.fn.zTree.getZTreeObj('authRule');
            var rules = [];
            $.each(zTree.getCheckedNodes(), function (i, z) {
                rules.push(z.id);
            });
            $('#rules').val(rules.join(','));
        }
    }
}, <?php echo $authRule; ?>);
</script>

</body>
</html>