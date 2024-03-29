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
            width: 400px;
            margin: 10px auto;
            padding: 40px;
        }
        .sign-up-container img {
            max-width: 100px;
            margin-bottom: 20px;
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
            left: 210px;
        }
        .form-group {
            margin-bottom: 6px!important;
        }
        .form-control {
            background: #2e2d2d;
            font-size: 12px;
            border: none;
            color: #9d9d9d;
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
            width: 400px;
            margin: 10px auto;
            padding: 20px;
        }
        select {
        width: 100%;
        padding: 10px;
        font-size: 14px;
        border: none;
        border-radius: 4px;
        background-color: #2e2d2d;
        color: #999;
        margin-bottom: 10px;
    }

    select option {
        background-color: #2e2d2d;
        color: #999;
    }

    select:hover {
        cursor: pointer;
        background-color: #333;
    }

    select:focus {
        outline: none;
        background-color: #444;
    }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-6 mt-5">
                <img src="{{ asset('/images/instagram1.gif') }}">
            </div>
            <div class="col-6 mb-3">
                <div class="sign-up-container col-12 text-center">
                    <img src="{{ asset('/images/logo.png') }}">
                    <p class="info">Sign up to see photo and videos from your friends.</p>
                    <a href="{{ route('auth.facebook') }}"><button type="submit" class="btn btn-primary">Log in with Facebook</button></a>
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
                        <select name="gender">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    @if ($errors->any())
                        <div class="alert text-danger">
                            <ul class="list-unstyled">
                                @foreach ($errors->all() as $error)
                                    <li class="text-start">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                        <button type="submit" class="btn btn-primary btn-block">Sign up</button>
                    </form>
                    <p class="terms">By signing up, you agree to our <a href="#">Terms</a>, <a href="#">Privacy Policy</a>, and <a href="#">Cookies Policy</a>.</p>
                </div>
                <div class="login text-center">
                    <p>Have an account? <a href="{{ route('login') }}">Log in</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
