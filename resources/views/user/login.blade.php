<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #121212; 
            color: #fff; 
        }

        .container {
            display: flex;
            /* justify-content: center; */
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #232222; 
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
            margin-top: 100px;
            height: 100%;
        }

        .login-container img {
            max-width: 100px;
            margin-bottom: 20px;
        }

        .login-container h2 {
            margin-bottom: 20px;
            color: #fff;
        }

        form {
            margin-top: 20px;
        }

    
        .form-control{
            background-color: #2e2d2d;
            border: none;
            color: #9d9d9d;
        }
        .form-control::placeholder{
            color: #9d9d9d;
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

        p {
            margin-top: 20px;
            color: #aaa;
        }

        a {
            color: #3498db;
            text-decoration: none;

        }

        a:hover {
            color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">   
            <div class="col-6 me-5">
                <img src="{{ asset('/images/instagram1.gif') }}">
            </div>
            <div class="login-container col-12 ml-5">
                <img src="{{ asset('/images/logo.png') }}">

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="Enter your email" required>
                    </div>

                    <div class="mb-3">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="mb-3 text-end">
                        <!-- <a href="{{ route('password.request') }}">Forget Password?</a> -->
                        @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary">{{ __('Log in') }}</button>
                </form>

                <p>Don't have an account? <a href="{{ route('user.signup') }}">Sign Up</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
