<?php

namespace app\admin\controller;

use app\common\controller\AdminBase;

class User extends AdminBase
{
    protected function _initialize()
    {
        parent::_initialize();
    }
    /**
     * 学员列表
     */
    public function index()
    {
        return $this->fetch('index', ['list' => model('user')->where(['is_teacher'=> 0])->order('id desc')->paginate(config('page_number'))]);
    }
    /**
     * 添加学员
     */
    public function add()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            empty($param['password']) && $this->error('密码不能为空');
            if ($this->insert('user', $param) === true) {
                insert_admin_log('添加了用户');
                $this->success('添加成功', url('admin/user/index'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        return $this->fetch('save');
    }
    /**
     * 编辑学员
     */
    public function edit()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            if (empty($param['password'])) {
                unset($param['password']);
            }
            if ($this->update('user', $param, input('_verify', true)) === true) {
                insert_admin_log('修改了用户');
                $this->success('修改成功', url('admin/user/index'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        return $this->fetch('save', ['data' => model('user')->where('id', input('id'))->find()]);
    }
    /**
     * 编辑老师
     */
    public function editteacher()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            if (empty($param['password'])) {
                unset($param['password']);
            }
            if ($this->update('user', $param, input('_verify', true)) === true) {
                model('admin')->where(['id'=>is_admin_login()])->update(['username' => $param['username'], 'password' => $param['password'],'mobile' => $param['mobile']]);
                insert_admin_log('修改了教师');
                $this->success('修改成功', url('admin/user/teacherList'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        return $this->fetch('saveteacher', ['data' => model('user')->where('id', input('id'))->find()]);
    }
    /**
     * 删除学员
     */
    public function del()
    {
        if ($this->request->isPost()) {
            if ($this->delete('user', $this->request->param()) === true) {
                insert_admin_log('删除了用户');
                $this->success('删除成功');
            } else {
                $this->error($this->errorMsg);
            }
        }
    }
    /**
     * 删除教师
     */
    public function delteacher()
    {
        if ($this->request->isPost()) {
            if ($this->delete('user', $this->request->param()) === true) {
                model('admin')->where('id', input('id'))->delete();
                insert_admin_log('删除了教师');
                $this->success('删除成功');
            } else {
                $this->error($this->errorMsg);
            }
        }
    }
    /**
     * 导出学员
     */
    public function export()
    {
        $data = collection(model('user')->field('id,username,mobile')->order('id desc')->select())->toArray();
        array_unshift($data, ['ID', '用户名', '手机号']);
        insert_admin_log('导出了用户');
        export_excel($data, date('YmdHis'));
    }
    /**
     * 导出学员
     */
    public function exportlaoshi()
    {
        $data = collection(model('user')->field('id,username,mobile')->order('id desc')->select())->toArray();
        array_unshift($data, ['ID', '用户名', '手机号']);
        insert_admin_log('导出了用户');
        export_excel($data, date('YmdHis'));
    }
    /**
     * 导入学员
     */
    function import()
    {
        return $this->fetch('import');
    }
    /**
     * 导入学员到数据库
     */
    public function importExcel()
    {
        $param = $this->request->param();
        $classRoomId = $param['classroomId'];
        try {
            $file = request()->file('file');
            $info = $file->validate(['size' => 3145728, 'ext' => 'xlsx,xls,csv'])->move(ROOT_PATH . 'public' . DS . 'upload' . DS . 'excels');
            if ($info) {
                vendor('PHPExcel.PHPExcel.Reader.Excel5');
                $fileName = $info->getSaveName();
                $filePath = ROOT_PATH . 'public' . DS . 'upload' . DS . 'excels' . DS . str_replace('\\', '/', $fileName);
                $PHPReader = new \PHPExcel_Reader_Excel5();
                $objPHPExcel = $PHPReader->load($filePath);
                $sheet = $objPHPExcel->getSheet(0);
                $allRow = $sheet->getHighestRow();
                for ($j = 2; $j <= $allRow; $j++) {
                    $data['username'] = $objPHPExcel->getActiveSheet()->getCell("A" . $j)->getValue();
                    $data['mobile'] = $objPHPExcel->getActiveSheet()->getCell("B" . $j)->getValue();
                    $data['password'] = md5($objPHPExcel->getActiveSheet()->getCell("C" . $j)->getValue());
                    $data['yue'] = $objPHPExcel->getActiveSheet()->getCell("D" . $j)->getValue();
                    $data['create_time']=time();
                    if (!$user = model('user')->where(['username' => $data['username'], 'mobile' => $data['mobile']])->find()) {
                        model('user')->insertGetId($data);
                    } else {
                        model('user')->where('id',$user['id'])->setField('create_time', time());
                    }
                }
                return ['code' => 1, 'msg' => '导入成功'];
            } else {
                $excel_path = null;
            }
        } catch (\Exception $e) {
            return ['code' => 0, 'msg' => $e->getMessage()];
        }
    }
    /**
     * 学员日志
     */
    public function log()
    {
        return $this->fetch('log', ['list' => model('userLog')->order('create_time desc')->paginate(config('page_number'))]);
    }

    public function truncate()
    {
        if ($this->request->isPost()) {
            db()->query('TRUNCATE ' . config('database.prefix') . 'user_log');
            $this->success('操作成功');
        }
    }
    /**
     * 教师列表
     */
    public function teacherList(){
        return $this->fetch('teacherList', ['list' => model('user')->where(['is_teacher'=> 1])->order('id desc')->paginate(config('page_number'))]);
    }
    /**
     * 添加教师
     */
    public function addteacher()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            $param['is_teacher'] = 1;
            empty($param['password']) && $this->error('密码不能为空');
            if ($this->insert('user', $param) === true) {
                model('admin')->save(['id' => $this->insertId, 'username' => $param['username'], 'password' => $param['password'], 'sex' => $param['sex'], 'mobile' => $param['mobile']]);
                model('auth_group_access')->save(['uid'=>$this->insertId,'group_id'=>2]);
                insert_admin_log('添加了教师');
                $this->success('添加成功', url('admin/user/teacherList'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        return $this->fetch('saveteacher');
    }
    /**
     * 教师申请审核列表
     */
//    public function verifyList(){
//        $list=model('cooperate')->order('addtime desc')->paginate(config('page_number'));
//        return $this->fetch('teacher', ['list' =>$list]);
//    }
    /**
     * 删除教师申请
     */
//    public function delverify(){
//        if ($this->request->isPost()) {
//            if ($this->delete('cooperate', $this->request->param()) === true) {
//                $this->success('删除成功');
//            } else {
//                $this->error($this->errorMsg);
//            }
//        }
//    }
    /**
     * 教师申请资料详情
     */
//    public function details(){
//        $param = $this->request->param();
//        $details=model('cooperate')->where('id',$param['id'])->find();
//        return $this->fetch('details', ['details' =>$details]);
//    }
    /**
     * 教师申请审核
     */
//    public function verify(){
//       if ($this->request->isPost()) {
//            $param = $this->request->param();
//            if(empty(config('KeyID')) or empty(config('KeySecret'))){
//               $this->error('请先配置云点播参数，以便为教师分配上传目录');
//               exit();
//             }
//            if ($this->update('cooperate', $param, input('_verify', true)) === true) {
//                $cooperateInfo=model('cooperate')->where(['id'=>$param['id']])->find();
//                if(!model('admin')->where(['cooperateid'=>$cooperateInfo['id']])->find()){
//                    $ategoryId=$this->addCategory($cooperateInfo['mobile']);
//                    $id=model('admin')->insertGetId(['username'=>$cooperateInfo['username'],'category_id'=>$ategoryId,'status'=>1,'cooperateid'=>$cooperateInfo['id'],'uid'=>$cooperateInfo['uid']]);
//                    $this->update('user', ['id'=>$cooperateInfo['uid'],'admin_id'=>$id,'is_teacher'=>$param['status'],'category_id'=>$ategoryId], input('_verify', true));
//                    model('authGroupAccess')->save(['uid' => $id, 'group_id' => 2]);
//                    insert_admin_log('教师审核通过');
//                    $this->success('教师审核通过', url('admin/user/teacher'));
//                }else{
//                    $this->update('user', ['id'=>$cooperateInfo['uid'],'is_teacher'=>$param['status']], input('_verify', true));
//                    insert_admin_log('教师审核操作');
//                    $this->success('操纵成功！', url('admin/user/teacher'));
//                }
//            } else {
//                $this->error($this->errorMsg);
//            }
//        }
//    }
    
    /**
     * 增加阿里云点播视频上传目录
     */
    function addCategory($name){
        $url = config('author_web') . "/educloud/alivideo/AddCategory";
        $postdata = ['KeyID' => config('KeyID'), 'keySecret' => config('KeySecret'),'CateName'=>$name];
        $restemp = json_to_array(post_curl($url, $postdata));
        return $restemp['Category']['CateId'];
    }
    /**
     * 教师申请条例
     */
//    function ordinance(){
//        if ($this->request->isPost()) {
//            $param = $this->request->param();
//            if ($this->update('other', $param) === true) {
//                $this->success('编辑成功', url('admin/user/ordinance'));
//            }
//        }
//        $ordinance=model('other')->where(['type'=>'ordinance'])->find();
//        return $this->fetch('ordinance', ['ordinance' =>$ordinance]);
//    }

    /**
     * 教师提现申请
     */
//    function tixian(){
//        if ($this->request->isPost()) {
//            $param = $this->request->param();
//            $param['tid']=getTeacherIdByUid(is_user_login());
//            if($param['money']<100){
//                $this->error('最低提现金额为100元');
//                exit();
//            }
//            if($param['money']>db('profit')->where('tid', getTeacherIdByUid(is_user_login()))->value('profit')){
//                $this->error('可提现金额不足');
//                exit();
//            }
//            if ($this->insert('tixian', $param) === true) {
//                if(db('profit')->where('tid', getTeacherIdByUid(is_user_login()))->setDec('profit',$param['money'])){
//                    $this->success('提交成功', url('admin/index/index'));
//                }else {
//                    $this->error($this->errorMsg);
//                }
//            }else {
//                $this->error($this->errorMsg);
//            }
//        }
//        return $this->fetch('tixian');
//    }
    /**
     * 后台教师提现管理
     */
//    function tixianAdmin(){
//        return $this->fetch('tixianadmin', ['list' => model('tixian')->order('id desc')->paginate(config('page_number'))]);
//    }
//
//    function tianxianPost(){
//        if ($this->request->isPost()) {
//            $param = $this->request->param();
//            if ($this->update('tixian', $param, input('_verify', true)) === true) {
//                $this->success('修改成功', url('admin/user/tixianAdmin'));
//            } else {
//                $this->error($this->errorMsg);
//            }
//        }
//    }
    /**
     * 导出教师提现数据
     */
//    function exporttixian(){
//        $data = collection(model('tixian')->field('name,type,account,money,addtime')->where(['status'=>0])->order('id desc')->select())->toArray();
//        array_unshift($data, ['用户名', '收款方式', '收款账号','提现金额','申请时间']);
//        export_excel($data, date('YmdHis'));
//    }
    /**
     * 给指定用户增加金钱
     */
//    function addmoney(){
//        $param = $this->request->param();
//        if ($this->request->isPost()) {
//            if ($this->update('user', $param, input('_verify', false)) === true) {
//                insert_admin_log('修改了用户');
//                $this->success('修改成功', url('admin/user/index'));
//            } else {
//                $this->error($this->errorMsg);
//            }
//        }
//        return $this->fetch('addmoney',['data' => model('user')->where('id', input('id'))->find()]);
//    }
}
