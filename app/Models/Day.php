<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Day extends Model
{
    use HasFactory;

    protected $fillable = ['day_index','day_date','start_morning', 'end_morning', 'start_afternoon', 'end_afternoon', 'week_id'];

    public function weeks()
    {
        return $this->belongsTo(Week::class);
    }

    public function getDayName($index) {
        $days = [
            0 => 'Lundi',
            1 => 'Mardi',
            2 => 'Mercredi',
            3 => 'Jeudi',
            4 => 'Vendredi',
            5 => 'Samedi',
            6 => 'Dimanche',
        ];

        return $days[$index] ?? 'Index non valide';
    }
}
