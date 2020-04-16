<?php

namespace app\admin\validate;

use think\Validate;

class CourseCategory extends Validate
{
    protected $rule = [
        'category_name' => 'require',
    ];

    protected $message = [
        'category_name.require' => '分类名称不能为空',
    ];
}
