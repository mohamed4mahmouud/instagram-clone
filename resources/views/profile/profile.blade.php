@extends('layouts.profile_layout')
@section('pic')
    <img src="{{ Storage::url($profile->avatar) }}" class="w-100 h-100 rounded-circle" alt="Avatar">
@endsection

@section('username')
    <h1 class="d-inline">{{ $user->userName }}</h1>
@endsection

@section('profile_content')
    {{-- Edit Profile Button --}}
    @if($user->id == 17)
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
    @if($user->id !== 17)
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
@endsection

@section('posts_nav')
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
@endsection

@section('posts')
    @foreach($posts as $post)
                    <div class="col-md-4 mb-1 posts">
                        <div class="post">                     
                            <a href="" data-bs-target="#exampleModalToggle2-{{$post->id}}" data-bs-toggle="modal"><img src="{{ Storage::url($post->images[0]) }}" alt="{{ $post->caption }}"><div class="overlay"><i class="fa-solid fa-heart"></i>{{ $post->like_count }}  <i class="fa-solid fa-comment"></i> {{ $post->comments_count }}</div></a>
                        </div>
                    </div>
    @endforeach
 
    
@endsection

@section('pagination')
    <div class="d-flex justify-content-center mt-3">
        {{ $posts->links() }}  
    </div>
@endsection

@section('modal')
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
@endsection
@section('script')
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

{{-- @foreach($posts as $post) --}}
@include('posts.show')

{{-- @endforeach --}}
