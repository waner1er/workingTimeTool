<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title></title>
@vite('resources/scss/app.scss')

</head>
<body id="app-layout" class="app-layout">
    <main class="main-app">
        <aside class="main-app__aside">
            <x-nav-menu name="main-app__aside__nav" secondList="true">
                <x-nav-link  route="welcome" name="welcome"></x-nav-link>
                <x-nav-link  route="dashboard" name="dashboard"></x-nav-link>
                <x-nav-link  route="app" name="app"></x-nav-link>
                <x-slot name="secondSlot">
                    <x-nav-link route="logout" name="logout"></x-nav-link>
                </x-slot>
            </x-nav-menu>
        </aside>
        <div class="app">
            {{ $slot }}
        </div>
    </main>
</body>
</html>
