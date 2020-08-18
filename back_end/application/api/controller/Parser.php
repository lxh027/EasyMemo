<?php

namespace app\api\controller;

use app\api\validate\MarkdownValidate;
use think\Controller;
use Parsedown;

class Parser extends Base
{
    public function md2html()
    {
        $markdownValidate = new MarkdownValidate();
        $parser = new Parsedown();

        $req = input('post.');
        $res = $markdownValidate->scene('convert')->check($req);
        if ($res != VALIDATE_PASS) {
            return apiReturn(CODE_ERROR, $markdownValidate->getError(), '');
        }

        $html = $parser
            ->setBreaksEnabled(true)
            ->setMarkupEscaped(true)
            ->text($req['text']);
        return apiReturn(CODE_SUCCESS, '转换成功', ['html' => $html]);
    }
}