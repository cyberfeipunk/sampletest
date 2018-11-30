<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <title>注册确认连接</title>
</head>
<body>
  <h1>感谢您注册Sample App</h1>
  <p>
    请点击连接完成注册
    <a href="{{ route('confirm_email',$user->activation_token) }}">
      {{ route('confirm_email',$user->activation_token) }}
    </a>
  </p>
  <p>
     如果不是本人就忽略此邮件！
  </p>
</body>
</html>
