<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->userName }}'s Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="dark-mode">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3">
                {{-- Profile Picture --}}
                <img src="{{ asset('storage/' . $profile->avatar) }}" class="w-75 rounded-circle" alt="Avatar">
            </div>
            <div class="col-md-9">
                {{-- Username --}}
                <h1>{{ $user->userName }}</h1>
                {{-- Bio --}}
                <p>Bio: {{ $profile->bio }}</p>
                {{-- Counts --}}
                <ul class="list-inline">
                    <li class="list-inline-item">Posts: 100</li>
                    <li class="list-inline-item">{{ $user->followers_count }} followers</li>
                    <li class="list-inline-item">{{ $user->following_count }} following</li>
                </ul>
                {{-- Website --}}
                <p>Website: <a href="#">{{ $profile->website }}</a></p>
                {{-- Follow Button --}}
                <button class="btn btn-primary">Follow</button>
            </div>
        </div>
        {{-- Posts --}}
        <div class="row mt-5">
            <div class="col-md-4 mb-4">
                <img src="https://via.placeholder.com/300" class="img-fluid" alt="Post Image">
            </div>
            <div class="col-md-4 mb-4">
                <img src="https://via.placeholder.com/300" class="img-fluid" alt="Post Image">
            </div>
            <div class="col-md-4 mb-4">
                <img src="https://via.placeholder.com/300" class="img-fluid" alt="Post Image">
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

