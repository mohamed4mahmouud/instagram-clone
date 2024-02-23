<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Sign up</title>
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        body {
            background-color: #121212;
            color: #fff;
        }
        .container {
            margin-top: 20px;
        }
        .sign-up-container {
            background: #232222;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
            width: 350px;
            margin: 10px auto;
            padding: 40px;
        }
        .info {
            font-weight: 600px;
            line-height: 20px;
            font-size: 17px;
            color: #999;
        }
        button {
            background-color: #3498db;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #2980b9;
        }
        .or {
            font-size: 13px !important;
            color: #999;
            font-weight: 600;
        }
        .or::before {
            content: " ";
            background: #999;
            display: block;
            height: 2px;
            width: 110px;
            position: relative;
            top: 11px;
        }
        .or::after {
            content: " ";
            background: #999;
            display: block;
            height: 2px;
            width: 110px;
            position: relative;
            bottom: 10px;
            left: 160px;
        }
        .form-group {
            margin-bottom: 6px!important;
        }
        .form-control {
            background: #2e2d2d;
            font-size: 12px;
            border: none;
        }
        .form-control::placeholder {
            color: #9d9d9d;
        }
        .terms {
            line-height: 18px;
            font-size: 14px;
            color: #999;
            margin: 5px 20px;
        }
        a {
            color: #3498db;
            text-decoration: none;
        }
        a:hover {
            color: #2980b9;
        }
        .login {
            background: #232222;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
            width: 350px;
            margin: 10px auto;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="sign-up-container text-center">
                    <p class="info">Sign up to see photo and videos from your friends.</p>
                    <button type="submit" class="btn btn-primary">Log in with Facebook</button>
                    <p class="or">OR</p>
                    <form action="{{ route('register') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Email" name="email">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Phone" name="phone">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Full Name" name="fullname">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username" name="username">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Sign up</button>
                    </form>
                    <p class="terms">By signing up, you agree to our <a href="#">Terms</a>, <a href="#">Privacy Policy</a>, and <a href="#">Cookies Policy</a>.</p>
                </div>
                <div class="login text-center">
                    <p>Have an account? <a href="#">Log in</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
