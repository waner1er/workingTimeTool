<div>
    <div class="grid">
        <div>
            <input type="date" wire:model="startDate" wire:change="weekPicker">
        </div>
        @if($selectedWeek)
            <h3 class="text-xl	"> Semaine du <span class="font-bold	">{{ $formattedStartDate }}</span> au
                <span
                    class="font-bold	">{{ $formattedEndDate }}</span>
            </h3>
            <div class="grid grid-cols-7">
                @foreach($selectedWeek->days as $day)
                    <div>
                        <h3>{{ $day->getDayName($day->day_index) }}</h3>
                        <input type="time" name="" id="" value="{{$day->start_morning}}">
                        <input type="time" name="" id="" value="{{$day->end_morning}}">
                        <input type="time" name="" id="" value="{{$day->start_afternoon}}">
                        <input type="time" name="" id="" value="{{$day->end_afternoon}}">
                    </div>
                @endforeach
            </div>
        @endif
        <button wire:click="save" class="btn btn-success">Enregistrer</button>
        @if (session('date_success'))
            <div class="alert alert-success">
                {{ session('date_success') }}
            </div>
        @endif
    </div>
</div>
