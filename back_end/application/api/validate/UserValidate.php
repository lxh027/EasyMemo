<?php

namespace app\api\validate;

use think\Validate;

class UserValidate extends Validate
{
    protected $rule = [
        'username'  => 'require|max:20',
        'nick'      => 'require|max:25',
        'password'  => 'require|length:6,16',
        'old_password' => 'require|length:6,16',
        'password_check' => 'require|length:6,16',
        'email'     => 'require|email'
    ];

    protected $message = [
        'username.require'  => '缺少用户名',
        'username.max'      => '用户名长度超过25',
        'nick.require'      => '缺少用户昵称',
        'nick.max'          => '昵称长度超过25',
        'password.require'  => '缺少密码',
        'password.length'   => '密码长度不正确',
        'old_password.require'  => '缺少旧密码',
        'old_password.length'   => '旧密码长度不正确',
        'password_check.require'  => '缺少确认密码',
        'password_check.length'   => '密码长度不正确',
        'email.require'     =>  '缺少邮箱',
        'email.email'       =>  '邮箱格式不正确'
    ];

    protected $scene = [
        'register'      =>  ['username', 'nick', 'password', 'password_check', 'email'],
        'login'         =>  ['username', 'password'],
    ];
}
