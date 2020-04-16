<?php

namespace app\admin\controller;
use app\common\controller\AdminBase;
vendor ('category.Category');
class Exam extends AdminBase
{
    protected function _initialize()
    {
        parent::_initialize();
        if ($this->request->isGet()) {
            $this->assign('courseCategory', list_to_level(model('courseCategory')->order('sort_order asc')->select()));
        }
    }

    /**
     * 试题列表
     */
    public function questionsList()
    {
        $param = $this->request->param();
        $where = [];
        if (isset($param['question'])) {
            $where['question'] = ['like', "%" . $param['question'] . "%"];
        }
        if (isset($param['questionchapterid'])) {
            $where['questionchapterid'] = $param['questionchapterid'];
        }
        if (isset($param['questiontype'])) {
            $where['questiontype'] = $param['questiontype'];
        }
        if (isset($param['questionknowsid'])) {
            $where['questionknowsid'] = $param['questionknowsid'];
        }
        if(($tid=getTeacherIdByUid(is_user_login()))>0){
            $where['questionuserid'] = $tid;
        }
        $list = model('questions')->order('id desc')->where($where)->where('questionparent',0)
            ->paginate(config('page_number'), false, ['query' => $param]);
        $type=model('questionType')->order('sort_order asc')->select();
        return $this->fetch('questionsList',['list' => $list,'type'=>$type]);
    }

