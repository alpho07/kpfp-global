<style>
    .nav-link.active {
        font-weight: bold;
        color: #0397D6 !important;
        position: relative;
    }

    .nav-link.active::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -5px;
        width: 100%;
        height: 3px;
        background-color: #0397D6;
        border-radius: 2px;
    }

</style>
<header class="main_menu {{ isset($breadcrumb) ? 'single_page_menu' : 'home_menu' }}" style="background: #fff !important; border-bottom:1px solid #0397D6;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand logo_1" href="{{ route('home') }}">
                        <img src="{{ asset('img/KPFP.png') }}" width="90" height="90" alt="logo">
                        <span style="margin-top: 30px !important; margin-left: 5px !important; color:#4159A4;">
                            Kenya Paediatric Fellowship Program
                        </span>
                    </a>
                    <a class="navbar-brand logo_2" href="{{ route('home') }}">
                        <img src="{{ asset('img/KPFP.png') }}" width="90" height="90" style="border-radius: 50%;" alt="logo">
                        <span style="margin-top: 30px !important; margin-left: 5px !important; color:#4159A4;">
                            Kenya Paediatric Fellowship Program
                        </span>
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse main-menu-item justify-content-end"
                         id="navbarSupportedContent">
                        <ul class="navbar-nav align-items-center">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                            </li>

                            @guest
                            <li class="nav-item">
                                <a style="color:white; margin-left:30px;" class="nav-link btn_4" href="{{ url('login') }}" >Login</a>
                            </li>
                            @endguest

                            @auth
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('enroll.myCourses') ? 'active' : '' }}" href="{{ route('enroll.myCourses') }}">My Scholarships</a>
                            </li>
                            @can('full_menu')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.enrollments.index') ? 'active' : '' }}" href="{{ route('admin.enrollments.index') }}">Admin Area</a>
                            </li>
                            @endcan

                            <!-- Profile Dropdown -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="{{ Auth::user()->profile_photo_url ?? asset('img/user.png') }}"
                                         alt="Profile" width="32" height="32" class="rounded-circle mr-2">
                                    
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="min-width: 250px;">
                                    <div class="dropdown-item-text text-center">
                                        <img src="{{ Auth::user()->profile_photo_url ?? asset('img/default-profile.png') }}"
                                             alt="Profile" width="64" height="64" class="rounded-circle mb-2">
                                        <div><strong>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</strong></div>
                                        <div class="text-muted small">{{ Auth::user()->email }}</div>
                                        <div class="text-muted small">{{ session('institution_name') }}</div>
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('profile.edit',auth()->user()->id) }}">Edit Profile</a>
                                    <a class="dropdown-item" href="#"
                                       onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                                        Logout
                                    </a>
                                    <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endauth
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
