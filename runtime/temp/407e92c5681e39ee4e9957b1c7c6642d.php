<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:82:"D:\phpstudy_pro\WWW\qingkaoedu\public/../application/admin\view\exam\typeSave.html";i:1581220650;s:65:"D:\phpstudy_pro\WWW\qingkaoedu\application\admin\view\iframe.html";i:1581220658;}*/ ?>
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

<div class="layui-card">
    <div class="layui-card-body">
        <form action="<?php echo request()->url(); ?>" class="layui-form" method="post">
            <div class="layui-form-item">
                <label class="layui-form-label">题型名称</label>
                <div class="layui-input-block">
                    <input type="text" name="type_name" value="<?php echo (isset($data['type_name']) && ($data['type_name'] !== '')?$data['type_name']:''); ?>" autocomplete="off" placeholder="请输入分类名称" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">题型分类</label>
                <div class="layui-input-block">
                    <select name="p_type">
                        <option value="">选择分类</option>
                        <option value="1" <?php if(isset($data) and $data['p_type'] == 1): ?>selected="selected"<?php endif; ?> >客观题</option>
                        <option value="2" <?php if(isset($data) and $data['p_type'] == 2): ?>selected="selected"<?php endif; ?>>主观题</option>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">题型标识</label>
                <div class="layui-input-block">
                    <select name="mark">
                        <option value="">选择标识</option>
                        <option value="SingleSelect" <?php if(isset($data) and $data['mark'] == SingleSelect): ?>selected="selected"<?php endif; ?>>SingleSelect(单选)</option>
                        <option value="MultiSelect" <?php if(isset($data) and $data['mark'] == MultiSelect): ?>selected="selected"<?php endif; ?>>MultiSelect(多选)</option>
                        <option value="FillInBlanks" <?php if(isset($data) and $data['mark'] == FillInBlanks): ?>selected="selected"<?php endif; ?>>FillInBlanks(填空)</option>
                        <option value="TrueOrfalse" <?php if(isset($data) and $data['mark'] == TrueOrfalse): ?>selected="selected"<?php endif; ?>>TrueOrfalse(判断)</option>
                        <option value="ShortAnswer" <?php if(isset($data) and $data['mark'] == ShortAnswer): ?>selected="selected"<?php endif; ?>>ShortAnswer（简答，论述等)</option>
                        <option value="TiMao" <?php if(isset($data) and $data['mark'] == TiMao): ?>selected="selected"<?php endif; ?>>TiMao（题帽题)</option>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-filter="i" lay-submit="">保存</button>
                    <button class="layui-btn layui-btn-primary" type="reset">重置</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="/static/libs/layui/layui.all.js"></script>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/layui.base.js"></script>

</body>
</html>
