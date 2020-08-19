<?php

namespace app\api\controller;

use app\api\model\UserModel;
use app\api\validate\UserValidate;
use think\Controller;
use think\facade\Session;

class User extends Base
{
    public function getUserInfo()
    {
        $userValidate = new UserValidate();
        $userModel = new UserModel();

        $req = input('post.');
        $res = $userValidate->scene('search')->check($req);
        if ($res != VALIDATE_PASS) {
            return apiReturn(CODE_ERROR, $userValidate->getError(), '');
        }

        $resp = $userModel->getUserInfo($req['username']);
        return apiReturn($resp['code'], $resp['msg'], $resp['data']);
    }

    public function editUserNick()
    {
        $userValidate = new UserValidate();
        $userModel = new UserModel();

        $req = input('post.');
        $res = $userValidate->scene('nick')->check($req);
        if ($res != VALIDATE_PASS) {
            return apiReturn(CODE_ERROR, $userValidate->getError(), '');
        }

        $resp = $userModel->editUserNick(Session::get('user_id'), $req['nick']);
        return apiReturn($resp['code'], $resp['msg'], $resp['data']);
    }
}