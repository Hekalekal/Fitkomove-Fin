<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nutrition extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit (agar aman)
    protected $table = 'nutritions';

    /**
     * protected $guarded = [];
     * Artinya: Kita mengizinkan semua kolom (food_name, calories, meal_type, date)
     * untuk diisi secara massal melalui Controller.
     */
    protected $guarded = [];

    /**
     * Definisi Relasi:
     * Setiap data Nutrisi pasti "milik" satu User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}