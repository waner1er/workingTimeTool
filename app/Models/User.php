<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function months()
    {
        return $this->weeks
            ->sortBy('start_date')
            ->groupBy(function($week) {
                return \Carbon\Carbon::parse($week->start_date)->format('Y-m');
            });
    }

    public function weeks(): HasMany
    {
        return $this->hasMany(Week::class);
    }

    function getIsAdminAttribute(): bool
    {
        return $this->attributes['is_admin'];
    }

    function setIsAdminAttribute(bool $value): void
    {
        $this->attributes['is_admin'] = $value;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if ($this->getIsAdminAttribute() === true) {
            return true;
        }
        return false;
    }

}
