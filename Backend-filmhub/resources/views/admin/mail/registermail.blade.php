<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
</head>
<body>
    <h1>Bạn đã gửi yêu cầu đăng ký tài khoản tại filmhub booking</h1>
    <p>Bấm vào đây để xác nhận đăng ký tài khoản 
        <a href="{{route('register.confirm',
         ['email'=>$user['email'],
         'password'=>$user['password']
        ])}}"><button style="color: blue; padding: 4px 8px">Xac nhan</button></a>
    </p>
    
</body>
</html>