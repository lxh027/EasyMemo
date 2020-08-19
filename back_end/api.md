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

# ForgetPassword
    use: 重置密码
    method: POST
    path: servername/api/login/forget_password
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


