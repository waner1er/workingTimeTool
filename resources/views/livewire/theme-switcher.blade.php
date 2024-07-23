<div>
    <select id="theme_switcher" class="select select-bordered w-full max-w-xs"
            wire:change="changeActiveTheme($event.target.value)">
        <option value="{{ $activeTheme }}" disabled selected>{{$activeTheme}}</option>
        @foreach($themes as $theme)
            <option value="{{$theme}}">{{$theme}}</option>
        @endforeach
    </select>
</div>
