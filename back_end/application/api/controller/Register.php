<?php

namespace app\api\controller;

use think\Controller;
use app\api\validate\UserValidate;
use app\api\model\UserModel;

class Register extends Controller
{
    public function register() {
        $userValidate = new UserValidate();
        $userModel = new UserModel();

        $req = input('post.');
        $res = $userValidate->scene('register')->check($req);
        if ($res != VALIDATE_PASS) {
            return apiReturn(CODE_ERROR, $userValidate->getError(), '');
        }
        if ($req['password'] !== $req['password_check']) {
            return apiReturn(CODE_ERROR, '两次输入密码不一致', '');
        }

        $resp = $userModel->addUser([
            'username'  => $req['username'],
            'password'  => md5(base64_encode($req['password'])),
            'nick'      => $req['nick'],
            'email'     => $req['email'],
            'contact'   => isset($req['contact'])?$req['contact']:'',
        ]);

        return apiReturn($resp['code'], $resp['msg'], $resp['data']);
    }
}
