<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Hours extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'id',
            'user_id',
            'morning_hours',
            'afternoon_hours',
            'created_at',
            'updated_at'
        ];


    function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


}
