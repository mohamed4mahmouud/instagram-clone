<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Please click the following link to reset your password:</p>
    <a href="{{ route('password.reset',['token'=>$token]) }}">Reset Password</a>
</body>
</html>
