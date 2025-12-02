<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // PENTING: Import Model User agar dikenali

class DashboardController extends Controller
{
    /**
     * Menampilkan Halaman Dashboard
     */
    public function index()
    {
        // Ambil data user yang sedang login
        $user = Auth::user();
        
        // Dummy Data Jadwal (Bisa diganti dengan data dari database nanti)
        $schedules = [
            ['time' => '08:00', 'activity' => 'Lari Pagi', 'status' => 'Selesai'],
            ['time' => '17:00', 'activity' => 'Gym Session', 'status' => 'Pending'],
        ];

        // Dummy Data Rekomendasi
        $recommendations = [
            ['title' => 'Cardio Blast', 'level' => 'Hard', 'duration' => '30 Min'],
            ['title' => 'Yoga Flow', 'level' => 'Easy', 'duration' => '45 Min'],
            ['title' => 'Strength Training', 'level' => 'Medium', 'duration' => '60 Min'],
        ];

        // Kirim semua variabel ke view dashboard
        return view('dashboard', compact('user', 'schedules', 'recommendations'));
    }

    /**
     * Memproses Update Profile
     */
    public function updateProfile(Request $request)
    {
        // 1. Validasi Input agar sesuai aturan database
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'nullable|integer',
            'gender' => 'nullable|string',
            'job' => 'nullable|string',
        ]);

        // 2. Ambil User yang sedang login
        /** @var \App\Models\User $user */ // Baris ini memberitahu VS Code bahwa ini adalah Model User
        $user = Auth::user();
        
        // 3. Update data ke database
        $user->update([
            'name' => $request->name,
            'age' => $request->age,
            'gender' => $request->gender,
            'job' => $request->job,
        ]);

        // 4. Redirect kembali ke dashboard dengan Pesan Sukses
        // Pesan 'success' ini yang akan ditangkap oleh View dashboard.blade.php
        return redirect()->route('dashboard')->with('success', 'Profil berhasil diperbarui!');
    }
}