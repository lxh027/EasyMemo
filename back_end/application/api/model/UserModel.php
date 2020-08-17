<?php

namespace app\api\model;

use think\Exception;
use think\exception\DbException;
use think\Model;

class UserModel extends Model
{
    protected $table = 'user';

    public function addUser($data)
    {
        try {
            $info =$this->where(['username' => $data['username']])->find();
            if ($info) {
                return ['code' => CODE_ERROR, 'msg' => '用户名已存在', 'data' => []];
            } else {
                $res = $this->insert($data);
                if ($res) {
                    return ['code' => CODE_SUCCESS, 'msg' => '添加成功', 'data' => $res];
                } else {
                    return ['code' => CODE_ERROR, 'msg' => '添加失败', 'data' => []];
                }
            }
        } catch (DbException $e) {
            return ['code' => CODE_ERROR, 'msg' => '数据库异常', 'data' => $e->getMessage()];
        }
    }

    public function checkLogin($username, $password)
    {
        try {
            $where = ['username' => $username, 'password' => $password];
            $res = $this->where($where)->find();
            if ($res) {
                return ['code' => CODE_SUCCESS, 'msg' => '登录验证成功', 'data' => $res];
            } else {
                return ['code' => CODE_ERROR, 'msg' => '用户名或密码错误', 'data' => []];
            }
        } catch (DbException $e) {
            return ['code' => CODE_ERROR, 'msg' => '数据库异常', 'data' => $e->getMessage()];
        }
    }

}