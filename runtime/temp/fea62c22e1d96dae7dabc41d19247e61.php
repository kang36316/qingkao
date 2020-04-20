<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:79:"D:\phpstudy_pro\WWW\qingkao\public/../application/install\view\index\check.html";i:1558351070;s:69:"D:\phpstudy_pro\WWW\qingkao\application\install\view\public\base.html";i:1558350812;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo config('website.site_title'); ?>系统安装</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" type="text/css" href="/static/libs/layui/css/layui.css" media="all">
	<link rel="stylesheet" type="text/css" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/static/css/base.css" media="all">
	
	<style>
		body{font-family: "Microsoft Yahei",'新宋体';}
		.container{background: #ffffff; margin: 50px auto; padding: 20px 0; width: 1024px;}
		.header-title{border-bottom: 1px solid #dedede; margin-bottom: 10px;}
		.progress-tool{padding: 10px;}
		.progress{height: 30px;}
		.progress-bar{line-height: 30px; font-size: 14px;}
		.article{padding: 0 20px;}
		h1{font-size: 18px; color: #333333; font-weight: bold;}
		h2{font-size: 16px; color: #333333; font-weight: bold;}
	</style>
	
</head>
<body style="background:  rgb(230, 234, 234)">
<div class="container">
	<div class="margin">
		<div class="text-center header-title margin-top">
			<h1>清考在线教育软件系统<?php if(session('update')): ?>升级<?php else: ?>安装<?php endif; ?></h1>
		</div>
		<div class="progress-tool">
			<div class="progress">
				<div class="progress-bar progress-bar-<?php echo $status['index']; ?> progress-bar-striped" style="width: 20%">
					<span>系统安装</span>
				</div>
				<div class="progress-bar progress-bar-<?php echo $status['check']; ?> progress-bar-striped" style="width: 20%">
					<span>环境检查</span>
				</div>
				<div class="progress-bar progress-bar-<?php echo $status['config']; ?> progress-bar-striped" style="width: 20%">
					<span>系统配置</span>
				</div>
				<div class="progress-bar progress-bar-<?php echo $status['sql']; ?> progress-bar-striped" style="width: 20%">
					<span>数据库安装</span>
				</div>
				<div class="progress-bar progress-bar-<?php echo $status['complete']; ?> progress-bar-striped" style="width: 20%">
					<span>安装完成</span>
				</div>
			</div>
		</div>
		<div class="article margin-top">
			
	<h1>环境检测</h1>
	<table class="table table-hover">
		<caption><h2>运行环境检查</h2></caption>
		<thead>
			<tr>
				<th>项目</th>
				<th>所需配置</th>
				<th>当前配置</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($env) || $env instanceof \think\Collection || $env instanceof \think\Paginator): $i = 0; $__LIST__ = $env;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
				<tr>
					<td><?php echo $item[0]; ?></td>
					<td><?php echo $item[1]; ?></td>
					<td><i class="icon icon-<?php echo $item[4]; ?>">&nbsp;</i><?php echo $item[3]; ?></td>       
				</tr>
			<?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>
	<?php if(isset($dirfile)): ?>
	<table class="table table-hover">
		<caption><h2>目录、文件权限检查</h2></caption>
		<thead>
			<tr>
				<th>目录/文件</th>
				<th>所需状态</th>
				<th>当前状态</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($dirfile) || $dirfile instanceof \think\Collection || $dirfile instanceof \think\Paginator): $i = 0; $__LIST__ = $dirfile;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
				<tr>
					<td><?php echo $item[3]; ?></td>
					<td><i class="icon icon-ok">&nbsp;</i>可写</td>
					<td><i class="icon icon-<?php echo $item[2]; ?>">&nbsp;</i><?php echo $item[1]; ?></td>
				</tr>
			<?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>
	<?php endif; ?>
	<table class="table table-hover">
		<caption><h2>函数依赖性检查</h2></caption>
		<thead>
			<tr>
				<th>函数名称</th>
				<th>检查结果</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($func) || $func instanceof \think\Collection || $func instanceof \think\Paginator): $i = 0; $__LIST__ = $func;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
				<tr>
					<td><?php echo $item[0]; ?>()</td>
					<td><i class="icon icon-<?php echo $item[2]; ?>">&nbsp;</i><?php echo $item[1]; ?></td>
				</tr>
			<?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>

			<div class="margin-top">
				
<div class="text-center">
	<?php if($status['error']): ?>
	<a class="btn btn-default" lay-filter="*" lay-submit="" href="<?php echo url('install/index/check'); ?>">重新检测</a>
	<?php else: ?>
	<a class="btn btn-primary" lay-filter="*" lay-submit="" href="<?php echo url('install/index/config'); ?>">下一步</a>
	<?php endif; ?>
    <a class="btn btn-default" href="<?php echo url('install/index/index'); ?>">上一步</a>
</div>

			</div>
		</div>
	</div>
</div>
<script src="/static/libs/layui/layui.all.js"></script>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/layui.base.js"></script>

</body>
</html>