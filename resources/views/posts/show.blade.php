<style>
    .modal-content {
        background-color: #121212;
    }

    .hash-tag {
        text-decoration: none;
    }
    .fixed-bottom {
    position: fixed;
    bottom: 0;
    /* right: 0; */
    width: 100%;
}
.custom-button {
    border: none;
    background: none;
    padding: 0;
    margin: 0;
    cursor: pointer;
}
</style>

{{-- @foreach ($posts as $post) --}}
<div class="modal fade" id="exampleModalToggle{{ $post->id }}" aria-hidden="true"
    aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-8">
                        {{-- posts image slider --}}
                        <div id="carouselExample{{ $post->id }}" class="carousel slide">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{ Storage::url($post->images[0]) }}" class="d-block w-100"
                                        style="width: 400px; height: 600px;">
                                </div>
                                @if (count($post->images) > 1)
                                    @foreach ($post->images as $index => $img)
                                        @if ($index > 0)
                                            <div class="carousel-item">
                                                <img src="{{ Storage::url($img) }}" class="d-block w-100"
                                                    style="width: 400px; height: 600px;">
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                            @if (count($post->images) > 1)
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExample{{ $post->id }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExample{{ $post->id }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            @endif
                        </div>
                    </div>

                    <div class="col-4" style="position: relative;">
                        <div>
                            <div class="d-flex align-items-center">
                                <div class="pe-3">
                                    @if ($post->user->profile)
                                        <img src="{{ Storage::url($post->user->profile->avatar) }}" alt="profile image"
                                        class="rounded-circle" height="40" width="40" alt="avatar">
                                        <!-- Using the profileImage() method in Profile.php model -->
                                    @endif
                                </div>
                                <div>
                                    <div class="fw-bold d-flex align-items-center">
                                        <a class="text-decoration-none" href="/profile/{{ $post->user->id }}">
                                            <span class="text-light">{{ $post->user->userName }}</span>
                                        </a>
                                        @if($user->id != Auth::id())
                                            @if($user->isFollowed(Auth::id()))

                                        <a href="" class="text-decoration-none ps-3">Following</a>
                                            @else
                                            <form action="{{ route('follow', $user) }}" method="POST">
                                            @csrf
                                        <button type="submit" class=" custom-button text-primary mt-3 ps-3">Follow</button>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div style="position: absolute; right: 0;">
                                    <i class="fa-solid fa-ellipsis me-5" style="color: #ffffff;"></i>
                                </div>
                            </div>
                            {{-- comments section --}}
                            {{-- post caption --}}
                            @if(!empty($post->caption))
                            <hr class="text-light">

                            <div class="d-flex">
                                <div class="pe-3">
                                    @if ($post->user->profile)
                                        <img src="{{ Storage::url($post->user->profile->avatar) }}" alt="profile image"
                                        class="rounded-circle" height="40" width="40" alt="avatar">
                                        <!-- Using the profileImage() method in Profile.php model -->
                                    @endif
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <span class="fw-bold text-light">
                                                <a class="text-decoration-none" href="/profile/{{ $post->user->id }}">
                                                    <span class="text-light">{{ $post->user->userName }}</span>
                                                </a>
                                            </span>
                                            <p class="text-light">
                                                @if ($post->tags->count()==0)
                                                    {{$post->caption}}
                                                @endif
                                                @foreach ($post->tags as $tag)
                                                    <span class="text-light ">
                                                            {!! preg_replace('/#(\w+)/', '<a class="hash-tag" href=" '. route('tags', ['id' => $tag->id] ) .'">$0</a>', $post->caption) !!}
                                                    </span>
                                                @endforeach
                                            </p>
                                        </div>
                                        
                                    </div>

                                    <p class="text-white-50">{{ $post->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            @endif
                            {{-- other comments --}}
                            @if (!empty($post->comments))
                                @foreach ($post->comments as $comment)
                                    <div class="d-flex pt-4">
                                        <div class="pe-3">
                                            <img src="{{ Storage::url($comment->user->profile->avatar) }}"
                                                alt="profile image" class="rounded-circle"
                                                height="40" width="40">
                                            <!-- Using the profileImage() method in Profile.php model -->
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <span class="fw-bold text-light">
                                                        <a class="text-decoration-none"
                                                            href="/profile/{{ $post->user->id }}">
                                                            <span
                                                                class="text-light">{{ $comment->user->userName }}</span>
                                                        </a>
                                                    </span>
                                                    <span class="text-light ms-1">{{ $comment->body }}</span>

                                                </div>
                                                <i class="fa-regular fa-heart fa-sm mt-3" style="color: #ffffff;"></i>
                                            </div>
                                            <p class="text-white-50 mt-2">{{ $post->timeDifference }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                            <div class="fixed-bottom" style="position: absolute; bottom: 0; right: 0;">
                            <hr class="text-light">
                            {{-- Reactions Bar  --}}
                            <div class="card-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <i data-post-id='{{ $post->id }}' data-user-id='{{ Auth::id() }}'
                                                class="fa-regular like fa-heart fa-lg text-white ms-0"></i>
                                            <a href="#comment-{{ $post->id }}"><i
                                                    class="fa-regular fa-comment fa-lg text-white ms-3"></i></a>
                                            <i class="fa-regular fa-paper-plane fa-lg text-white ms-3"></i>
                                        </div>
                                        <div class="col-md-4 text-end">
                                            <i data-post-id={{ $post->id }}
                                                class="fa-regular fa-bookmark text-white"></i>
                                        </div>
                                    </div>
                                    {{-- Liked by --}}
                                    @if ($post->like_count)
                                    @foreach ($post->likes->take(1) as $like)
                                                <div class="mt-4">
                                                <img src="{{Storage::url($post->likes[0]->user->profile->avatar)}}"
                                                    class="rounded-circle" height="40" width="40" alt="avatar" />
                                                        <small class="mt-5">Liked by <strong>
                                                            {{ $like->user->userName }}
                                                        @endforeach

                                                    </strong> {{ $post->like_count - 1 ? 'and' : '' }}
                                                    <strong>{{ $post->like_count - 1 ? $post->like_count - 1 : '' }}</strong>{{ $post->like_count > 1 ? ' others' : '' }}</small>
                                                </div>
                                                @endif
                                </div>
                            </div>
                            {{-- Comments form --}}
                            <hr class="text-light">
                            <div class="row mt-2">
                                <div class="col-md-9">
                                    <div class="form-outline" data-mdb-input-init>
                                        <input type="text" id="comment-{{ $post->id }}"
                                            class="form-control bg-black text-light"
                                            placeholder="leave a comment ..." />
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" data-post-id="{{ $post->id }}"
                                        class="btn post-comment-btn btn-outline-info" data-user-id="{{ Auth::id()}}">Post</button>
                                </div>
                            </div>
                            </div>
                            {{-- end of fixed bar --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
{{-- @endforeach --}}
{{--  --}}

<script>
        window.addEventListener('DOMContentLoaded',function () {
    let likeBtns = document.querySelectorAll(".like")
    console.log(likeBtns);
    likeBtns.forEach(likeBtn => {
        likeBtn.onclick = async function() {
            let res = await fetch('http://localhost:8000/posts/' + likeBtn.getAttribute(
                'data-post-id') + '/like/' + likeBtn.getAttribute('data-user-id'));
            let data = await res.json();
            console.log(data);
        }
    });
    let postComments = document.querySelectorAll('.post-comment-btn')
            postComments.forEach(postComment => {
                postComment.onclick = async function() {
                    const postId = this.getAttribute('data-post-id');
                    const userId = this.getAttribute('data-user-id');
                    const commentBody = document.getElementById('comment-' + postId).value;
                    const url = 'http://localhost:8000/post/'+userId+'/'+postId+'/comment/'+commentBody;
                    const csrf = document.querySelectorAll('meta')[2].getAttribute('content');
                    const res = await fetch(url)
                    let resData = await res.json();
                    console.log(resData);
                }
            });
    let savePosts = document.querySelectorAll('.fa-bookmark');
    savePosts.forEach(savePost => {
        savePost.onclick = async function() {
            const postId = this.getAttribute('data-post-id');
            const res = await fetch("http://localhost:8000/posts/" + postId + "/save");
            let resData = await res.json();
            console.log(resData);

        }
    });
});




</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
{{-- @endsection --}}
