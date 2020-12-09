<?php

namespace app\api\controller;

use app\api\model\NoteModel;
use app\api\validate\NoteValidate;
use think\Controller;
use think\facade\Session;

class Note extends Base
{
    public function createNote()
    {
        $noteValidate = new NoteValidate();
        $noteModel = new NoteModel();

        $req = input('post.');
        if (!isset($req['group'])) {
            $req['group'] = 'default';
        }
        if (!isset($req['text'])) {
            $req['text'] = '# '.$req['title'];
        }
        $res = $noteValidate->scene('add')->check($req);
        if ($res != VALIDATE_PASS) {
            return apiReturn(CODE_ERROR, $noteValidate->getError(), $req);
        }

        $data = [
            'text'      => $req['text'],
            'title'     => $req['title'],
            'group'     => $req['group'],
            'user_id'   => Session::get('user_id'),
            'create_time'   => date('Y-m-d H:i:s'),
            'update_time'   => date('Y-m-d H:i:s')
        ];
        $resp = $noteModel->addText($data);
        return apiReturn($resp['code'], $resp['msg'], $resp['data']);
    }

    public function deleteNote()
    {
        $noteValidate = new NoteValidate();
        $noteModel = new NoteModel();

        $req = input('post.');
        $res = $noteValidate->scene('delete')->check($req);
        if ($res != VALIDATE_PASS) {
            return apiReturn(CODE_ERROR, $noteValidate->getError(), '');
        }

        $resp = $noteModel->deleteText($req['id']);
        return apiReturn($resp['code'], $resp['msg'], $resp['data']);
    }

    public function editText()
    {
        $noteValidate = new NoteValidate();
        $noteModel = new NoteModel();

        $req = input('post.');
        $res = $noteValidate->scene('editText')->check($req);
        if ($res != VALIDATE_PASS) {
            return apiReturn(CODE_ERROR, $noteValidate->getError(), '');
        }

        $data = [
            'text'  => $req['text'],
            'update_time'   => date('Y-m-d H:i:s')
        ];
        $resp = $noteModel->edit($req['id'], $data);
        return apiReturn($resp['code'], $resp['msg'], $resp['data']);
    }

    public function editGroup()
    {
        $noteValidate = new NoteValidate();
        $noteModel = new NoteModel();

        $req = input('post.');
        if (!isset($req['group'])) {
            $req['group'] = 'default';
        }
        $res = $noteValidate->scene('editGroup')->check($req);
        if ($res != VALIDATE_PASS) {
            return apiReturn(CODE_ERROR, $noteValidate->getError(), '');
        }

        $data = [
            'group'  => $req['group'],
        ];
        $resp = $noteModel->edit($req['id'], $data);
        return apiReturn($resp['code'], $resp['msg'], $resp['data']);
    }

    public function getNoteByUserID()
    {
        $noteValidate = new NoteValidate();
        $noteModel = new NoteModel();

        $req = input('post.');
        $res = $noteValidate->scene('getUserText')->check($req);
        if ($res != VALIDATE_PASS) {
            return apiReturn(CODE_ERROR, $noteValidate->getError(), '');
        }


        $resp = $noteModel->getNoteByUser($req['user_id']);
        return apiReturn($resp['code'], $resp['msg'], $resp['data']);
    }

    public function getNote()
    {
        $noteValidate = new NoteValidate();
        $noteModel = new NoteModel();

        $req = input('post.');
        $res = $noteValidate->scene('get')->check($req);
        if ($res != VALIDATE_PASS) {
            return apiReturn(CODE_ERROR, $noteValidate->getError(), '');
        }


        $resp = $noteModel->getNote($req['id']);
        return apiReturn($resp['code'], $resp['msg'], $resp['data']);
    }

    public function getGroups()
    {
        $noteValidate = new NoteValidate();
        $noteModel = new NoteModel();

        $req = input('post.');
        $res = $noteValidate->scene('group')->check($req);
        if ($res != VALIDATE_PASS) {
            return apiReturn(CODE_ERROR, $noteValidate->getError(), '');
        }


        $resp = $noteModel->getGroups($req['user_id']);
        return apiReturn($resp['code'], $resp['msg'], $resp['data']);
    }
}