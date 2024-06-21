<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="noindex">
    <link rel="icon" href="">
    <link rel="apple-touch-icon" sizes="152x152" href="">
    <link rel="apple-touch-icon" sizes="167x167" href="">
    <link rel="apple-touch-icon" sizes="180x180" href="">
    <meta name="description" content="">
    <meta property="og:title" content="{{ config('app.name') }}" />
    <meta property="og:description" content="" />
    <meta property="og:url" content="" />
    <meta property="og:locale" content="fr_FR" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="" />
    <meta property="og:image:secure_url" content="" />
    <meta property="og:image:width" content="" />
    <meta property="og:image:height" content="" />
    <meta property="og:site_name" content="{{ config('app.name') }}" />
    <title>@hasSection('title')@yield('title') - @endif {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div>
        @yield('content')
    </div>
</body>
</html>
