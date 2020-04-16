<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:89:"D:\phpstudy_pro\WWW\qingkao\public/../application/admin\view\exam\questionsSingleAdd.html";i:1581223770;s:62:"D:\phpstudy_pro\WWW\qingkao\application\admin\view\iframe.html";i:1581220658;}*/ ?>
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
        <label class="layui-form-label">科目</label>
        <div class="layui-input-inline">
            <select name="questionchapterid" lay-verify="required" id="chapterid" lay-filter="questionknowsid">
                <option value="">全部分类</option>
                <?php if(is_array($category) || $category instanceof \think\Collection || $category instanceof \think\Paginator): if( count($category)==0 ) : echo "$empty" ;else: foreach($category as $key=>$v): ?>
                <option value="<?php echo $v['id']; ?>" <?php if(isset($data) and $data['questionchapterid'] == $v['id']): ?>selected="selected"<?php endif; ?>><?php echo $v['cname']; ?></option>
                <?php endforeach; endif; else: echo "$empty" ;endif; ?>
            </select>
        </div>
        <div class="layui-input-inline layui-hide" id="knowledgebox">
            <select name="questionknowsid" id="knowledge" >
                <option value="">知识点</option>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">题型</label>
        <div class="layui-input-inline">
            <select name="questiontype" id="questiontype" lay-verify="required" lay-filter="questiontype">
                <option value="">选择题型</option>
                <?php if(is_array($type) || $type instanceof \think\Collection || $type instanceof \think\Paginator): if( count($type)==0 ) : echo "" ;else: foreach($type as $key=>$v): ?>
                <option value="<?php echo $v['id']; ?>－<?php echo $v['mark']; ?>" <?php if(isset($data) and $data['questiontype'] == $v['id']): ?>selected="selected"<?php endif; ?>><?php echo $v['type_name']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">题干</label>
        <div class="layui-input-block">
            <textarea class="ckeditor" lay-verify="required" name="question" id="question"><?php echo (isset($data['question']) && ($data['question'] !== '')?$data['question']:""); ?></textarea>
        </div>
    </div>
    <div class="layui-form-item layui-hide" id="questionselectbox">
        <label class="layui-form-label">选项</label>
        <div class="layui-input-block">
            <textarea class="ckeditor" name="questionselect" id="questionselect"><?php echo (isset($data['questionselect']) && ($data['questionselect'] !== '')?$data['questionselect']:""); ?></textarea>
        </div>
    </div>
    <div class="layui-form-item layui-hide" id="questionselectnumberbox">
        <label class="layui-form-label">选项数量</label>
        <div class="layui-input-inline">
            <select name="questionselectnumber">
                <option value="4" <?php if(isset($data) and $data['questionselectnumber'] == 4): ?>selected="selected"<?php endif; ?>>4</option>
                <option value="1" <?php if(isset($data) and $data['questionselectnumber'] == 1): ?>selected="selected"<?php endif; ?>>1</option>
                <option value="2" <?php if(isset($data) and $data['questionselectnumber'] == 2): ?>selected="selected"<?php endif; ?>>2</option>
                <option value="3" <?php if(isset($data) and $data['questionselectnumber'] == 3): ?>selected="selected"<?php endif; ?>>3</option>
                <option value="5" <?php if(isset($data) and $data['questionselectnumber'] == 5): ?>selected="selected"<?php endif; ?>>5</option>
                <option value="6" <?php if(isset($data) and $data['questionselectnumber'] == 6): ?>selected="selected"<?php endif; ?>>6</option>
                <option value="7" <?php if(isset($data) and $data['questionselectnumber'] == 7): ?>selected="selected"<?php endif; ?>>7</option>
                <option value="8" <?php if(isset($data) and $data['questionselectnumber'] == 8): ?>selected="selected"<?php endif; ?>>8</option>
            </select>
        </div>
    </div>
    <div class="layui-form-item layui-hide" id="answerbox">
        <label class="layui-form-label">参考答案</label>
        <div class="layui-input-block layui-hide" id="answerbox_1">
            <input type="radio" <?php if(isset($data) and $data['questionanswer'] == A): ?>checked<?php endif; ?> name="questionanswerSingleSelect" value="A" title="A">
            <input type="radio" <?php if(isset($data) and $data['questionanswer'] == B): ?>checked<?php endif; ?> name="questionanswerSingleSelect" value="B" title="B">
            <input type="radio" <?php if(isset($data) and $data['questionanswer'] == C): ?>checked<?php endif; ?> name="questionanswerSingleSelect" value="C" title="C">
            <input type="radio" <?php if(isset($data) and $data['questionanswer'] == D): ?>checked<?php endif; ?> name="questionanswerSingleSelect" value="D" title="D">
            <input type="radio" <?php if(isset($data) and $data['questionanswer'] == E): ?>checked<?php endif; ?> name="questionanswerSingleSelect" value="E" title="E">
            <input type="radio" <?php if(isset($data) and $data['questionanswer'] == F): ?>checked<?php endif; ?> name="questionanswerSingleSelect" value="F" title="F">
            <input type="radio" <?php if(isset($data) and $data['questionanswer'] == G): ?>checked<?php endif; ?> name="questionanswerSingleSelect" value="G" title="G">
            <input type="radio" <?php if(isset($data) and $data['questionanswer'] == H): ?>checked<?php endif; ?> name="questionanswerSingleSelect" value="H" title="H">
        </div>
        <div class="layui-input-block layui-hide" id="answerbox_2">
            <input type="checkbox" <?php if(isset($data) and strstr($data['questionanswer'] ,'A')): ?>checked="checked"<?php endif; ?> name="questionanswerMultiSelect[]" value="A" title="A">
            <input type="checkbox" <?php if(isset($data) and strstr($data['questionanswer'] ,'B')): ?>checked="checked"<?php endif; ?> name="questionanswerMultiSelect[]" value="B" title="B">
            <input type="checkbox" <?php if(isset($data) and strstr($data['questionanswer'] ,'C')): ?>checked="checked"<?php endif; ?> name="questionanswerMultiSelect[]" value="C" title="C">
            <input type="checkbox" <?php if(isset($data) and strstr($data['questionanswer'] ,'D')): ?>checked="checked"<?php endif; ?> name="questionanswerMultiSelect[]" value="D" title="D">
            <input type="checkbox" <?php if(isset($data) and strstr($data['questionanswer'] ,'E')): ?>checked="checked"<?php endif; ?> name="questionanswerMultiSelect[]" value="E" title="E">
            <input type="checkbox" <?php if(isset($data) and strstr($data['questionanswer'] ,'F')): ?>checked="checked"<?php endif; ?> name="questionanswerMultiSelect[]" value="F" title="F">
            <input type="checkbox" <?php if(isset($data) and strstr($data['questionanswer'] ,'G')): ?>checked="checked"<?php endif; ?> name="questionanswerMultiSelect[]" value="G" title="G">
            <input type="checkbox" <?php if(isset($data) and strstr($data['questionanswer'] ,'H')): ?>checked="checked"<?php endif; ?> name="questionanswerMultiSelect[]" value="H" title="H">
        </div>
        <div class="layui-input-block layui-hide" id="answerbox_3">
            <input type="radio" name="questionanswerTrueOrfalse" value="1" title="对">
            <input type="radio" name="questionanswerTrueOrfalse" value="0" title="错">
        </div>
        <div class="layui-input-block layui-hide" id="answerbox_4">
            <textarea class="ckeditor" name="questionanswerFillInBlanks" id="questionanswer4"></textarea>
        </div>
        <div class="layui-input-block layui-hide" id="answerbox_5">
            <textarea class="ckeditor" name="questionanswerShortAnswer" id="questionanswer5"></textarea>
        </div>
    </div>
    <div class="layui-form-item" id="questiondescribe_box">
        <label class="layui-form-label">试题解析</label>
        <div class="layui-input-block">
            <textarea class="ckeditor" name="questiondescribe" id="questiondescribe"><?php echo (isset($data['questiondescribe']) && ($data['questiondescribe'] !== '')?$data['questiondescribe']:""); ?></textarea>
        </div>
    </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">试题难度</label>
        <div class="layui-input-block">
            <select name="questionlevel">
                <option value="1" <?php if(isset($data) and $data['questionlevel'] == 1): ?>selected="selected"<?php endif; ?>>易</option>
                <option value="2" <?php if(isset($data) and $data['questionlevel'] == 2): ?>selected="selected"<?php endif; ?>>中</option>
                <option value="3" <?php if(isset($data) and $data['questionlevel'] == 3): ?>selected="selected"<?php endif; ?>> 难</option>
            </select>
        </div>
    </div>
    <div class="layui-form-item mt30">
        <div class="layui-input-block">
            <button id="other-btn" class="layui-btn" lay-filter="i" lay-submit="">保存</button>
            <button id="timao-btn" class="layui-btn layui-hide" lay-filter="*" lay-submit="">保存子题</button>
            <button class="layui-btn layui-btn-primary" type="reset">重置</button>
        </div>
    </div>
    <input type="hidden" name="questioncreatetime" value="<?php echo $addtime; ?>">
