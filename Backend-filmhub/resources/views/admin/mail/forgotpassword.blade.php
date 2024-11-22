<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3>Xin chào, email cho forgot password</h3>
    <p>Bấm vào link này để thay đổi mật khẩu {{$email}} <a href="{{route('getChangePassword', $email)}}"> change password</a></p>
</body>
</html>