<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title></title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body id="app-layout" data-theme="light">
<main class="main-app container mx-auto min-h-screen">
    @livewire('nav-menu')
    <div class="w-2/3 mx-auto my-12 ">
        {{ $slot }}
    </div>
</main>
</body>
</html>