</form>

<script src="/static/libs/layui/layui.all.js"></script>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/layui.base.js"></script>

<script src="/static/libs/ueditor/ueditor.config.js"></script>
<script src="/static/libs/ueditor/ueditor.all.js"></script>
<script src="/static/libs/ueditor/lang/zh-cn/zh-cn.js"></script>
<script src="/static/libs/ueditor/kityformula-plugin/addKityFormulaDialog.js"></script>
<script src="/static/libs/ueditor/kityformula-plugin/getKfContent.js"></script>
<script src="/static/libs/ueditor/kityformula-plugin/defaultFilterFix.js"></script>
<script>
    UE.getEditor('question',{
        initialFrameHeight:100,
        elementPathEnabled:false,
        wordCount:false,
        scaleEnabled:false,
        toolbars: [['fullscreen', 'source','bold','fontsize', 'italic', 'underline', 'fontborder', 'insertaudio',  'insertvideo',  'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist']],
        labelMap: {'anchor' : '', 'vaecolor' : '自定义字体颜色', 'insertaudio' : '音频',}
    });
</script>
<script>
    UE.getEditor('questiondescribe',{
        initialFrameHeight:100,
        elementPathEnabled:false,
        wordCount:false,
        scaleEnabled:false,
        toolbars: [['fullscreen', 'source','bold','fontsize', 'italic', 'underline', 'fontborder','strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist']],
    });
