# Register
    use: 注册
    method: POST
    path: servername/api/register
    param:
        username: require|max:20
        password: require|len:6-16
        password_check: require|len:6-16
        nick: require|max:25
        email: require
        contact: optional
- 添加成功：
```json
{
    "status": 0,
    "message": "添加成功",
    "data": 1
}
```
- 重复添加
```json
{
    "status": -1,
    "message": "用户名已存在",
    "data": []
}
```
- 信息不正确
```json
{
    "status": -1,
    "message": "缺少密码",
    "data": ""
}
```
```json
{
    "status": -1,
    "message": "两次输入密码不一致",
    "data": ""
}
```

# Login
    use: 登录
    method: POST
    path: servername/api/login/login
    param:
        username: require|max:20
        password: require|len:6-16

- 登录成功
```json
{
    "status": 0,
    "message": "登录验证成功",
    "data": {
        "user_id": 3,
        "username": "admin",
        "nick": "lxh001",
        "contact": "",
        "email": "992874705@qq.com"
    }
}
```
- 登录失败
```json
{
    "status": -1,
    "message": "用户名或密码错误",
    "data": []
}
```
```json
{
    "status": -1,
    "message": "已有账号登录",
    "data": {
        "user_id": 3,
        "username": "admin",
        "nick": "lxh001",
        "contact": "",
        "email": "992874705@qq.com"
    }
}
```

# ResetPassword
    use: 重置密码
    method: POST
    path: servername/api/login/reset_password
    param:
        username: require|max:20
        password: require|len:6-16
        password_check: require|len:6-16
        email: require
- 修改成功
```json
{
    "status": 0,
    "message": "修改成功",
    "data": []
}
```
- 用户名邮箱不正确
```json
{
    "status": -1,
    "message": "用户名或邮箱不存在",
    "data": []
}
```

# CheckLogin
    use: 检查登录状态
    method: POST
    path: servername/api/login/check_login
    param:
        null
- 返回结果
```json
{
    "status": 0,
    "message": "已经登陆",
    "data": ""
}
```

# Logout
    use: 注销
    method: POST
    path: servername/api/logout
    param:
        null

- 注销成功
```json
{
    "status": 0,
    "message": "注销成功",
    "data": ""
}
```

# convert
    use: markdown转html
    method: POST
    path: servername/api/md2html
    param:
        text: require(markdown原文)
      
- 转换成功
```cpp
{
    "status": 0,
    "message": "转换成功",
    "data": {
        "html": "<h1>123123</h1>\n<h1>555</h1>"
    }
}
```

# getUserInfo
    use: 获取用户信息
    method: POST
    path: servername/api/user/find
    param:
        null
    
- 查找成功
```json
{
    "status": 0,
    "message": "查找成功",
    "data": {
        "id": 3,
        "username": "admin",
        "password": "823b5817cadd75bb4809a539ff68a5d3",
        "nick": "lxh001",
        "email": "992874705@qq.com",
        "contact": ""
    }
}
```
- 查找失败
```json
{
    "status": -1,
    "message": "查找失败",
    "data": []
}
```

# getUserInfoByID
    use: 获取用户信息
    method: POST
    path: servername/api/user/getUser
    param:
        id: 用户ID|require

```json
{
    "status": 0,
    "message": "查找成功",
    "data": {
        "id": 3,
        "username": "admin",
        "password": "823b5817cadd75bb4809a539ff68a5d3",
        "nick": "lxh001",
        "email": "992874705@qq.com",
        "contact": ""
    }
}
```

# addNote
    use: 添加笔记
    method: POST
    path: servername/api/note/add
    param:
        text: 笔记内容，可为空
        group: 笔记分组，可为空，默认为default
        title: 笔记标题，不可为空

- 添加成功
```json
{
    "status": 0,
    "message": "添加成功",
    "data": {
        "note_id": "5"
    }
}
```

# deleteNote
    use: 删除笔记
    method: POST
    path: servername/api/note/delete
    param:
        id: 笔记id
- 删除成功
```json
{
    "status": 0,
    "message": "删除成功",
    "data": []
}
```

- id不存在
```json
{
    "status": -1,
    "message": "id不存在",
    "data": []
}
```

# editText
    use: 编辑笔记
    method: POST
    path: servername/api/note/edit
    param:
        id: 笔记id
        text: 笔记内容，可为空
        title
- 更新成功
```json
{
    "status": 0,
    "message": "更新成功",
    "data": 1
}
```

# editGroup
    use: 编辑笔记分组
    method: POST
    path: servername/api/note/group
    param:
        id: 笔记id
        group: 笔记分组，可为空，默认为default
   
- 更新成功 
```json
{
    "status": 0,
    "message": "更新成功",
    "data": 1
}
```
- 未更新
```json
{
    "status": -1,
    "message": "未更新",
    "data": 0
}
```

# getNote
    use: 获取笔记
    method: POST
    path: servername/api/note/getNote
    param:
        id: 笔记id

- 获取成功
```json
{
    "status": 0,
    "message": "查找成功",
    "data": {
        "id": 9,
        "title": "title",
        "text": "# markdow\n## markdown\n### markdown\n\n",
        "user_id": 3,
        "create_time": "2020-08-21 16:10:12",
        "update_time": "2020-08-21 16:10:12",
        "group": "default"
    }
}
```
- 获取失败
```json
{
    "status": 0,
    "message": "查找失败",
    "data": []
}
```

# getGroups
    use: 获取用户笔记分组
    method: POST
    path: servername/api/note/getGroups
    param:
        user_id: 用户id

- 获取成功    
```json
{
    "status": 0,
    "message": "查询成功",
    "data": [
        "12",
        "default"
    ]
}
```

# getAllNotes
    use: 获取用户所有笔记
    method: POST
    path: servername/api/note/getNotesByUserID
    param:
        user_id: 用户id
- 获取成功
```json
{
    "status": 0,
    "message": "查询成功",
    "data": {
        "user_id": "3",
        "notes": {
            "12": [
                {
                    "id": 6,
                    "title": "",
                    "create_time": "2020-08-21 13:53:27",
                    "update_time": "2020-08-21 13:57:25"
                }
            ],
            "default": [
                {
                    "id": 7,
                    "title": "",
                    "create_time": "2020-08-21 14:02:14",
                    "update_time": "2020-08-21 14:02:14"
                },
                {
                    "id": 8,
                    "title": "",
                    "create_time": "2020-08-21 14:03:02",
                    "update_time": "2020-08-21 14:03:02"
                },
                {
                    "id": 9,
                    "title": "title",
                    "create_time": "2020-08-21 16:10:12",
                    "update_time": "2020-08-21 16:10:12"
                }
            ]
        }
    }
}
```