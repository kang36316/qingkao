<?php

namespace app\index\validate;

use think\Validate;

class ForumTopic extends Validate
{
    protected $rule = [
        'name'=>'token',
    ];
}