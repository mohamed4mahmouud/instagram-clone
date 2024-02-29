@extends('layouts.main')
@section('css')
    <style>
        .card-body {
            background-color: black;
        }

        div #story {
            background-color: black;
            margin: auto;
            border: 1px solid red;
            border-radius: 5px;
            height: 110px;
            overflow: hidden;
            position: relative;
        }

        .story {
            border-radius: 50%
        }

        .story-container ul {
            list-style-type: none;
            display: flex;
            overflow-y: auto;
            padding: 20px;

        }

        .story-container ul li {
            padding: 0 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .story-container ul li .story {
            padding: 2px;
            background: linear-gradient(45deg,
                    #f09433 0%,
                    #e6683c 25%,
                    #dc2743 50%,
                    #cc2366 75%,
                    #bc1888 100%);
        }

        .user-name {
            font-size: 12px;
        }
    </style>
@endsection
@section('stories')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12 story-container" id="story">
                    <ul>
                        <li>
                            {{-- List your followings stories here --}}
                            <div class="story">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img (31).webp" class="rounded-circle"
                                    height="60" alt="avatar" />
                            </div>
                            <span class="text-white">Willi wanka</span>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    @endsection


    @section('newsfeed')
        <div class="container my-5">
            {{-- for each 3l post hena --}}
            @foreach ($posts as $post)
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="container">
                                    {{-- the row that carries the username and avatar also the ... to the more options of post --}}
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="d-flex story">
                                                <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img (31).webp"
                                                    class="rounded-circle" height="40" alt="avatar" />
                                                <div class="mt-2">
                                                    <a href="{{ route('profile', ['user' => $user->id]) }}"
                                                        class="text-white">
                                                        <strong class="strong mt-5 ms-2">{{ $user->userName }}</strong>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-end d-flex justify-content-end  align-items-center">
                                            <i class="fa-solid fa-ellipsis fa-lg text-white">
                                            </i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            {{-- Image --}}
                            <div id="carouselExample" class="carousel slide">
                                <div class="carousel-inner">
                                    @for ($i = 0; $i < count($post->images); $i++)
                                    @if ($i==0)
                                        <div class="carousel-item active">
                                            <img src="{{ Storage::url($post->images[0]) }}" class="d-block w-100" style="width: 400px; height: 600px;">
                                        </div>
                                    @endif
                                        @if ($i>0)
                                        <div class="carousel-item">
                                            <img src="{{ Storage::url($post->images[$i]) }}" class="d-block w-100" style="width: 400px; height: 600px;">
                                        </div>    
                                        @endif
                                    
                                     @endfor
                                    </div>
                                    @if (count($post->images)>1)
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
                            
                            {{-- Interactions --}}

                            <div class="card-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <i data-post-id='{{ $post->id }}'
                                                class="fa-regular fa-heart fa-lg text-white ms-0"></i>
                                            <a href="#comment-{{ $post->id }}"><i
                                                    data-comment-form-id='{{ $post->id }}'
                                                    class="fa-regular fa-comment fa-lg text-white ms-2"></i></a>
                                            <i class="fa-regular fa-paper-plane fa-lg text-white ms-2"></i>
                                        </div>
                                        <div class="col-md-4 text-end">
                                            <i data-post-id="{{$post->id}}" class="fa-regular fa-bookmark text-white"></i>
                                        </div>
                                    </div>
                                    {{-- Liked by --}}
                                    <div class="row text-white">
                                        <div class="col-md-8 mt-1">
                                            @if ($post->like_count)
                                                <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img (31).webp"
                                                    class="rounded-circle" height="30" alt="avatar" />
                                                <small>Liked by <strong>
                                                        @foreach ($post->likes->take(1) as $like)
                                                            {{ $like->user->userName }}
                                                        @endforeach

                                                    </strong> {{ $post->like_count - 1 ? 'and' : '' }}
                                                    <strong>{{ $post->like_count - 1 ? $post->like_count - 1 : '' }}</strong>{{ $post->like_count > 1 ? ' others' : '' }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    {{-- Caption --}}
                                    <div class="row text-white">
                                        <div class="col-md-12 mt-1">
                                            <p class="text-white">
                                                <strong class="text-white">
                                                    {{ $user->userName }}
                                                </strong>
                                                {{ $post->caption }}
                                            </p>
                                        </div>
                                    </div>
                                    {{-- Comments --}}
                                    <div class="row text-white">
                                        @if ($post->comments_count)
                                            @if ($post->comments_count > 3)
                                                {{-- TODO: Add href 3la View bywreek comments el post dh w yslam lw modal based yb2a 3zma @everyone --}}
                                                <small class="my-1"> View All {{ $post->comments_count }}
                                                    Comments</small>
                                            @endif
                                            @foreach ($post->comments->take(3) as $comment)
                                                <p class="mb-0"><strong
                                                        class="text-white">{{ $comment->user->userName }}:</strong>
                                                    {{ $comment->body }}
                                                </p>
                                                <small class="mb-2 text-secondary">{{ $comment->timeDifference }}</small>
                                            @endforeach
                                        @endif

                                        <small class="my-1 text-secondary">{{ $post->timeDifference }}</small>
                                    </div>

                                    {{-- Comments form --}}
                                    <div class="row mt-2">
                                        <hr>
                                        <div class="col-md-11">
                                            <div class="form-outline" data-mdb-input-init>
                                                <input type="text" id="comment-{{ $post->id }}" class="form-control"
                                                    placeholder="leave a comment ..." />
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
            @endforeach
        </div>
    @endsection
    {{-- Profile section --}}
    @section('profile')
        <div class="mt-5">
            {{-- Author profile --}}
            <div class="row">
                <div class="col-md-3">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img (31).webp" class="rounded-circle"
                        height="60" alt="avatar" />
                </div>
                <div class="col-md-9">
                    <ul class="ml-0 ps-1 mt-1 list-unstyled">
                        <li>
                            <p class="ml-3 text-dark mb-0 mt-1">
                                <strong>Billy the goat</strong>
                            </p>
                        </li>
                        <li>
                            <span class="ml-3 text-dark">Bill will</span>
                        </li>
                    </ul>
                </div>
            </div>
            {{-- Suggestions --}}
            <div>
                <small>Suggestion for you</small>
                <span class="float-end text-primary"><small>See All</small></span>
            </div>
            {{-- Suggested users --}}
            <div class="row">
                <div class="col-md-2"><img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img (31).webp"
                        class="rounded-circle mt-2" height="40" alt="avatar" /></div>
                <div class="col-md-8">
                    <ul class="ml-0 ps-1 mt-1 list-unstyled">
                        <li>
                            <small class="user-name"><strong>bill_the_programmer</strong></small>
                        </li>
                        <li>
                            <span class="user-name">Followed by johnyQT</span>
                        </li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <a href="#" class="text-decoration-none ps-3"><small>Follow</small></a>
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

            let savePosts= document.querySelectorAll('.fa-bookmark');
            // console.log(savePosts);
            savePosts.forEach(savePost => {
                savePost.onclick = async function() {
                    const postId=this.getAttribute('data-post-id');
                    const res=await fetch("http://localhost:8000/posts/"+postId+"/save");
                    let resData=await res.json();
                   console.log(resData);
                    
                }
            });
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    @include('posts.create')
    @endsection
