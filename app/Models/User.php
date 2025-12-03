<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// PENTING: Import Model Lain agar dikenali
use App\Models\Workout;
use App\Models\Nutrition;
use App\Models\ProgressLog;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // Kita gunakan guarded kosong agar semua kolom (age, gender, dll) bisa diisi
    protected $guarded = []; 

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

    // --- DEFINISI RELASI KE TABEL LAIN ---

    // Satu User bisa punya BANYAK Workout
    public function workouts() {
        return $this->hasMany(Workout::class);
    }
    
    // Satu User bisa punya BANYAK Catatan Nutrisi
    public function nutritions() {
        return $this->hasMany(Nutrition::class);
    }

    // Satu User bisa punya BANYAK Catatan Progress
    public function progressLogs() {
        return $this->hasMany(ProgressLog::class);
    }
}