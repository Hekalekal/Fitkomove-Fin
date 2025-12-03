<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    use HasFactory;

    /**
     * protected $guarded = [];
     * Artinya: Kita mengizinkan SEMUA kolom (activity, duration, calories, date)
     * untuk diisi secara massal melalui Controller.
     */
    protected $guarded = [];

    /**
     * Definisi Relasi:
     * Setiap data Workout pasti "milik" satu User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}