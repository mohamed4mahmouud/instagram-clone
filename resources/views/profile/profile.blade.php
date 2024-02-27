@extends('layouts.main')
@section('css')
<style>
    body {
        background-color: #000000; 
        color: #fff; 
    }
    .custom-container {
    max-width: 935px; 
    margin: 0 0 0 350px; 
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
    .posts{
        padding: 0;
    }
    .posts-container{
        padding: 0;
    }
    .post {
    position: relative;
    width: 100%;
    height: auto;
    }

    .overlay {
    font-size: 20px;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    opacity: 0; 
    transition: opacity 0.2s ease;
    display: flex;
    justify-content: center;
    align-items: center;
    }
    .post:hover .overlay {
    opacity: 1;
    color: white
    }
    .overlay .fa-comment {
    margin: 0 0 0 20px;
    }
    .overlay .fa-solid {
    margin-right: 5px; 
    }
    .counts .counts-btn:hover{
        cursor: pointer;
    }
    .counts li:hover{
        background-color: #000000;
    }
    .counts li{
        margin-right: 30px;
    }
    .modal-content{
        background-color: #262626;
    }
    .modal-title{
        margin-left: auto;
    }
    .btn-close{
        margin-left: auto;
    }
    .follower-avatar{
        margin-right: 20px;
    }
    .rm-btn{
        background-color: #464646;
        color: white;
        font-weight: bold;
        margin-left: auto;
    }
</style>

@endsection
@section('newsfeed')
    <div class="container mt-5 custom-container ">
        <div class="row mb-5">
            <div class="col-md-3">
                {{-- Profile Picture --}}
                <img src="{{ asset('storage/' . $profile->avatar) }}" class="w-75 rounded-circle" alt="Avatar">
            </div>
            <div class="col-md-9">
                {{-- Username --}}
                <h1 class="d-inline">{{ $user->userName }}</h1>
                {{-- Edit Profile Button --}}
                @if($user->id == 6)
                    <button class="btn edit-btn ms-5 mb-4">Edit Profile</button>
                @endif
                {{-- Bio --}}
                @if($profile->bio)
                <p>Bio: {{ $profile->bio }}</p>
                @endif
                {{-- Counts --}}
                <ul class="list-inline counts">
                    <li class="d-inline-block">{{ $user->posts_count }} Posts</li>
                    <li class="d-inline-block counts-btn" id="followersBtn" data-bs-toggle="modal" data-bs-target="#followersModal">{{ $user->followers_count }} followers</li>
                    <li class="d-inline-block counts-btn" id="followingBtn" data-bs-toggle="modal" data-bs-target="#followingModal">{{ $user->following_count }} following</li>
                </ul>
                {{-- Website --}}
                @if($profile->website)
                <p>Website: <a href="#">{{ $profile->website }}</a></p>
                @endif
                {{-- Follow Button --}}
                @if($user->id !== 6)
                    @if ($user->isFollowed())
                        <form action="{{ route('unfollow', $user) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Unfollow</button>
                        </form>
                    @else
                        <form action="{{ route('follow', $user) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Follow</button>
                        </form>
                    @endif
                @endif
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
            @if($posts->isEmpty())
                <div class="text-center mt-3">
                    <img src="{{ URL('images/no_posts.png') }}" alt="" class="mt-5">
                    <h1 class="mt-3">No Posts Yet</h1>
                </div>
            @else
            <div class="row mb-1">
                @foreach($posts as $post)
                <div class="col-md-4 mb-1 posts">
                    <div class="post">
                        <a href="#"><img src="{{ Storage::url($post->images[0]) }}" alt="{{ $post->caption }}"><div class="overlay"><i class="fa-solid fa-heart"></i>{{ $post->like_count }}  <i class="fa-solid fa-comment"></i> {{ $post->comments_count }}</div></a>
                    </div>
                </div>
            @endforeach
            </div>
            @endif
        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $posts->links() }}  
        </div>
        <!-- Followers Modal -->
        <div class="modal fade" id="followersModal" tabindex="-1" aria-labelledby="followersModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable  ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="followersModalLabel">Followers</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="max-height: 350px; overflow-y: auto;">
                        @foreach($followers as $follower)
                        {{-- @dd($follower) --}}
                        <div class="person mb-3">
                            <div class="person-info d-flex justify-content-between">
                                <div class="person-container d-inline-block ">
                                    <div class="person-img d-inline-block">
                                        <img src="{{ asset('storage/'. $follower->follower->profile->avatar) }}" alt="Avatar" class="rounded-circle shadow-4 follower-avatar"
                                        style="width: 50px;">
                                    </div>
                                    <div class="person-name d-inline-block">
                                        <a href="{{ route('profile', ['user' => $follower->follower]) }}" class="text-white text-decoration-none">{{ $follower->follower->userName }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Following Modal -->
        <div class="modal fade" id="followingModal" tabindex="-1" aria-labelledby="followingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable  ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="followingModalLabel">Following</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="max-height: 350px; overflow-y: auto;">
                        @foreach($followings as $following)
                        <div class="person mb-3">
                            <div class="person-info d-flex justify-content-between">
                                <div class="person-container d-inline-block ">
                                    <div class="person-img d-inline-block">
                                        <img src="{{ asset('storage/'. $following->followee->profile->avatar) }}" alt="Avatar" class="rounded-circle shadow-4 follower-avatar"
                                        style="width: 50px;">
                                    </div>
                                    <div class="person-name d-inline-block">
                                        <a href="{{ route('profile', ['user' => $following->followee]) }}" class="text-white text-decoration-none">{{ $following->followee->userName }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    @endsection
