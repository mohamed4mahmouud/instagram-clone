@extends('layouts.main')
<body>
<div class="container page-content1">
        <div class="row">
            <div class="col-8 mt-5">
                    <div class="font-weight-bolder text-white"><h4>{{ __('Edit Profile') }}</h4></div>
                    <div>
                        <form method="POST" action="{{ route('user.viewprofile') }}" enctype="multipart/form-data">
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
                                <div class="row mt-4">
                                    <div class="col-md-12 text-md-left">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Save Changes') }}
                                        </button>
                                    </div>
                        </form>
                        
                    </div>
                </div>
            </div>
            <div class="col-6 mt-5 accounts">
                        <h5 class=" text-white">Accounts Center</h5>
                        <a class="d-block text-decoration-none mt-3 mb-3 text-gray" href="{{ route('user.changeEmail') }}">Change E-mail</a>
                        <a class="d-block text-decoration-none text-gray" href="{{ route('user.changePassword') }}">Change Password</a>
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
</body>
