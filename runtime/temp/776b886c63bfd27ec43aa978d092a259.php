<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:79:"D:\phpstudy_pro\WWW\qingkao\public/../application/install\view\index\index.html";i:1560859092;s:69:"D:\phpstudy_pro\WWW\qingkao\application\install\view\public\base.html";i:1558350812;}*/ ?>
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
			
<div class="margin-top">
	<header>
		<h2 class="text-center mb10">清考在线教育软件 安装协议</h2>
		<section class="text-center abstract  mb20">版权所有 (c) 2019-2020，清考保留所有权利。</section>
	</header>
	<section class="article-content" style="text-indent: 2em">
		<p>
			清考在线教育软件基于
			<a target="_blank" href="http://www.thinkphp.cn">ThinkPHP</a>框架
			的开发产品。感谢顶想公司为清考在线教育软件提供内核支持。
		</p>

		<p>
			感谢您选择清考在线教育软件，希望我们的努力可以为您创造价值。公司网址为
			<a href="https://www.newlogo.cn" target="_blank">https://www.newlogo.cn</a>
			，产品官方网站网址为
			<a href="https://www.newlogo.cn" target="_blank">https://www.newlogo.cn</a>
			。
		</p>

		<p>
			用户须知：本协议是您于清考关于清考在线教育软件产品使用的法律协议。无论您是个人或组织、盈利与否、用途如何（包括以学习和研究为目的），均需仔细阅读本协议，包括免除或者限制清考责任的免责条款及对您的权利限制。请您审阅并接受或不接受本服务条款。如您不同意本服务条款及或清考随时对其的修改，您应不使用或主动取消清考在线教育软件产品。否则，您的任何对清考在线教育软件的相关服务的注册、登陆、下载、查看等使用行为将被视为您对本服务条款全部的完全接受，包括接受清考对服务条款随时所做的任何修改。
		</p>

		<p>
			本服务条款一旦发生变更,清考将在产品官网上公布修改内容。修改后的服务条款一旦在网站公布即有效代替原来的服务条款。您可随时登陆官网查阅最新版服务条款。如果您选择接受本条款，即表示您同意接受协议各项条件的约束。如果您不同意本服务条款，则不能获得使用本服务的权利。您若有违反本条款规定，清考有权随时中止或终止您对清考在线教育软件产品的使用资格并保留追究相关法律责任的权利。
		</p>

		<p>
			在理解、同意、并遵守本协议的全部条款后，方可开始使用清考在线教育软件产品。您也可能与清考直接签订另一书面协议，以补充或者取代本协议的全部或者任何部分。
		</p>

		<p>
			清考拥有清考在线教育软件的知识产权，包括商标和著作权。本软件只供许可协议，并非出售。想天只允许您在遵守本协议各项条款的情况下复制、下载、安装、使用或者以其他方式受益于本软件的功能或者知识产权。
		</p>

	</section>

</div>

			<div class="margin-top">
				
<div class="text-center">
	<a class="btn btn-primary" href="<?php echo url('Install/index/check'); ?>">同意安装协议</a>
	<a class="btn btn-default" style="background: white;" href="https://www.newlogo.cn">不同意</a>
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