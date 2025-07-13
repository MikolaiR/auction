@if($admin)
<div class="app-header header sticky">
    <div class="container-fluid main-container">
      <div class="d-flex">
        <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar"
          href="javascript:void(0)"></a>
        <!-- sidebar-toggle-->

        <a class="logo-horizontal " href="index.html">
          <img src="/assets/images/bg/header-logo2.png" class="header-brand-img desktop-logo" alt="logo">
          <img src="/assets/images/bg/header-logo2.png" class="header-brand-img light-logo1" alt="logo">
        </a>
        <!-- LOGO -->
        <form action="{{route('admin.search')}}" class="main-header-center ms-3 d-none d-lg-block">
          <input type="text" class="form-control" id="typehead" placeholder="{{ __('Search here...') }}" name="q" autocomplete="off" value="{{request()->q}}">
          <button type="submit" class="btn px-0 pt-2"><i class="fa-regular fa-magnifying-glass" aria-hidden="true"></i></button>
        </form>
        <div class="d-flex order-lg-2 ms-auto header-right-icons">
          <!-- SEARCH -->
          <button class="navbar-toggler navresponsive-toggler d-lg-none ms-auto" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4"
            aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon fa-solid fa-ellipsis-vertical"></span>
          </button>
          <div class="navbar navbar-collapse responsive-navbar p-0">
            <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
              <div class="d-flex order-lg-2">
                <div class="dropdown d-lg-none d-flex">
                  <a href="javascript:void(0)" class="nav-link icon" data-bs-toggle="dropdown">
                    <i class="fa-regular fa-magnifying-glass"></i>
                  </a>
                  <div class="dropdown-menu header-search dropdown-menu-start">
                    <div class="input-group w-100 p-2">
                      <input type="text" class="form-control" placeholder="{{ __('Search here...') }}">
                      <div class="input-group-text btn btn-primary">
                        <i class="fa-regular fa-search" aria-hidden="true"></i>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- LANGUAGE DROPDOWN -->
                <div class="dropdown d-flex">
                  <a class="nav-link icon" data-bs-toggle="dropdown">
                    <i class="fa-light fa-globe"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <div class="drop-heading border-bottom">
                      <div class="d-flex">
                        <h6 class="mt-1 mb-0 fs-16 fw-semibold text-dark">{{ __('Language') }}</h6>
                      </div>
                    </div>
                    <a class="dropdown-item d-flex" href="{{ route('language.switch', 'en') }}">
                      <div class="d-flex">
                        <span class="my-auto">{{ __('English') }}</span>
                      </div>
                    </a>
                    <a class="dropdown-item d-flex" href="{{ route('language.switch', 'ru') }}">
                      <div class="d-flex">
                        <span class="my-auto">{{ __('Russian') }}</span>
                      </div>
                    </a>
                  </div>
                </div>
                <!-- FULL-SCREEN -->
                <div class="dropdown  d-flex notifications">
                  <a class="nav-link icon" data-bs-toggle="dropdown">
                    <i class="fa-light fa-bell"></i>
                    <span class="pulse"></span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <div class="drop-heading border-bottom">
                      <div class="d-flex">
                        <h6 class="mt-1 mb-0 fs-16 fw-semibold text-dark">Notifications
                        </h6>
                      </div>
                    </div>
                    <div class="notifications-menu">
                      <a class="dropdown-item d-flex" href="notify-list.html">
                        <div class="me-3 notifyimg  bg-primary brround box-shadow-primary">
                          <i class="fe fe-mail"></i>
                        </div>
                        <div class="mt-1 wd-80p">
                          <h5 class="notification-label mb-1">New Application received
                          </h5>
                          <span class="notification-subtext">3 days ago</span>
                        </div>
                      </a>
                      <a class="dropdown-item d-flex" href="notify-list.html">
                        <div class="me-3 notifyimg  bg-secondary brround box-shadow-secondary">
                          <i class="fe fe-check-circle"></i>
                        </div>
                        <div class="mt-1 wd-80p">
                          <h5 class="notification-label mb-1">Project has been
                            approved</h5>
                          <span class="notification-subtext">2 hours ago</span>
                        </div>
                      </a>
                      <a class="dropdown-item d-flex" href="notify-list.html">
                        <div class="me-3 notifyimg  bg-success brround box-shadow-success">
                          <i class="fe fe-shopping-cart"></i>
                        </div>
                        <div class="mt-1 wd-80p">
                          <h5 class="notification-label mb-1">Your Product Delivered
                          </h5>
                          <span class="notification-subtext">30 min ago</span>
                        </div>
                      </a>
                      <a class="dropdown-item d-flex" href="notify-list.html">
                        <div class="me-3 notifyimg bg-pink brround box-shadow-pink">
                          <i class="fe fe-user-plus"></i>
                        </div>
                        <div class="mt-1 wd-80p">
                          <h5 class="notification-label mb-1">Friend Requests</h5>
                          <span class="notification-subtext">1 day ago</span>
                        </div>
                      </a>
                    </div>
                    <div class="dropdown-divider m-0"></div>
                    <a href="notify-list.html" class="dropdown-item text-center p-3 text-muted">View all
                      Notification</a>
                  </div>
                </div>
                <!-- SIDE-MENU -->
                <x-profile-avatar-card />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@else
