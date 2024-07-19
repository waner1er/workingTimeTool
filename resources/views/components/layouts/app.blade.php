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
            <livewire:navlink :name="__('app.welcome')" route="home"/>
            <livewire:navlink :name="__('app.dashboard')" route="dashboard"/>
            <livewire:navlink :name="__('app.app')" route="app"/>
            <x-slot name="secondSlot">
                <livewire:navlink :name="__('logout')" route="logout"/>
            </x-slot>
        </x-nav-menu>
{{--        @livewire('nav-menu', ['data'=> '$data', '$name => 'toto'])--}}

{{--        <livewire:nav-menu />--}}
    </aside>
    <div class="app">
        {{ $slot }}
    </div>
</main>
</body>
</html>
