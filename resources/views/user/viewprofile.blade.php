<!DOCTYPE html>
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

    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <!-- Edit Profile Form -->
        <div class="col-md-8 mt-5">
            <div class="font-weight-bolder"><h4>{{ __('Edit Profile') }}</h4></div>
            <div>
                <form method="POST" action="{{ route('ay7aga') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row mt-5 mb-2 userimg">
                        <div class="col-md-2 mt-2 ps-4">
                            <img id="avatarimg" src="{{ Storage::url($profile->avatar ?? old('avatar')) }}">
                        </div>
                        <div class="col-md-4 mt-3 ps-2">
                            <p class="usrname mb-0">{{ $user->userName }}</p>
                            <p class="text-white-50">{{ $user->fullName }}</p>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="btn btn-primary">
                                Change photo<input id="avatar" type="file" class="form-control" name="avatar" style="display: none;" value="{{ $profile->avatar ?? old('avatar') }}">
                            </label>
                        </div>
                    </div>

                    <label for="website" class="col-md-4 col-form-label text-md-right text-white">{{ __('Website') }}</label>
                    <div class="col-md-6 w-75">
                        <input id="website" type="text" class="form-control" name="website" placeholder="Website" value="{{ $profile->website ?? old('website') }}">
                    </div>
                    
                    <label for="bio" class="col-md-4 col-form-label text-md-right text-white">{{ __('Bio') }}</label>
                    <div class="col-md-6 w-75">
                        <textarea id="bio" class="form-control" name="bio" placeholder="Bio">{{ $profile->bio ?? old('bio') }}</textarea>
                    </div>

                    <div class="col-md-6 offset-md-4 mt-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Upload Profile') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-8 mt-5">
            <div class="font-weight-bolder"><h4>{{ __('Update Contact Info') }}</h4></div>
            <form method="POST" action="{{ route('updateUser') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row mt-2">
                        <label for="email" class="col-md-4 col-form-label text-md-right text-white">{{ __('Email') }}</label>
                        <div class="col-md-6 w-75">
                            <input id="email" type="email" class="form-control" name="email" placeholder="Email" value="{{ $user->email ?? old('email') }}">
                        </div>
                    </div>

                    <div class="row mt-2">
                        <label for="full_name" class="col-md-4 col-form-label text-md-right text-white">{{ __('Full Name') }}</label>
                        <div class="col-md-6 w-75">
                            <input id="fullName" type="text" class="form-control" name="fullName" placeholder="Full Name" value="{{ $user->fullName ?? old('fullName') }}">
                        </div>
                    </div>

                    <div class="row mt-2">
                        <label for="phone" class="col-md-4 col-form-label text-md-right text-white">{{ __('Phone') }}</label>
                        <div class="col-md-6 w-75">
                            <input id="phone" type="text" class="form-control" name="phone" placeholder="Phone" value="{{ $user->phone ?? old('phone') }}">
                        </div>
                    </div>

                    <div class="row mt-2">
                        <label for="gender" class="col-md-4 col-form-label text-md-right text-white">{{ __('Gender') }}</label>
                        <div class="col-md-6 w-75">
                            <select id="gender" class="form-control" name="gender">
                                <option value="male" {{ ($user->gender == 'male' || old('gender') == 'male') ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ ($user->gender == 'female' || old('gender') == 'female') ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ ($user->gender == 'other' || old('gender') == 'other') ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                    </div>
                <div class="col-md-6 offset-md-4 mt-4 mb-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Update Contact Info') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('avatar').addEventListener('change', function (event) {
        var input = event.target;
        var reader = new FileReader();

        reader.onload = function () {
            var img = document.getElementById('avatarimg');
            img.src = reader.result;
        };

        if (input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
