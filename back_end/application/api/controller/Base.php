<?php

namespace app\api\controller;

use think\Controller;
use think\facade\Session;

class Base extends Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!Session::has('user_id')) {
            $this->redirect('api\Fail\un_logged_in');
        }
    }

}
