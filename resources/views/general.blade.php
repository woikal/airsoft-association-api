<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Kugerlschubser.at</title>

    @googlefonts

    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
</head>

<body>
<header class="site-header">
    <div class="container site-menu">
        <a href="{{ route('dashboard.new') }}" class="menu-item">Team hinzufügen</a>
        <a href="{{ route('extract.index') }}" class="menu-item">ZVR Laden</a>
        <a href="{{ route('parse') }}" class="menu-item">Parse</a>
    </div>
</header>

<main class="site-main">
    <div class="container">
        <h1>@yield('title')</h1>

        @hasSection('subtitle')
            <p class="subtitle">@yield('subtitle')</p>
        @endif

        @hasSection('content')
            @yield('content')
        @else
            Oops - No content section found!
        @endif
    </div>
</main>

<footer class="site-footer">
    <div class="container">
        Footer
    </div>
</footer>
</body>
</html>
