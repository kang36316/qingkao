<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:81:"D:\phpstudy_pro\WWW\qingkao\public/../application/admin\view\course\livesave.html";i:1581221404;s:60:"D:\phpstudy_pro\WWW\qingkao\application\admin\view\base.html";i:1586589106;}*/ ?>
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
    <div class="layui-card-header">创建课程</div>
    <div class="layui-card-body">
        <form action="<?php echo request()->url(); ?>" class="layui-form" method="post">
            <div class="layui-form-item">
                <label class="layui-form-label">* 课程分类</label>
                <div class="layui-input-block">
                    <select name="cid">
                        <option value="">请选择所属分类</option>
                        <?php if(is_array($courseCategory) || $courseCategory instanceof \think\Collection || $courseCategory instanceof \think\Paginator): if( count($courseCategory)==0 ) : echo "" ;else: foreach($courseCategory as $key=>$v): ?>
                        <option value="<?php echo $v['id']; ?>" <?php if(isset($data) and $data['cid'] == $v['id']): ?>selected="selected"<?php endif; ?>><?php if($v['level'] != '1'): ?>|<?php for($i=1;$i<$v['level'];$i++){echo ' ----';} endif; ?> <?php echo $v['category_name']; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">*课程封面</label>
                <div class="layui-input-block">
                    <input type="text" name="picture" value="<?php echo (isset($data['picture']) && ($data['picture'] !== '')?$data['picture']:''); ?>" autocomplete="off" placeholder="请上传课程封面" class="layui-input">
                    <button type="button" class="layui-btn layui-btn-primary layui-btn-position ajax-images"><i class="fa fa-file-image-o"></i> 选择图片</button>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">* 课程标题</label>
                <div class="layui-input-block">
                    <input type="text" name="title" value="<?php echo (isset($data['title']) && ($data['title'] !== '')?$data['title']:''); ?>" autocomplete="off" placeholder="请输入课程标题" class="layui-input">
                    <input type="hidden" name="__token__" value="<?php echo \think\Request::instance()->token(); ?>" />
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">*课程价格</label>
                <div class="layui-input-block">
                    <input type="text" name="price" value="<?php echo (isset($data['price']) && ($data['price'] !== '')?$data['price']:''); ?>" autocomplete="off" placeholder="请输入课程价格" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">*教室容量</label>
                <div class="layui-input-block">
                    <input type="text" name="limit" value="<?php echo (isset($data['limit']) && ($data['limit'] !== '')?$data['limit']:''); ?>" autocomplete="off" placeholder="教室直播间的容量，超过此容量，无法进入" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">*虚拟学员</label>
                <div class="layui-input-block">
                    <input type="text" name="xuni_num" value="<?php echo (isset($data['xuni_num']) && ($data['xuni_num'] !== '')?$data['xuni_num']:''); ?>" autocomplete="off" placeholder="为增加课程的热度，可适当增加虚拟学员" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">*课程有限期</label>
                <div class="layui-input-block">
                    <input type="text" name="youxiaoqi" value="<?php echo (isset($data['youxiaoqi']) && ($data['youxiaoqi'] !== '')?$data['youxiaoqi']:''); ?>" autocomplete="off" placeholder="有效期从学员购买时刻起计算,单位天" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">*课程简介</label>
                <div class="layui-input-block">
                    <textarea name="brief" placeholder="请输入课程简介" id="editor" style="height:400px;"><?php echo (isset($data['brief']) && ($data['brief'] !== '')?$data['brief']:''); ?></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-filter="*" lay-submit="">保存</button>
                    <button class="layui-btn layui-btn-primary" type="reset">重置</button>
                </div>
            </div>
            <input type="hidden" name="type" value="2"  class="layui-input">
            <input type="hidden" name="status" value="1"  class="layui-input">
        </form>
    </div>
</div>

    </div>
</div>
<script src="/static/libs/layui/layui.all.js"></script>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/layui.base.js"></script>

<script src="/static/libs/ueditor/ueditor.config.js"></script>
<script src="/static/libs/ueditor/ueditor.all.min.js"></script>
<script src="/static/libs/ueditor/lang/zh-cn/zh-cn.js"></script>
<script>
    UE.getEditor('editor',{
        initialFrameHeight:400,
        scaleEnabled:true
    });
</script>

</body>
</html>