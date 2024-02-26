<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>
<body>
    <p>Dear {{  $name  }} ,</p>
    <p>Please click the following link to verify your email:</p>
    <a href="{{ route('verification.verify',['token'=>$token]) }}">Verify Email</a>
</body>
</html>
