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
                $info =$this->where(['email' => $data['email']])->find();
                if ($info) {
                    return ['code' => CODE_ERROR, 'msg' => '邮箱已存在', 'data' => []];
                } else {
                    $res = $this->insert($data);
                    if ($res) {
                        return ['code' => CODE_SUCCESS, 'msg' => '添加成功', 'data' => $res];
                    } else {
                        return ['code' => CODE_ERROR, 'msg' => '添加失败', 'data' => []];
                    }
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

    public function resetPassword($data)
    {
        try {
            $where = ['username' => $data['username'], 'email' => $data['email']];
            $info = $this->where($where)->find();
            if ($info) {
                $res = $this->where($where)->update($data);
                return ['code' => CODE_SUCCESS, 'msg' => '修改成功', 'data' => []];
            } else {
                return ['code' => CODE_ERROR, 'msg' => '用户名或邮箱不存在', 'data' => []];
            }
        } catch (DbException $e) {
            return ['code' => CODE_ERROR, 'msg' => '数据库异常', 'data' => $e->getMessage()];
        } catch (Exception $e) {
            return ['code' => CODE_ERROR, 'msg' => '数据库异常', 'data' => $e->getMessage()];
        }
    }

    public function getUserInfo($username)
    {
        try {
            $res = $this->where(['username' => $username])->find();
            if ($res) {
                return ['code' => CODE_SUCCESS, 'msg' => '查找成功', 'data' => $res];
            } else {
                return ['code' => CODE_ERROR, 'msg' => '查找失败', 'data' => []];
            }
        } catch (DbException $e) {
            return ['code' => CODE_ERROR, 'msg' => '数据库异常', 'data' => $e->getMessage()];
        }
    }

    public function editUserNick($id, $nick)
    {
        try {
            $res = $this->where(['id' => $id])->update(['nick' => $nick]);
            if ($res) {
                return ['code' => CODE_SUCCESS, 'msg' => '更新成功', 'data' => $res];
            } else {
                return ['code' => CODE_ERROR, 'msg' => '更新失败', 'data' => []];
            }
        } catch (DbException $e) {
            return ['code' => CODE_ERROR, 'msg' => '数据库异常', 'data' => $e->getMessage()];
        } catch (Exception $e) {
            return ['code' => CODE_ERROR, 'msg' => '数据库异常', 'data' => $e->getMessage()];
        }
    }
}