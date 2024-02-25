        @section('navbar')
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-black border-end border-secondary pt-5">
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
                            <a href="#" class="d-flex align-items-center text-white text-decoration-none"
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
        @endsection
 