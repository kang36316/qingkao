<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:82:"D:\phpstudy_pro\WWW\qingkao\public/../application/install\view\index\complete.html";i:1559262230;s:69:"D:\phpstudy_pro\WWW\qingkao\application\install\view\public\base.html";i:1558350812;}*/ ?>
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
			
<h1 class="text-center">完成</h1>
<div class="row">
	<div class="col-sm-6">
		<ul class="list-group">
			<li class="list-group-item"><a href="http://www.yxtcms.cn" target="_blank">易校通网校系统官网</a></li>
			<li class="list-group-item"><a href="" target="_blank">当前版本1.0.2</a></li>
			<li class="list-group-item"><a href="http://wpa.qq.com/msgrd?v=3&uin=378146005&site=qq&menu=yes" target="_blank">QQ客服</a></li>
		</ul>
	</div>
	<div class="col-sm-6">
		<ul class="list-group">
			<li class="list-group-item"><a href="http://www.yxtcms.cn" target="_blank">使用文档</a></li>
			<li class="list-group-item"><a href="http://bbs.yxtcms.cn" target="_blank">易校通讨论社区</a></li>
			<li class="list-group-item"><a href="https://jq.qq.com/?_wv=1027&k=5Ddg9Vl" target="_blank">使用交流群</a></li>
		</ul>
	</div>
</div>

			<div class="margin-top">
				
<div class="text-center">
    <a class="btn btn-primary" target="_blank" href="<?php echo url('/admin'); ?>">登录后台</a>
    <a class="btn btn-success" target="_blank" href="<?php echo url('/'); ?>">访问首页</a>
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