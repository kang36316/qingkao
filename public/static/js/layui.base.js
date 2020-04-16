var layer = layui.layer,
    form = layui.form,
    element = layui.element,
    laydate = layui.laydate,
    upload = layui.upload,
    laypage = layui.laypage;
var countdown=60;
// 通用提交
form.on('submit(*)', function (data) {
    var index = layer.msg('提交中，请稍候', {
        icon: 16,
        time: false,
        shade: 0.3
    });
    $(data.elem).attr('disabled', true);
    $.ajax({
        url: data.form.action,
        type: data.form.method,
        dataType: 'json',
        data: $(data.form).serialize(),
        success: function (result) {
            if (result.code === 1 && result.url != '') {
                setTimeout(function () {
                    location.href = result.url;
                }, 1000);
            } else {
                $(data.elem).attr('disabled', false);
            }
            layer.close(index);
            layer.msg(result.msg);
        },
        error: function (xhr, state, errorThrown) {
            layer.close(index);
            layer.msg(state + '：' + errorThrown);
        }
    });
    return false;
});
// 用户注册验证码出错刷新
form.on('submit(login)', function(data) {
    var index = layer.msg('登录中，请稍候', {
        icon: 16,
        time: false,
        shade: 0.3
    });
    $.ajax({
        url: data.form.action,
        type: data.form.method,
        dataType: 'json',
        data: $(data.form).serialize(),
        success: function(result) {
            if (result.code === 1) {
                location.href = result.url;
            } else {
                $('.captcha img').attr('src', '/admin/index/captcha.html');
                $(".captchaInput").val("");
                layer.close(index);
                layer.msg(result.msg);
            }
        },
        error: function (xhr, state, errorThrown) {
            layer.close(index);
            layer.msg(state + '：' + errorThrown);
        }
    });
    return false;
});
// 父窗口通用提交
form.on('submit(i)', function (data) {
    var index = layer.msg('提交中，请稍候', {
        icon: 16,
        time: false,
        shade: 0.3
    });
    $.ajax({
        url: data.form.action,
        type: data.form.method,
        dataType: 'json',
        data: $(data.form).serialize(),
        success: function (result) {
            if (result.code === 1) {
                setTimeout(function () {
                    parent.location.reload();
                }, 1000);
            }
            layer.close(index);
            layer.msg(result.msg);
        },
        error: function (xhr, state, errorThrown) {
            layer.close(index);
            layer.msg(state + '：' + errorThrown);
        }
    });
    return false;
});
// 通用开关
form.on('switch(*)', function (data) {
    var index = layer.msg('修改中，请稍候', {
        icon: 16,
        time: false,
        shade: 0.3
    });
    // 参数
    var obj = {};
    obj[$(this).attr('name')] = this.checked == true ? 1 : 0;
    obj['_verify'] = 0;
    $.ajax({
        url: $(this).data('url'),
        type: 'post',
        dataType: 'json',
        data: obj,
        success: function (result) {
            layer.close(index);
            layer.msg(result.msg);
        },
        error: function (xhr, state, errorThrown) {
            layer.close(index);
            layer.msg(state + '：' + errorThrown);
        }
    });
});
// 通用全选
form.on('checkbox(*)', function (data) {
    $('.layui-table tbody input[lay-skin="primary"]').each(function (index, item) {
        item.checked = data.elem.checked;
    });
    form.render('checkbox');
});

