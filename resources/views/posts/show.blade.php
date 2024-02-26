<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
                                {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        .bg-black::placeholder {
        color: white;
    }
    </style>
</head>
<body>
    <body class="bg-black">
      <div class="container mt-5">
        <div class="row">
            <div class="col-8">
               {{--posts image slider--}}
                <div id="carouselExample" class="carousel slide">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ Storage::url($post->images[0]) }}" class="d-block w-100" style="width: 400px; height: 600px;">
                         </div>
                        <div class="carousel-item">
                            <img src="{{ Storage::url($post->images[1]) }}" class="d-block w-100" style="width: 400px; height: 600px;">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <div class="col-4">
                <div>
                    <div class="d-flex align-items-center">
                        <div class="pe-3">
                            <img src="{{url('/images/download.jpg')}}" alt="profile image" class="rounded-circle w-100" style="max-width: 40px"> <!-- Using the profileImage() method in Profile.php model -->
                        </div>           
                        <div>
                            <div class="fw-bold">
                                <a class="text-decoration-none" href="/profile/{{ $post->user->id }}">
                                    <span class="text-light">{{$post->user->fullName}}</span>
                                </a>
                                <a href="#" class="text-decoration-none ps-3">Follow</a>
                            </div>
                        </div>
                        <div>
                            <i class="fa-solid fa-ellipsis ms-5" style="color: #ffffff;"></i>
                        </div>
                    </div>

                    <hr class="text-light">

                    {{-- comments section --}}
                    {{-- post owner post description --}}
                        <div class="d-flex">
                            <div class="pe-3">
                                <img src="{{ url('/images/download.jpg') }}" alt="profile image" class="rounded-circle w-100" style="max-width: 40px"> <!-- Using the profileImage() method in Profile.php model -->
                            </div>    
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <span class="fw-bold text-light">
                                            <a class="text-decoration-none" href="/profile/{{ $post->user->id }}">
                                            <span class="text-light">{{ $post->user->fullName }}</span>
                                            </a>
                                        </span>
                                        <span class="text-light ms-1">{{ $post->caption }}</span>
                                    </div>
                                    <i class="fa-regular fa-heart fa-sm mt-3 ms-2" style="color: #ffffff;"></i>
                                </div>
                                <p class="text-white-50">1h</p>
                            </div>
                        </div>

                        {{-- other comments --}}
                        <div class="d-flex">
                            <div class="pe-3">
                                <img src="{{ url('/images/download.jpg') }}" alt="profile image" class="rounded-circle w-100" style="max-width: 40px"> <!-- Using the profileImage() method in Profile.php model -->
                            </div>    
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <span class="fw-bold text-light">
                                            <a class="text-decoration-none" href="/profile/{{ $post->user->id }}">
                                            <span class="text-light">{{$post->comments[0]->user->fullName}}</span>
                                            </a>
                                        </span>
                                        <span class="text-light ms-1">{{ $post->comments[0]->body }}</span>
                                    </div>
                                    <i class="fa-regular fa-heart fa-sm mt-3" style="color: #ffffff;"></i>
                                </div>
                                <p class="text-white-50 mt-2">{{$post->timeDifference}}</p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="pe-3">
                                <img src="{{ url('/images/download.jpg') }}" alt="profile image" class="rounded-circle w-100" style="max-width: 40px"> <!-- Using the profileImage() method in Profile.php model -->
                            </div>    
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <span class="fw-bold text-light">
                                            <a class="text-decoration-none" href="/profile/{{ $post->user->id }}">
                                            <span class="text-light">{{ $post->user->fullName }}</span>
                                            </a>
                                        </span>
                                        <span class="text-light ms-1">{{ $post->caption }}</span>
                                    </div>
                                    <i class="fa-regular fa-heart fa-sm mt-3" style="color: #ffffff;"></i>
                                </div>
                                <p class="text-white-50 mt-2">1h</p>
                            </div>
                        </div>
                    
                    
                    <hr class="text-light">
                    {{-- Reactions Bar  --}}
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8">
                                    <i
                                        class="fa-regular fa-heart fa-lg text-white ms-0"></i>
                                    <i
                                         class="fa-regular fa-comment fa-lg text-white ms-3"></i></a>
                                    <i class="fa-regular fa-paper-plane fa-lg text-white ms-3"></i>
                                </div>
                                <div class="col-md-4 text-end">
                                    <i class="fa-regular fa-bookmark text-white"></i>
                                </div>
                            </div>
                            {{-- Liked by --}}
                            <div class="row text-white">
                                <div class="col-md-12 mt-4">
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img (31).webp"
                                        class="rounded-circle" height="30" alt="avatar" />
                                    <small>Liked by <strong>{{$post->likes[0]->user->fullName}}</strong> and
                                        <strong>{{$post->like_count}}</strong> others</small>
                                        <div class="col-md-12 mt-2">
                                            <span class="my-1 text-secondary">{{ $post->timeDifference }}</span>
                                        </div>
                                </div>
                            </div>

                            {{-- Comments form --}}
                            <div class="row mt-2">
                                <hr>
                                <div class="col-md-11">
                                    <div class="form-outline" data-mdb-input-init>
                                        <input type="text" id="comment-{{ $post->id }}" class="form-control bg-black"
                                            placeholder="leave a comment ..."/>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" data-post-id="{{ $post->id }}"
                                        class="btn post-comment-btn btn-outline-info">Post</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>