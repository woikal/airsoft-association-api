<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Airsoft Vereinsverzeichnis</title>

    @googlefonts

    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
</head>
<body>
<header>
    <h1>@yield('title')</h1>

    @hasSection('subtitle')
        <p class="subtitle">@yield('subtitle')</p>
    @endif
</header>

<main>
    @hasSection('content')
        @yield('content')
    @else
        Oops - No content section found!
    @endif
</main>

</body>
</html>