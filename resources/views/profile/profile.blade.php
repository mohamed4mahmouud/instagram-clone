<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->userName }}'s Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #000000; 
            color: #fff; 
        }
        .custom-container {
        max-width: 935px; 
        margin: 0 auto; 
        padding: 0;
        }
        
        .text-white:hover {
            color: #f8f9fa !important;
            text-decoration: none !important;
        }
        .tab-selected {
            opacity: 1;
        }
        .tab-not-selected {
            opacity: 0.5;
        }
        .indicator {
        height: 2px;
        background-color: #ffffff;
        position: absolute;
        top: -25px;
        left: 50%;
        transform: translateX(-50%);
        width: 65px;
        z-index: 1;
        }
        .edit-btn{
            background-color: #363636;
            color: white;
        }
        .edit-btn:hover{
            background-color: #262626;
        }
        .post img {
        width: 315px;
        height: 315px;
        object-fit: cover;
        }
        .post{
            padding: 0;
        }
        .col-md-4{
            padding: 0;
        }
        .posts-container{
            padding: 0;
        }
        .post a:hover{
            background: rgba(0,0,0, .4);
        }
    </style>
</head>
<body>
    <div class="container mt-5 custom-container">
        <div class="row">
            <div class="col-md-3">
                {{-- Profile Picture --}}
                <img src="{{ asset('storage/' . $profile->avatar) }}" class="w-75 rounded-circle" alt="Avatar">
            </div>
            <div class="col-md-9">
                {{-- Username --}}
                <h1 class="d-inline">{{ $user->userName }}</h1>
                {{-- Edit Profile Button --}}
                <button class="btn edit-btn ms-5 mb-4">Edit Profile</button>
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
        {{-- Posts navBar --}}
        <div class="row mt-3 mb-3">
            <hr class="mt-4">
            <div class="col d-flex justify-content-center mt-2 position-relative">
                <a href="{{ route('profile', ['user' => $user]) }}" id="postsTab" class="text-white text-decoration-none tab-selected position-relative">
                    <i class="fa-solid fa-table-cells"></i> Posts
                    <div class="indicator"></div>
                </a>
                <a href="{{ route('saved', ['user' => $user]) }}" id="savedTab" class="text-white text-decoration-none ms-5 tab-not-selected position-relative">
                    <i class="fa-regular fa-bookmark"></i> Saved
                    <div class="indicator"></div>
                </a>
            </div>
        </div>
        
        {{-- Posts --}}
        <div class="container posts-container">
            <div class="row mb-1">
                <div class="col-md-4">
                    <div class="post">
                        <a href="#"><img src="/storage/images/1.png" alt="Post 1"></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="post">
                        <a href="#"><img src="/storage/images/post1.png" alt="Post 2"></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="post">
                        <a href="#"><img src="/storage/images/post2.png" alt="Post 3"></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="post">
                        <a href="#"><img src="/storage/images/post3.png" alt="Post 4"></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="post">
                        <a href="#"><img src="https://via.placeholder.com/150" alt="Post 5"></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="post">
                        <a href="#"><img src="https://via.placeholder.com/150" alt="Post 6"></a>
                    </div>
                </div>
            </div>
        </div>        
    </div>
    <script src="https://kit.fontawesome.com/4a3689b860.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        const postsTab = document.getElementById('postsTab');
        const savedTab = document.getElementById('savedTab');
        const postsIndicator = document.querySelector('#postsTab .indicator');
        const savedIndicator = document.querySelector('#savedTab .indicator');
    
        function setActiveTab() {
            if (postsTab.classList.contains('tab-selected')) {
                postsIndicator.style.display = 'block';
                savedIndicator.style.display = 'none';
            } else {
                savedIndicator.style.display = 'block';
                postsIndicator.style.display = 'none';
            }
        }
    
        postsTab.addEventListener('click', () => {
            postsTab.classList.add('tab-selected');
            savedTab.classList.remove('tab-selected');
            postsTab.classList.remove('tab-not-selected');
            savedTab.classList.add('tab-not-selected');
            postsIndicator.style.display = 'block';
            savedIndicator.style.display = 'none';
        });
    
        savedTab.addEventListener('click', () => {
            savedTab.classList.add('tab-selected');
            postsTab.classList.remove('tab-selected');
            savedTab.classList.remove('tab-not-selected');
            postsTab.classList.add('tab-not-selected');
            savedIndicator.style.display = 'block';
            postsIndicator.style.display = 'none';
        });
    
        window.addEventListener('load', setActiveTab);
    </script>
    
    
</body>
</html>

