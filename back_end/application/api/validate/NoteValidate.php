<?php

namespace app\api\validate;

use think\Validate;

class NoteValidate extends Validate
{
    protected $rule = [
        'text'  => 'require',
        'group'      => 'require|max:40',
        'user_id'   => 'require',
        'id'    => 'require',
        'title' => 'require|max:25'
    ];

    protected $message = [
        'text.require'      => '缺少文本',
        'group.max'         => '分组名超过40',
        'user_id.require'   => '缺少用户id',
        'id.require'        => '缺少笔记id',
        'title.require'     => '缺少笔记标题',
        'title.max'         => '笔记标题长度超过25'
    ];

    protected $scene = [
        'add'      =>  ['title', 'text', 'group'],
        'editText'         =>  ['id', 'text', 'title'],
        'editGroup'   =>  ['id', 'group'],
        'getUserText'        =>  ['user_id'],
        'delete'        => ['id'],
        'get'       => ['id'],
        'group'     => ['user_id']
    ];
}