<header class="container-fluid py-2">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="/assets/images/bg/header-logo2.png" alt="logo" class="img-fluid">
            </a>
            
            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" 
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Main Navigation Content -->
            <div class="collapse navbar-collapse" id="navbarContent">
                <!-- Main Menu Links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">{{ __('Home') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('how-it-works') }}">{{ __('How It Works') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('live-auction') }}">{{ __('Live Auction') }}</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="companyDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            {{ __('Company') }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="companyDropdown">
                            <li><a class="dropdown-item" href="{{ route('about') }}">{{ __('About') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('contact') }}">{{ __('Contact') }}</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('blog.index') }}">{{ __('Blog') }}</a>
                    </li>
                </ul>
                
                <!-- Mobile Only Search Form -->
                <div class="d-lg-none d-block mb-3">
                    <form class="d-flex" method="GET">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="{{ __('Search here...') }}" value="{{ request()->q ?? '' }}">
                            <button class="btn btn-primary" type="submit">{{ __('Search') }}</button>
                        </div>
                    </form>
                    <div class="mt-3 p-2 border-top">
                        <small class="d-block">{{ __('Click To Call') }}</small>
                        <h6><a href="tel:347-274-8816" class="text-decoration-none">+347-274-8816</a></h6>
                    </div>
                </div>
                
                <!-- Right Side Navigation Items -->
                <div class="d-flex align-items-center">
                    <!-- Search Button & Dropdown -->
                    <div class="dropdown d-none d-lg-block">
                        <button class="btn btn-link" type="button" id="searchDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-search"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end p-3" aria-labelledby="searchDropdown" style="min-width: 300px;">
                            <form method="GET">
                                <div class="input-group">
                                    <input type="text" name="q" class="form-control" placeholder="{{ __('Search here...') }}" value="{{ request()->q ?? '' }}">
                                    <button class="btn btn-primary" type="submit">{{ __('Search') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Add Listing Button -->
                    <a href="{{ route('add-listing') }}" class="btn btn-primary btn-sm mx-2">{{ __('Add Listing') }}</a>
                    
                    <!-- Auth Buttons -->
                    @guest('web')
                        <a href="{{ route('user.login') }}" class="btn btn-primary btn-sm mx-1">{{ __('Login') }}</a>
                        <a href="{{ route('user.register') }}" class="btn btn-outline-primary btn-sm mx-1">{{ __('Register') }}</a>
                    @endguest
                    
                    @auth
                        <div class="dropdown">
                            <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="userDropdown"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                {{ __('My Account') }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="{{ route('user.dashboard') }}">{{ __('Dashboard') }}</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('user.logout.handle') }}" method="POST" class="px-2">
                                        @csrf
                                        <button type="submit" class="dropdown-item d-flex align-items-center">
                                            <svg width="16" height="16" viewBox="0 0 22 22" class="me-2" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_382_377)">
                                                    <path d="M21.7273 10.4732L19.3734 8.81368C18.9473 8.51333 18.3574 8.81866 18.3574 9.34047V12.6595C18.3574 13.1834 18.9485 13.4856 19.3733 13.1863L21.7272 11.5268C22.0916 11.2699 22.0906 10.7294 21.7273 10.4732Z"></path>
                                                    <path d="M18.4963 15.1385C18.1882 14.9603 17.7939 15.0655 17.6156 15.3737C16.1016 17.9911 13.2715 19.7482 10.0374 19.7482C5.21356 19.7482 1.28906 15.8237 1.28906 11C1.28906 6.17625 5.21356 2.25171 10.0374 2.25171C13.2736 2.25171 16.1025 4.0105 17.6156 6.62617C17.7938 6.93434 18.1882 7.03949 18.4962 6.86138C18.8043 6.68315 18.9096 6.28887 18.7314 5.98074C16.9902 2.97053 13.738 0.962646 10.0374 0.962646C4.48967 0.962646 0 5.45184 0 11C0 16.5477 4.48919 21.0373 10.0374 21.0373C13.7396 21.0373 16.9909 19.028 18.7315 16.0191C18.9097 15.711 18.8044 15.3168 18.4963 15.1385Z"></path>
                                                    <path d="M7.05469 10.3555C6.69873 10.3555 6.41016 10.644 6.41016 11C6.41016 11.356 6.69873 11.6445 7.05469 11.6445H17.0677V10.3555H7.05469Z"></path>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_382_377">
                                                        <rect width="22" height="22"></rect>
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                            {{ __('Logout') }}
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endauth
                </div>
            </div>
            <div class="dropdown d-flex me-2 position-static position-lg-relative">
              <a class="nav-link" href="#" data-bs-toggle="dropdown">
                  <i class="fa-light fa-globe"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg-end w-auto" style="min-width: 120px; max-width: 200px;">
                  <a class="dropdown-item" href="{{ route('language.switch', 'en') }}">
                      {{ __('English') }}
                  </a>
                  <a class="dropdown-item" href="{{ route('language.switch', 'ru') }}">
                      {{ __('Russian') }}
                  </a>
              </div>
        </div>
    </nav>
</header>
@endif
