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
    .counts li:hover{
        background-color: #000000;
        cursor: pointer;
    }
    .counts li{
        margin-right: 30px;
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
                <button class="btn edit-btn ms-5 mb-4">Edit Profile</button>
                {{-- Bio --}}
                @if($profile->bio)
                <p>Bio: {{ $profile->bio }}</p>
                @endif
                {{-- Counts --}}
                <ul class="list-inline counts">
                    <li class="d-inline-block">{{ $user->posts_count }} Posts</li>
                    <li class="d-inline-block"><a href=""></a>{{ $user->followers_count }} followers</a></li>
                    <li class="d-inline-block">{{ $user->following_count }} following</li>
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
            <div class="row mb-1">
                @foreach($posts as $post)
                <div class="col-md-4 mb-1 posts">
                    <div class="post">
                        <a href="#"><img src="{{$post->images }}" alt="{{ $post->caption }}"><div class="overlay"><i class="fa-solid fa-heart"></i>{{ $post->like_count }}  <i class="fa-solid fa-comment"></i> {{ $post->comments_count }}</div></a>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $posts->links() }}  
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
