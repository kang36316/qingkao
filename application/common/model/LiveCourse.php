<?php

namespace app\common\model;

use think\Model;

class LiveCourse extends Model
{
    public function courseCategory()
    {
        return $this->belongsTo('courseCategory', 'cid', 'id')->bind('category_name');
    }
    public function getSection($courseId){
        $sectionList=model('liveSection')->where(['csid'=>$courseId,'ischapter'=>1])->order('sort_order asc')->select();
        if(!empty($sectionList)){
            foreach ($sectionList as $key => $value) {
                $sectionList[$key]['section']=model('liveSection')->where(['chapterid'=>$sectionList[$key]['id']])->order('starttime asc')->select();
            }
            return $sectionList;
        }else{
            $sectionList = model('liveSection')->where(['csid'=>$courseId])->order('starttime asc')->select();
            return $sectionList;
        }
    }
}