// 通用提交
$('.ajax-submit').on('click', function () {
    var than = $(this);
    var form = $(this).parents('form');
    var index = layer.msg('提交中，请稍候', {
        icon: 16,
        time: false,
        shade: 0.3
    });
    than.attr('disabled', true);
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        dataType: 'json',
        data: $(data.form).serialize(),
        success: function (result) {
            if (result.code === 1 && result.url != '') {
                setTimeout(function () {
                    location.href = result.url;
                }, 1000);
            } else {
                than.attr('disabled', false);
            }
            layer.close(index);
            layer.msg(result.msg);
        },
        error: function (xhr, state, errorThrown) {
            layer.close(index);
            layer.msg(state + '：' + errorThrown);
        }
    });
    return false;
});
// 通用异步
$('.ajax-action').on('click', function () {
    var url = $(this).attr('href');
    var index = layer.msg('请求中，请稍候', {
        icon: 16,
        time: false,
        shade: 0.3
    });
    $.ajax({
        url: url,
        type: 'post',
        dataType: 'json',
        success: function (result) {
            if (result.code === 1 && result.url != '') {
                setTimeout(function () {
                    location.href = result.url;
                }, 1000);
            }
            layer.close(index);
            layer.msg(result.msg);
        },
        error: function (xhr, state, errorThrown) {
            layer.close(index);
            layer.msg(state + '：' + errorThrown);
        }
    });
    return false;
});
// 向父窗口插入数据并提交到数据库
$('.ajax-insert').on('click', function () {
    var url = $(this).attr('href');
    var index = layer.msg('请求中，请稍候', {
        icon: 16,
        time: false,
        shade: 0.3
    });
    $.ajax({
        url: url,
        type: 'post',
        dataType: 'json',
        success: function (result) {
            if (result.code === 1 && result.url != '') {
                setTimeout(function () {
                    parent.location.reload();
                }, 1000);
            }
            layer.msg(result.msg);
            layer.close(index);
        },
        error: function (xhr, state, errorThrown) {
            layer.close(index);
            layer.msg(state + '：' + errorThrown);
        }
    });
    return false;
});
// 通用更新
$('.ajax-update').on('blur', function () {
    // 参数
    var obj = {};
    obj[$(this).attr('name')] = $(this).val();
    obj['_verify'] = 0;
    $.ajax({
        url: $(this).data('url'),
        type: 'post',
        dataType: 'json',
        data: obj,
        success: function (result) {
            if (result.code === 1) {
                layer.msg(result.msg);
                setTimeout(function () {
                    location.reload();
                }, 1000);
            }
        },
        error: function (xhr, state, errorThrown) {
            layer.close(index);
            layer.msg(state + '：' + errorThrown);
        }
    });
    return false;
});
// 通用删除
$('.ajax-delete').on('click', function () {
    var url = $(this).attr('href');
    layer.confirm('确定删除？', {
        icon: 3,
        title: '提示'
    }, function (index) {
        var index = layer.msg('删除中，请稍候', {
            icon: 16,
            time: false,
            shade: 0.3
        });
        $.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            success: function (result) {
                if (result.code === 1 && result.url != '') {
                    setTimeout(function () {
                        location.href = result.url;
                    }, 1000);
                }
                layer.close(index);
                layer.msg(result.msg);
            },
            error: function (xhr, state, errorThrown) {
                layer.close(index);
                layer.msg(state + '：' + errorThrown);
            }
        });
    });
    return false;
});
// 通用详情
$('.ajax-detail').on('click', function () {
    var title = $(this).html();
    var url = $(this).attr('href');
    var index = layer.open({
        title: title,
        type: 2,
        content: url,
        success: function (layero, index) {
            setTimeout(function () {
                layer.tips('点击此处返回', '.layui-layer-setwin .layui-layer-close', {
                    tips: 3
                });
            }, 500)
        }
    })
    layer.full(index);
    return false;
});
// 通用窗口
$('.ajax-iframe').on('click', function() {
    var title = $(this).html();
    var url = $(this).attr('href');
    var width = $(this).data('width');
    var height = $(this).data('height');
    var index = layer.open({
        title: title,
        type: 2,
        area: [width, height],
        content: url,
        shade:0.4
    })
    return false;
});

