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

        .heartbox {
            position: sticky;
            display: inline;
            /* top: 10%; */
            left: 20%;
            transform: translate(-50%, -50%)
        }

        svg {
            cursor: pointer;
            overflow: visible;
            width: 45px;
            padding-bottom: 5px;
            /* margin: 20px */
        }

        svg #heart {
            transform-origin: center;
            animation: animateHeartOut .3s linear forwards
        }

        svg #main-circ {
            transform-origin: 29.5px 29.5px
        }

        .checkbox {
            display: none
        }

        .checkbox:checked+label svg #heart {
            transform: scale(0.2);
            fill: #E2264D;
            animation: animateHeart .3s linear forwards .25s
        }

        .checkbox:checked+label svg #main-circ {
            transition: all 2s;
            animation: animateCircle .3s linear forwards;
            opacity: 1
        }

        .checkbox:checked+label svg #heartgroup1 {
            opacity: 1;
            transition: .1s all .3s
        }

        .checkbox:checked+label svg #heartgroup1 #heart1 {
            transform: scale(0) translate(0, -30px);
            transform-origin: 0 0 0;
            transition: .5s transform .3s
        }

        .checkbox:checked+label svg #heartgroup1 #heart2 {
            transform: scale(0) translate(10px, -50px);
            transform-origin: 0 0 0;
            transition: 1.5s transform .3s
        }

        .checkbox:checked+label svg #heartgroup2 {
            opacity: 1;
            transition: .1s all .3s
        }

        .checkbox:checked+label svg #heartgroup2 #heart1 {
            transform: scale(0) translate(30px, -15px);
            transform-origin: 0 0 0;
            transition: .5s transform .3s
        }

        .checkbox:checked+label svg #heartgroup2 #heart2 {
            transform: scale(0) translate(60px, -15px);
            transform-origin: 0 0 0;
            transition: 1.5s transform .3s
        }

        .checkbox:checked+label svg #heartgroup3 {
            opacity: 1;
            transition: .1s all .3s
        }

        .checkbox:checked+label svg #heartgroup3 #heart1 {
            transform: scale(0) translate(30px, 0px);
            transform-origin: 0 0 0;
            transition: .5s transform .3s
        }

        .checkbox:checked+label svg #heartgroup3 #heart2 {
            transform: scale(0) translate(60px, 10px);
            transform-origin: 0 0 0;
            transition: 1.5s transform .3s
        }

        .checkbox:checked+label svg #heartgroup4 {
            opacity: 1;
            transition: .1s all .3s
        }

        .checkbox:checked+label svg #heartgroup4 #heart1 {
            transform: scale(0) translate(30px, 15px);
            transform-origin: 0 0 0;
            transition: .5s transform .3s
        }

        .checkbox:checked+label svg #heartgroup4 #heart2 {
            transform: scale(0) translate(40px, 50px);
            transform-origin: 0 0 0;
            transition: 1.5s transform .3s
        }

        .checkbox:checked+label svg #heartgroup5 {
            opacity: 1;
            transition: .1s all .3s
        }

        .checkbox:checked+label svg #heartgroup5 #heart1 {
            transform: scale(0) translate(-10px, 20px);
            transform-origin: 0 0 0;
            transition: .5s transform .3s
        }

        .checkbox:checked+label svg #heartgroup5 #heart2 {
            transform: scale(0) translate(-60px, 30px);
            transform-origin: 0 0 0;
            transition: 1.5s transform .3s
        }

        .checkbox:checked+label svg #heartgroup6 {
            opacity: 1;
            transition: .1s all .3s
        }

        .checkbox:checked+label svg #heartgroup6 #heart1 {
            transform: scale(0) translate(-30px, 0px);
            transform-origin: 0 0 0;
            transition: .5s transform .3s
        }

        .checkbox:checked+label svg #heartgroup6 #heart2 {
            transform: scale(0) translate(-60px, -5px);
            transform-origin: 0 0 0;
            transition: 1.5s transform .3s
        }

        .checkbox:checked+label svg #heartgroup7 {
            opacity: 1;
            transition: .1s all .3s
        }

        .checkbox:checked+label svg #heartgroup7 #heart1 {
            transform: scale(0) translate(-30px, -15px);
            transform-origin: 0 0 0;
            transition: .5s transform .3s
        }

        .checkbox:checked+label svg #heartgroup7 #heart2 {
            transform: scale(0) translate(-55px, -30px);
            transform-origin: 0 0 0;
            transition: 1.5s transform .3s
        }

        .checkbox:checked+label svg #heartgroup2 {
            opacity: 1;
            transition: .1s opacity .3s
        }

        .checkbox:checked+label svg #heartgroup3 {
            opacity: 1;
            transition: .1s opacity .3s
        }

        .checkbox:checked+label svg #heartgroup4 {
            opacity: 1;
            transition: .1s opacity .3s
        }

        .checkbox:checked+label svg #heartgroup5 {
            opacity: 1;
            transition: .1s opacity .3s
        }

        .checkbox:checked+label svg #heartgroup6 {
            opacity: 1;
            transition: .1s opacity .3s
        }

        .checkbox:checked+label svg #heartgroup7 {
            opacity: 1;
            transition: .1s opacity .3s
        }

        .heartbox svg #heart {
            transform-origin: center;
            animation: animateHeartOut .3s cubic-bezier(0.68, -0.55, 0.27, 1.55) forwards;
        }

        .checkbox:checked+label svg #heartgroup1 #heart1,
        .checkbox:checked+label svg #heartgroup1 #heart2,
        /* Add similar rules for other heart groups */
            {
            transform: scale(0.5) translate(0, -30px);
            transform-origin: 0 0 0;
            transition: 0.5s transform 0.3s;
        }

        @keyframes animateCircle {
            40% {
                transform: scale(10);
                opacity: 1;
                fill: #DD4688
            }

            55% {
                transform: scale(11);
                opacity: 1;
                fill: #D46ABF
            }

            65% {
                transform: scale(12);
                opacity: 1;
                fill: #CC8EF5
            }

            75% {
                transform: scale(13);
                opacity: 1;
                fill: transparent;
                stroke: #CC8EF5;
                stroke-width: .5
            }

            85% {
                transform: scale(17);
                opacity: 1;
                fill: transparent;
                stroke: #CC8EF5;
                stroke-width: .2
            }

            95% {
                transform: scale(18);
                opacity: 1;
                fill: transparent;
                stroke: #CC8EF5;
                stroke-width: .1
            }

            100% {
                transform: scale(19);
                opacity: 1;
                fill: transparent;
                stroke: #CC8EF5;
                stroke-width: 0
            }
        }

        @keyframes animateHeart {
            0% {
                transform: scale(0.2)
            }

            40% {
                transform: scale(1.2)
            }

            100% {
                transform: scale(1)
            }
        }

        @keyframes animateHeartOut {
            0% {
                transform: scale(1.4)
            }

            100% {
                transform: scale(1)
            }
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
                                                <img src="{{Storage::url($post->user->profile->avatar) }}" class="rounded-circle"
                                                    height="40" alt="avatar" />
                                                <div class="mt-2">
                                                    <a href="{{ route('profile', ['user' => $post->user->id]) }}"
                                                        class="text-white">
                                                        <strong
                                                            class="strong mt-5 ms-2">{{ $post->user->userName }}</strong>
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
                                        @if ($i == 0)
                                            <div class="carousel-item active">
                                                <img src="{{ Storage::url($post->images[0]) }}" class="d-block w-100"
                                                    style="width: 400px; height: 600px;">
                                            </div>
                                        @endif
                                        @if ($i > 0)
                                            <div class="carousel-item">
                                                <img src="{{ Storage::url($post->images[$i]) }}" class="d-block w-100"
                                                    style="width: 400px; height: 600px;">
                                            </div>
                                        @endif
                                    @endfor
                                </div>
                                @if (count($post->images) > 1)
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                                        data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                                        data-bs-slide="next">
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
                                            <div class="heartbox">
                                                <input type="checkbox" data-post-id='{{ $post->id }}'
                                                    data-user-id='{{ $user->id }}' class="checkbox" class="checkbox"
                                                    id="checkbox-{{ $post->id }}" />
                                                <label for="checkbox-{{ $post->id }}">
                                                    <svg id="heart-svg" viewBox="467 392 58 57"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g id="Group" fill="none" fill-rule="evenodd"
                                                            transform="translate(467 392)">
                                                            <path
                                                                d="M29.144 20.773c-.063-.13-4.227-8.67-11.44-2.59C7.63 28.795 28.94 43.256 29.143 43.394c.204-.138 21.513-14.6 11.44-25.213-7.214-6.08-11.377 2.46-11.44 2.59z"
                                                                id="heart" fill="#AAB8C2" />
                                                            <circle id="main-circ" fill="#E2264D" opacity="0"
                                                                cx="29.5" cy="29.5" r="1.5" />
                                                            <g id="heartgroup7" opacity="0" transform="translate(7 6)">
                                                                <circle id="heart1" fill="#9CD8C3" cx="2"
                                                                    cy="6" r="2" />
                                                                <circle id="heart2" fill="#8CE8C3" cx="5"
                                                                    cy="2" r="2" />
                                                            </g>
                                                            <g id="heartgroup6" opacity="0" transform="translate(0 28)">
                                                                <circle id="heart1" fill="#CC8EF5" cx="2"
                                                                    cy="7" r="2" />
                                                                <circle id="heart2" fill="#91D2FA" cx="3"
                                                                    cy="2" r="2" />
                                                            </g>
                                                            <g id="heartgroup3" opacity="0"
                                                                transform="translate(52 28)">
                                                                <circle id="heart2" fill="#9CD8C3" cx="2"
                                                                    cy="7" r="2" />
                                                                <circle id="heart1" fill="#8CE8C3" cx="4"
                                                                    cy="2" r="2" />
                                                            </g>
                                                            <g id="heartgroup2" opacity="0"
                                                                transform="translate(44 6)">
                                                                <circle id="heart2" fill="#CC8EF5" cx="5"
                                                                    cy="6" r="2" />
                                                                <circle id="heart1" fill="#CC8EF5" cx="2"
                                                                    cy="2" r="2" />
                                                            </g>
                                                            <g id="heartgroup5" opacity="0"
                                                                transform="translate(14 50)">
                                                                <circle id="heart1" fill="#91D2FA" cx="6"
                                                                    cy="5" r="2" />
                                                                <circle id="heart2" fill="#91D2FA" cx="2"
                                                                    cy="2" r="2" />
                                                            </g>
                                                            <g id="heartgroup4" opacity="0"
                                                                transform="translate(35 50)">
                                                                <circle id="heart1" fill="#F48EA7" cx="6"
                                                                    cy="5" r="2" />
                                                                <circle id="heart2" fill="#F48EA7" cx="2"
                                                                    cy="2" r="2" />
                                                            </g>
                                                            <g id="heartgroup1" opacity="0" transform="translate(24)">
                                                                <circle id="heart1" fill="#9FC7FA" cx="2.5"
                                                                    cy="3" r="2" />
                                                                <circle id="heart2" fill="#9FC7FA" cx="7.5"
                                                                    cy="2" r="2" />
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </label>
                                            </div>
                                            <a href="#comment-{{ $post->id }}"><i
                                                    data-comment-form-id='{{ $post->id }}'
                                                    class="fa-regular fa-comment fa-lg text-white ms-2 me-2"></i></a>
                                            <i class="fa-regular fa-paper-plane fa-lg text-white ms-2"></i>
                                        </div>
                                        <div class="col-md-4 text-end">
                                            <i data-post-id="{{ $post->id }}"
                                                class="fa-regular fa-bookmark text-white"></i>
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
                                                <input type="text" id="comment-{{ $post->id }}"
                                                    class="form-control" placeholder="leave a comment ..." />
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
                    <img src="{{ Storage::url($user->profile->avatar) }}" class="rounded-circle" height="50"
                        alt="avatar" />
                </div>
                <div class="col-md-9">
                    <ul class="ml-0 ps-1 mt-1 list-unstyled">
                        <li>
                            <p class="ml-3 text-secondary text-opacity-70 mb-0 mt-1">
                                <strong>{{ $user->userName }}</strong>
                            </p>
                        </li>
                        <li>
                            <span class="ml-3 text-secondary text-opacity-70">{{ $user->fullName }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            {{-- Suggestions --}}
            <div class="text-secondary text-opacity-70">
                <bold>Suggestion for you</bold>
                <span class="float-end text-primary"><small>See All</small></span>
            </div>
            {{-- Suggested users --}}
            <div class="row">
                <div class="col-md-2"><img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img (31).webp"
                        class="rounded-circle mt-2" height="40" alt="avatar" /></div>
                <div class="col-md-8">
                    <ul class="ml-0 ps-1 mt-1 ms-2 list-unstyled">
                        <li>
                            <small
                                class="user-name text-secondary text-opacity-70"><strong>bill_the_programmer</strong></small>
                        </li>
                        <li>
                            <span class="user-name text-secondary text-opacity-70">Followed by johnyQT</span>
                        </li>
                    </ul>
                </div>
                <div class="col-md-2 mt-3">
                    <a href="#" class="text-decoration-none ps-3"><small>Follow</small></a>
                </div>

            </div>

        </div>
        <script>
            let likeBtns = document.querySelectorAll(".checkbox")
            likeBtns.forEach(likeBtn => {
                likeBtn.onclick = async function() {
                    let res = await fetch('http://localhost:8000/posts/' + likeBtn.getAttribute(
                        'data-post-id') + '/like/' + likeBtn.getAttribute('data-user-id'));
                    let data = await res.json();

                    console.log(data);

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

            let savePosts = document.querySelectorAll('.fa-bookmark');
            // console.log(savePosts);
            savePosts.forEach(savePost => {
                savePost.onclick = async function() {
                    const postId = this.getAttribute('data-post-id');
                    const res = await fetch("http://localhost:8000/posts/" + postId + "/save");
                    let resData = await res.json();
                    console.log(resData);

                }
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
    @include('posts.create')
    @endsection
