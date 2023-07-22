<!DOCTYPE html>
<html lang="en" data-topbar-color="dark">


<!-- Mirrored from coderthemes.com/ubold/layouts/default/auth-signin-signup-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Jul 2023 10:26:04 GMT -->
<head>
    <meta charset="utf-8" />
    <title>Auth Pages | Create Account | Sign In | Ubold - Responsive Bootstrap 5 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <!-- App favicon -->
    @include('auth.layouts.style')
    @yield('style')
</head>

<body class="auth-fluid-pages pb-0">

<div class="auth-fluid">
    <!--Auth fluid left content -->
    @yield('content')
    <!-- end auth-fluid-form-box-->

    <!-- Auth fluid right content -->
    <div class="auth-fluid-right text-center custom-box">
        <img class="background" src="{{asset('assets/images/banner.gif')}}" alt="">
        <div class="auth-user-testimonial">
            <h2 class="mb-3 text-white text-custom">I love the color!</h2>
        </div> <!-- end auth-user-testimonial-->
    </div>
    <!-- end Auth fluid right content -->
</div>
<!-- end auth-fluid-->


<!-- Authentication js -->
@include('auth.layouts.script')
@yield('scripts')
</body>

<!-- Mirrored from coderthemes.com/ubold/layouts/default/auth-signin-signup-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Jul 2023 10:26:04 GMT -->
</html>
