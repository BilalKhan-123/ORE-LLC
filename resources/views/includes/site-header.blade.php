<header id="header" class="header sticky-top">

    <div class="topbar d-flex align-items-center">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="d-none d-md-flex align-items-center">
                <i class="bi bi-clock me-1"></i> {{ __('messages.monday_hours') }}
            </div>
            @php
                $phones = [];

                if (!empty($data['contacts']->phone_1)) {
                    $phones[] = $data['contacts']->phone_1;
                }
                if (!empty($data['contacts']->phone_2)) {
                    $phones[] = $data['contacts']->phone_2;
                }
                if (!empty($data['contacts']->phone_3)) {
                    $phones[] = $data['contacts']->phone_3;
                }
            @endphp

            <div class="d-flex align-items-center">
            <i class="bi bi-phone me-1"></i> {{ __('messages.call_us') }} {{ !empty($phones) ? implode(' | ', $phones) : __('messages.phone_number') }}

            </div>
            <div class="d-flex align-items-center ms-3 px-5">
                <div class="dropdown">
                   
                    
                    @auth
                        <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                         <a target="__BLANK" href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-info">
                            <i class="bi bi-person-circle"></i> Dashboard
                        </a>
                    @else
                         <button class="btn btn-sm btn-outline-info dropdown-toggle" type="button" id="langDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ strtoupper(app()->getLocale()) }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="langDropdown">
                            <li><a class="dropdown-item" href="{{ route('lang.switch', 'en') }}">English</a></li>
                            <li><a class="dropdown-item" href="{{ route('lang.switch', 'de') }}">Deutsch</a></li>
                        </ul>
                        <a href="{{ route('admin.login') }}" class="btn btn-sm btn-outline-info">
                            <i class="bi bi-person-circle"></i> {{ __('messages.admin_login') }}
                        </a>
                    @endauth


                </div>
            </div>
        </div>
    </div><!-- End Top Bar -->

    <div class="branding d-flex align-items-center">
        <div class="container position-relative d-flex align-items-center justify-content-end">
            <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
            <img style="height: 100px" src="{{ asset(siteLogo()) }}" alt="">
            <!-- Uncomment the line below if you also wish to use a text logo -->
            <!-- <h1 class="sitename">Medicio</h1>  -->
            </a>

            <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ route('home') }}" class="active">{{ __('messages.home') }}</a></li>
                <li><a href="{{ route('site.about') }}">{{ __('messages.about') }}</a></li>
                <li><a href="{{ route('site.services') }}">{{ __('messages.services') }}</a></li>
                <li><a href="{{ route('site.departments') }}">{{ __('messages.departments') }}</a></li>
                {{-- <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                    <li><a href="#">Dropdown 1</a></li>
                    <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="#">Deep Dropdown 1</a></li>
                        <li><a href="#">Deep Dropdown 2</a></li>
                        <li><a href="#">Deep Dropdown 3</a></li>
                        <li><a href="#">Deep Dropdown 4</a></li>
                        <li><a href="#">Deep Dropdown 5</a></li>
                    </ul>
                    </li>
                    <li><a href="#">Dropdown 2</a></li>
                    <li><a href="#">Dropdown 3</a></li>
                    <li><a href="#">Dropdown 4</a></li>
                </ul>
                </li> --}}
                <li><a href="{{ route('site.contact') }}">{{ __('messages.contact') }}</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
        </div>
    </div>

</header>