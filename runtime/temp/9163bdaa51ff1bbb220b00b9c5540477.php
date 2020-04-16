<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:82:"D:\phpstudy_pro\WWW\qingkaoedu\public/../application/admin\view\exam\selfpage.html";i:1581221422;s:63:"D:\phpstudy_pro\WWW\qingkaoedu\application\admin\view\base.html";i:1586589106;}*/ ?>
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
    <div class="layui-card-header">手动组卷</div>
    <div class="layui-card-body">
    <form action="<?php echo request()->url(); ?>" class="layui-form" method="post">
        <table class="layui-table layui-form">
            <thead>
                <tr>
                    <th>试卷名称</th>
                    <th style="width:200px;">科目分类</th>
                    <th style="width:100px;">考试时长</th>
                    <th style="width:100px;">试卷总分</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" name="exam"   placeholder="必填" class="layui-input"></td>
                    <td><select name="examsubject" lay-filter="selectedsubjectid" id="selectedsubjectid">
                            <option value="">全部分类</option>
                            <?php if(is_array($courseCategory) || $courseCategory instanceof \think\Collection || $courseCategory instanceof \think\Paginator): if( count($courseCategory)==0 ) : echo "" ;else: foreach($courseCategory as $key=>$v): ?>
                            <option value="<?php echo $v['id']; ?>"><?php echo $v['cname']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                         </select>
                    </td>
                    <td><input type="text" name="examtime"  placeholder="单位：分钟" class="layui-input"></td>
                    <td><input type="text" name="examscore"  placeholder="必填" class="layui-input"></td>
                </tr>
            </tbody>
        </table>
        <table class="layui-table layui-form mt20" lay-skin="nob">
            <thead>
                <tr>
                    <th style="width:140px;">题型</th>
                    <th style="width:80px;">题数</th>
                    <th style="width:80px;">单题分值</th>
                    <th style="width:80px;">已选	</th>
                    <th style="width:150px;">操作</th>
                    <th>试题说明</th>
                </tr>
            </thead>
            <tbody>
                <?php if(is_array($questiontype) || $questiontype instanceof \think\Collection || $questiontype instanceof \think\Paginator): if( count($questiontype)==0 ) : echo "" ;else: foreach($questiontype as $key=>$v): ?>
                <tr>
                    <td><?php echo $v['type_name']; ?></td>
                    <td><input type="text" name="questype[<?php echo $v['id']; ?>][number]"   class="layui-input"  id="iselectallnumber_<?php echo $v['id']; ?>"></td>
                    <td><input type="text" name="questype[<?php echo $v['id']; ?>][score]"   class="layui-input" ></td>
                    <td><span id="ialreadyselectnumber_<?php echo $v['id']; ?>">0</span></td>
                    <td><a href="<?php echo url('admin/exam/questionsSelect',['questiontype'=>$v['id'],'questionchapterid'=>$v['id']]); ?>" class="layui-btn layui-btn-sm ajax-iframe_noshut select" data-width="800px" data-height="500px">选题</a></td>
                    <td><input type="text" name=questype[<?php echo $v['id']; ?>][describe] id="describe_<?php echo $v['id']; ?>"   value="每小题？分，本题共？个小题，共？分" class="layui-input"></td>
                    <input type="hidden" value="" id="iselectquestions_<?php echo $v['id']; ?>" name="examquestions[<?php echo $v['id']; ?>][questions]" />
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                <!--<tr>-->
                    <!--<td>题型排序</td>-->
                    <!--<td colspan="4">-->
                        <!--<div class="layui-btn-group mt20 ml20" id="sortable">-->
                             <!--<a class="layui-btn layui-btn-sm">单选题</a>-->
                             <!--<a class="layui-btn layui-btn-sm">多选题</a>-->
                             <!--<a class="layui-btn layui-btn-sm">填空题</a>-->
                             <!--<a class="layui-btn layui-btn-sm">判断题</a>-->
                             <!--<a class="layui-btn layui-btn-sm">简答题</a>-->
                        <!--</div>-->
                    <!--</td>-->
                    <!--<td>拖动进行试题排序</td>-->
                <!--</tr>-->
            </tbody>
        </table>
        <div class="layui-form-item mt20">
            <div class="layui-input-block">
                <button class="layui-btn" lay-filter="*" lay-submit="">保存</button>
                <button class="layui-btn layui-btn-primary" type="reset">重置</button>
            </div>
        </div>
        <input type="hidden" name="addtime" value="<?php echo $addtime; ?>"  class="layui-input">
    </form>
    </div>
</div>


    </div>
</div>
<script src="/static/libs/layui/layui.all.js"></script>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/layui.base.js"></script>

  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script>
  $(function() {
    $("#sortable").sortable();
    $("#sortable").disableSelection();
  });
  </script>

</body>
</html>