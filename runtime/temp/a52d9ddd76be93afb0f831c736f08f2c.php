<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:76:"D:\phpstudy_pro\WWW\qingkao\public/../application/admin\view\user\index.html";i:1581221392;s:60:"D:\phpstudy_pro\WWW\qingkao\application\admin\view\base.html";i:1586589106;}*/ ?>
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
        <div class="layui-btn-group fl">
		    <a href="<?php echo url('admin/user/add'); ?>" class="layui-btn"><i class="fa fa-plus-circle"></i> 添加会员</a>
			<a href="<?php echo url('admin/user/import'); ?>" class="layui-btn ajax-iframe" data-width="500px" data-height="300px"><i class="fa fa-plus-circle"></i> 批量导入</a>
		    <a href="<?php echo url('admin/user/export'); ?>" class="layui-btn layui-btn-primary"><i class="fa fa-file-excel-o"></i> 导出会员</a>
        </div>
		<div class="fl ml20">
			<form action="<?php echo url('admin/user/index'); ?>" class="layui-form" method="get" style="padding:0px;">
				<div class="layui-form-item">
					<div class="layui-input-inline">
						<input type="text" name="key" value="<?php echo input('key'); ?>" autocomplete="off" placeholder="用学员用户名或手机号搜索" class="layui-input"/>
					</div>
					<div class="fl">
						<button class="layui-btn layui-btn-primary ajax-search"><i class="fa fa-search"></i></button>
					</div>
				</div>
			</form>
		</div>
		<table class="layui-table layui-form">
			<thead>
				<tr>
					<th>ID</th>
					<th>用户名</th>
					<th>手机号</th>
					<th>余额</th>
					<th>上次登录时间</th>
					<th>登录次数</th>
					<th>创建时间</th>
					<th>状态</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "$empty" ;else: foreach($list as $key=>$v): ?>
				<tr>
					<td><?php echo $v['id']; ?></td>
					<td><?php echo $v['username']; ?></td>
					<td><?php echo $v['mobile']; ?></td>
					<td><?php echo $v['yue']; ?></td>
					<td><?php if(empty($v['last_login_time'])): ?>无<?php else: ?><?php echo date('Y-m-d H:i:s', $v['last_login_time']); endif; ?></td>
					<td><?php echo $v['login_count']; ?></td>
					<td><?php echo $v['create_time']; ?></td>
					<td>
						<input type="checkbox" name="status" lay-skin="switch" lay-filter="*" lay-text="启用|禁用" data-url="<?php echo url('admin/user/edit', ['id' => $v['id']]); ?>" <?php if($v['status'] == 1): ?>checked="checked"<?php endif; ?>>
					</td>
					<td>
						<div class="layui-btn-group mb0">
							<a href="<?php echo url('admin/user/edit', ['id' => $v['id']]); ?>" class="layui-btn layui-btn-xs"> <i class="layui-icon">&#xe642;</i></a>
							<a href="<?php echo url('admin/user/addmoney', ['id' => $v['id']]); ?>" class="layui-btn layui-btn-xs  layui-btn-normal  ajax-iframe" data-width="600px" data-height="400px" data-type="admin"><i class="layui-icon">&#xe65e;</i></a>
							<!--<a href="<?php echo url('admin/user/course', ['id' => $v['id']]); ?>" class="layui-btn layui-btn-xs  layui-btn-warm   ajax-iframe" data-width="600px" data-height="400px" data-type="admin" ><i class="layui-icon">&#xe62c;</i></a>-->
							<a href="<?php echo url('admin/user/del', ['id' => $v['id']]); ?>" class="layui-btn layui-btn-xs layui-btn-danger ajax-delete"> <i class="layui-icon">&#xe640;</i></a>
						</div>
					</td>
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