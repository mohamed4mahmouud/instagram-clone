@extends('layouts.main')

@section('css')
<style>
    body {
        background-color: #000000; 
        color: #fff; 
    }
    .custom-container {
    max-width: 935px; 
    margin: 0 0 0 280px; 
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
    @yield('css2')
</style>
@endsection

@section('newsfeed')
    <div class="container mt-5 custom-container ">
        <header class="row mb-5">
            <div class="col-md-3" style="width: 230px; height:200px;">
                {{-- Profile Picture --}}
                @yield('pic')
            </div>
            <div class="col-md-9">
                {{-- Username --}}
                @yield('username')
                @yield('profile_content')
            </div>
        </header>
        @yield('posts_nav')
        {{-- Posts --}}
        <div class="container posts-container">
            @if($posts->isEmpty())
                <div class="text-center mt-3">
                    <img src="{{ URL('images/no_posts.png') }}" alt="" class="mt-5">
                    <h1 class="mt-3">No Posts Yet</h1>
                </div>
            @else
            <div class="row mb-1">
                @yield('posts')
            </div>
            @endif
        </div>
        @yield('pagination')
        @yield('modal')
    </div>
    @yield('script')
@endsection
