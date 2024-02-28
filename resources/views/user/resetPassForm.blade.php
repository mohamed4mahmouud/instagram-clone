<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Reset password</title>
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        body {
            background-color: #121212;
            color: #fff;
        }
        .parent-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .parent-container img {
            max-width: 100px;
            margin-bottom: 20px;
        }
        .container {
            background: #232222;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
            width: 350px;
            margin: auto;
            padding: 40px;
        }
          .form-group {
            margin-bottom: 6px;
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
    </style>
</head>
<body>
    <div class="parent-container">
        <div class="container">
            <img src="{{ asset('/images/logo.png') }}">
            <form action="{{ route('password.store') }}" method="post">
            @csrf
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Email" name="email">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" placeholder=" Confirm Password" name="password_confirmation">
                </div>

                <button type="submit" class="btn btn-primary btn-block">reset password</button>
            </form>
        </div>
    </div>
</body>
</html>
