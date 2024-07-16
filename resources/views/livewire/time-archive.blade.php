<div>
    @foreach($user->months() as $month => $weeks)
        <div style="display: flex; justify-content: center ">
            <h1>{{ \Carbon\Carbon::parse($month)->locale(env('APP_LOCALE'))->isoFormat('MMMM YYYY') }}</h1>
        </div>
        @foreach($weeks as $week)
            <div style="display: flex; flex-direction: column; align-items: center;">
                <div style="display: flex; justify-content: space-around;">
                    @foreach($week->days as $day)
                        @if($day->start_morning != "00:00"
                            && $day->end_morning != "00:00"
                            && $day->start_afternoon != "00:00"
                            && $day->end_afternoon != "00:00")
                            <div
                                style="display: flex; flex-direction: column; align-items: center; margin: 10px; padding: 10px; border: 1px solid #000;">
                                <div>
                                    {{ \Carbon\Carbon::parse($day->day_date)->locale(env('APP_LOCALE'))->isoFormat('dddd D MMMM Y') }}
                                    <div>
                                        {{ $day->start_morning }}
                                        {{ $day->end_morning }}
                                        {{ $day->start_afternoon }}
                                        {{ $day->end_afternoon }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
    @endforeach
</div>
