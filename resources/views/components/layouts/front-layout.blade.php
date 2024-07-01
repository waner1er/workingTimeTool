<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/scss/front.scss')
    <title></title>

</head>
<body>
<div>
    <ul>
            <x-nav-link  route="welcome" name="welcome"></x-nav-link>
        @auth()
            <x-nav-link  route="dashboard" name="dashboard"></x-nav-link>
        @endauth
    </ul>
    <ul>
            @auth()
            <x-nav-link  route="logout" name="logout"></x-nav-link>
            @endauth
            @guest()
                    <x-nav-link  route="login" name="login"></x-nav-link>
            @endguest
    </ul>
</div>
{{ $slot }}
</body>
</html>
