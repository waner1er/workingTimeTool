<?php

namespace App\Livewire;

use App\Models\Day;
use App\Models\Week;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TimeEntryForm extends Component
{
    public $startDate;
    public $endDate;
    public $formattedStartDate;
    public $formattedEndDate;
    public $week;
    public $weeks;
    public $days = [];
    public $selectedWeek;

    public function mount(): void
    {
        $this->startDate = Carbon::now()->format('Y-m-d') ?? '';
        $this->endDate = Carbon::now()->format('Y-m-d') ?? '';
        $this->weekPicker();

    }


    public function weekPicker()
    {
        $this->startDate = Carbon::parse($this->startDate)->startOfWeek()->format('Y-m-d');
        $this->endDate = Carbon::parse($this->endDate)->endOfWeek()->format('Y-m-d');


        $this->week = auth()->user()->weeks->firstWhere('start_date', $this->startDate);

        if (!$this->week) {
            $this->week = new Week;
            $this->week->days = collect(range(0, 6))->map(function () {
                $day = new Day;
                $day->start_morning = '08:00'; // remplacer par vos valeurs par défaut
                $day->end_morning = '12:00';
                $day->start_afternoon = '13:00';
                $day->end_afternoon = '17:00';
                return $day;
            });
        }

        $this->formattedStartDate = Carbon::parse($this->startDate)->translatedFormat('l j F Y');
        $this->formattedEndDate = Carbon::parse($this->endDate)->translatedFormat('l j F Y');
    }




    public function render()
    {
        return view('livewire.time-entry-form');
    }
}
