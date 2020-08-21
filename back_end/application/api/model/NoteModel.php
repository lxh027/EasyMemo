<?php

namespace app\api\model;

use think\Exception;
use think\Model;
use think\exception\DbException;

class NoteModel extends  Model
{
    protected $table = 'note';

    public function addText($data)
    {
        try {
            $info = $this->insertGetId($data);
            return ['code' => CODE_SUCCESS, 'msg' => '添加成功', 'data' => ['note_id' => $info]];
        } catch (DbException $e) {
            return ['code' => CODE_ERROR, 'msg' => '数据库异常', 'data' => $e->getMessage()];
        }
    }

    public function deleteText($id)
    {
        try {
            $where = ['id' => $id];
            $info = $this->where($where)->find();
            if ($info) {
                $res = $this->where($where)->delete();
                if ($res) {
                    return ['code' => CODE_SUCCESS, 'msg' => '删除成功', 'data' => []];
                } else {
                    return ['code' => CODE_ERROR, 'msg' => '删除失败', 'data' => []];
                }
            } else {
                return ['code' => CODE_ERROR, 'msg' => 'id不存在', 'data' => []];
            }
        } catch (DbException $e) {
            return ['code' => CODE_ERROR, 'msg' => '数据库异常', 'data' => $e->getMessage()];
        } catch (Exception $e) {
            return ['code' => CODE_ERROR, 'msg' => '数据库异常', 'data' => $e->getMessage()];
        }
    }

    public function edit($id, $data)
    {
        try {
            $where = ['id' => $id];
            $info = $this->where($where)->find();
            if ($info) {
                $res = $this->where($where)->update($data);
                if ($res) {
                    return ['code' => CODE_SUCCESS, 'msg' => '更新成功', 'data' => $res];
                } else {
                    return ['code' => CODE_ERROR, 'msg' => '未更新', 'data' => $res];
                }
            } else {
                return ['code' => CODE_ERROR, 'msg' => 'id不存在', 'data' => []];
            }
        } catch (DbException $e) {
            return ['code' => CODE_ERROR, 'msg' => '数据库异常', 'data' => $e->getMessage()];
        } catch (Exception $e) {
            return ['code' => CODE_ERROR, 'msg' => '数据库异常', 'data' => $e->getMessage()];
        }
    }

    public function getNoteByUser($user_id)
    {
        try {
            $where = ['user_id' => $user_id];
            $info = $this->where($where)->field(['id', 'create_time', 'update_time', 'group'])->select();
            $data = array();
            foreach ($info as $note) {
                if (!isset($data[$note['group']])) {
                    $data[$note['group']] = array();
                }
                $note_val = [
                    'id'    => $note['id'],
                    'create_time'   => $note['create_time'],
                    'update_time'   => $note['update_time']
                ];
                array_push($data[$note['group']], $note_val);
            }
            return ['code' => CODE_SUCCESS, 'msg' => '查询成功', 'data' => $data];
        } catch (DbException $e) {
            return ['code' => CODE_ERROR, 'msg' => '数据库异常', 'data' => $e->getMessage()];
        }
    }

    public function getNote($id)
    {
        try {
            $where = ['id' => $id];
            $info = $this->where($where)->find();
            if ($info) {
                return ['code' => CODE_SUCCESS, 'msg' => '查找成功', 'data' => $info];
            } else {
                return ['code' => CODE_SUCCESS, 'msg' => '查找失败', 'data' => []];
            }
        } catch (DbException $e) {
            return ['code' => CODE_ERROR, 'msg' => '数据库异常', 'data' => $e->getMessage()];
        }
    }

    public function getGroups($user_id)
    {
        try {
            $where = ['user_id' => $user_id];
            $info = $this->where($where)->field(['group'])->select();
            $data = array();
            foreach ($info as $note) {
                array_push($data, $note['group']);
            }
            $data = array_unique($data);
            return ['code' => CODE_SUCCESS, 'msg' => '查询成功', 'data' => $data];
        } catch (DbException $e) {
            return ['code' => CODE_ERROR, 'msg' => '数据库异常', 'data' => $e->getMessage()];
        }
    }
}