<?php
namespace app\admin\controller;
use app\common\controller\AdminBase;
vendor ('category.Category');
class Course extends AdminBase
{
    protected function _initialize()
    {
        parent::_initialize();
        if ($this->request->isGet()) {
            $this->assign('courseCategory', list_to_level(model('courseCategory')->order('sort_order asc')->select()));
        }
    }
    /**
     * 点播课程
     */
    public function videoIndex()
    {
        $param = $this->request->param();
        $where = [];
        if (isset($param['title'])) {
            $where['title'] = ['like', "%" . $param['title'] . "%"];
        }
        if (isset($param['cid'])) {
            $where['cid'] = $param['cid'];
        }
        if (isset($param['is_top'])) {
            $where['is_top'] = $param['is_top'];
        }
        if (isset($param['is_hot'])) {
            $where['is_hot'] = $param['is_hot'];
        }
        if (isset($param['status'])) {
            $where['status'] = $param['status'];
        }
        if(getAdminAuthId(is_admin_login())!=1){
            $map['teacher_id'] =getTeacherIdByUid(is_user_login());
        }
        $list = model('videoCourse')->with('courseCategory')->order('sort_order asc')->where($where)->where($map)
            ->paginate(config('page_number'), false, ['query' => $param]);
        return $this->fetch('videoindex', ['list' => $list]);
    }
    /**
     * 添加点播课程
     */
    public function videoAdd(){
        if ($this->request->isPost()) {
            $param=$this->request->param();
            $param['addtime']=date('Y-m-d h:i:s', time());
            $param['teacher_id']=getTeacherIdByAdminId(is_admin_login());
            if ($this->insert('videoCourse', $param) === true) {
                clear_cache();
                insert_admin_log('添加了点播课程');
                $this->success('添加成功', url('admin/course/videoindex'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        return $this->fetch('videosave');
    }
    /**
     * 编辑点播课程
     */
    public function videoEdit()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            if (is_array($param['id'])) {
                $data = [];
                foreach ($param['id'] as $v) {
                    $data[] = ['id' => $v, $param['name'] => $param['value']];
                }
                $result = $this->saveAll('videoCourse', $data, input('_verify', true));
            } else {
                $result = $this->update('videoCourse', $param, input('_verify', true));
            }
            if ($result === true) {
                insert_admin_log('修改了点播课程');
                clear_cache();
                $this->success('修改成功', url('admin/course/videoindex'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        return $this->fetch('videosave', ['data' => model('videoCourse')->get(input('id'))]);
    }
    /**
     * 删除点播课程
     */
    public function videoDel()
    {
        if ($this->request->isPost()) {
            if ($this->delete('videoCourse', $this->request->param()) === true) {
                insert_admin_log('删除了点播课程');
                clear_cache();
                $this->success('删除成功');
            } else {
                $this->error($this->errorMsg);
            }
        }
    }
    /**
     * 点播课程管理
     */
    public function videoAdmin(){
        $data=model('videoCourse')->where('id', input('id'))->find();
        $sectionlist=model('videoSection')->order('sort_order asc')->where(['csid'=>input('id'),'ischapter'=>1])->select();
        if(!empty($sectionlist)){
            foreach ($sectionlist as $key => $value) {
                $sectionlist[$key]['seclist']=model('videoSection')->order('sort_order asc')->where(['chapterid'=>$sectionlist[$key]['id']])->select();
            }
        }else{
            $sectionlist=model('videoSection')->order('sort_order asc')->where(['csid'=>input('id')])->select();
        }
        return $this->fetch('videoadmin',['data' =>$data,'sectionlist'=>$sectionlist ]);
    }
    /**
     * 点播课程添加章
     */
    public function videoAddZhang(){
        if ($this->request->isPost()) {
            if ($this->insert('videoSection', $this->request->param()) === true) {
                insert_admin_log('添加了点播课程章节');
                $this->success('添加成功', url('admin/course/videoadmin',['id'=>input('cid')]));
            } else {
                $this->error($this->errorMsg);
            }
        }
        return $this->fetch('videoAddZhang',['cid'=>input('cid')]);
    }
    /**
     * 点播课程编辑章
     */
    public function videoEditZhang()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            $result = $this->update('videoSection', $param, input('_verify', true));
            if ($result === true) {
                insert_admin_log('修改了点播课程章节');
                $this->success('修改成功', url('admin/course/videoadmin'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        $data=model('videoSection')->get(input('id'));
        return $this->fetch('videoAddZhang', ['cid'=>$data['csid'],'data' =>$data]);
    }
    /**
     * 点播课程添加课时
     */
    public function videoAddSection(){
        if ($this->request->isPost()) {
            if ($this->insert('videoSection', $this->request->param()) === true) {
                insert_admin_log('添加了点播课程章节');
                $this->success('添加成功', url('admin/course/videoadmin',['id'=>input('cid')]));
            } else {
                $this->error($this->errorMsg);
            }
        }
        $zhang=model('videoSection')->order('sort_order asc')->where(['csid'=>input('cid'),'ischapter'=>1])->select();
        return $this->fetch('videoAddSection',['cid'=>input('cid'),'zhang'=>$zhang]);
    }
    /**
     * 点播课程编辑课时
     */
    public function videoEditSection()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            $result = $this->update('videoSection', $param, input('_verify', true));
            if ($result === true) {
                insert_admin_log('修改了点播课程章节');
                $this->success('修改成功', url('admin/course/videoadmin'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        $data=model('videoSection')->get(input('id'));
        $zhang=model('videoSection')->order('sort_order asc')->where(['csid'=>$data['csid'],'ischapter'=>1])->select();
        return $this->fetch('videoAddSection', ['cid'=>$data['csid'],'data' =>$data,'zhang'=>$zhang]);
    }
    /**
     * 点播课程删除课时
     */
    public function videoDelSection()
    {
        if ($this->request->isPost()) {
            if ($this->delete('videoSection', $this->request->param()) === true) {
                insert_admin_log('删除了点播课程');
                $this->success('删除成功');
            } else {
                $this->error($this->errorMsg);
            }
        }
    }
    /**
     * 视频列表
     */
    public function videoList(){
        $info=$this->get_site_info();
        $param = $this->request->param();
        $url = config('author_web') . "/educloud/alivideo/getvideolist";
        if(empty($param['categoryId'])){
            $category_id=model('admin')->where(['id'=>is_admin_login()])->value('category_id');
        }else{
            $category_id=$param['categoryId'];
        }
        $postdata = ['private_domain'=>$info['private_domain'],'domain'=>$info['domain'],'authorcode'=>$info['authorcode'],'KeyID' => config('KeyID'), 'keySecret' => config('KeySecret'), 'PageSize' => config('PageSize'),'PageNo'=>$param['page'],'aliyuncategory'=>$category_id];
        $restemp = json_to_array(post_curl($url, $postdata));
        $categoryList=controller('admin/educloud')->getvideoCategory(1,100);
        return $this->fetch('videoList', ['categoryList'=>$categoryList['SubCategories']['Category'],'list' => $restemp['VideoList']['Video'],'curr'=>$param['page'],'count'=>$restemp['Total'],'PageSize'=>config('PageSize'),'userId'=>config('AliUserId'),'categoryid'=>$param['categoryId']]);
    }
    /**
     * 点播课程添加文本课时
     */
    public function videoAddDoc(){
        if ($this->request->isPost()) {
            if ($this->insert('videoSection', $this->request->param()) === true) {
                insert_admin_log('添加了点播课程章节');
                $this->success('添加成功', url('admin/course/videoadmin',['id'=>input('cid')]));
            } else {
                $this->error($this->errorMsg);
            }
        }
        $zhang=model('videoSection')->order('sort_order asc')->where(['csid'=>input('cid'),'ischapter'=>1])->select();
        return $this->fetch('videoAddDoc',['cid'=>input('cid'),'zhang'=>$zhang]);
    }
    /**
     * 点播课程编辑文本课时
     */
    public function videoEditDoc()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            $result = $this->update('videoSection', $param, input('_verify', true));
            if ($result === true) {
                insert_admin_log('修改了点播课程章节');
                $this->success('修改成功', url('admin/course/videoadmin'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        $data=model('videoSection')->get(input('id'));
        $zhang=model('videoSection')->order('sort_order asc')->where(['csid'=>$data['csid'],'ischapter'=>1])->select();
        return $this->fetch('videoAddDoc', ['cid'=>$data['csid'],'data' =>$data,'zhang'=>$zhang]);
    }
    /**
     * 点播课程添加考试课程
     */
    public function videoaddExam(){
        if ($this->request->isPost()) {
            $param=$this->request->param();
            $param['addtime']=date('Y-m-d h:i:s',time());
            $param['ischapter']=0;
            if ($this->insert('videoSection',$param) === true) {
                insert_admin_log('添加了点播课程考试章节');
                $this->success('添加成功', url('admin/course/videoadmin',['id'=>input('csid')]));
            } else {
                $this->error($this->errorMsg);
            }
        }
        $zhang=model('videoSection')->order('sort_order asc')->where(['csid'=>input('cid'),'ischapter'=>1])->select();
        return $this->fetch('videoaddExam',['cid'=>input('cid'),'zhang' =>$zhang]);
    }
    /**
     * 点播课程编辑考试课程
     */
    public function videoEditExam(){
        if ($this->request->isPost()) {
            $param=$this->request->param();
            $param['addtime']=date('Y-m-d h:i:s',time());
            $param['ischapter']=0;
            $result = $this->update('videoSection', $param, input('_verify', true));
            if ($result === true) {
                insert_admin_log('修改了点播课程考试章节');
                $this->success('修改成功', url('admin/course/videoadmin'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        $data=model('videoSection')->get(input('id'));
        $zhang=model('videoSection')->order('sort_order asc')->where(['csid'=>input('cid'),'ischapter'=>1])->select();
        return $this->fetch('videoaddExam', ['cid'=>$data['csid'],'data' =>$data,'zhang'=>$zhang]);
    }
    /**
     * 试卷列表
     */
    public function paperlist(){
        if(getAdminAuthId(is_admin_login())!=1){
            $map['examauthorid'] =getTeacherIdByUid(is_user_login());
        }
        $list=model('Exams')->order('id desc')->where($map)->paginate(15);
        return $this->fetch('paperList',['list'=>$list]);
    }
    /**
     * 课程学员列表
     */
    public function xueyuanList(){
        $param = $this->request->param();
        $list=model('userCourse')->where(['cid'=>$param['cid'],'type'=>$param['type']])->select();
        foreach ($list as $key => $value) {
            $data[$key]['uid']=$list[$key]['uid'];
            $data[$key]['progress']=round(json_count($list[$key]['studied'])/getCourseNum($param['cid'],$param['type'])*100);
        }
        return $this->fetch('xueyuanList', ['list'=>$data]);
    }
    /**
     * 课程资料列表
     */
    public function materialList(){
        $param = $this->request->param();
        if($param['type']==1){
            $courseInfo=model('videoCourse')->where(['id'=>$param['cid']])->field('material_id')->find();
        }
        if($param['type']==2){
            $courseInfo=model('liveCourse')->where(['id'=>$param['cid']])->field('material_id')->find();
        }
        $materialIds=json_to_array($courseInfo['material_id']);
        $where['id']=['in',$materialIds];
        return $this->fetch('materialList', ['cid'=>input('cid'),'list' => model('Material')->where($where)->order('id desc')->paginate(7)]);
    }
    /**
     * 课程添加资料
     */
    public function MaterialAdd(){
        return $this->fetch('materialAdd', ['list' => model('Material')->order('id desc')->paginate(7),'cid'=>input('cid'),'cstype'=>input('cstype')]);
    }
    /**
     * 课程删除资料，只是删除关联关系，并未真实删除
     */
    public function videoMaterialDel()
    {
        if ($this->request->isPost()){
            $model=model('videoCourse');
            $courseInfo=$model->where(['id'=>input('cid')])->field('material_id')->find();
            $materialIds=json_to_array($courseInfo['material_id']);
            foreach( $materialIds as $k=>$v) {
                if(input('mid') == $v) unset($materialIds[$k]);
            }
            $data['material_id']=json_encode($materialIds);
            if($model->allowField(true)->save($data, ['id'=>input('cid')])){
                insert_admin_log('向点播课程中添加了资料');
                $this->success('删除成功');
            }else {
                $this->error($this->errorMsg);
            }
        }
    }
    /**
     * 向点播课程中添加资料
     */
    public function MaterialInsert(){
        if ($this->request->isPost()) {
            if(input('cstype')==1){
                $model= model('videoCourse');
            }
            if(input('cstype')==2){
                $model= model('liveCourse');
            }
            $courseInfo=$model->where(['id'=>input('cid')])->field('material_id')->find();
            $materialIds=json_to_array($courseInfo['material_id']);
            if(empty($materialIds)){
                $materialIdsArr[]=input('id');
                $data['material_id']=json_encode($materialIdsArr);
            }else{
                if(in_array(input('id'),$materialIds)){
                    $this->error("课程中已存在，不要重复添加");
                }else{
                    array_push($materialIds,input('id'));
                    $data['material_id']=json_encode($materialIds);
                }
            }
            if($model->allowField(true)->save($data, ['id'=>input('cid')])){
                insert_admin_log('向点播课程中添加了资料');
                $this->success('添加成功');
            }else {
                $this->error($this->errorMsg);
            }
        }
    }
    /**
     * 直播课程
     */
    public function liveIndex(){
        $param = $this->request->param();
        $where = [];
        if (isset($param['title'])) {
            $where['title'] = ['like', "%" . $param['title'] . "%"];
        }
        if (isset($param['cid'])) {
            $where['cid'] = $param['cid'];
        }
        if (isset($param['is_top'])) {
            $where['is_top'] = $param['is_top'];
        }
        if (isset($param['is_hot'])) {
            $where['is_hot'] = $param['is_hot'];
        }
        if (isset($param['status'])) {
            $where['status'] = $param['status'];
        }
        if(getAdminAuthId(is_admin_login())!=1){
            $map['teacher_id'] =getTeacherIdByUid(is_user_login());
        }
        $list = model('liveCourse')->with('courseCategory')->order('sort_order asc')->where($where)->where($map)
            ->paginate(config('page_number'), false, ['query' => $param]);
        return $this->fetch('liveindex', ['list' => $list]);
    }
    /**
     * 课程直播课程
     */
    public function liveAdd(){
        if ($this->request->isPost()) {
            $param=$this->request->param();
            $param['addtime']=date('Y-m-d h:i:s', time());
            $param['teacher_id']=getTeacherIdByAdminId(is_admin_login());
            if ($this->insert('liveCourse',$param) === true) {
                clear_cache();
                insert_admin_log('添加了点播课程');
                $this->success('添加成功', url('admin/course/liveIndex'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        return $this->fetch('livesave');
    }
    /**
     * 编辑直播课程
     */
    public function liveEdit()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            if (is_array($param['id'])) {
                $data = [];
                foreach ($param['id'] as $v) {
                    $data[] = ['id' => $v, $param['name'] => $param['value']];
                }
                $result = $this->saveAll('liveCourse', $data, input('_verify', true));
            } else {
                $result = $this->update('liveCourse', $param, input('_verify', true));
            }
            if ($result === true) {
                insert_admin_log('修改了点播课程');
                clear_cache();
                $this->success('修改成功', url('admin/course/liveIndex'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        return $this->fetch('livesave', ['data' => model('liveCourse')->get(input('id'))]);
    }
    /**
     * 删除直播课程
     */
    public function liveDel()
    {
        if ($this->request->isPost()) {
            if ($this->delete('liveCourse', $this->request->param()) === true) {
                insert_admin_log('删除了点播课程');
                clear_cache();
                $this->success('删除成功');
            } else {
                $this->error($this->errorMsg);
            }
        }
    }
    /**
     * 直播课程管理
     */
    public function liveAdmin(){
        $data=model('liveCourse')->where('id', input('id'))->find();
        $sectionlist=model('liveSection')->order('sort_order asc')->where(['csid'=>input('id'),'ischapter'=>1])->select();
        if(!empty($sectionlist)){
            foreach ($sectionlist as $key => $value) {
                $sectionlist[$key]['seclist']=model('liveSection')->order('sort_order asc')->where(['chapterid'=>$sectionlist[$key]['id']])->select();
            }
        }else{
            $sectionlist=model('liveSection')->order('sort_order asc')->where(['csid'=>input('id')])->select();
        }
        return $this->fetch('liveadmin',['data' =>$data,'sectionlist'=>$sectionlist]);
    }
    /**
     * 直播课程添加章
     */
    public function liveAddZhang(){
        if ($this->request->isPost()) {
            if ($this->insert('liveSection', $this->request->param()) === true) {
                insert_admin_log('添加了点播课程章节');
                $this->success('添加成功', url('admin/course/liveadmin',['id'=>input('cid')]));
            } else {
                $this->error($this->errorMsg);
            }
        }
        return $this->fetch('liveAddZhang',['cid'=>input('cid')]);
    }
    /**
     * 直播课程编辑章
     */
    public function liveEditZhang()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            $result = $this->update('liveSection', $param, input('_verify', true));
            if ($result === true) {
                insert_admin_log('修改了点播课程章节');
                $this->success('修改成功', url('admin/course/liveadmin'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        $data=model('liveSection')->get(input('id'));
        return $this->fetch('liveAddZhang', ['cid'=>$data['csid'],'data' =>$data]);
    }
    /**
     * 直播课程添加课时创建直播间
     */
    public function liveAddSection(){
        if ($this->request->isPost()) {
            $param=$this->request->param();
            $info=$this->get_site_info();
            $postdata=$info;
            $postdata['title'] = $param['title'];
            $postdata['live_starttime'] = $param['starttime'];
            $postdata['duration'] =$param['duration'];
            $postdata['live_type'] = $param['meetingtype'];
            $postdata['max_users'] = 0;
            $url=$info['server']."/educloud/educloud/createlive";
            $res = json_decode($res = post_curl($url, $postdata), true);
            if(empty($info['authorcode']) || empty($info['partner_id']) ){
                $this->error("请先配置直播云参数");exit();
            }
            if($res['code']==0){
                $roominfo=$res['data'];
                $param['room_id']=$roominfo['room_id'];
                $param['admin_code']=$roominfo['admin_code'];
                $param['teacher_code']=$roominfo['teacher_code'];
                $param['student_code']=$roominfo['student_code'];
                if ($this->insert('liveSection',$param) === true) {
                    insert_admin_log('添加了直播课程章节');
                    $this->success('添加成功', url('admin/course/liveadmin',['id'=>input('cid')]));
                } else {
                    $this->error($this->errorMsg);
                }
            }else{
                $this->error($res['msg']);
            }
        }
        $zhang=model('liveSection')->order('sort_order asc')->where(['csid'=>input('cid'),'ischapter'=>1])->select();
        return $this->fetch('liveAddSection',['cid'=>input('cid'),'zhang'=>$zhang]);
    }
    /**
     * 编辑直播间信息
     */
    public function liveEditSection()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            $result = $this->update('liveSection', $param, input('_verify', true));
            if ($result === true) {
                insert_admin_log('修改了点播课程章节');
                $this->success('修改成功', url('admin/course/liveadmin'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        $data=model('liveSection')->get(input('id'));
        $zhang=model('liveSection')->order('sort_order asc')->where(['csid'=>$data['csid'],'ischapter'=>1])->select();
        return $this->fetch('liveAddSection', ['cid'=>$data['csid'],'data' =>$data,'zhang'=>$zhang]);
    }
    /**
     * 删除直播课时
     */
    public function liveDelSection(){
        {
            if ($this->request->isPost()) {
                if( model('liveSection')->where('chapterid', input('id'))->find()){
                    $this->error('请先删除此章下的节');
                }else{
                    if ($this->delete('liveSection', $this->request->param()) === true) {
                        insert_admin_log('删除了点播课程章节');
                        $this->success('删除成功');
                    } else {
                        $this->error($this->errorMsg);
                    }
                }
            }
        }
    }
    /**
     * 直播课程添加文本课时
     */
    public function liveAddDoc(){
        if ($this->request->isPost()) {
            if ($this->insert('liveSection', $this->request->param()) === true) {
                insert_admin_log('添加了点播课程章节');
                $this->success('添加成功', url('admin/course/liveadmin',['id'=>input('cid')]));
            } else {
                $this->error($this->errorMsg);
            }
        }
        $zhang=model('liveSection')->order('sort_order asc')->where(['csid'=>input('cid'),'ischapter'=>1])->select();
        return $this->fetch('liveAddDoc',['cid'=>input('cid'),'zhang'=>$zhang]);
    }
    /**
     * 直播课程编辑文本课时
     */
    public function liveEditDoc()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            $result = $this->update('liveSection', $param, input('_verify', true));
            if ($result === true) {
                insert_admin_log('修改了点播课程章节');
                $this->success('修改成功', url('admin/course/liveadmin'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        $data=model('liveSection')->get(input('id'));
        $zhang=model('liveSection')->order('sort_order asc')->where(['csid'=>$data['csid'],'ischapter'=>1])->select();
        return $this->fetch('liveAddDoc', ['cid'=>$data['csid'],'data' =>$data,'zhang'=>$zhang]);
    }
    /**
     * 直播课程添加考试课程
     */
    public function liveaddExam(){
        if ($this->request->isPost()) {
            $param=$this->request->param();
            $param['addtime']=date('Y-m-d h:i:s',time());
            $param['ischapter']=0;
            if ($this->insert('liveSection',$param) === true) {
                insert_admin_log('添加了直播课程考试章节');
                $this->success('添加成功', url('admin/course/liveadmin',['id'=>input('csid')]));
            } else {
                $this->error($this->errorMsg);
            }
        }
        $zhang=model('liveSection')->order('sort_order asc')->where(['csid'=>input('cid'),'ischapter'=>1])->select();
        return $this->fetch('liveaddExam',['cid'=>input('cid'),'zhang' =>$zhang]);
    }
    /**
     * 直播课程添加考试课程
     */
    public function liveEditExam(){
        if ($this->request->isPost()) {
            $param=$this->request->param();
            $param['addtime']=date('Y-m-d h:i:s',time());
            $param['ischapter']=0;
            $result = $this->update('liveSection', $param, input('_verify', true));
            if ($result === true) {
                insert_admin_log('修改了点播课程考试章节');
                $this->success('修改成功', url('admin/course/liveadmin'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        $data=model('liveSection')->get(input('id'));
        $zhang=model('liveSection')->order('sort_order asc')->where(['csid'=>input('cid'),'ischapter'=>1])->select();
        return $this->fetch('liveaddExam', ['cid'=>$data['csid'],'data' =>$data,'zhang'=>$zhang]);
    }
    /**
     * 课程分类
     */
    public function courseCategory(){
        $list=model('courseCategory')->order('sort_order asc')->select();
        foreach ($list as $key => $value) {
            $list[$key]['knowledgePoints']=count(model('knowledge')->where(['sectionid'=>$list[$key]['id']])->select());
        }
        $cat = new \org\Category(array('id', 'pid', 'category_name','cname'));
        $data = $cat->getTree($list, intval($id=0));
        return $this->fetch('courseCategory', ['list' => $data]);
    }
    /**
     * 添加课程分类
     */
    public function categoryAdd()
    {
        if ($this->request->isPost()) {
            if ($this->insert('courseCategory', $this->request->param()) === true) {
                insert_admin_log('添加了课程分类');
                $this->success('添加成功', url('admin/course/courseCategory'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        $list=model('courseCategory')->order('sort_order asc')->select();
        $cat = new \org\Category(array('id', 'pid', 'category_name','cname'));
        $data = $cat->getTree($list, intval($id=0));
        return $this->fetch('categorySave', ['category' => $data]);
    }
    /**
     * 编辑课程分类
     */
    public function categoryEdit()
    {
        if ($this->request->isPost()) {
            if ($this->update('courseCategory', $this->request->param(), input('_verify', true)) === true) {
                insert_admin_log('修改了课程分类');
                $this->success('修改成功', url('admin/course/coursecategory'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        $list=model('courseCategory')->order('sort_order asc')->select();
        $cat = new \org\Category(array('id', 'pid', 'category_name','cname'));
        $data = $cat->getTree($list, intval($id=0));
        return $this->fetch('categorySave', [
            'data'     => model('courseCategory')->where('id', input('id'))->find(),
            'category' => $data,
        ]);
    }
    /**
     * 删除课程分类
     */
    public function categoryDel()
    {
        if ($this->request->isPost()) {
            if( model('courseCategory')->where('pid', input('id'))->find()){
                $this->error('请先删除子分类');
            }else{
                if ($this->delete('courseCategory', $this->request->param()) === true) {
                    insert_admin_log('删除了课程分类');
                    $this->success('删除成功');
                } else {
                    $this->error($this->errorMsg);
                }
            }
        }
    }
    /**
     * 分类知识点列表
     */
    public function knowledgeList()
    {
        $list=model('knowledge')->where('sectionid', input('pid'))->order('sort_order asc')->select();
        return $this->fetch('knowledgeList', ['list' => $list]);
    }
    /**
     * 给分类添加知识点
     */
    public function knowledgeAdd(){
        if ($this->request->isPost()) {
            $this->isAdd(input('sectionid'));
            if ($this->insert('knowledge', $this->request->param()) === true) {
                insert_admin_log('添加了知识点');
                $this->success('添加成功', url('admin/course/courseCategory'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        return $this->fetch('knowledgeSave',['pid'=>input('pid')]);
    }
    /**
     * 删除知识点
     */
    public function knowledgeDel(){
        if ($this->request->isPost()) {
            if ($this->delete('knowledge', $this->request->param()) === true) {
                insert_admin_log('删除了知识点');
                $this->success('删除成功');
            } else {
                $this->error($this->errorMsg);
            }
        }
    }
    /**
     * 获取知识点
     */
    public function ajaxGetKnowledge(){
        $list=model('knowledge')->where('sectionid', input('id'))->order('sort_order asc')->select();
        echo json_encode($list);
    }
    /**
     * 判断是否可以添加知识点
     */
    public function isAdd($pid){
        if(model('courseCategory')->where('pid',$pid)->select()){
            $this->error('此处不能添加知识点!',url('admin/course/courseCategory'));
        }
    }
    /**
     * 课程订单
     */
    public function courseOrder(){
        $param = $this->request->param();
        $where = [];
        if (isset($param['orderid'])) {
            $where['orderid'] = ['like', "%" . $param['orderid'] . "%"];
        }
        if (isset($param['state'])) {
            $where['state'] = $param['state'];
        }
        if(getTeacherIdByUid(is_user_login())>0){
            $where['tid'] = getTeacherIdByUid(is_user_login());
        }
        $list=model('order')->where($where)->order('id desc')->paginate(config('page_number'), false, ['query' => $param]);
        return $this->fetch('courseOrder',['list'=>$list]);
    }
    /**
     * 删除课程订单
     */
    public function delCourseOrder(){
        if ($this->request->isPost()) {
            if ($this->delete('order', $this->request->param()) === true) {
                $this->success('删除成功');
            } else {
                $this->error($this->errorMsg);
            }
        }
    }
}