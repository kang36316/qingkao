<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:78:"D:\phpstudy_pro\WWW\qingkao\public/../application/admin\view\article\save.html";i:1547447008;s:60:"D:\phpstudy_pro\WWW\qingkao\application\admin\view\base.html";i:1586589106;}*/ ?>
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
    <div class="layui-card-header">编辑数据</div>
    <div class="layui-card-body">
        <form action="<?php echo request()->url(); ?>" class="layui-form" method="post">
            <div class="layui-form-item">
                <label class="layui-form-label">文章封面</label>
                <div class="layui-input-block">
                    <input type="text" name="image" value="<?php echo (isset($data['image']) && ($data['image'] !== '')?$data['image']:''); ?>" autocomplete="off" placeholder="请上传文章封面" class="layui-input">
                    <button type="button" class="layui-btn layui-btn-primary layui-btn-position ajax-images"><i class="fa fa-file-image-o"></i> 选择图片</button>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">* 所属分类</label>
                <div class="layui-input-block">
                    <select name="cid">
                        <option value="">请选择所属分类</option>
                        <?php if(is_array($category) || $category instanceof \think\Collection || $category instanceof \think\Paginator): if( count($category)==0 ) : echo "" ;else: foreach($category as $key=>$v): ?>
                        <option value="<?php echo $v['id']; ?>" <?php if(isset($data) and $data['cid'] == $v['id']): ?>selected="selected"<?php endif; ?>><?php if($v['level'] != '1'): ?>|<?php for($i=1;$i<$v['level'];$i++){echo ' ----';} endif; ?> <?php echo $v['category_name']; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">* 文章标题</label>
                <div class="layui-input-block">
                    <input type="text" name="title" value="<?php echo (isset($data['title']) && ($data['title'] !== '')?$data['title']:''); ?>" autocomplete="off" placeholder="请输入文章标题" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">文章作者</label>
                <div class="layui-input-block">
                    <input type="text" name="author" value="<?php echo (isset($data['author']) && ($data['author'] !== '')?$data['author']:''); ?>" autocomplete="off" placeholder="请输入文章作者" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">文章简介</label>
                <div class="layui-input-block">
                    <textarea name="summary" placeholder="请输入文章简介" class="layui-textarea"><?php echo (isset($data['summary']) && ($data['summary'] !== '')?$data['summary']:''); ?></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">文章相册</label>
                <div class="layui-input-inline" style="width:112px;">
                    <input type="hidden" name="photo">
                    <button type="button" class="layui-btn layui-btn-primary ajax-photos"><i class="fa fa-file-image-o"></i> 选择图片</button>
                </div>
                <div class="layui-form-mid layui-word-aux">允许多文件上传，不支持ie8/9</div>
            </div>
            <?php if(!empty($data['photo'])): if(is_array($data['photo']) || $data['photo'] instanceof \think\Collection || $data['photo'] instanceof \think\Paginator): if( count($data['photo'])==0 ) : echo "" ;else: foreach($data['photo'] as $key=>$v): ?>
            <div class="layui-form-item">
                <label class="layui-form-label"></label>
                <div class="layui-input-block">
                    <input type="text" name="photo[]" value="<?php echo $v; ?>" autocomplete="off" readonly class="layui-input">
                    <button type="button" class="layui-btn layui-btn-primary layui-btn-position delete-photo"><i class="fa fa-times-circle"></i></button>
                </div>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; endif; ?>
            <div class="layui-form-item">
                <label class="layui-form-label">详情内容</label>
                <div class="layui-input-block">
                    <textarea name="content" placeholder="请输入详情内容" id="editor" style="height:400px;"><?php echo (isset($data['content']) && ($data['content'] !== '')?$data['content']:''); ?></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">SEO关键字</label>
                <div class="layui-input-block">
                    <input type="text" name="keywords" autocomplete="off" value="<?php echo (isset($data['keywords']) && ($data['keywords'] !== '')?$data['keywords']:''); ?>" placeholder="请输入SEO关键字" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">SEO描述</label>
                <div class="layui-input-block">
                    <textarea name="description" autocomplete="off" placeholder="请输入SEO描述" class="layui-textarea"><?php echo (isset($data['description']) && ($data['description'] !== '')?$data['description']:''); ?></textarea>
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

<script src="/static/libs/ueditor/ueditor.config.js"></script>
<script src="/static/libs/ueditor/ueditor.all.min.js"></script>
<script src="/static/libs/ueditor/lang/zh-cn/zh-cn.js"></script>
<script>
    UE.getEditor('editor',{
        // initialFrameWidth :800,// 设置编辑器宽度
        initialFrameHeight:400,// 设置编辑器高度
        scaleEnabled:true
    });
</script>

</body>
</html>