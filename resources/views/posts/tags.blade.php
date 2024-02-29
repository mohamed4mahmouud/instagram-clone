@extends('layouts.profile_layout')

@section('pic')
    <img src="{{Storage :: url($tag->posts[0]->images[0])}}" class="rounded-circle w-100 h-100" alt="Avatar" >
@endsection

@section('username')
{{-- Tag name --}}
    <h1 class="d-inline text-light ms-5">#{{$tag->name}}</h1>
@endsection

@section('profile_content')
    {{-- Add listner for post count --}}
                {{-- Counts --}}
                <ul class="list-inline counts text-light ms-5">
                    <li class="d-inline-block">{{$tag->post_count}}</li>
                    <p>Posts</p>
                    {{-- <li class="d-inline-block"><a href=""></a>followerscount followers</a></li>
                    <li class="d-inline-block">followingcount following</li> --}}
                </ul>
                
                {{-- Follow Button --}}
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Follow</button>
                </div>
                
@endsection

@section('posts')
    @foreach($tag->posts as $post)
    {{-- @foreach($post->images as $image) --}}
    <div class="col-md-4 mb-1 posts">
        <div class="post">
            <a href="" data-bs-target="#exampleModalToggle{{$post->id}}" data-bs-toggle="modal">
                <img src="{{ Storage::url($post->images[0]) }}" alt="{{ $post->caption }}"><div class="overlay"><i class="fa-solid fa-heart"></i>{{ $post->like_count }}  <i class="fa-solid fa-comment"></i> {{ $post->comments_count }}</div>
            </a>
        {{-- <img src="{{ Storage::url($post->images[0]) }}" alt=""> --}}
        </div>

    </div>
    {{-- @endforeach --}}
    @endforeach
    
    @include('posts.create');
@endsection
        {{-- open view posts modal --}}
        @foreach($tag->posts as $post)
        @include('posts.show')
        @endforeach







