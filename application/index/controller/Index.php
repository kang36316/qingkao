<?php

namespace app\index\controller;

use app\common\controller\IndexBase;

class Index extends IndexBase
{
    public function index()
    {
        $slide = cache('slide')?:model('ad')->order('sort_order asc')->where(['category'=>'index','status'=>1])->select();
        $videoCourse=cache('videoCourse')?:model('videoCourse')->order('sort_order asc,id desc')->limit(16)->select();
        $liveCourse=cache('liveCourse')?:model('liveCourse')->order('sort_order asc,id desc')->limit(16)->select();
        $videoCourse2=cache('videoCourse2')?:model('videoCourse')->order('sort_order asc,id desc')->limit(8)->select();
        $liveCourse2=cache('liveCourse2')?:model('liveCourse')->order('sort_order asc,id desc')->limit(8)->select();
        $allCourse=cache('allCourse')?:array_merge($videoCourse2,$liveCourse2);
        $article=cache('article')?:model('article')->order('sort_order asc,update_time desc')->limit(8)->select();
        $teacher=cache('teacher')?:model('cooperate')->where('status',1)->limit(4)->select();
        $classroom = cache('classroom')?:model('classroom')->order('sort_order asc,addtime desc')->limit(4)->select();
        if(!cache('slide')) cache('slide', $slide);
        if(!cache('videoCourse')) cache('videoCourse', $videoCourse);
        if(!cache('liveCourse')) cache('liveCourse', $liveCourse);
        if(!cache('videoCourse2')) cache('videoCourse2', $videoCourse2);
        if(!cache('liveCourse2')) cache('liveCourse2', $liveCourse2);
        if(!cache('allCourse')) cache('allCourse', $allCourse);
        if(!cache('article')) cache('article', $article);
        if(!cache('teacher')) cache('teacher', $teacher);
        if(!cache('classroom')) cache('classroom', $classroom);
        return $this->fetch('index', ['slide' => $slide,'allCourse'=>$allCourse,'videoCourse'=>$videoCourse,'liveCourse'=>$liveCourse,'article'=>$article,'classroom'=>$classroom,'teacher'=>$teacher]);
    }
    public function down(){
        $Android=json_to_array($this->getAppStatus('Android'));
        $Android['downurl']=UrlEncode($Android['downurl']);
        $H5=json_to_array($this->getAppStatus('H5'));
        $H5['domain']=UrlEncode(is_https().$H5['domain']);
        return $this->fetch('down',['Android'=>$Android,'H5'=>$H5]);
    }
    function getAppStatus($type){
        $info=$this->get_site_info();
        $url = $info['server'] . "/educloud/Mobileterminal/getAppStatus";
        $postdata = ['domain'=>$info['domain'],'type'=>$type];
        return (post_curl($url, $postdata));
    }
    function qrcode(){
        vendor('phpqrcode.phpqrcode');
        $param = $this->request->param();
        $url=urldecode($param['url']);
        $level = $param['level'];
        $size = $param['size'];
        \QRcode::png($url, false, $level, $size);
    }
    function search(){
        return $this->fetch('search');
    }
    function LiveClient(){
        return $this->fetch('liveClient');
    }
}
