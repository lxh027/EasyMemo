<?php

namespace app\api\validate;

use think\Validate;

class NoteValidate extends Validate
{
    protected $rule = [
        'text'  => 'require',
        'group'      => 'require|max:40',
        'user_id'   => 'require',
        'id'    => 'require'
    ];

    protected $message = [
        'text.require'  => '缺少文本',
        'group.max'      => '分组名超过40',
    ];

    protected $scene = [
        'add'      =>  ['text', 'group'],
        'editText'         =>  ['id', 'text'],
        'editGroup'   =>  ['id', 'group'],
        'getUserText'        =>  ['user_id'],
        'delete'        => ['id'],
        'get'       => ['id'],
        'group'     => ['user_id']
    ];
}