    /**
     * 单个添加试题
     */
    public function questionsSingleAdd()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            $param['questionuserid']=getTeacherIdByAdminId(is_admin_login());
            $typearr=explode("－",$param['questiontype']);
            $param['questiontype']=$typearr[0];
            if(get_question_mark($typearr[0])=='TiMao'){
                $param['questionsequence']=1;
                if ( $id=db('questions')->insertGetId($param)) {
                    $this->success('添加成功', url('admin/exam/addSubQuestions',['questionparent'=>$id]));
                } else {
                    $this->error($this->errorMsg);
                }
            }else{
                $param['questionsequence']=0;
                $param['questionanswer']=$param['questionanswer'.get_question_mark($typearr[0])];
                if(is_array($param['questionanswer'])) {$param['questionanswer'] = implode('',$param['questionanswer']);}
                if ($this->insert('questions', $param) === true) {
                    $this->success('添加成功', url('admin/exam/questionsList'));
                } else {
                    $this->error($this->errorMsg);
                }
            }
        }
        $list=model('courseCategory')->order('sort_order asc')->select();
        $cat = new \org\Category(array('id', 'pid', 'category_name','cname'));
        $data = $cat->getTree($list, intval($id=0));
        $type=model('questionType')->order('sort_order asc')->select();
        return $this->fetch('questionsSingleAdd',['category' => $data,'type'=>$type]);
    }
    /**
     * 题帽题添加子题
     */
    public function addSubQuestions()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            $param['questionuserid']=getTeacherIdByAdminId(is_admin_login());
            $typearr=explode("-",$param['questiontype']);
            $param['questionanswer']=$param['questionanswer'.get_question_mark($typearr[0])];
            if(is_array($param['questionanswer'])) {$param['questionanswer'] = implode('',$param['questionanswer']);}
            if ($this->insert('questions', $param, $rule = false) === true) {
                insert_admin_log('添加了题帽子题');
                $this->success('添加成功', url('admin/exam/addSubQuestions',['questionparent'=>$param['questionparent']]));
            } else {
                $this->error($this->errorMsg);
            }
        }
        $type=model('questionType')->order('sort_order asc')->where('mark','not like','TiMao')->select();
        $param = $this->request->param();
        return $this->fetch('addSubQuestions',['type'=>$type,'questionparent'=>$param['questionparent']]);
    }
    /**
     * CSV文件批量导入试题
     */
    public function questionsCSVleAdd()
    {
        return $this->fetch('questionsCSVleAdd');
    }

    /**
     * 编辑试题
     */
    public function questionsEdit()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            $param['questionuserid']=getTeacherIdByAdminId(is_admin_login());
            $typearr=explode("－",$param['questiontype']);
            $param['questiontype']=$typearr[0];
            $param['questionsequence']=0;
            $param['questionanswer']=$param['questionanswer'.get_question_mark($typearr[0])];
            if(is_array($param['questionanswer'])) {$param['questionanswer'] = implode('',$param['questionanswer']);}
            if ($this->update('questions', $param) === true) {
                $this->success('编辑成功', url('admin/exam/questionsList'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        $list=model('courseCategory')->order('sort_order asc')->select();
        $cat = new \org\Category(array('id', 'pid', 'category_name','cname'));
        $data = $cat->getTree($list, intval($id=0));
        $type=model('questionType')->order('sort_order asc')->select();
        $questions=model('questions')->where('id',input('id'))->find();
        return $this->fetch('questionsSingleAdd',['data'=>$questions,'category' => $data,'type'=>$type]);
    }
    /**
     * 试题浏览
     */
    public function questionsPreview()
    {
        $data= model('questions')->where('id',input('id'))->find();
        if($data['questionsequence']==1){
            $data['subQuestions']= model('questions')->where('questionparent',$data['id'])->select();
        }
        return $this->fetch('questionsPreview',['data'=>$data,'NoBtn'=>input('NoBtn')]);
    }

    /**
     * 删除试题
     */
    public function questionsDel()
    {
        if ($this->request->isPost()) {
            if ($this->delete('questions', $this->request->param()) === true) {
                insert_admin_log('删除了试题');
                $this->success('删除成功');
            } else {
                $this->error($this->errorMsg);
            }
        }
    }

    /**
     * 试卷列表
     */
    public function examList()
    {
        if(($tid=getTeacherIdByUid(is_user_login()))>0){
            $where['examauthorid'] = $tid;
        }
        return $this->fetch('examList',['list' => model('exams')->order('id desc')->where($where)->paginate(config('page_number'))]);
    }

    /**
     * 试卷预览
     */
    public function examPreview()
    {
        $exam=model('exams')->where('id',input('id'))->find();
        $exam['examsetting']=json_to_array($exam['examsetting']);
        $exam['examquestions']=json_to_array($exam['examquestions']);
        $subQuestions=[];
        foreach ($exam['examquestions'] as $k => $value) {
            if(get_question_mark($k)=='TiMao'){
                foreach ($exam['examquestions'][$k] as $i => $value) {
                    $subQuestions[$value]=$this->getSubQuestions($value);
                }
            }
        }
        $exam['subQuestions']=$subQuestions;
        return $this->fetch('examPreview',['exam'=>$exam]);
    }
    /**
     * 根据题帽ID获取题帽题子题
     */
    function getSubQuestions($id){
        $getSubQuestions= model('questions')->field('id')->where('questionparent',$id)->column('id');
        return $getSubQuestions;
    }
    /**
     * 删除试卷
     */
    public function examDel()
    {
        if ($this->request->isPost()) {
            if ($this->delete('exams', $this->request->param()) === true) {
                insert_admin_log('删除了试卷');
                $this->success('删除成功');
            } else {
                $this->error($this->errorMsg);
            }
        }
    }

    /**
     * 手动组卷
     */
    public function selfpage()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            foreach ($param['examquestions'] as $k => $value) {
                $param['examquestions'][$k]=explode(',',(rtrim(ltrim($value['questions'],','),',')));
            }
            foreach ($param['questype'] as $k => $value) {
                if(!empty($param['questype'][$k]['number'])){
                    $temp[$k]=$param['questype'][$k];
                }
            }
            $exam['examauthorid']=getTeacherIdByAdminId(is_admin_login());
            $exam['examsetting']= json_encode(['examtime'=>$param['examtime'],'examscore'=>$param['examscore'],'questype'=>$temp]);
            $exam['examquestions']= json_encode($param['examquestions']);
            $exam['examsubject']=$param['examsubject'];
            $exam['exam']=$param['exam'];
            $exam['examtime']=$param['examtime'];
            $exam['examscore']=$param['examscore'];
            $exam['examstatus']=1;
            $exam['addtime']=$param['addtime'];
            if ($this->insert('exams', $exam)===true) {
                insert_admin_log('添加了试题');
                $this->success('添加成功', url('admin/exam/examList'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        $list=model('courseCategory')->order('sort_order asc')->select();
        $cat = new \org\Category(array('id', 'pid', 'category_name','cname'));
        $data = $cat->getTree($list, intval($id=0));
        return $this->fetch('selfpage',['questiontype'=>model('questionType')->order('sort_order asc')->select(),'courseCategory'=>$data]);
    }

    /**
     * 手动组卷选择试题
     */
    public function questionsSelect()
    {
        $where['questiontype']=input('questiontype');
        return $this->fetch('questionsSelect',['list'=>model('questions')->where($where)->where('questionparent',0)->order('id asc')->paginate(config('page_number')),'questiontype'=>input('questiontype')]);

    }
    /**
     * 试题类型列表
     */
    public function typeList(){

        return $this->fetch('typeList', ['list' => model('questionType')->order('sort_order asc')->select()]);
    }

    /**
     * 添加试题类型
     */
    public function typeAdd(){

        if ($this->request->isPost()) {
            if ($this->insert('questionType', $this->request->param()) === true) {
                insert_admin_log('添加了题型');
                $this->success('添加成功', url('admin/exam/typeList'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        return $this->fetch('typeSave');
    }

    /**
     * 编辑试题类型
     */
    public function typeEdit()
    {
        if ($this->request->isPost()) {
            if ($this->update('questionType', $this->request->param(), input('_verify', true)) === true) {
                insert_admin_log('修改了题型');
                $this->success('修改成功', url('admin/exam/typeList'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        return $this->fetch('typeSave', ['data' => model('questionType')->where('id', input('id'))->find()]);
    }

    /**
     * 删除试题类型
     */
    public function typeDel()
    {
        if ($this->request->isPost()) {
            if ($this->delete('questionType', $this->request->param()) === true) {
                insert_admin_log('删除试题类型');
                $this->success('删除成功');
            } else {
                $this->error($this->errorMsg);
            }
        }
    }
    /**
     * 批阅试卷
     */
    public function mark(){
        if ($this->request->isPost()) {
            $param = $this->request->param();
            $myscore=json_to_array(db('myexam')->where(['uid'=>$param['uid'],'eid'=>$param['eid']])->value('myscore'));
            $kgscores=json_to_array(db('myexam')->where(['uid'=>$param['uid'],'eid'=>$param['eid']])->value('kgscores'));
            $myexam['myscore']=json_encode($myscore+$param['score']);
            foreach ($param['score'] as $k=> $value) {
                $myexam['zgscores']=$myexam['zgscores']+$param['score'][$k];
            }
            $myexam['totalscores']=$myexam['zgscores']+$kgscores;
            $myexam['status']=1;
            $myexam['id']=$param['id'];
            if($this->update('myexam', $myexam ,input('_verify', true)) === true){
                $this->success('批阅完成');
            }else{
                $this->error($this->errorMsg);
            }
        }
        $param = $this->request->param();
        $exam=model('exams')->where('id',$param['eid'])->find();
        $exam['examsetting']=json_to_array($exam['examsetting']);
        $exam['examquestions']=json_to_array($exam['examquestions']);
        $subQuestions=[];
        foreach ($exam['examquestions'] as $k => $value) {
            if(get_question_mark($k)=='TiMao'){
                foreach ($exam['examquestions'][$k] as $i => $value) {
                    $subQuestions[$value]=$this->getSubQuestions($value);
                }
            }
        }
        $exam['subQuestions']=$subQuestions;
        $myexam=model('myexam')->where(['uid'=>$param['uid'],'id'=>$param['id'],'eid'=>$param['eid']])->find();
        $myexam['myanswer']=json_to_array($myexam['myanswer']);
        $myexam['myscore']=json_to_array($myexam['myscore']);
        return $this->fetch('mark', ['exam'=>$exam,'myexam'=>$myexam]);
    }
    /**
     * 试卷列表
     */
    public function paperList(){
        $param = $this->request->param();
        $where = ['status'=>1];
        if (isset($param['cid'])) {
            $ids= explode("-", $param['cid']);
            $map['ctype'] = $ids[0];
            $map['cid'] = $ids[1];
        }
        if(getAdminAuthId(is_admin_login())!=1){
            $where['teacher_id']=getTeacherIdByUid(is_user_login());
            $map['tid'] = getTeacherIdByUid(is_user_login());
        }
        $list=model('myexam')->where($map)->paginate(config('page_number'));
        $videoCourse=model('videoCourse')->order('sort_order asc,addtime desc')->where($where)->select();
        $liveCourse=model('liveCourse')->order('sort_order asc,addtime desc')->where($where)->select();
        return $this->fetch('paperList', ['list' => $list,'course'=>array_merge($videoCourse,$liveCourse)]);
    }
}