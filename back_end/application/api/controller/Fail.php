<?php

namespace app\api\controller;

use think\Controller;

class Fail extends Controller
{
    public function un_logged_in() {
        return apiReturn(CODE_ERROR, '账号未登录', []);
    }
}