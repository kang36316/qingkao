<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:78:"D:\phpstudy_pro\WWW\qingkao\public/../application/admin\view\coupon\index.html";i:1581221312;s:60:"D:\phpstudy_pro\WWW\qingkao\application\admin\view\base.html";i:1586589106;}*/ ?>
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
    <div class="layui-card-header">
        <form action="<?php echo url('admin/coupon/index'); ?>" class="layui-form" method="get">
            <div class="layui-form-item">
                <div class="layui-input-inline">
                    <input type="text" name="code" value="<?php echo input('code'); ?>" autocomplete="off" placeholder="请输入优惠券卡号" class="layui-input"/>
                </div>
                <div class="layui-input-inline">
                    <select name="buystatus">
                        <option value="">是否发放</option>
                        <option value="1" <?php if(input('?buystatus') and (input('buystatus') == 1)): ?> selected="selected"<?php endif; ?>>是</option>
                        <option value="0" <?php if(input('?buystatus') and (input('buystatus') == 0)): ?> selected="selected"<?php endif; ?>>否</option>
                    </select>
                </div>
                <div class="layui-input-inline">
                    <select name="usestatus">
                        <option value="">是否使用</option>
                        <option value="1" <?php if(input('?usestatus') and (input('usestatus') == 1)): ?> selected="selected"<?php endif; ?>>是</option>
                        <option value="0" <?php if(input('?usestatus') and (input('usestatus') == 0)): ?> selected="selected"<?php endif; ?>>否</option>
                    </select>
                </div>
                <div class="layui-input-inline">
                    <select name="status">
                        <option value="">状态</option>
                        <option value="0" <?php if(input('?status') and (input('status') == 0)): ?> selected="selected"<?php endif; ?>>正常</option>
                        <option value="1" <?php if(input('?status') and (input('status') == 1)): ?> selected="selected"<?php endif; ?>>禁用</option>
                    </select>
                </div>
                <div>
                    <button class="layui-btn layui-btn-primary ajax-search"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="layui-card-body">
        <div class="layui-btn-group">
            <a href="<?php echo url('admin/coupon/add'); ?>" class="layui-btn ajax-iframe" data-width="600px" data-height="400px"><i class="fa fa-plus-circle"></i> 生成优惠券</a>
            <a href="<?php echo url('admin/coupon/del'); ?>" class="layui-btn layui-btn-danger ajax-batch"><i class="fa fa-trash-o"></i> 批量删除</a>
            <a href="<?php echo url('admin/coupon/edit',['name' => 'status', 'value' => '1']); ?>" class="layui-btn layui-btn-primary ajax-batch"><i class="fa fa-ban"></i> 设为禁用</a>
            <a href="<?php echo url('admin/coupon/edit',['name' => 'status', 'value' => '0']); ?>" class="layui-btn layui-btn-primary ajax-batch"><i class="fa fa-bullseye"></i> 取消禁用</a>
            <a href="<?php echo url('admin/coupon/edit',['name' => 'buystatus', 'value' => '1']); ?>" class="layui-btn layui-btn-primary ajax-batch"><i class="fa fa-flag-o"></i> 标记发放</a>
            <a href="<?php echo url('admin/coupon/edit',['name' => 'buystatus', 'value' => '0']); ?>" class="layui-btn layui-btn-primary ajax-batch"><i class="fa fa-close"></i> 取消发放</a>
            <a href="<?php echo url('admin/coupon/fafang'); ?>" class="layui-btn layui-btn-primary ajax-iframe" data-width="600px" data-height="400px"><i class="fa fa-plus-circle"></i> 发放规则</a>
        </div>
        <table class="layui-table layui-form">
            <thead>
            <tr>
                <th style="width:20px;"><input type="checkbox" lay-skin="primary" lay-filter="*"></th>
                <th style="width:40px;">ID</th>
                <th >优惠券卡号</th>
                <th  style="width:80px;">优惠折扣</th>
                <th  style="width:80px;">是否发放</th>
                <th  style="width:80px;">是否使用</th>
                <th  style="width:120px;">使用者</th>
                <th  style="width:80px;">状态</th>
                <th  style="width:50px;">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "$empty" ;else: foreach($list as $key=>$v): ?>
            <tr>
                <td><input type="checkbox" name="id" value="<?php echo $v['id']; ?>" lay-skin="primary"></td>
                <td><?php echo $v['id']; ?></td>
                <td><?php echo $v['code']; ?></td>
                <td><?php echo $v['rate']; ?>折</td>
                <td><?php if($v['buystatus']==0): ?>未发放<?php endif; if($v['buystatus']==1): ?>已发放<?php endif; ?></td>
                <td><?php if($v['usestatus']==0): ?>未使用<?php endif; if($v['usestatus']==1): ?>已使用<?php endif; ?></td>
                <td><?php echo getUserName($v['userId']); ?></td>
                <td> <?php if($v['status']==0): ?>正常<?php endif; if($v['status']==1): ?><font color="red">禁用</font><?php endif; ?></td>
                <td><a href="<?php echo url('admin/coupon/del', ['id' => $v['id']]); ?>" class="layui-btn layui-btn-xs layui-btn-danger ajax-delete"> <i class="layui-icon">&#xe640;</i></a></td>
            </tr>
            <?php endforeach; endif; else: echo "$empty" ;endif; ?>
            </tbody>
        </table>
        <div class="page"><?php echo $list->render(); ?></div>
    </div>
</div>

    </div>
</div>
<script src="/static/libs/layui/layui.all.js"></script>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/layui.base.js"></script>

</body>
</html>