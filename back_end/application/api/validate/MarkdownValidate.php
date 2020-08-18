<?php

namespace app\api\validate;

use think\Validate;

class MarkdownValidate extends Validate
{
    protected $rule = [
        'text'  =>  'require',
    ];

    protected $message = [
        'text.require' =>  '未输入markdown原文'
    ];

    protected $scene = [
        'convert'   =>  ['text']
    ];
}