<x-layouts.app-layout>
    {{ Auth::user()->name }}
    {{ Auth::user()->firstname }}

    @livewire('time-entry-form')


</x-layouts.app-layout>
