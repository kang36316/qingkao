<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:87:"D:\phpstudy_pro\WWW\qingkaoedu\public/../application/admin\view\course\videoAddDoc.html";i:1560405098;s:65:"D:\phpstudy_pro\WWW\qingkaoedu\application\admin\view\iframe.html";i:1581220658;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>网站后台管理系统</title>
    <link rel="stylesheet" href="/static/libs/layui/css/layui.css">
    <link rel="stylesheet" href="/static/css/base.css">
    <link rel="stylesheet" href="/static/css/fonts.css">
    
</head>
<body class="layui-layout-iframe">

<form action="<?php echo request()->url(); ?>" class="layui-form mt30 mr50" method="post">
    <div class="layui-form-item">
        <label class="layui-form-label">选择章</label>
        <div class="layui-input-block">
            <?php if($zhang): ?>
            <select name="chapterid" lay-verify="required">
            <?php else: ?>
            <select name="chapterid">
            <?php endif; ?>
                <option value="">选择章</option>
                <?php if(is_array($zhang) || $zhang instanceof \think\Collection || $zhang instanceof \think\Paginator): if( count($zhang)==0 ) : echo "" ;else: foreach($zhang as $key=>$v): ?>
                <option value="<?php echo $v['id']; ?>" <?php if($data['chapterid'] == $v['id']): ?>selected="selected"<?php endif; ?>><?php echo $v['title']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">课时标题</label>
        <div class="layui-input-block">
            <input type="text" name="title" value="<?php echo (isset($data['title']) && ($data['title'] !== '')?$data['title']:''); ?>" autocomplete="off" placeholder="请输入章名称" class="layui-input">
            <input type="hidden" name="__token__" value="<?php echo \think\Request::instance()->token(); ?>" />
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">是否免费</label>
        <div class="layui-input-block">
            <input type="radio" name="isfree" <?php if((isset($data['isfree']) && ($data['isfree'] !== '')?$data['isfree']:1) == '1'): ?>checked<?php endif; ?> title="是" value="1" checked />
            <input type="radio" name="isfree" <?php if((isset($data['isfree']) && ($data['isfree'] !== '')?$data['isfree']:0) == '0'): ?>checked<?php endif; ?> title="否" value="0" />
        </div>
    </div>
   <!-- <div class="layui-form-item">
        <label class="layui-form-label">学习次数</label>
        <div class="layui-input-block">
            <input type="text" name="playtimes" value="<?php echo (isset($data['playtimes']) && ($data['playtimes'] !== '')?$data['playtimes']:''); ?>" autocomplete="off" placeholder="请输入章名称" class="layui-input">
        </div>
    </div>-->
    <div class="layui-form-item">
        <label class="layui-form-label">学习内容</label>
        <div class="layui-input-block">
            <textarea name="document" placeholder="学习内容" id="editor" style="height:400px;"><?php echo (isset($data['document']) && ($data['document'] !== '')?$data['document']:''); ?></textarea>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">排序</label>
        <div class="layui-input-block">
            <input type="text" name="sort_order" value="<?php echo (isset($data['sort_order']) && ($data['sort_order'] !== '')?$data['sort_order']:0); ?>" autocomplete="off" placeholder="章排序,默认即可" class="layui-input">
            <input type="hidden" name="csid" value="<?php echo $cid; ?>"  class="layui-input">
            <input type="hidden" name="ischapter" value="0"  class="layui-input">
            <input type="hidden" name="status" value="1"  class="layui-input">
            <input type="hidden" name="coursetype" value="1"  class="layui-input">
            <input type="hidden" name="sectype" value="3"  class="layui-input">
            <input type="hidden" name="addtime" value="<?php echo $addtime; ?>"  class="layui-input">
        </div>
    </div>
    <div class="layui-form-item mt30">
        <div class="layui-input-block">
            <button class="layui-btn" lay-filter="i" lay-submit="">保存</button>
            <button class="layui-btn layui-btn-primary" type="reset">重置</button>
        </div>
    </div>
</form>

<script src="/static/libs/layui/layui.all.js"></script>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/layui.base.js"></script>

<script src="/static/libs/ueditor/ueditor.config.js"></script>
<script src="/static/libs/ueditor/ueditor.all.min.js"></script>
<script src="/static/libs/ueditor/lang/zh-cn/zh-cn.js"></script>
<script>
    UE.getEditor('editor',{
        // initialFrameWidth :800,// 设置编辑器宽度
        initialFrameHeight:800,// 设置编辑器高度
        scaleEnabled:true
    });
</script>

</body>
</html>
