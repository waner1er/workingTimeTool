<div>
    @if (session('date_success'))
        <div class="alert alert-success">
            {{ session('date_success') }}
        </div>
    @endif
    <div>
        <label for="startDate">Date de début :</label>
        <input type="date" id="startDate" wire:model.lazy="startDate">
        @error('startDate') <span class="error">{{ $message }}ssss</span> @enderror

        <label for="endDate">Date de fin :</label>
        <input type="date" wire:model.lazy="endDate">
        @error('endDate') <span class="error">{{ $message }}</span> @enderror

        @if (session('date_error'))
            <div class="alert alert-danger">
                {{ session('date_error') }}
            </div>
        @endif
    </div>

    @foreach ($entries as $dayIndex => $day)
        <div>
            <h3>{{ \Carbon\Carbon::now()->startOfWeek()->addDays($dayIndex)->format('l') }}</h3>

            <input type="time" wire:model.lazy="entries.{{$dayIndex}}.0" placeholder="Heure d'entrée">
            <input type="time" wire:model.lazy="entries.{{$dayIndex}}.1" placeholder="Heure de pause du midi">
            <input type="time" wire:model.lazy="entries.{{$dayIndex}}.2" placeholder="Reprise de l'après midi">
            <input type="time" wire:model.lazy="entries.{{$dayIndex}}.3" placeholder="Heure de fin de journée">
        </div>
    @endforeach

    <button wire:click="save">Enregistrer</button>


    <div>
        Heures réalisées :
        @if($remainingHours < 38)
            <span>{{ $remainingHours }}</span>
        @elseif($remainingHours === '38:00')
            <span style="color: #38e438; font-size: 2rem">{{ $remainingHours }}</span>
        @else
            <span style="color: red">{{ $remainingHours }}</span>
        @endif
    </div>
</div>
