<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Kpm Shop v2</title>

    <meta charset="utf-8">
    <!--[if IE]>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">

    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700%7COpen+Sans:400,400i,600,700'
          rel='stylesheet'>

    <!-- Css -->
    <link rel="stylesheet" href="{{ asset('/css/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/font-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/sliders.css') }}" />
    @vite('resources/v2/css/bootstrap.min.css')
    @vite('resources/v2/css/sass/style.scss')
    @vite('resources/scss/all.scss')


    <!-- Favicons -->
    {{--    <link rel="shortcut icon" href="img/favicon.ico">--}}
    {{--    <link rel="apple-touch-icon" href="img/apple-touch-icon.png">--}}
    {{--    <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png">--}}
    {{--    <link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.png">--}}
</head>

<body class="antialiased relative">
<div id="app"></div>
@vite('resources/js/app.js')
<script type="text/javascript" src="{{ asset('/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/plugins.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/scripts.js') }}"></script>
</body>
</html>
