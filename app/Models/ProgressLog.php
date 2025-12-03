<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressLog extends Model
{
    use HasFactory;

    /**
     * protected $guarded = [];
     * Artinya: Kita mengizinkan SEMUA kolom (weight, waist, date)
     * untuk diisi secara massal melalui Controller.
     */
    protected $guarded = [];

    /**
     * Definisi Relasi:
     * Setiap catatan progress pasti "milik" satu User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}