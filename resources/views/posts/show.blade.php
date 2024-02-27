@extends('layouts.main');
@section('newsfeed');
    <style>
        .bg-black::placeholder {
        color: white;

    }
    .hash-tag{
        text-decoration: none;
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
                         @if (count ($post->images) > 1)
                         @foreach ($post->images as $index => $img)
                         @if($index >0)
                        <div class="carousel-item">
                            <img src="{{ Storage::url($img) }}" class="d-block w-100" style="width: 400px; height: 600px;">
                        </div>
                        @endif
                        @endforeach
                        @endif
                     </div>
                     @if (count ($post->images) > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                    @endif
                </div>
            </div>

            <div class="col-4">
                <div>
                    <div class="d-flex align-items-center">
                        <div class="pe-3">
                            {{-- <img src="{{asset($post->user->profile->avatar)}}" alt="profile image" class="rounded-circle w-100" style="max-width: 40px"> <!-- Using the profileImage() method in Profile.php model --> --}}
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
                    {{-- post caption --}}
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
                                        <p class="text-light">
                                           {{$post->caption}}
                                           @foreach ($post->tags as $tag)
                                           <span class="text-light">
                                               <a href="{{ route("tags", ["id" => $tag->id]) }}" class="hash-tag">#{{ $tag->name }}</a>
                                           </span>
                                       @endforeach
                                       
                                               
                                           {{-- <p class="text-light">{{$post->caption}}</p>   --}}
                                        </p>
                                    </div>
                                    <i class="fa-regular fa-heart fa-sm mt-3 ms-2" style="color: #ffffff;"></i>
                                </div>
                                <p class="text-white-50">{{$post->created_at->diffForHumans()}}</p>
                            </div>
                        </div>

                        {{-- other comments --}}
                        @if (!$post->comments->isEmpty())
                        @foreach ($post->comments as $comment)
                        <div class="d-flex">
                            <div class="pe-3">
                                <img src="{{ url('/images/download.jpg') }}" alt="profile image" class="rounded-circle w-100" style="max-width: 40px"> <!-- Using the profileImage() method in Profile.php model -->
                            </div>    
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <span class="fw-bold text-light">
                                            <a class="text-decoration-none" href="/profile/{{ $post->user->id }}">                
                                            <span class="text-light">{{$comment->user->fullName}}</span>
                                            </a>
                                        </span>
                                        <span class="text-light ms-1">{{ $comment->body }}</span>
                                    
                                    </div>
                                    <i class="fa-regular fa-heart fa-sm mt-3" style="color: #ffffff;"></i>
                                </div>
                                <p class="text-white-50 mt-2">{{$post->timeDifference}}</p>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    
                    <hr class="text-light">
                    {{-- Reactions Bar  --}}
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8">
                                    <i
                                        data-post-id='{{ $post->id }}'
                                        class="fa-regular fa-heart fa-lg text-white ms-0"></i>
                                    <a href="#comment-{{ $post->id }}"><i
                                        class="fa-regular fa-comment fa-lg text-white ms-3"></i></a>
                                    <i class="fa-regular fa-paper-plane fa-lg text-white ms-3"></i>
                                </div>
                                <div class="col-md-4 text-end">
                                    <i class="fa-regular fa-bookmark text-white"></i>
                                </div>
                            </div>
                            {{-- Liked by --}}
                             @if (!$post->likes->isEmpty())
                            <div class="row text-white">
                                <div class="col-md-12 mt-4">
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img (31).webp"
                                        class="rounded-circle" height="30" alt="avatar" />
                                    <small>Liked by <strong>{{$post->likes[0]->user->fullName}}</strong> and
                                        <strong>{{$post->like_count}}</strong> others</small>
                                        <div class="col-md-12 mt-2">
                                            <span class="my-1 text-secondary">{{ $post->timeDifference }}</span>
                                        </div>
                                        @endif
                                </div>
                            </div>

                            {{-- Comments form --}}
                            <div class="row mt-2">
                                <hr>
                                <div class="col-md-11">
                                    <div class="form-outline" data-mdb-input-init>
                                        <input type="text" id="comment-{{ $post->id }}" class="form-control bg-black text-light"
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
     <script>
            let likeBtns = document.querySelectorAll(".fa-heart")
            likeBtns.forEach(likeBtn => {
                likeBtn.onclick = async function() {
                    let res = await fetch('http://localhost:8000/posts/' + likeBtn.getAttribute(
                        'data-post-id') + '/like');
                    let data = await res.json();
                    // TODO: change heart icon to be filled with LOVE @farah
                    console.log(data);
                    //Handle the likes increment or decrement on the browser View
                }
            });


            //TODO: Dynamic load Posts comments and likes



            let postComments = document.querySelectorAll('.post-comment-btn')
            postComments.forEach(postComment => {
                postComment.onclick = async function() {
                    const postId = this.getAttribute('data-post-id');
                    const commentBody = document.getElementById('comment-' + postId).value;
                    const url = 'http://localhost:8000/post/' + postId + '/comment';
                    const csrf = document.querySelectorAll('meta')[2].getAttribute('content');
                    const data = {
                        comment: commentBody
                    };
                    const res = await fetch(url, {
                        method: 'POST',
                        headers: {
                            "content-type": "application/json",
                            "X-CSRF-TOKEN": csrf
                        },
                        body: JSON.stringify(data),
                    })
                    let resData = await res.json();
                    console.log(resData);
                }
            });

        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
@endsection