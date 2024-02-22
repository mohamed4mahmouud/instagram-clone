<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        li:hover {
            background-color: rgb(59, 58, 58)
        }
    </style>
</head>

<body>
    <!-- MDB -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="/"
                        class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <img src="{{ URL('images/logo.png') }}" alt="Instagram logo" height="50">
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto col-lg-12 mb-0 align-items-center align-items-sm-start"
                        id="menu">
                        <li>
                            <a href="#" class="nav-link  align-middle px-0">
                                <i class="fa-solid fa-house fa-lg text-white"></i><span
                                    class="ms-1 d-none d-sm-inline text-white">Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <i class="fa-solid fa-magnifying-glass fa-lg text-white"></i> <span
                                    class="ms-1 d-none d-sm-inline text-white">Search</span> </a>

                        </li>
                        <li>
                            <a href="#" class="nav-link px-0 align-middle">
                                <i class="fa-regular fa-compass pe-1 fa-lg text-white"></i><span
                                    class="ms-1 d-none d-sm-inline text-white">Explore</span></a>
                        </li>
                        <li>
                            <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                <i class="fa-regular fa-heart fa-lg text-white"></i><span
                                    class="ms-1 d-none d-sm-inline text-white">Notifications</span></a>
                        </li>
                        <li>
                            <a href="{{ route('posts.create') }}"class="nav-link px-0 align-middle">
                                <i class="fa-regular fa-square-plus fa-lg text-white"></i> <span
                                    class="ms-1 d-none d-sm-inline text-white">Add Post</span> </a>

                        </li>
                        <li>
                            <a href="#"
                                class="d-flex align-items-center text-white text-decoration-none"
                                id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30"
                                    class="rounded-circle me-2">
                                <span class="d-none d-sm-inline text-white">Profile</span>
                            </a>
                        </li>
                    </ul>
                    <hr>

                </div>
            </div>
            <div class="col py-3">
                Content area...
            </div>
        </div>
    </div>
    <script>
        let listItems = document.querySelectorAll('li')
        listItems.forEach(listitem => {
            listitem.classList.add('nav-item');
            listitem.classList.add('col-lg-12');
            listitem.classList.add('pe-4')
            listitem.classList.add('ps-4')
            listitem.classList.add('mt-4')
            listitem.classList.add('mb-4')
            listitem.classList.add('pt-2')
            listitem.classList.add('pb-2')
            listitem.classList.add('h5')
            listitem.classList.add('rounded')
        });
    </script>
</body>

</html>
