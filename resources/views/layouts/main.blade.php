<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf_token" content="{{csrf_token()}}">
    <title>Instagram</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="{{asset('css/navbar.css')}}">
    <link rel="icon" href="{{url('/images/instagramfavicon.png')}}">
    <style>
        body {
            overflow-x: hidden;
        }
        li:hover {
            background-color: rgb(59, 58, 58);
            padding-bottom: 5px;
        }
        .page-content {
            margin-left: 250px;
        }
        .page-content1{
            margin-left: 350px;
        }
        .fixed-navbar {
                    position: fixed;
                    top: 0;
                    left: 0;
                    z-index: 2000;
                }
                .searchbar{
                    position: fixed;
                    top: 0;
                    left: 0;
                    z-index: 2200;
                }
                .form-control {
        background-color: #262626;
        color: #fff;
        border: 1px solid #2f3136;
    }

    .btn-primary {
        background-color: #0095f6;
        color: #fff;
        border: 1px solid #0095f6;
    }

    .btn-primary:hover {
        background-color: #007bb5;
        border: 1px solid #007bb5;
    }
    #avatarimg {
        border-radius: 50%;
        overflow: hidden;
        width: 70px;
        height: 70px;
        object-fit: cover;
    }
    .userimg {
        background-color: #262626;
        border-radius: 15px;
        padding-top: 10px;
        padding-bottom: 10px;
        width: 77%;
    }
    .usrname {
        font-weight: bold;
    }
    #website {
        color: #9d9d9d;
    }
    #website::placeholder {
        color: #9d9d9d;
    }
    #bio {
        border: 1px solid #2f2f2f;
        background-color: #121212;
        color: #9d9d9d;
    }
    #bio::placeholder {
        color: #9d9d9d;
    }
    .accounts {
        background-color: #262626;
        border-radius: 15px;
        padding-top: 10px;
        padding-bottom: 10px;
        width: 22%;
        height: 200px;
        padding: 20px;
        margin-left: -100px;
    }
    .text-gray {
    color: gray;
    transition: color 0.3s ease; 
}

.text-gray:hover {
    color: #cfcece;
}
    </style>
    @yield('css')
</head>

<body class="bg-black">
    <!-- MDB -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            @section('navbar')
                @include('components.instagram-navbar')
            @show
            <div class="col-md-7 page-content">
                @yield('stories')
                @yield('newsfeed')

            </div>
        </div>
        <div class="col-md-2 d-md-none d-lg-block">
            @yield('profile')
        </div>
    </div>
{{-- @yield('script') --}}
</body>

</html>
