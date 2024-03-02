@section('navbar')
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-black border-end border-dark pt-5 fixed-navbar">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="/instagram"
                        class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <img src="{{ URL('images/logo.png') }}" alt="Instagram logo" height="45">
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto col-lg-12 mb-0 align-items-center align-items-sm-start"
                        id="menu">
                        <li>
                            <a href="{{ route('posts.index') }}" class="nav-link align-middle px-0">
                                <i class="fa-solid fa-house fa-lg text-white"></i><span
                                    class="ms-2 d-none d-sm-inline text-white">Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="#submenu1" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling" class="nav-link px-0 align-middle">
                                <i class="fa-solid fa-magnifying-glass fa-lg text-white"></i>
                                <span class="ms-2 d-none d-sm-inline text-white">Search</span> </a>

                        </li>
                        <li>
                            <a href="#" class="nav-link px-0 align-middle">
                                <i class="fa-regular fa-compass pe-1 fa-lg text-white"></i><span
                                    class="ms-2 d-none d-sm-inline text-white">Explore</span></a>
                        </li>
                        <li>
                            <a href="#notificationOffcanvas" data-bs-toggle="offcanvas" class="nav-link px-0 align-middle">
                                <i class="fa-regular fa-bell fa-lg text-white"></i><span class="ms-2 d-none d-sm-inline text-white">Notifications</span>
                            </a>
                        </li>
                        <li>
                            <a href="" id="addPostBtn" class="nav-link px-0 align-middle" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">
                                <i class="fa-regular fa-square-plus fa-lg text-white"></i> <span
                                    class="ms-2 d-none d-sm-inline text-white">Add Post</span> </a>
                                  {{-- <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Open first modal</button> --}}
                                       {{-- @include('posts.create') --}}

                        </li>
                        <li>
                            <a href="{{route('profile',['user'=>Auth::id()])}}" class="d-flex align-items-center text-white text-decoration-none"
                                id="dropdownUser1" aria-expanded="false">
                                <img src="{{Storage::url(Auth::user()->profile->avatar)}}" alt="hugenerd" width="30" height="30"
                                    class="rounded-circle me-2">
                                <span class="d-none d-sm-inline text-white">Profile</span>
                            </a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="text-white">
                                @csrf
                                <button type="submit" class="btn btn-link p-0 text-white text-decoration-none">
                                    <i class="fa-solid fa-sign-out-alt fa-lg me-2"></i>{{ __('Log Out') }}
                                </button>
                            </form>
                        </li>
                    </ul>
                    <hr>

                </div>
            </div>
            {{-- Search Canvas --}}
            <div class="offcanvas offcanvas-start ms-5 px-0 searchbar" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
                id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                <div class="offcanvas-header bg-black ">
                    <h5 class="offcanvas-title text-white" id="offcanvasScrollingLabel">Search</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close" ></button>
                </div>
                <div class="offcanvas-body bg-black ">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control bg-secondary" name="Username" id="Username"
                            placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div id="Searchresult" class="text-white">
                        {{-- Search Result div --}}
                        <hr>
                        <p>Seeking your Instagram doppelgänger? Search away and cross your fingers for a photogenic match! 🔍🤞😄</p>
                    </div>
                </div>
            </div>
            {{-- Notification Canvas --}}
            <div class="offcanvas offcanvas-start ms-5 px-0 notification-modal Notificationbar" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
                id="notificationOffcanvas" aria-labelledby="notificationOffcanvasLabel">
                <div class="offcanvas-header bg-black">
                    <h5 class="offcanvas-title text-white ms-2" id="notificationOffcanvasLabel">Notifications</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body bg-black">
                    <ul class="list-group">
                        @forelse ($user->notifications as $notification)
                            @if(isset($notification->data['like_id']))
                                <li class="list-group-item bg-secondary text-white">{{ ($notification->data['userName']) }} liked your post</li>
                            @elseif(isset($notification->data['comment_id']))
                                <li class="list-group-item bg-secondary text-white">{{ $notification->data['userName'] }} commented on your post</li>
                            @else
                                <li class="list-group-item bg-secondary text-white">No Notification Yet</li>
                            @endif
                            @empty
                            <li class="list-group-item bg-secondary text-white">No Notification Yet</li>
                        @endforelse

                        {{-- @foreach($user->notifications as $notification)
                            <li class="list-group-item bg-secondary text-white">{{ $notification->message }}</li>
                        @endforeach --}}
                    </ul>
                </div>
            </div>
            <script src="{{ asset('js/navbar.js') }}"></script>

            <script>
                let listItems = document.querySelectorAll('li')
                listItems.forEach(listitem => {
                    listitem.classList.add('nav-item');
                    listitem.classList.add('col-lg-12');
                    listitem.classList.add('pe-4')
                    listitem.classList.add('ps-1')
                    listitem.classList.add('mt-4')
                    // listitem.classList.add('mb-4')
                    listitem.classList.add('pt-2')
                    // listitem.classList.add('pb-2')
                    listitem.classList.add('h5')
                    listitem.classList.add('rounded')
                });
            </script>

        @endsection
