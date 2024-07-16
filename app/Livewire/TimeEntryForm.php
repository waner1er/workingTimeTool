<?php

namespace App\Livewire;

use App\Models\Day;
use App\Models\Week;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TimeEntryForm extends Component
{
    public ?string $week = null;
    public array $entries = [];
    public string $remainingHours;
    public $startDate;
    public $endDate;


    public function mount(): void
    {
        $this->entries = $this->getUserTimes() ? $this->getUserTimes() : $this->getDefaultTimes();
        $this->remainingHours = $this->computeTotalHours($this->entries);
        $this->startDate = Carbon::now()->startOfWeek()->format('Y-m-d');
        $this->endDate = Carbon::now()->endOfWeek()->format('Y-m-d');
    }

    public function updatedStartDate()
    {
        $this->loadWeekSchedule();
    }

    public function updatedEndDate()
    {
        $this->loadWeekSchedule();
    }

    public function loadWeekSchedule()
    {
        $week = Week::where('start_date', $this->startDate)
            ->where('end_date', $this->endDate)
            ->with('days')
            ->first();

        if ($week) {
            foreach ($week->days as $index => $day) {
                $this->entries[$index][0] = $day->start_morning;
                $this->entries[$index][1] = $day->end_morning;
                $this->entries[$index][2] = $day->start_afternoon;
                $this->entries[$index][3] = $day->end_afternoon;
            }
        } else {
            // Reset the entries if no matching week was found
            $this->entries = $this->emptyEntries();
        }
    }
    protected function emptyEntries()
    {
        return [
            ['08:45', '12:00', '13:30', '17:30'], // Lundi
            ['08:45', '12:00', '12:30', '17:00'], // Mardi
            ['08:45', '12:00', '12:30', '17:00'], // Mercredi
            ['08:45', '12:00', '12:30', '17:30'], // Jeudi
            ['08:45', '12:00', '12:30', '16:15'], // Vendredi
            ['00:00', '00:00', '00:00', '00:00'], // Samedi
            ['00:00', '00:00', '00:00', '00:00'], // Dimanche

        ];
    }
    public function updatedEntries(): void
    {
        $this->remainingHours = $this->computeTotalHours($this->entries);
    }


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'startDate' => 'required|date|before:endDate',
            'endDate' => 'required|date|after:startDate',
        ]);
    }


    public function save(): void
    {
        $validatedData = $this->validate([
            'startDate' => 'required|date|before:endDate',
            'endDate' => 'required|date|after:startDate',
        ]);

        try {
            $startDate = \Carbon\Carbon::parse($this->startDate);
            $endDate = \Carbon\Carbon::parse($this->endDate);

            if ($startDate->weekOfYear !== $endDate->weekOfYear) {
                session()->flash('date_error', __('application.validation.same_date'));
                return;
            }
            $week = Week::updateOrCreate([
                'user_id' => auth()->id(),
                'start_date' => $startDate,
                'end_date' => $endDate,
            ]);

            foreach ($this->entries as $dayIndex => $day) {
                $dDate = \Carbon\Carbon::parse($this->startDate)->addDays($dayIndex);
                $dayRecord = Day::updateOrCreate(
                    [
                        'week_id' => $week->id,
                        'day_index' => $dayIndex,
                        'day_date' => $dDate
                    ],
                    [
                        'start_morning' => $day[0],
                        'end_morning' => $day[1],
                        'start_afternoon' => $day[2],
                        'end_afternoon' => $day[3],
                    ]
                );
            }

            session()->flash('date_success', __('application.validation.success'));
        } catch (\Exception $e) {
            session()->flash('date_error', $e->getMessage());
        }
    }

    private function getUserTimes(): array
    {
        $userId = auth()->id();

        // Récupérer la semaine d'utilisateur spécifique
        $week = \App\Models\Week::with('days')
            ->where('user_id', $userId)
            ->where('start_date', $this->week)
            ->first();

        if ($week) {
            // Récupérer les horaires de chaque jour et les retourner
            $times = $week->days->map(function ($day) {
                return [$day->start_morning, $day->end_morning, $day->start_afternoon, $day->end_afternoon];
            })->toArray();

            return $times;
        }

        // Si pas de semaine correspondante trouvé, retourner les horaires par défaut
        return $this->getDefaultTimes();
    }

    private function getDefaultTimes(): array
    {
        return [
            ['08:45', '12:00', '13:30', '17:30'], // Lundi
            ['08:45', '12:00', '12:30', '17:00'], // Mardi
            ['08:45', '12:00', '12:30', '17:00'], // Mercredi
            ['08:45', '12:00', '12:30', '17:30'], // Jeudi
            ['08:45', '12:00', '12:30', '16:15'], // Vendredi
            ['00:00', '00:00', '00:00', '00:00'], // Samedi
            ['00:00', '00:00', '00:00', '00:00'], // Dimanche
        ];
    }

    private function computeTotalHours(array $entries): string
    {
        $totalMinutes = 0;

        foreach ($entries as $day) {
            $morningStart = explode(":", $day[0]);
            $morningEnd = explode(":", $day[1]);
            $afternoonStart = explode(":", $day[2]);
            $afternoonEnd = explode(":", $day[3]);

            // calculate morning and afternoon duration only if it's not a day off (not 00:00)
            if(!($morningStart[0] === $morningEnd[0] && $morningEnd[0] === '00')) {
                $totalMinutes += ($morningEnd[0] * 60 + $morningEnd[1]) - ($morningStart[0] * 60 + $morningStart[1]);
            }
            if(!($afternoonStart[0] === $afternoonEnd[0] && $afternoonEnd[0] === '00')) {
                $totalMinutes += ($afternoonEnd[0] * 60 + $afternoonEnd[1]) - ($afternoonStart[0] * 60 + $afternoonStart[1]);
            }
        }

        // convert total minutes back to hours and minutes
        $totalHours = intdiv($totalMinutes, 60);
        $remainingMinutes = $totalMinutes % 60;

        return sprintf('%02d:%02d', $totalHours, $remainingMinutes);
    }


    public function render()
    {
        return view('livewire.time-entry-form');
    }
}
