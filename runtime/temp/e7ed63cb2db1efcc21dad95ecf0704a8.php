<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:79:"D:\phpstudy_pro\WWW\qingkao\public/../application/admin\view\config\upload.html";i:1547447008;s:60:"D:\phpstudy_pro\WWW\qingkao\application\admin\view\base.html";i:1586589106;}*/ ?>
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
    <div class="layui-card-header">上传设置</div>
    <div class="layui-card-body">
        <form action="<?php echo url('admin/config/upload'); ?>" class="layui-form" method="post">
            <div class="layui-form-item">
                <label class="layui-form-label">图片压缩</label>
                <div class="layui-input-block">
                    <input type="hidden" name="is_thumb" value="0">
                    <input type="checkbox" name="is_thumb" value="1" lay-skin="switch" lay-text="开启|关闭" <?php if(isset($data['is_thumb']) and $data['is_thumb'] == '1'): ?>checked="checked"<?php endif; ?>>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">最大宽度</label>
                <div class="layui-input-inline">
                    <input type="text" name="max_width" value="<?php echo (isset($data['max_width']) && ($data['max_width'] !== '')?$data['max_width']:''); ?>" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">px</div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">最大高度</label>
                <div class="layui-input-inline">
                    <input type="text" name="max_height" value="<?php echo (isset($data['max_height']) && ($data['max_height'] !== '')?$data['max_height']:''); ?>" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">px</div>
            </div>
            <hr>
            <div class="layui-form-item">
                <label class="layui-form-label">水印图片</label>
                <div class="layui-input-block">
                    <input type="hidden" name="is_water" value="0">
                    <input type="checkbox" name="is_water" value="1" lay-skin="switch" lay-text="开启|关闭" <?php if(isset($data['is_water']) and $data['is_water'] == '1'): ?>checked="checked"<?php endif; ?>>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">上传水印</label>
                <div class="layui-input-inline" style="width: 300px">
                    <input type="text" name="water_source" value="<?php echo (isset($data['water_source']) && ($data['water_source'] !== '')?$data['water_source']:''); ?>" autocomplete="off" placeholder="请上传图片" class="layui-input">
                    <button type="button" class="layui-btn layui-btn-primary layui-btn-position ajax-file"><i class="fa fa-file-image-o"></i> 选择图片</button>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">水印位置</label>
                <div class="layui-input-inline">
                    <select name="water_locate">
                        <option value="1" <?php if(isset($data['water_locate']) and $data['water_locate'] == '1'): ?>selected<?php endif; ?>>左上角</option>
                        <option value="2" <?php if(isset($data['water_locate']) and $data['water_locate'] == '2'): ?>selected<?php endif; ?>>上居中</option>
                        <option value="3" <?php if(isset($data['water_locate']) and $data['water_locate'] == '3'): ?>selected<?php endif; ?>>右上角</option>
                        <option value="4" <?php if(isset($data['water_locate']) and $data['water_locate'] == '4'): ?>selected<?php endif; ?>>左居中</option>
                        <option value="5" <?php if(isset($data['water_locate']) and $data['water_locate'] == '5'): ?>selected<?php endif; ?>>居中</option>
                        <option value="6" <?php if(isset($data['water_locate']) and $data['water_locate'] == '6'): ?>selected<?php endif; ?>>右居中</option>
                        <option value="7" <?php if(isset($data['water_locate']) and $data['water_locate'] == '7'): ?>selected<?php endif; ?>>左下角</option>
                        <option value="8" <?php if(isset($data['water_locate']) and $data['water_locate'] == '8'): ?>selected<?php endif; ?>>下居中</option>
                        <option value="9" <?php if(isset($data['water_locate']) and $data['water_locate'] == '9'): ?>selected<?php endif; ?>>右下角</option>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">水印透明度</label>
                <div class="layui-input-inline">
                    <input type="text" name="water_alpha" value="<?php echo (isset($data['water_alpha']) && ($data['water_alpha'] !== '')?$data['water_alpha']:''); ?>" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">可设置值为0~100，数字越小，透明度越高</div>
            </div>
            <hr>
            <div class="layui-form-item">
                <label class="layui-form-label">文本水印</label>
                <div class="layui-input-block">
                    <input type="hidden" name="is_text" value="0">
                    <input type="checkbox" name="is_text" value="1" lay-skin="switch" lay-text="开启|关闭" <?php if(isset($data['is_text']) and $data['is_text'] == '1'): ?>checked="checked"<?php endif; ?>>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">文本内容</label>
                <div class="layui-input-inline">
                    <input type="text" name="text" value="<?php echo (isset($data['text']) && ($data['text'] !== '')?$data['text']:''); ?>" autocomplete="off" placeholder="请输入文本内容" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">上传字体</label>
                <div class="layui-input-inline" style="width: 300px">
                    <input type="text" name="text_font" value="<?php echo (isset($data['text_font']) && ($data['text_font'] !== '')?$data['text_font']:''); ?>" autocomplete="off" placeholder="请上传字体" class="layui-input">
                    <button type="button" class="layui-btn layui-btn-primary layui-btn-position ajax-file"><i class="fa fa-file-o"></i> 选择文件</button>
                </div>
                <div class="layui-form-mid layui-word-aux">默认使用系统字体</div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">水印位置</label>
                <div class="layui-input-inline">
                    <select name="text_locate">
                        <option value="1" <?php if(isset($data['text_locate']) and $data['text_locate'] == '1'): ?>selected<?php endif; ?>>左上角</option>
                        <option value="2" <?php if(isset($data['text_locate']) and $data['text_locate'] == '2'): ?>selected<?php endif; ?>>上居中</option>
                        <option value="3" <?php if(isset($data['text_locate']) and $data['text_locate'] == '3'): ?>selected<?php endif; ?>>右上角</option>
                        <option value="4" <?php if(isset($data['text_locate']) and $data['text_locate'] == '4'): ?>selected<?php endif; ?>>左居中</option>
                        <option value="5" <?php if(isset($data['text_locate']) and $data['text_locate'] == '5'): ?>selected<?php endif; ?>>居中</option>
                        <option value="6" <?php if(isset($data['text_locate']) and $data['text_locate'] == '6'): ?>selected<?php endif; ?>>右居中</option>
                        <option value="7" <?php if(isset($data['text_locate']) and $data['text_locate'] == '7'): ?>selected<?php endif; ?>>左下角</option>
                        <option value="8" <?php if(isset($data['text_locate']) and $data['text_locate'] == '8'): ?>selected<?php endif; ?>>下居中</option>
                        <option value="9" <?php if(isset($data['text_locate']) and $data['text_locate'] == '9'): ?>selected<?php endif; ?>>右下角</option>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">字体大小</label>
                <div class="layui-input-inline">
                    <input type="text" name="text_size" value="<?php echo (isset($data['text_size']) && ($data['text_size'] !== '')?$data['text_size']:''); ?>" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">px</div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">字体颜色</label>
                <div class="layui-input-inline">
                    <input type="text" name="text_color" value="<?php echo (isset($data['text_color']) && ($data['text_color'] !== '')?$data['text_color']:''); ?>" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">格式：#000000</div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">偏移量</label>
                <div class="layui-input-inline">
                    <input type="text" name="text_offset" value="<?php echo (isset($data['text_offset']) && ($data['text_offset'] !== '')?$data['text_offset']:''); ?>" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">文字相对当前位置的偏移量</div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">倾斜角度</label>
                <div class="layui-input-inline">
                    <input type="text" name="text_angle" value="<?php echo (isset($data['text_angle']) && ($data['text_angle'] !== '')?$data['text_angle']:''); ?>" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">文字相对当前位置的倾斜角度</div>
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

</body>
</html>