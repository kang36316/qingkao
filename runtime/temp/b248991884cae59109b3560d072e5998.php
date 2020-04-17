<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:86:"D:\phpstudy_pro\WWW\qingkaoedu\public/../application/admin\view\course\videoadmin.html";i:1581220650;s:63:"D:\phpstudy_pro\WWW\qingkaoedu\application\admin\view\base.html";i:1586589108;}*/ ?>
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
    <div class="layui-card-header">课程管理：<?php echo $data['title']; ?></div>
    <div class="layui-card-body">
        <div class="layui-btn-group">
            <a href="<?php echo url('admin/course/videoAddZhang', ['cid' => $data['id']]); ?>" class="layui-btn layui-btn-primary ajax-iframe" data-width="800px" data-height="500px"><i class="fa fa-plus-circle"></i> 添加章</a>
            <a href="<?php echo url('admin/course/videoAddSection',['cid' => $data['id']]); ?>" class="layui-btn layui-btn-primary ajax-iframe" data-width="800px" data-height="500px"><i class="fa fa-plus-circle"></i> 视频课程</a>
            <a href="<?php echo url('admin/course/videoAddDoc',['cid' => $data['id']]); ?>" class="layui-btn layui-btn-primary ajax-iframe" data-width="800px" data-height="500px"><i class="fa fa-plus-circle"></i> 文本课程</a>
            <a href="<?php echo url('admin/course/videoaddExam', ['cid' => $data['id']]); ?>" class="layui-btn layui-btn-primary ajax-iframe" data-width="800px" data-height="500px"><i class="fa fa-plus-circle"></i> 添加试卷</a>
            <a href="<?php echo url('admin/course/materialAdd',['cid' => $data['id'],'cstype'=>$data['type']]); ?>" class="layui-btn layui-btn-primary ajax-iframe" data-width="800px" data-height="500px"><i class="fa fa-plus-circle"></i> 添加资料<span class="layui-badge"><?php echo json_count($data['material_id']); ?></span></a>
            <a href="<?php echo url('admin/course/videodelsection'); ?>" class="layui-btn layui-btn-danger ajax-batch"><i class="fa fa-trash-o"></i> 批量删除</a>
        </div>
        <table class="layui-table layui-form">
            <thead>
            <tr>
                <th style="width:20px;"><input type="checkbox" lay-skin="primary" lay-filter="*"></th>
                <th style="width:40px;">ID</th>
                <th >章节名称</th>
                <th style="width:100px;">课程类型</th>
                <th  style="width:60px;">是否免费</th>
                <th  style="width:140px;">发布时间</th>
                <th  style="width:50px;">排序</th>
                <th  style="width:60px;">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($sectionlist) || $sectionlist instanceof \think\Collection || $sectionlist instanceof \think\Paginator): if( count($sectionlist)==0 ) : echo "$empty" ;else: foreach($sectionlist as $key=>$v): ?>
            <tr>
                <td><input type="checkbox" name="id" value="<?php echo $v['id']; ?>" lay-skin="primary"></td>
                <td><?php echo $v['id']; ?></td>
                <td><?php echo $v['title']; ?></td>
                <td><?php echo section_type($v['sectype']); ?></td>
                <td>
                  <?php if(empty($v['seclist'])): ?>
                    <input type="checkbox" name="isfree" lay-skin="switch" lay-filter="*" lay-text="是|否" data-url="<?php echo url('admin/course/videoEditZhang', ['id' => $v['id']]); ?>" <?php if($v['isfree'] == 1): ?>checked="checked" <?php endif; ?>>
                  <?php endif; ?>
              </td>
                <td><?php echo $v['addtime']; ?></td>
                <td >
                    <input type="text" name="sort_order" value="<?php echo $v['sort_order']; ?>" autocomplete="off" class="layui-input ajax-update" data-url="<?php echo url('admin/course/videoEditZhang', ['id' => $v['id']]); ?>">
                </td>
                <td>
                    <div class="layui-btn-group mb0">
                        <?php if($v['ischapter']==1): ?>
                        <a href="<?php echo url('admin/course/videoEditZhang', ['id' => $v['id']]); ?>" class="layui-btn layui-btn-xs ajax-iframe" data-width="600px" data-height="400px"> <i class="layui-icon">&#xe642;</i></a>
                        <?php endif; if($v['ischapter']==0): switch($v['sectype']): case "1": ?><a href="<?php echo url('admin/course/videoEditSection', ['id' => $v['id']]); ?>" class="layui-btn layui-btn-xs ajax-iframe" data-width="800px" data-height="500px"> <i class="layui-icon">&#xe642;</i></a><?php break; case "2": ?><a href="<?php echo url('admin/course/videoEditAudio', ['id' => $v['id']]); ?>" class="layui-btn layui-btn-xs ajax-iframe" data-width="800px" data-height="500px"> <i class="layui-icon">&#xe642;</i></a><?php break; case "3": ?><a href="<?php echo url('admin/course/videoEditDoc', ['id' => $v['id']]); ?>" class="layui-btn layui-btn-xs ajax-iframe" data-width="800px" data-height="500px"> <i class="layui-icon">&#xe642;</i></a><?php break; case "4": ?><a href="<?php echo url('admin/course/videoEditExam', ['id' => $v['id']]); ?>" class="layui-btn layui-btn-xs ajax-iframe" data-width="800px" data-height="500px"> <i class="layui-icon">&#xe642;</i></a><?php break; endswitch; endif; ?>
                        <a href="<?php echo url('admin/course/videodelsection', ['id' => $v['id']]); ?>" class="layui-btn layui-btn-xs layui-btn-danger ajax-delete"> <i class="layui-icon">&#xe640;</i></a>
                    </div>
                </td>
            </tr>
            <?php if(is_array((isset($v['seclist']) && ($v['seclist'] !== '')?$v['seclist']:'')) || (isset($v['seclist']) && ($v['seclist'] !== '')?$v['seclist']:'') instanceof \think\Collection || (isset($v['seclist']) && ($v['seclist'] !== '')?$v['seclist']:'') instanceof \think\Paginator): if( count((isset($v['seclist']) && ($v['seclist'] !== '')?$v['seclist']:''))==0 ) : echo "" ;else: foreach((isset($v['seclist']) && ($v['seclist'] !== '')?$v['seclist']:'') as $key=>$vv): ?>
            <tr>
                <td><input type="checkbox" name="id" value="<?php echo $vv['id']; ?>" lay-skin="primary"></td>
                <td><?php echo $vv['id']; ?></td>
                <td>&nbsp;&nbsp;&nbsp;└<?php echo $vv['title']; ?></td>
                <td><?php echo section_type($vv['sectype']); ?></td>
                <td>
                    <input type="checkbox" name="isfree" lay-skin="switch" lay-filter="*" lay-text="是|否" data-url="<?php echo url('admin/course/videoEditZhang', ['id' => $vv['id']]); ?>" <?php if($vv['isfree'] == 1): ?>checked="checked" <?php endif; ?>>
                </td>
                <td><?php echo $vv['addtime']; ?></td>
                <td >
                    <input type="text" name="sort_order" value="<?php echo $vv['sort_order']; ?>" autocomplete="off" class="layui-input ajax-update" data-url="<?php echo url('admin/course/videoEditZhang', ['id' => $vv['id']]); ?>">
                </td>
                <td>
                    <div class="layui-btn-group mb0">
                        <?php switch($vv['sectype']): case "1": ?><a href="<?php echo url('admin/course/videoEditSection', ['id' => $vv['id']]); ?>" class="layui-btn layui-btn-xs ajax-iframe" data-width="800px" data-height="500px"> <i class="layui-icon">&#xe642;</i></a><?php break; case "2": ?><a href="<?php echo url('admin/course/videoEditAudio', ['id' => $vv['id']]); ?>" class="layui-btn layui-btn-xs ajax-iframe" data-width="800px" data-height="500px"> <i class="layui-icon">&#xe642;</i></a><?php break; case "3": ?><a href="<?php echo url('admin/course/videoEditDoc', ['id' => $vv['id']]); ?>" class="layui-btn layui-btn-xs ajax-iframe" data-width="800px" data-height="500px"> <i class="layui-icon">&#xe642;</i></a><?php break; case "4": ?><a href="<?php echo url('admin/course/videoEditExam', ['id' => $vv['id']]); ?>" class="layui-btn layui-btn-xs ajax-iframe" data-width="800px" data-height="500px"> <i class="layui-icon">&#xe642;</i></a><?php break; endswitch; ?>
                        <a href="<?php echo url('admin/course/videodelsection', ['id' => $vv['id']]); ?>" class="layui-btn layui-btn-xs layui-btn-danger ajax-delete"> <i class="layui-icon">&#xe640;</i></a>
                    </div>
                </td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "$empty" ;endif; ?>
            </tbody>
        </table>
        <div class="page"></div>
    </div>
</div>

    </div>
</div>
<script src="/static/libs/layui/layui.all.js"></script>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/layui.base.js"></script>

</body>
</html>