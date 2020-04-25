<?php

namespace app\admin\controller;

use app\common\controller\AdminBase;

class Classroom extends AdminBase
{
    protected function _initialize()
    {
        parent::_initialize();
    }

    /**
     * 班级首页
     */
    function index()
    {
        $param = $this->request->param();
        $where = [];
        if (isset($param['title'])) {
            $where['title'] = ['like', "%" . $param['title'] . "%"];
        }
        if (isset($param['is_top'])) {
            $where['is_top'] = $param['is_top'];
        }
        if (isset($param['status'])) {
            $where['status'] = $param['status'];
        }
        if (getAdminAuthId(is_admin_login()) != 1) {
            $map['headteacher'] = getTeacherIdByUid(is_user_login());
        }
        $list = model('classroom')->where($where)->where($map)->order('sort_order asc,id desc')->paginate(config('page_number'), false, ['query' => $param]);
        $teacher=model('user')->where(['id'=>input('headteacher')])->field('headteacher')->find();
        return $this->fetch('index', ['list' => $list,'teacher' => $teacher]);
    }

    /**
     * 添加班级
     */
    public function add()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            $param['addtime']=date('Y-m-d h:i:s', time());
//            $param['headteacher'] = getTeacherIdByAdminId(is_admin_login());
            $param['status'] = 1;
            $param['is_top'] = 0;
            $param['views'] = 0;
            $param['price'] = 0;
            $param['youxiaoqi'] = 99999;
            if ($this->insert('classroom', $param) === true) {
                insert_admin_log('添加了班级');
                $this->success('添加成功', url('admin/classroom/index'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        $zhang = model('user')->order('id asc')->where(['is_teacher'=>1])->select();
        return $this->fetch('save',['zhang' =>$zhang]);
    }

    /**
     * 编辑班级
     */
    public function edit()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            $param['price'] = 0;
            if (is_array($param['id'])) {
                $data = [];
                foreach ($param['id'] as $v) {
                    $data[] = ['id' => $v, $param['name'] => $param['value']];
                }
                $result = $this->saveAll('classroom', $data, input('_verify', true));
            } else {
                $result = $this->update('classroom', $param, input('_verify', true));
            }
            if ($result === true) {
                insert_admin_log('修改了班级信息');
                $this->success('修改成功', url('admin/classroom/index'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        $zhang=model('user')->order('id asc')->where(['is_teacher'=>1])->select();
        return $this->fetch('save', ['zhang' =>$zhang,'data' => model('classroom')->get(input('id'))]);
    }

    /**
     * 删除班级
     */
    public function del()
    {
        if ($this->request->isPost()) {
            if ($this->delete('classroom', $this->request->param()) === true) {
                insert_admin_log('删除了班级');
                $this->success('删除成功');
            } else {
                $this->error($this->errorMsg);
            }
        }
    }

    /**
     * 获取班级课程
     */
    function courseList()
    {
        $data = model('classroom')->get(input('id'));
        $allCourse = controller('admin/flashsale')->getCourse(1);
        return $this->fetch('courseList', ['data' => $data, 'selectCourse' => $data['cids'], 'course' => json_encode($allCourse)]);
    }

    public function editPost()
    {
        $param = $this->request->param();
        foreach ($param['course'] as $key => $value) {
            $cids[] = $param['course'][$key]['value'];
        }
        $data['cids'] = json_encode($cids);
        $data['id'] = $param['id'];
        if ($this->update('classroom', $data, input('_verify', false)) === true) {
            $res = ['code' => 0, 'msg' => '编辑成功'];
        } else {
            $res = ['code' => 1, 'msg' => $this->errorMsg];
        }
        echo json_encode($res);
    }

    /**
     * 获取班级学员列表
     */
    function yuanList()
    {
        $param = $this->request->param();
        $list = model('userCourse')->where(['cid' => $param['cid'], 'type' => $param['type']])->select();
        foreach ($list as $key => $value) {
            $data[$key]['uid'] = $list[$key]['uid'];
            $data[$key]['progress'] = getAllProgress($param['cid'], $list[$key]['uid']);
        }
        return $this->fetch('xueyuanList', ['list' => $data, 'cid' => $param['cid']]);
    }
    /**
     * 批量导出班级学员
     */
    function export()
    {
        $param = $this->request->param();
        $list = model('userCourse')->where(['cid' => $param['cid'], 'type' => 3])->select();
        foreach ($list as $key => $value) {
            $data[] = $list[$key]['uid'];
        }
        $data = collection(model('user')->field('id,username,mobile')->whereIn('id', $data)->select())->toArray();
        array_unshift($data, ['ID', '用户名', '手机号']);
        export_excel($data, date('YmdHis'));
    }

    /**
     * 批量向班级中导入学员
     */
    function import()
    {
        return $this->fetch('import', ['classroomId' => input('cid')]);
    }
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
                        $userIds[] = model('user')->insertGetId($data);
                    } else {
                        $userIds[] = $user['id'];
                    }
                }
                $getIds = controller('index/course')->getClassroomCourseIds($classRoomId);
                $videoIds = $getIds['videoIds'];
                $liveIds = $getIds['liveIds'];
                foreach ($userIds as $key => $value) {
                    $res[]= controller('index/course')->batchAddCourse($userIds[$key], $videoIds, $liveIds,$classRoomId);
                    if (!$data = model('user_course')->where(['uid' => $userIds[$key], 'cid' => $classRoomId, 'type' => 3])->find()){
                        model('user_course')->insertGetId(['cid' => $classRoomId, 'uid' => $userIds[$key], 'type' => 3, 'addtime' => date('Y-m-d h:i:s', time()), 'state' => 1]);
                    } else {
                        model('user_course')->where('id',$data['id'])->setField(['addtime'=>date('Y-m-d h:i:s', time())]);
                    }
                }
                return ['code' => 1, 'msg' => '导入成功', 'url' => '/public/upload/file/' . str_replace('\\', '/', $info->getSaveName())];
            } else {
                $excel_path = null;
            }
        } catch (\Exception $e) {
            return ['code' => 0, 'msg' => $e->getMessage()];
        }
    }
    function detach(){
        if ($this->request->isPost()) {
            $param = $this->request->param();
            $result1=model('userCourse')->where(['uid'=>$param['uid'],'cid'=>$param['cid'],'type'=>3])->delete();
            $result2= model('userCourse')->where(['uid'=>$param['uid'],'isclassroom'=>$param['cid']])->delete();
            if ($result1 && $result2) {
                $this->success('删除成功');
            } else {
                $this->error('删除失败');
            }
        }
    }
}