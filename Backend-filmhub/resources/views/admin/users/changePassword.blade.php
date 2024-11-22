<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{route('changePassword')}}" enctype="multipart/form-data" method="POST">
        @csrf
        @method('POST')
        <div>
            <label for="name">password</label>
            <input type="text" id="name" name="password" required>
        </div>
        <div>
            <label for="name">enter password</label>
            <input type="text" id="name" name="password_confirmation" required>
        </div>
        <input type="hidden" value="{{$email}}" name="email">
        <div><button>Submit</button></div>
    </form>
    
</body>
</html>