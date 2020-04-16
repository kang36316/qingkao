<?php

namespace app\admin\controller;

use app\common\controller\AdminBase;

class Forum extends AdminBase
{
    /**
     * 论坛板块管理
     */
    public function plate()
    {
        return $this->fetch('plate', ['list' => model('forumPlate')->order('sort_order asc')->select()]);
    }

    /**
     * 论坛主题管理
     */
    public function topic()
    {

        return $this->fetch('topic');
    }

    /**
     * 添加论坛板块
     */
    public function addplate()
    {
        if ($this->request->isPost()) {
            if ($this->insert('forumPlate', $this->request->param()) === true) {
                insert_admin_log('添加了分类');
                $this->success('添加成功', url('admin/forum/plate'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        return $this->fetch('addplate');
    }

    /**
     * 编辑论坛板块
     */
    public function editplate()
    {
        if ($this->request->isPost()) {
            if ($this->update('forumPlate', $this->request->param(), input('_verify', true)) === true) {
                insert_admin_log('修改了论坛板块');
                $this->success('修改成功', url('admin/forum/plate'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        return $this->fetch('addplate', ['data'=> model('forumPlate')->where('id', input('id'))->find()]);
    }

    /**
     * 删除论坛板块
     */
    public function delplate()
    {
        if ($this->request->isPost()) {
            if ($this->delete('forumPlate', $this->request->param()) === true) {
                insert_admin_log('删除了论坛板块');
                $this->success('删除成功');
            } else {
                $this->error($this->errorMsg);
            }
        }
    }
}