// 通用窗口无叉号
$('.ajax-iframe_noshut').on('click', function() {
    var title = $(this).html();
    var url = $(this).attr('href');
    var width = $(this).data('width');
    var height = $(this).data('height');
    var index = layer.open({
        title: title,
        type: 2,
        area: [width, height],
        content: url,
        closeBtn: 0,
        shade:0.4,
        btn: ['确定'],
        yes: function(index, layero){
            layer.close(index);
        }
    })
    return false;
});
// 通用窗口无叉号无确定
$('.ajax-iframe_noshut_nobutton').on('click', function() {
    var title = $(this).html();
    var url = $(this).attr('href');
    var width = $(this).data('width');
    var height = $(this).data('height');
    var index = layer.open({
        title: title,
        type: 2,
        area: [width, height],
        content: url,
        closeBtn: 0,
        shade:0.4
    })
    return false;
});
// 通用搜索
$('.ajax-search').on('click', function () {
    var form = $(this).parents('form');
    var url = form.attr('action');
    var query = form.serialize();
    query = query.replace(/(&|^)(\w*?\d*?\-*?_*?)*?=?((?=&)|(?=$))/g, '');
    query = query.replace(/^&/g, '');
    if (url.indexOf('?') > 0) {
        url += '&' + query;
    } else {
        url += '?' + query;
    }
    location.href = url;
    return false;
});
// 通用批量
$('.ajax-batch').on('click', function () {
    var url = $(this).attr('href');
    var val = [];
    $('.layui-table tbody input[lay-skin="primary"]:checked').each(function (i) {
        val[i] = $(this).val();
    });
    if (val === undefined || val.length == 0) {
        layer.msg('请选择数据');
        return false;
    }
    var index = layer.msg('请求中，请稍候', {
        icon: 16,
        time: false,
        shade: 0.3
    });
    // 参数
    var obj = {};
    obj[$('.layui-table tbody input[lay-skin="primary"]:checked').attr('name')] = val;
    obj['_verify'] = 0;
    $.ajax({
        url: url,
        type: 'post',
        dataType: 'json',
        data: obj,
        success: function (result) {
            if (result.code === 1 && result.url != '') {
                setTimeout(function () {
                    location.reload();
                }, 1000);
            }
            layer.close(index);
            layer.msg(result.msg);
        },
        error: function (xhr, state, errorThrown) {
            layer.close(index);
            layer.msg(state + '：' + errorThrown);
        }
    });
    return false;
});
// 添加图标
$('.ajax-icon').on('click', function () {
    var url = $(this).attr('href');
    var index = layer.open({
        title: '选择图标',
        type: 2,
        area: ['100%', '100%'],
        content: url
    });
    return false;
});
// 通用上传
upload.render({
    elem: '.ajax-images',
    url: '/admin/index/uploadImage',
    done: function (result) {
        // 上传完毕回调
        if (result.code === 1) {
            this.item.prev('input').val(result.url);
        } else {
            layer.msg(result.msg);
        }
    }
});
upload.render({
    elem: '.ajax-file',
    url: '/admin/index/uploadFile',
    accept: 'file', // 普通文件
    done: function (result) {
        // 上传完毕回调
        if (result.code === 1) {
            this.item.prev('input').val(result.url);
        } else {
            layer.msg(result.msg);
        }
    }
});
upload.render({
    elem: '.ajax-video',
    url: '/admin/index/uploadVideo',
    accept: 'video', // 视频文件
    done: function (result) {
        // 上传完毕回调
        if (result.code === 1) {
            this.item.prev('input').val(result.url);
        } else {
            layer.msg(result.msg);
        }
    }
});
// 导入学员到班级
upload.render({
    elem: '.ajax-import',
    url: '/admin/Classroom/importExcel',
    accept: 'file', // 普通文件
    data: {
        classroomId:function(){
            return $('#classroomId').val();
        }},
    before: function(obj){
        layer.load();
    },
    done: function (result , index, upload) {
        // 上传完毕回调
        if (result.code === 1) {
            layer.closeAll('loading');
            setTimeout(function () {
                window.parent.location.reload();
                layer.close(layer.index);
            }, 1000);
            layer.msg(result.msg);
        } else {
            layer.msg(result.msg);
        }
    }
});
// 批量导入学员
upload.render({
    elem: '.ajax-import-user',
    url: '/admin/user/importExcel',
    accept: 'file', // 普通文件
    before: function(obj){
        layer.load();
    },
    done: function (result , index, upload) {
        // 上传完毕回调
        if (result.code === 1) {
            layer.closeAll('loading');
            setTimeout(function () {
                window.parent.location.reload();
                layer.close(layer.index);
            }, 1000);
            layer.msg(result.msg);
        } else {
            layer.msg(result.msg);
        }
    }
});
// 上传头像
upload.render({
    elem: '.ajax-avatar',
    url: '/index/user/upavatar',
    done: function (result) {
        // 上传完毕回调
        if (result.code === 1) {
            this.item.prev('input').val(result.url);
        } else {
            layer.msg(result.msg);
        }
    }
});
// 阿里云oss上传文件
upload.render({
    elem: '.ajax-oss',
    url: '/admin/educloud/ossupload',
    accept: 'file',
    done: function (result) {
        if (result.code === 1) {
            layer.msg("上传成功");
            location.reload();
        } else {
            layer.msg(result.msg);
        }
    }
});
// 通用相册
upload.render({
    elem: '.ajax-photos',
    url: '/admin/index/uploadImage',
    multiple: true,
    done: function (result) {
        // 上传完毕回调
        if (result.code === 1) {
            var html = '<div class="layui-form-item"><label class="layui-form-label"></label><div class="layui-input-block"><input type="text" name="photo[]" value="' + result.url + '" autocomplete="off" readonly class="layui-input"><button type="button" class="layui-btn layui-btn-primary layui-btn-position delete-photo"><i class="fa fa-times-circle"></i></button></div></div>';
            this.item.parents('.layui-form-item').after(html);
        } else {
            layer.msg(result.msg);
        }
    }
});
// 删除相册
$('.layui-form').delegate('.delete-photo', 'click', function () {
    $(this).parents('.layui-form-item').remove();
});
// 选择图标
$('.icon-library .fa').on('click', function () {
    $('input[name=icon]', window.parent.document).val($(this).attr('class'));
    parent.layer.closeAll();
});
form.verify({
    username: function (value, item) {
        if (!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)) {
            return '用户名不能有特殊字符';
        }
        if (/(^\_)|(\__)|(\_+$)/.test(value)) {
            return '用户名首尾不能出现下划线\'_\'';
        }
        if (/^\d+\d+\d$/.test(value)) {
            return '用户名不能全为数字';
        }
    },
    password: [
        /^[\S]{6,12}$/
        , '密码必须6到12位，且不能出现空格'
    ],
    payment : function(value) {
        if (value.length < 1) {
            return '请选择支付方式';
        }
    },
    http: function(value){
        if (value.indexOf("http") != -1 ) {
            return '私有域名中不能含有https://';
        }
    },
});
// 向试卷中添加试题
form.on('checkbox(exam)', function (data) {
    var id=data.value;
    var typeId= data.elem.getAttribute("typeid");
    var selected=$('#iselectquestions_'+typeId, window.parent.document);
    var selectnum=$('#ialreadyselectnumber_'+typeId,window.parent.document);
    if(selected.val() == '') {selected.val(',')}
    if(data.elem.checked){
        if(selected.val().indexOf(','+id+',') < 0){
            selected.val(selected.val()+id+',');
            var num= parseInt(selectnum.html())+parseInt(1);
            selectnum.html(num);
        }
    }else{
        var t = eval('/,'+id+',/');
        if(selected.val().indexOf(','+id+',') >= 0){
            selected.val(selected.val().replace(t,','));
            var num= parseInt(selectnum.html())-parseInt(1);
            selectnum.html(num);
        }
    }
});
//选择支付方式
$('.payment #alipay').on('click', function () {
    $(this).addClass("active");
    $('#payment').val('alipay');
    $('.payment #wxpay').removeClass("active");
    $('.payment #yuepay').removeClass("active");
});
$('.payment #wxpay').on('click', function () {
    $(this).addClass("active");
    $('#payment').val('wxpay');
    $('.payment #alipay').removeClass("active");
    $('.payment #yuepay').removeClass("active");
});
$('.payment #yuepay').on('click', function () {
    $(this).addClass("active");
    $('#payment').val('yuepay');
    $('.payment #wxpay').removeClass("active");
    $('.payment #alipay').removeClass("active");
});
// 支付提交
form.on('submit(f)', function (data) {
    var index = layer.msg('提交中，请稍候', {
        icon: 16,
        time: false,
        shade: 0.3
    });
    return true;
});
// 视频播放页面右侧栏
$("#aside-slide").on("click", function() {
    var width="0px";
    var paddingRight="16px";
    if($(this).hasClass("l")){
        $(this).removeClass("l").addClass("s");
        $("#aside-slide i").html("〈");
    }else if($(this).hasClass("s")){
        $(this).removeClass("s").addClass("l");
        width="338px";
        paddingRight="338px";
        $("#aside-slide i").html("〉");
    }
    $(".learn-right-box").animate({
        width: width
    }, {
        duration: 200
    });
    $(".learn-content").animate({
        paddingRight: paddingRight
    }, {
        duration: 200
    });
});
//检测是否购买课程
$('.check-learn a').on('click', function () {
    var sid =  $(this).attr('sid');
    var type = $(this).attr('type');
    var url = $(this).attr('url');
    $.ajax({
        url: url,
        type: 'post',
        dataType: 'json',
        data: {sid:sid,type:type},
        success: function (result) {
            if (result.code ==1) {
                location.href = result.href;
            }
            if(result.code ==0){
                layer.msg(result.msg);
            }
        },
        error: function (xhr, state, errorThrown) {
            layer.msg(state + '：' + errorThrown);
        }
    });
    return false;
});
//电脑端进入直播间
$('.enterLiveRoom').on('click' , function (){
        var room_id =  $(this).attr('room_id');
        var url= $(this).attr('url');
        var stime=new Date($(this).attr('stime'));
        var now = new Date();
        if((parseInt(stime - now)/ 1000)>600){
            layer.msg('只允许提前十分钟进入教室');
        }else{
            $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                data: {room_id:room_id},
                success: function (result) {
                    if (result.code ==0) {
                        enterClassroomClientURL = 'bjylive://urlpath=https://' + encodeURIComponent(result.url) + '&token=token&ts=ts';
                        enterClsssroomURL=encodeURIComponent(result.url);
                        var userAgent = navigator.userAgent;
                        if ( (userAgent.indexOf("Firefox") > -1) || (userAgent.indexOf("compatible") > -1 && userAgent.indexOf("MSIE") > -1)) {
                            var client = window.open(enterClassroomClientURL);
                            setTimeout(function () {
                                if (client) {
                                    client.close();
                                }
                            }, 5000);
                        } else {
                            var a = document.createElement("a");
                            a.setAttribute("href", enterClassroomClientURL);
                            document.body.appendChild(a);
                            a.click();
                        }
                        setTimeout(function () {
                            layer.confirm('如果未安装或不能打开客户端，请下载最新客户端，客户端观看直播更流畅，功能更强大。', {
                                btn: ['下载客户端','网页进入教室'] ,
                                skin: 'layui-layer-molv',
                                time: 8000,
                            }, function(){
                                var downURL="http://www.baijiayun.com/default/home/liveclientDownload?type=windows&partner_id=30000000";
                                location.href = downURL;
                            }, function(){
                                $("#intclassiframe").show();
                                $(".learn-box").hide();
                                window.open('https://'+result.url,'intclassiframe');
                            });
                        }, 3000);
                    }else{
                        layer.msg(result.msg);
                    }
                },
                error: function (xhr, state, errorThrown) {
                    layer.msg(state + '：' + errorThrown);
                }
            });
        }
        return false;
    }
)
//手机端进入直播间
$('.mobileEnterLiveRoom').on('click' , function (){
        var room_id =  $(this).attr('room_id');
        var url= $(this).attr('url');
        var stime=new Date($(this).attr('stime'));
        var now = new Date();
        if((parseInt(stime - now)/ 1000)>600){
            layer.msg('只允许提前十分钟进入教室');
        }else{
            $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                data: {room_id:room_id},
                success: function (result) {
                    if (result.code ==0) {
                        $("#intclassiframe").show();
                        $(".learn-box").hide();
                        var tabHieght=window.screen.availHeight-94+'px';
                        $('#intclassiframe').height(tabHieght);
                        window.open('https://'+result.url,'intclassiframe');
                    }else{
                        layer.msg(result.msg);
                    }
                },
                error: function (xhr, state, errorThrown) {
                    layer.msg(state + '：' + errorThrown);
                }
            });
        }
        return false;
    }
)
//手机端调取APP进入直播间
$('.appEnterLiveRoom').on('click' , function (){
        var room_id =  $(this).attr('room_id');
        var url= $(this).attr('url');
        var stime=new Date($(this).attr('stime'));
        var now = new Date();
        if((parseInt(stime - now)/ 1000)>600){
            layer.msg('只允许提前十分钟进入教室');
        }else{
            $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                data: {room_id:room_id},
                success: function (result) {
                    if (result.code ==0) {
                        var params = {};
                        params.roomId = room_id;
                        params.userNumber = result.user_number;
                        params.userName = result.user_name;
                        params.userType =result.user_role;
                        params.userAvatar = result.user_avatar;
                        params.sign = result.sign;
                        var url = 'bjlivemeeting://room.join?' + $.param(params);
                        var a = document.createElement('a');
                        a.href = url;
                        a.click();
                    }else{
                        layer.msg(result.msg);
                    }
                },
                error: function (xhr, state, errorThrown) {
                    layer.msg(state + '：' + errorThrown);
                }
            });
        }
        return false;
    }
)
//进入直播回放
$('.enterLivePlayBac').on('click' , function (){
        var room_id =  $(this).attr('room_id');
        var url= $(this).attr('url');
        $.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            data: {room_id:room_id},
            success: function (result) {
                if (result.code ==0) {
                    $("#intclassiframe").show();
                    $(".learn-box").hide();
                    window.open('https://'+result.playBacurl,'intclassiframe');
                }else{
                    layer.msg(result.msg);
                }
            },
            error: function (xhr, state, errorThrown) {
                layer.msg(state + '：' + errorThrown);
            }
        });
        return false;
    }
)
//手动点击已经学完按钮
$('.studied').on('click' , function (){
    var sid=$(this).attr('sid');
    var cid=$(this).attr('cid');
    var type=$(this).attr('type');
    var url=$(this).attr('url');
    $.ajax({
        url:url,
        type:"post", data:{'sid':sid,'cid':cid,'type':type},
        dataType:'json',
        success:function(data){
            if(data.status==1){
                layer.alert('恭喜你，本节课已经学完！', {
                    skin: 'layui-layer-molv'
                    ,closeBtn: 0
                });
            }else if(data.status==2){
                layer.alert('请先登录系统！', {
                    skin: 'layui-layer-molv'
                    ,closeBtn: 0
                });
            }else{
                layer.alert('您好像点过了亲！', {
                    skin: 'layui-layer-molv'
                    ,closeBtn: 0
                });
            }
        }
    })

})
//获取笔记
function getNotes(cid,sid,type,geturl,id) {
    $.ajax({
        url : geturl,
        type : "post",
        dataType : "json",
        data : {"cid" : cid, "sid" : sid, "type": type,'id':id},
        async:false,
        success : function(result) {
            var htm='<li id="courseNote'+result.id+'">'+
                '	    <div class="notes-list-box">'+
                '		    <section class="mt10  mr10">'+
                '			    <p class="c-999  font-12">'+result.contents+'</p>'+
                '           </section>'+
                '           <section class="mt10 mr10 hui-fr">'+
                '               <span class="c-999  l-h-30 font-12 ">' +result.addtime+'</span>'+
                '               <span class="c-666">'+
                '                   <a class="layui-btn  btn-del layui-btn-sm fr delNotes" url="/index/course/delnotes.html" id="'+result.id+'"><i class="layui-icon">&#xe640;</i></a>'+
                '               </span>'+
                '           </section>'+
                '       </div>'+
                '     </li>';
            $("#noteslist").prepend(htm);
        }
    });
}
//添加笔记
$('.addNotes').on('click' , function (){
    var quesContent=$('#quesContent').val();
    var cid=$(this).attr('cid');
    var sid=$(this).attr('sid');
    var type=$(this).attr('type');
    var url=$(this).attr('url');
    var geturl=$(this).attr('geturl');
    if(quesContent==''){
        layer.msg("笔记内容不能为空！");
    }else{
        $.ajax({
            url:url,
            type:"post", data:{'sid':sid,'cid':cid,'cstype':type,'contents':quesContent},
            dataType:'json',
            success:function(data){
                if(data.code==1){
                    layer.msg("笔记添加成功");
                    $('#quesContent').val('');
                    var id=data.id;
                    getNotes(cid,sid,type,geturl,id);
                }else{
                    layer.msg(data.msg);
                }
            }
        })
    }
})
//删除笔记
$('.delNotes').on('click' , function (){
    var id=$(this).attr('id');
    var url=$(this).attr('url');
    $.ajax({
        url : url,
        type : "post",
        dataType : "json",
        data : {'id' : id},
        async:false,
        success : function(data) {
            if(data.code==1){
                layer.msg(data.msg);
                $("#courseNote"+id).remove();
            }else{
                layer.msg(data.msg);
            }
        }
    });
})
//获取课程评论
function getComment(cid,sid,type,geturl,id) {
    $.ajax({
        url : geturl,
        type : "post",
        dataType : "json",
        data : {"cid" : cid, "sid" : sid, "type": type,'id':id},
        async:false,
        success : function(result) {
            var htm='<li id="courseNote'+result.id+'">'+
                '	    <div class="notes-list-box">'+
                '		    <section class="mt10  mr10">'+
                '			    <p class="c-999  font-12">'+result.contents+'</p>'+
                '           </section>'+
                '           <section class="mt10 mr10 hui-fr">'+
                '               <span class="c-999  l-h-30 font-12 ">' +result.addtime+'</span>'+
                '               <span class="c-666">'+
                '                   <a class="layui-btn  btn-del layui-btn-sm fr delNotes" url="/index/course/delnotes.html" id="'+result.id+'"><i class="layui-icon">&#xe640;</i></a>'+
                '               </span>'+
                '           </section>'+
                '       </div>'+
                '     </li>';
            $("#commentlist").prepend(htm);
        }
    });
}
//添加课程评论
$('.addComment').on('click' , function (){
    var commentContent=$('#commentContent').val();
    var cid=$(this).attr('cid');
    var sid=$(this).attr('sid');
    var type=$(this).attr('type');
    var url=$(this).attr('url');
    var geturl=$(this).attr('geturl');
    if(commentContent==''){
        layer.msg("评论内容不能为空！");
    }else{
        $.ajax({
            url:url,
            type:"post", data:{'sid':sid,'cid':cid,'cstype':type,'contents':commentContent},
            dataType:'json',
            success:function(data){
                if(data.code==1){
                    layer.msg("评论添加成功");
                    $('#commentContent').val('');
                    var id=data.id;
                    getComment(cid,sid,type,geturl,id);
                }else{
                    layer.msg(data.msg);
                }
            }
        })
    }
})
//删除课程评论
$('.delComment').on('click' , function (){
    var id=$(this).attr('id');
    var url=$(this).attr('url');
    $.ajax({
        url : url,
        type : "post",
        dataType : "json",
        data : {'id' : id},
        async:false,
        success : function(data) {
            if(data.code==1){
                layer.msg(data.msg);
                $("#courseComment"+id).remove();
            }else{
                layer.msg(data.msg);
            }
        }
    });
})

