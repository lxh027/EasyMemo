<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::get('hello/:name', 'index/hello');
Route::rule('api/register', 'api/Register/register')->allowCrossDomain();
Route::rule('api/login/login', 'api/Login/login')->allowCrossDomain();
Route::rule('api/login/check_login', 'api/Login/checkLogin')->allowCrossDomain();
Route::rule('api/login/reset_password', 'api/Login/resetPassword')->allowCrossDomain();
Route::rule('api/logout', 'api/login/logout')->allowCrossDomain();

Route::rule('api/user/find', 'api/User/getUserInfo')->allowCrossDomain();
Route::rule('api/user/editNick', 'api/User/editUserNick')->allowCrossDomain();
Route::rule('api/user/getUser', 'api/User/getUserInfoByID')->allowCrossDomain();

Route::rule('api/md2html', 'api/parser/md2html')->allowCrossDomain();

Route::rule('api/note/add', 'api/Note/createNote')->allowCrossDomain();
Route::rule('api/note/delete', 'api/Note/deleteNote')->allowCrossDomain();
Route::rule('api/note/edit', 'api/Note/editText')->allowCrossDomain();
Route::rule('api/note/group', 'api/Note/editGroup')->allowCrossDomain();
Route::rule('api/note/getNotesByUserID', 'api/Note/getNoteByUserID')->allowCrossDomain();
Route::rule('api/note/getNote', 'api/Note/getNote')->allowCrossDomain();
Route::rule('api/note/getGroups', 'api/Note/getGroups')->allowCrossDomain();

return [
];
