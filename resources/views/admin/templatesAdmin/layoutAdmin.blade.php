<!DOCTYPE html>
<html lang="en" data-topbar-color="dark">


<!-- Mirrored from coderthemes.com/ubold/layout/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Jul 2023 10:24:12 GMT -->
<head>
    <meta charset="utf-8"/>
    <title>Dashboard | Ubold - Responsive Bootstrap 5 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
    <meta content="Coderthemes" name="author"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('link')



    <!-- Plugins css -->
    <link href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/libs/selectize/css/selectize.bootstrap3.css')}}" rel="stylesheet" type="text/css"/>

    <!-- Theme Config Js -->
    <script src="{{asset('assets/js/head.js')}}"></script>
    <!-- Bootstrap css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" id="app-style"/>

    <!-- App css -->
    <link href="{{asset('assets/css/app.css')}}" rel="stylesheet" type="text/css" id="app-style"/>

    <!-- Icons css -->
{{--    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" id="app-style"/>--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<style>
    @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css");
</style>
<body>
<!-- Begin page -->
<div id="wrapper">
    <!-- ========== Menu ========== -->
    <div class="app-menu">

        <!-- Brand Logo -->
        <div class="logo-box">
            <!-- Brand Logo Light -->
            <a href="{{route('admin')}}" class="logo-light">
                <img src="{{asset('assets/images/logo-light.png')}}" alt="logo" class="logo-lg">
                <img src="{{asset('assets/images/logo-sm.png')}}" alt="small logo" class="logo-sm">
            </a>
            <!-- Brand Logo Dark -->
            <a href="{{route('admin')}}" class="logo-dark">
                <img src="{{asset('assets/images/logo-dark.png')}}" alt="dark logo" class="logo-lg">
                <img src="{{asset('assets/images/logo-light.png')}}" alt="small logo" class="logo-sm">
            </a>
        </div>
        <!-- menu-left -->
        <div class="scrollbar">
            <!-- User box -->
            <div class="user-box text-center">
                <img src="{{asset('assets/images/logo-light.png')}}" alt="user-img"
                     title="Mat Helme" class="rounded-circle avatar-md">
                <div class="dropdown">
                    <a href="javascript: void(0);" class="dropdown-toggle h5 mb-1 d-block" data-bs-toggle="dropdown">Geneva
                        Kennedy</a>
                    <div class="dropdown-menu user-pro-dropdown">

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-user me-1"></i>
                            <span>My Account</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-settings me-1"></i>
                            <span>Settings</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-lock me-1"></i>
                            <span>Lock Screen</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-log-out me-1"></i>
                            <span>Logout</span>
                        </a>

                    </div>
                </div>
                <p class="text-muted mb-0">Admin Head</p>
            </div>

            <!--- Menu -->
            <ul class="menu">
                <li class="menu-title">Navigation</li>
                <li class="menu-item">
                    <a href="#menuDashboards" data-bs-toggle="collapse" class="menu-link">
                        <span class="menu-icon"><i data-feather="airplay"></i></span>
                        <span class="menu-text"> Sản phẩm </span>
                    </a>
                    <div class="collapse" id="menuDashboards">
                        <ul class="sub-menu">
                            <li class="menu-item">
                                <a href="{{route('product.index')}}" class="menu-link">
                                    <span class="menu-text">Danh sách sản phẩm</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{route('color.index')}}" class="menu-link">
                                    <span class="menu-text">Thuộc tính mằu sắc</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{route('size.index')}}" class="menu-link">
                                    <span class="menu-text">Thuộc tính kích cỡ</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="menu-title">Apps</li>

                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <span class="menu-icon"><i data-feather="calendar"></i></span>
                        <span class="menu-text"> thuộc tính </span>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="#menuProjects" data-bs-toggle="collapse" class="menu-link">
                        <span class="menu-icon"><i data-feather="briefcase"></i></span>
                        <span class="menu-text"> Thương hiệu </span>
                    </a>
                    <div class="collapse" id="menuProjects">
                        <ul class="sub-menu">
                            <li class="menu-item">
                                <a href="{{route('route.brands.list')}}" class="menu-link">
                                    <span class="menu-text">danh sách Thương hiệu</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{route('route.brands.list')}}" class="menu-link">
                                    <span class="menu-text">Thêm Thương hiệu</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="menu-item">
                    <a href="#menuTasks" data-bs-toggle="collapse" class="menu-link">
                        <span class="menu-icon"><i data-feather="clipboard"></i></span>
                        <span class="menu-text"> Tasks </span>
                        <!-- <span class="menu-arrow"></span> -->
                    </a>
                    <div class="collapse" id="menuTasks">
                        <ul class="sub-menu">
                            <li class="menu-item">
                                <a href="#" class="menu-link">
                                    <span class="menu-text">List</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="menu-item">
                    <a href="#menuContacts" data-bs-toggle="collapse" class="menu-link">
                        <span class="menu-icon"><i data-feather="book"></i></span>
                        <span class="menu-text"> Contacts </span>
                        <!-- <span class="menu-arrow"></span> -->
                    </a>
                    <div class="collapse" id="menuContacts">
                        <ul class="sub-menu">
                            <li class="menu-item">
                                <a href="#" class="menu-link">
                                    <span class="menu-text">Members List</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="menu-item">
                    <a href="#menuTickets" data-bs-toggle="collapse" class="menu-link">
                        <span class="menu-icon"><i data-feather="aperture"></i></span>
                        <span class="menu-text"> Tickets </span>
                        <!-- <span class="menu-arrow"></span> -->
                    </a>
                    <div class="collapse" id="menuTickets">
                        <ul class="sub-menu">
                            <li class="menu-item">
                                <a href="#" class="menu-link">
                                    <span class="menu-text">List</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="menu-item">
                    <a href="#menuTrush" data-bs-toggle="collapse" class="menu-link">
                        <span class="menu-icon"><i class="bi bi-trash"></i></span>
                        <span class="menu-text"> Thùng rác </span>
                        <!-- <span class="menu-arrow"></span> -->
                    </a>
                    <div class="collapse" id="menuTrush">
                        <ul class="sub-menu">
                            <li class="menu-item">
                                <a href="{{route('route.brands.trash')}}" class="menu-link">
                                    <span class="menu-text">Thương hiệu</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="#" class="menu-link">
                                    <span class="menu-text">Sản phẩm</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="#" class="menu-link">
                                    <span class="menu-text">Thuộc tính</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
            <!--- End Menu -->
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- ========== Left menu End ========== -->


    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">

        <!-- ========== Topbar Start ========== -->
        <div class="navbar-custom">
            <div class="topbar">
                <div class="topbar-menu d-flex align-items-center gap-1">

                    <!-- Topbar Brand Logo -->
                    <div class="logo-box">
                        <!-- Brand Logo Light -->
                        <a href="index.html" class="logo-light">
                            <img src="{{asset('assets/images/logo-light.png')}}" alt="logo" class="logo-lg">
                            <img src="{{asset('assets/images/logo-sm.png')}}" alt="small logo" class="logo-sm">
                        </a>

                        <!-- Brand Logo Dark -->
                        <a href="index.html" class="logo-dark">
                            <img src="{{asset('assets/images/logo-dark.png')}}" alt="dark logo" class="logo-lg">
                            <img src="{{asset('assets/images/logo-sm.png')}}" alt="small logo" class="logo-sm">
                        </a>
                    </div>

                    <!-- Sidebar Menu Toggle Button -->
                    <button class="button-toggle-menu">

                        <i class="bi bi-list"></i>
                    </button>

                </div>

                <ul class="topbar-menu d-flex align-items-center">
                    <!-- Topbar Search Form -->
                    <li class="app-search dropdown me-3 d-none d-lg-block">
                        <form>
                            <input type="search" class="form-control rounded-pill" placeholder="Search..."
                                   id="top-search">
                            <span class="search-icon font-22">
                                        <i class="bi bi-search"></i>
                                    </span>

                        </form>

                    </li>

                    <!-- Fullscreen Button -->
                    <li class="d-none d-md-inline-block">
                        <a class="nav-link waves-effect waves-light" href="#" data-toggle="fullscreen">
                            <!-- <i class="fe-maximize font-22"></i> -->
                            <i class="bi bi-arrows-fullscreen font-22"></i>
                        </a>
                    </li>

                    <!-- Search Dropdown (for Mobile/Tablet) -->
                    <li class="dropdown d-lg-none">
                        <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none"
                           data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="ri-search-line font-22"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                            <form class="p-3">
                                <input type="search" class="form-control" placeholder="Search ..."
                                       aria-label="Recipient's username">
                            </form>
                        </div>
                    </li>

                    <!-- App Dropdown -->
                    <li class="dropdown d-none d-md-inline-block">
                        <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none"
                           data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="bi bi-grid font-22"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg p-0">

                            <div class="p-2">
                                <div class="row g-0">
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="{{asset('assets/images/brands/slack.png')}}" alt="slack">
                                            <span>Slack</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="{{asset('assets/images/brands/github.png')}}" alt="Github">
                                            <span>GitHub</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="{{asset('assets/images/brands/dribbble.png')}}" alt="dribbble">
                                            <span>Dribbble</span>
                                        </a>
                                    </div>
                                </div>

                                <div class="row g-0">
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="{{asset('assets/images/brands/bitbucket.png')}}" alt="bitbucket">
                                            <span>Bitbucket</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="{{asset('assets/images/brands/dropbox.png')}}" alt="dropbox">
                                            <span>Dropbox</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="{{asset('assets/images/brands/g-suite.png')}}" alt="G Suite">
                                            <span>G Suite</span>
                                        </a>
                                    </div>
                                </div> <!-- end row-->
                            </div>
                        </div>
                    </li>

                    <!-- Language flag dropdown  -->
                    <li class="dropdown d-none d-md-inline-block">
                        <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none"
                           data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="{{asset('assets/images/flags/russia.jpg')}}" alt="user-image" class="me-0 me-sm-1"
                                 height="18">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated">
                            <!-- item-->
{{--                            <a href="javascript:void(0);" class="dropdown-item">--}}
{{--                                <img src="{{asset('assets/images/flags/germany.jpg')}}" alt="user-image" class="me-1"--}}
{{--                                     height="12"> <span class="align-middle">German</span>--}}
{{--                            </a>--}}
                        </div>
                    </li>

                    <!-- Notofication dropdown -->

                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none"
                           data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="bi bi-bell font-22"></i>
                            <span class="badge bg-danger rounded-circle noti-icon-badge">0</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg py-0">
                            <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0 font-16 fw-semibold"> Notification</h6>
                                    </div>
                                    <div class="col-auto">
                                        <a href="javascript: void(0);" class="text-dark text-decoration-underline">
                                            <small>Clear All</small>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="px-1" style="max-height: 300px;" data-simplebar="init">
                                <div class="simplebar-wrapper" style="margin: 0px -6px;">
                                    <div class="simplebar-height-auto-observer-wrapper">
                                        <div class="simplebar-height-auto-observer"></div>
                                    </div>
                                    <div class="simplebar-mask">
                                        <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                            <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                                 aria-label="scrollable content"
                                                 style="height: auto; overflow: hidden;">
                                                <div class="simplebar-content" style="padding: 0px 6px;">
                                                    <!-- item-->
                                                    <!-- item-->
                                                    <!-- item-->
                                                    <!-- item-->
                                                    <!-- item-->
                                                    <div class="text-center">
                                                        <i class="mdi mdi-dots-circle mdi-spin text-muted h3 mt-0"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div>
                                </div>
                                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                    <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                                </div>
                                <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                                    <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
                                </div>
                            </div>

                            <!-- All-->
                            <a href="javascript:void(0);"
                               class="dropdown-item text-center text-primary notify-item border-top border-light py-2">
                                View All
                            </a>

                        </div>
                    </li>
                    <!-- Light/Darj Mode Toggle Button -->
                    <li class="d-none d-sm-inline-block">
                        <div class="nav-link waves-effect waves-light" id="light-dark-mode">
                            <i class="bi bi-moon font-22"></i>
                        </div>
                    </li>

                    <!-- User Dropdown -->
                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light"
                           data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            @if(session('user_avatar'))
                                <img src="{{session('user_avatar')}}" alt="user-image" class="rounded-circle">
                            @else
                                <img src="{{asset('assets/images/flags/spain.jpg')}}" alt="user-image" class="rounded-circle">
                            @endif
                            <span class="ms-1 d-none d-md-inline-block">
                                {{ Auth::user()->name }} <i class="bi bi-chevron-bar-down"></i>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                            <!-- item-->
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome !</h6>
                            </div>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="bi bi-person"></i>
                                <span>My Account</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="bi bi-gear"></i>
                                <span>Settings</span>
                            </a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="bi bi-lock"></i>
                                <span>Lock Screen</span>
                            </a>

                            <div class="dropdown-divider"></div>

                            <!-- item-->
{{--                            <a href="javascript:void(0);" class="dropdown-item notify-item">--}}
{{--                                <i class="bi bi-box-arrow-right"></i>--}}
{{--                                <span>Logout</span>--}}
{{--                            </a>--}}
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-responsive-nav-link :href="route('logout')"
                                                       onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-responsive-nav-link>
                            </form>

                        </div>
                    </li>

                    <!-- Right Bar offcanvas button (Theme Customization Panel) -->
                    <li>
                        <a class="nav-link waves-effect waves-light" data-bs-toggle="offcanvas"
                           href="#theme-settings-offcanvas">
                            <!-- <i class="fe-settings font-22"></i> -->
                            <i class="bi bi-gear font-22"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- ========== Topbar End ========== -->

        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">


                @yield('content')


            </div> <!-- container -->

        </div> <!-- content -->

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div>
{{--                            <script>document.write(new Date().getFullYear())</script>--}}
                            © Ubold - <a href="https://coderthemes.com/" target="_blank">Coderthemes.com</a></div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-none d-md-flex gap-4 align-item-center justify-content-md-end footer-links">
                            <a href="javascript: void(0);">About</a>
                            <a href="javascript: void(0);">Support</a>
                            <a href="javascript: void(0);">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->
</div>
<!-- Vendor js -->
<script src="{{asset('assets/js/vendor.min.js')}}"></script>
<!-- App js -->
<script src="{{asset('assets/js/app.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


<!-- Dashboar 1 init js-->
{{--<script src="{{asset('assets/js/pages/dashboard-1.init.js')}}"></script>--}}


<!-- Datatables init -->
{{--<script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>--}}


@yield('js')

</body>
</html>

