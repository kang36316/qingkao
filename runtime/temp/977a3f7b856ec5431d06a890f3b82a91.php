<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:77:"/www/wwwroot/qingkao/public/../application/admin/view/exam/questionsList.html";i:1581220650;s:53:"/www/wwwroot/qingkao/application/admin/view/base.html";i:1586589108;}*/ ?>
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
        <form action="<?php echo url('admin/exam/questionsList'); ?>" class="layui-form" method="get">
            <div class="layui-form-item">
                <div class="layui-input-inline">
                    <input type="text" name="question" value="<?php echo input('question'); ?>" autocomplete="off" placeholder="请输入试题关键字" class="layui-input"/>
                </div>
                <div class="layui-input-inline">
                    <select name="questionchapterid">
                        <option value="">全部分类</option>
                        <?php if(is_array($courseCategory) || $courseCategory instanceof \think\Collection || $courseCategory instanceof \think\Paginator): if( count($courseCategory)==0 ) : echo "" ;else: foreach($courseCategory as $key=>$v): ?>
                        <option value="<?php echo $v['id']; ?>" <?php if(input('?questionknowsid') and (input('questionknowsid') == $v['id'])): ?>selected="selected"<?php endif; ?>><?php if($v['level'] != '1'): ?>|<?php $__FOR_START_1870276330__=1;$__FOR_END_1870276330__=$v['level'];for($i=$__FOR_START_1870276330__;$i < $__FOR_END_1870276330__;$i+=1){ ?> &#45;&#45;&#45;&#45;<?php } endif; ?> <?php echo $v['category_name']; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
                <div class="layui-input-inline">
                    <select name="questiontype">
                        <option value="">试题类型</option>
                        <?php if(is_array($type) || $type instanceof \think\Collection || $type instanceof \think\Paginator): if( count($type)==0 ) : echo "" ;else: foreach($type as $key=>$v): ?>
                        <option value="<?php echo $v['id']; ?>－<?php echo $v['mark']; ?>" <?php if(input('?questiontype') and (input('questiontype') == $v['id'])): ?>selected="selected"<?php endif; ?>><?php echo $v['type_name']; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
                <div class="layui-input-inline">
                    <select name="questionlevel">
                        <option value="">试题难度</option>
                        <option value="1" <?php if(input('?questionlevel') and (input('questionlevel') == 1)): ?> selected="selected"<?php endif; ?>>易</option>
                        <option value="2" <?php if(input('?questionlevel') and (input('questionlevel') == 2)): ?> selected="selected"<?php endif; ?>>中</option>
                        <option value="3" <?php if(input('?questionlevel') and (input('questionlevel') == 3)): ?> selected="selected"<?php endif; ?>>难</option>
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
            <a href="<?php echo url('admin/exam/questionsSingleAdd'); ?>" class="layui-btn ajax-iframe" data-width="800px" data-height="500px"><i class="fa fa-plus-circle"></i> 单题添加</a>
            <a href="<?php echo url('admin/exam/questionsCSVleAdd'); ?>" class="layui-btn ajax-iframe" data-width="800px" data-height="500px"><i class="fa fa-plus-circle"></i> CSV导入</a>
            <a href="<?php echo url('admin/exam/questionsDel'); ?>" class="layui-btn layui-btn-danger ajax-batch"><i class="fa fa-trash-o"></i> 批量删除</a>
        </div>
        <table class="layui-table layui-form">
            <thead>
            <tr>
                <th style="width:20px;"><input type="checkbox" lay-skin="primary" lay-filter="*"></th>
                <th style="width:40px;">ID</th>
                <th style="width:100px;">试题类型</th>
                <th >试题内容</th>
                <th  style="width:40px;">难度</th>
                <th  style="width:120px;">录入人</th>
                <th  style="width:210px;">录入时间</th>
                <th  style="width:120px;">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "$empty" ;else: foreach($list as $key=>$v): ?>
            <tr>
                <td><input type="checkbox" name="id" value="<?php echo $v['id']; ?>" lay-skin="primary"></td>
                <td><?php echo $v['id']; ?></td>
                <td><?php echo get_question_type($v['questiontype']); ?></td>
                <td class="layui-elip"><?php echo $v['question']; ?></td>
                <td><?php echo get_question_level($v['questionlevel']); ?></td>
                <td><?php echo getTeacherName($v['questionuserid']); ?></td>
                <td><?php echo $v['questioncreatetime']; ?></td>
                <td>
                    <div class="layui-btn-group mb0">
                        <a href="<?php echo url('admin/exam/questionsPreview', ['id' => $v['id']]); ?>" class="layui-btn  layui-btn-warm layui-btn-xs ajax-iframe" data-width="900px" data-height="600px"> <i class="layui-icon">&#xe705;</i></a>
                        <a href="<?php echo url('admin/exam/questionsEdit', ['id' => $v['id']]); ?>" class="layui-btn layui-btn-xs ajax-iframe" data-width="800px" data-height="500px"> <i class="layui-icon">&#xe642;</i></a>
                        <a href="<?php echo url('admin/exam/questionsDel', ['id' => $v['id']]); ?>" class="layui-btn layui-btn-xs layui-btn-danger ajax-delete"> <i class="layui-icon">&#xe640;</i></a>
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