//下载远程文件
$('.downfile a').on('click', function () {
    var cid=$(this).attr('cid');
    var type=$(this).attr('type');
    var mid=$(this).attr('mid');
    var url=$(this).attr('url');
    $.ajax({
        url: url,
        type: 'post',
        dataType: 'json',
        data: {cid:cid,type:type,mid:mid},
        success: function (result) {
            if (result.code ==1) {
                var $form = $('<form method="GET"></form>');
                $form.attr('action', result.downHref);
                $form.appendTo($('body'));
                $form.submit();
            }
            if(result.code ==0){
                layer.msg(result.msg);
            }
        },
        error: function (xhr, state, errorThrown) {
            layer.msg(state + '：' + errorThrown);
        }
    });
});
//试题解析按钮
$('.js-analysis a').on('click', function () {
    var id=$(this).attr('aid');
    if($(this).hasClass('zhankai')){
        $(".zhankai"+id).addClass("layui-hide");
        $(".shouqi"+id).removeClass("layui-hide");
        $(".analysis"+id).removeClass("layui-hide");
    }
    if($(this).hasClass('shouqi')){
        $(".zhankai"+id).removeClass("layui-hide");
        $(".shouqi"+id).addClass("layui-hide");
        $(".analysis"+id).addClass("layui-hide");
    }
})
//试卷批阅检测给的分数是否合理
$('.check-score').on('blur', function () {
    var score=$(this).val();
    var tscore=$(this).attr('score');
    if(parseInt(score)>parseInt(tscore)){
        layer.msg('给的分值大于本题最高分值')
    }
    return false;
});
// 视频课程选择视频的点击事件
$(".exam-list a").click(function() {
    $('input[name=paperid]', window.parent.document).val($(this).attr('eid'));
    $('input[name=title]', window.parent.document).val($(this).attr('ename'));
    var index = parent.layer.getFrameIndex(window.name);
    parent.layer.close(index);
})
// 课程收藏
$('.favourite').on('click', function () {
    var cid=$(this).attr('cid');
    var url=$(this).attr('url');
    var type=$(this).attr('type');
    var status=$(this).attr('status');
    $.ajax({
        url : url,
        type : "post",
        dataType : "json",
        data : {'cid':cid,'type':type},
        async:false,
        success : function(data) {
            if(data.code==1){
                layer.msg(data.msg);
                $(".f").addClass("layui-hide");
                $(".unf").removeClass("layui-hide");
            }
            if(data.code==2){
                layer.msg(data.msg);
                $(".f").removeClass("layui-hide");
                $(".unf").addClass("layui-hide");
            }
            if(data.code==0){
                layer.msg(data.msg);
            }
        }
    });
})
// 发送注册手机验证码
$('.getPhoneCode').on('click', function () {
    var url=$(this).attr('url');
    var mobile=$("#mobile").val();
    if(mobile=='' || mobile==null){
        layer.msg('请输入手机号码');
        return false;
    }
    $.ajax({
        type: "post",
        url: url,
        data: {mobile:mobile},
        dataType: "json",
        async:false,
        success:function(data){
            if(data.Code=='OK'){
                layer.msg('发送成功');
                settime();
            }else{
                layer.msg(data.Message);
            }
        },
        error:function(err){
            console.log(err);
        }
    });
});
function settime() {
    var _generate_code = $(".generate_code");
    _generate_code.addClass('layui-btn-disabled');
    if (countdown == 0) {
        _generate_code.removeClass('layui-btn-disabled');
        _generate_code.val("获取验证码");
        countdown = 60;
        return false;
    } else {
        _generate_code.addClass('layui-btn-disabled');
        _generate_code.val("重新发送(" + countdown + ")");
        countdown--;
    }
    setTimeout(function() {
        settime();
    },1000);
}
function IsPC() {
    var userAgentInfo = navigator.userAgent;
    var Agents = ["Android", "iPhone",
        "SymbianOS", "Windows Phone",
        "iPad", "iPod"];
    var flag = true;
    for (var v = 0; v < Agents.length; v++) {
        if (userAgentInfo.indexOf(Agents[v]) > 0) {
            flag = false;
            break;
        }
    }
    return flag;
}
// 优惠券点击使用
$('.mycoupon').on('click', function () {
    var coupon=$('#coupon').val();
    var url=$(this).attr('url');
    var cid=$(this).attr('cid');
    var price=$(this).attr('price');
    var type=$(this).attr('type');
    var usetype=$(this).attr('usetype');
    if(coupon=='none'){
        layer.msg('请选择优惠券');
    }else{
        $.ajax({
            url : url,
            type : "post",
            dataType : "json",
            data : {'coupon':coupon,'cid':cid,'price':price,'type':type,'usetype':usetype},
            async:false,
            success : function(data) {
                if(data.code==1){
                    layer.msg(data.msg);
                }
                if(data.code==0){
                    $("#usedCoupon").val(coupon);
                    $("#coupon-type").text(data.rate+'折优惠券');
                    $("#coupon-price").text(parseFloat(parseFloat(data.rate/10)*parseFloat($("#yuan-price").text())).toFixed(1));
                }
            }
        });
    }
})
//阿里云视频、分类分页
var count=$("#count").val();
var PageSize=$("#PageSize").val();
var curr=$("#curr").val();
var url=$("#url").val();
laypage.render({
    elem: 'page'
    ,count: count
    ,curr:curr
    ,limit:PageSize
    ,layout: [ 'prev', 'page', 'next']
    ,jump: function(obj,first){
        if (!first) {
            location.href = url+obj.curr+'.html';
        }
    }
});
//监听secect
form.on('select(select)', function(data){
    var url=$(data.elem).attr("data-url");
    var obj = {};
    obj[$(data.elem).attr('name')] = data.value;
    obj['_verify'] = 0;
    $.ajax({
        url: url,
        type: 'post',
        dataType: 'json',
        data: obj,
        success: function (result) {
            if (result.code === 1) {
                layer.msg(result.msg);
                setTimeout(function () {
                    location.reload();
                }, 1000);
            }
        },
        error: function (xhr, state, errorThrown) {
            layer.close(index);
            layer.msg(state + '：' + errorThrown);
        }
    });
    form.render('select');
});
//鼠标滑过显示tips
$(".tips").mouseover(function() {
    var tips=$(this).attr('tips');
    layer.tips(tips, this, {
        tips: [1, "#FF5722"]
    });
});
