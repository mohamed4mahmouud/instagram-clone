<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    body {
        background-color: #121212;
        color: #fff;
    }

    .form-control {
        background-color: #262626;
        color: #fff;
        border: 1px solid #2f3136;
    }

    .btn-primary {
        background-color: #0095f6;
        color: #fff;
        border: 1px solid #0095f6;
    }

    .btn-primary:hover {
        background-color: #007bb5;
        border: 1px solid #007bb5;
    }
    #avatarimg {
        border-radius: 50%;
        overflow: hidden;
        width: 70px;
        height: 70px;
        object-fit: cover;
    }
    .userimg {
        background-color: #262626;
        border-radius: 15px;
        padding-top: 10px;
        padding-bottom: 10px;
        width: 77%;
    }
    .usrname {
        font-weight: bold;
    }
    #website {
        color: #9d9d9d;
    }
    #website::placeholder {
        color: #9d9d9d;
    }
    #bio {
        border: 1px solid #2f2f2f;
        background-color: #121212;
        color: #9d9d9d;
    }
    #bio::placeholder {
        color: #9d9d9d;
    }
    .accounts {
        background-color: #262626;
        border-radius: 15px;
        padding-top: 10px;
        padding-bottom: 10px;
        width: 22%;
        height: 200px;
        padding: 20px;
    }

    </style>
</head>
<body>
<div class="container">
        <div class="row justify-content-center">
        
            <div class="col-md-8 mt-5">
                    <div class="font-weight-bolder"><h4>{{ __('Change Email') }}</h4></div>
                    <div>
                        <form method="POST" action="{{ route('verifyEmail') }}">
                            @csrf
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

                                <div class="row mt-4">
                                    <div class="col-md-12 text-md-left">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Change Email') }}
                                        </button>
                                    </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>