</script>
<script>
    $(function(){
        var questiontype=$('#questiontype option:selected').val();
        if(questiontype.length >0){
            changeType(questiontype);
        }
    })
    layui.use('form', function() {
        form.on('select(questiontype)', function (data) {
            var typemark=data.value;
            changeType(typemark);
        });
        form.on('select(questionknowsid)', function(data){
            var parentId=$("#chapterid").val();
            $('#knowledgebox').addClass('layui-hide');
            if(null!= parentId && ""!=parentId){
                $.getJSON("/admin/course/ajaxGetKnowledge",{id:parentId},function(myJSON){
                    var options="";
                    if(myJSON.length>0){
                        $('#knowledgebox').removeClass('layui-hide');
                        options+="<option value=''>==知识点==</option>";
                        for(var i=0;i<myJSON.length;i++){
                            options+="<option value="+myJSON[i].id+">"+myJSON[i].title+"</option>";
                        }
                        $("#knowledge").html(options);
                        form.render('select');
                    }
                }
            )}
        })
    })
    function changeType(typemark){
        if (typemark.indexOf("SingleSelect")>0) {
            $('#questionselectbox').removeClass('layui-hide');
            $('#questionselectnumberbox').removeClass('layui-hide');
            $('#answerbox').removeClass('layui-hide');
            $('#answerbox_1').removeClass('layui-hide');
            $('#other-btn').removeClass('layui-hide');
            $('#timao-btn').addClass('layui-hide');
            $('#answerbox_2').addClass('layui-hide');
            $('#answerbox_3').addClass('layui-hide');
            $('#answerbox_4').addClass('layui-hide');
            $('#answerbox_5').addClass('layui-hide');
            UE.getEditor('questionselect', {
                initialFrameHeight: 100,
                elementPathEnabled: false,
                wordCount: false,
                scaleEnabled: false,
                toolbars: [['fullscreen', 'source', 'bold', 'fontsize', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist']]
            });
        }
        if (typemark.indexOf("MultiSelect")>0) {
            $('#questionselectbox').removeClass('layui-hide');
            $('#questionselectnumberbox').removeClass('layui-hide');
            $('#answerbox').removeClass('layui-hide');
            $('#other-btn').removeClass('layui-hide');
            $('#timao-btn').addClass('layui-hide');
            $('#answerbox_1').addClass('layui-hide');
            $('#answerbox_2').removeClass('layui-hide');
            $('#answerbox_3').addClass('layui-hide');
            $('#answerbox_4').addClass('layui-hide');
            $('#answerbox_5').addClass('layui-hide');
            UE.getEditor('questionselect', {
                initialFrameHeight: 100,
                elementPathEnabled: false,
                wordCount: false,
                scaleEnabled: false,
                toolbars: [['fullscreen', 'source', 'bold', 'fontsize', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist']]
            });
        }
        if (typemark.indexOf("FillInBlanks")>0) {
            $('#questionselectbox').addClass('layui-hide');
            $('#questionselectnumberbox').addClass('layui-hide');
            $('#answerbox').removeClass('layui-hide');
            $('#other-btn').removeClass('layui-hide');
            $('#timao-btn').addClass('layui-hide');
            $('#answerbox_1').addClass('layui-hide');
            $('#answerbox_2').addClass('layui-hide');
            $('#answerbox_3').addClass('layui-hide');
            $('#answerbox_4').removeClass('layui-hide');
            $('#answerbox_5').addClass('layui-hide');
            UE.getEditor('questionanswer4', {
                initialFrameHeight: 100,
                elementPathEnabled: false,
                wordCount: false,
                scaleEnabled: false,
                toolbars: [['fullscreen', 'source', 'bold', 'fontsize', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist']]
            });
        }
        if (typemark.indexOf("TrueOrfalse")>0) {
            $('#questionselectbox').addClass('layui-hide');
            $('#questionselectnumberbox').addClass('layui-hide');
            $('#answerbox').removeClass('layui-hide');
            $('#other-btn').removeClass('layui-hide');
            $('#timao-btn').addClass('layui-hide');
            $('#answerbox_1').addClass('layui-hide');
            $('#answerbox_2').addClass('layui-hide');
            $('#answerbox_3').removeClass('layui-hide');
            $('#answerbox_4').addClass('layui-hide');
            $('#answerbox_5').addClass('layui-hide');
        }
        if (typemark.indexOf("ShortAnswer")>0) {
            $('#questionselectbox').addClass('layui-hide');
            $('#questionselectnumberbox').addClass('layui-hide');
            $('#answerbox').removeClass('layui-hide');
            $('#other-btn').removeClass('layui-hide');
            $('#timao-btn').addClass('layui-hide');
            $('#answerbox_1').addClass('layui-hide');
            $('#answerbox_2').addClass('layui-hide');
            $('#answerbox_3').addClass('layui-hide');
            $('#answerbox_4').addClass('layui-hide');
            $('#answerbox_5').removeClass('layui-hide');
            UE.getEditor('questionanswer5', {
                initialFrameHeight: 100,
                elementPathEnabled: false,
                wordCount: false,
                scaleEnabled: false,
                toolbars: [['fullscreen', 'source', 'bold', 'fontsize', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist']]
            });
        }
        if (typemark.indexOf("TiMao")>0) {
            $('#questionselectbox').addClass('layui-hide');
            $('#other-btn').addClass('layui-hide')
            $('#timao-btn').removeClass('layui-hide');
            $('#questionselectnumberbox').addClass('layui-hide');
            $('#questiondescribe_box').addClass('layui-hide');
            $('#answerbox').addClass('layui-hide');
            $('#answerbox_1').addClass('layui-hide');
            $('#answerbox_2').addClass('layui-hide');
            $('#answerbox_3').removeClass('layui-hide');
            $('#answerbox_4').addClass('layui-hide');
            $('#answerbox_5').addClass('layui-hide');
        }
    }
</script>

</body>
</html>
