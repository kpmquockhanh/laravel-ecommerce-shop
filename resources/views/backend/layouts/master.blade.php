<!DOCTYPE html>
<html lang="en">

<head>
    @yield('style')
    @include('backend.layouts.header')
    <title>
        @yield('title', 'Watch shop')
    </title>
</head>
<body class="">
    <div class="wrapper ">
        @include('backend.layouts.sidebar')
        <div class="main-panel">
            <!-- Navbar -->
            @include('backend.layouts.navbar')
            <!-- End Navbar -->

            @yield('content')
            @include('backend.layouts.footer')
        </div>
    </div>
@yield('script')
</body>
</html>
