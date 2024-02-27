<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Email</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #121212;
            color: #fff;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #232222;
            padding: 50px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
            /* margin-top: 100px; */
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
            <div class="login-container">
                <form method="POST" action="{{ route('verifyEmail') }}">
                    @csrf
                    <h4 class="mb-4">Change E-mail</h4>
                    <div class="row mt-2">
                                    <label for="email" class="col-md-4 col-form-label text-md-right text-white">{{ __('Email') }}</label>

                                    <div class="col-md-6 w-75">
                                        <input id="email" type="email" class="form-control" name="email" placeholder="Email" value="{{ $user->email ?? old('email') }}">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <label for="email" class="col-md-4 col-form-label text-md-right text-white">{{ __('New Email') }}</label>

                                    <div class="col-md-6 w-75">
                                        <input id="email" type="email" class="form-control" name="new_email" placeholder="Email" value="{{ $user->email ?? old('email') }}">
                                    </div>
                                </div>

                <button type="submit" class="btn btn-primary">{{ __('Change Email') }}</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
