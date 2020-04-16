<?php

namespace app\index\controller;

use app\common\controller\IndexBase;

class Teacher extends IndexBase
{
    function index(){
        $teacher=model('cooperate')->where('status',1)->select();
        return $this->fetch('index',['teacher'=>$teacher]);
    }
    function centert(){
        $param=$this->request->param();
        $teacherInfo=model('cooperate')->where('id',$param['id'])->find();
        $videoCourse=model('videoCourse')->order('sort_order asc,addtime desc')->where(['status'=>1,'teacher_id'=>$param['id']])->select();
        $liveCourse=model('liveCourse')->order('sort_order asc,addtime desc')->where(['status'=>1,'teacher_id'=>$param['id']])->select();
        $allCourse=array_merge($videoCourse,$liveCourse);
        return $this->fetch('centert',['list'=>$allCourse,'teacherInfo'=>$teacherInfo]);
    }



}