<?php

namespace app\api\controller;

use think\Controller;
use think\facade\Session;
use app\api\model\UserModel;
use app\api\validate\UserValidate;

class Login extends Controller
{
    public function login() {
        if (Session::has('user_id')) {
            return apiReturn(CODE_ERROR, '已有账号登录', Session::get('data'));
        }
        $userModel = new UserModel();
        $userValidate = new UserValidate();

        $req = input('post.');
        $res = $userValidate->scene('login')->check($req);
        if ($res != VALIDATE_PASS) {
            return apiReturn(CODE_ERROR, $userValidate->getError(), '');
        }

        $resp = $userModel->checkLogin($req['username'], md5(base64_encode($req['password'])));
        $data = [];
        if ($resp['code'] == CODE_SUCCESS) {
            $data = [
                'user_id' => $resp['data']['id'],
                'username'  => $resp['data']['username'],
                'nick'      => $resp['data']['nick'],
                'contact'   => $resp['data']['contact'],
                'email'     => $resp['data']['email']
            ];
            session('user_id', $data['user_id']);
            session('username', $data['username']);
            session('nick', $data['nick']);
            session('data', $data);
        }
        return apiReturn($resp['code'], $resp['msg'], $data);
    }

    public function logout() {
        session(null);
        return apiReturn(CODE_SUCCESS, '注销成功', '');
    }

    public function checkLogin() {
        $req = input('post.');
        if (Session::has('user_id')) {
            if(isset($req['user_id'])) {
                if($req['user_id']==Session::get('user_id')) {
                    return apiReturn(CODE_SUCCESS, '已经登陆，且账号相符', '');
                }else{
                    return apiReturn(CODE_SUCCESS, '已经登陆，账号不符', Session::get('user_id'));
                }
            }
            return apiReturn(CODE_SUCCESS, '已经登陆', '');
        }
        return apiReturn(CODE_ERROR, '未登陆', '');
    }

    public function resetPassword() {
        $userValidate = new UserValidate();
        $userModel = new UserModel();

        $req = input('post.');
        $res = $userValidate->scene('forget_password')->check($req);
        if ($res != VALIDATE_PASS) {
            return apiReturn(CODE_ERROR, $userValidate->getError(), '');
        }
        if ($req['password'] !== $req['password_check']) {
            return apiReturn(CODE_ERROR, '两次输入密码不一致', '');
        }
        $data = [
            'username'  => $req['username'],
            'email'     => $req['email'],
            'password'  => md5(base64_encode($req['password']))
        ];
        $resp = $userModel->resetPassword($data);
        return apiReturn($resp['code'], $resp['msg'], $resp['data']);
    }
}
