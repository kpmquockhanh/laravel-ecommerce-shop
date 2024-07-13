<!DOCTYPE html>
<html lang="en">

<head>
    @include('backend.layouts.header')
    @yield('style')

    <title>{{ config('app.name') }}</title>
</head>
<body class="">
<div class="wrapper">
    @include('backend.layouts.sidebar')
    <div class="main-panel">
        <!-- Navbar -->
        @include('backend.layouts.navbar')
        <!-- End Navbar -->
        @yield('content')
        @include('backend.layouts.footer')
        @yield('script')
    </div>
</div>

</body>
</html>
