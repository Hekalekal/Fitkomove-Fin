<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

// PENTING: Import semua Model yang sudah kita buat
use App\Models\User;
use App\Models\Workout;
use App\Models\Nutrition;
use App\Models\ProgressLog;

class DashboardController extends Controller
{
    /**
     * Menampilkan Halaman Dashboard dengan Semua Data
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $today = Carbon::today();

        // 1. Ambil Data Latihan & Makan HARI INI
        $todaysWorkouts = $user->workouts()->whereDate('date', $today)->get();
        $todaysNutrition = $user->nutritions()->whereDate('date', $today)->get();
        
        // 2. Hitung Total Kalori (Masuk vs Keluar)
        $totalCaloriesIn = $todaysNutrition->sum('calories');
        $totalCaloriesOut = $todaysWorkouts->sum('calories');

        // 3. Ambil Data Progress (7 Hari Terakhir) untuk Grafik
        $progressRaw = $user->progressLogs()
                             ->orderBy('date', 'asc')
                             ->take(7)
                             ->get();

        // Siapkan Data untuk Grafik Chart.js
        // Kita format tanggalnya agar rapi (contoh: "12 Dec")
        $chartLabels = $progressRaw->map(function ($log) {
            return Carbon::parse($log->date)->format('d M');
        })->toArray();

        $chartData = $progressRaw->pluck('weight')->toArray();

        return view('dashboard', compact(
            'user', 
            'todaysWorkouts', 
            'todaysNutrition', 
            'totalCaloriesIn', 
            'totalCaloriesOut', 
            'progressRaw',
            'chartLabels',
            'chartData'
        ));
    }

    // --- LOGIKA MENYIMPAN DATA (CREATE) ---

    public function storeWorkout(Request $request)
    {
        // Validasi input sederhana
        $request->validate([
            'activity' => 'required',
            'duration' => 'required|integer',
            'calories' => 'required|integer'
        ]);

        Workout::create([
            'user_id' => Auth::id(),
            'activity' => $request->activity,
            'duration' => $request->duration,
            'calories' => $request->calories,
            'date' => $request->date ?? Carbon::today(),
        ]);

        return back()->with('success', 'Latihan berhasil dicatat! Semangat 🔥');
    }

    public function storeNutrition(Request $request)
    {
        $request->validate([
            'food_name' => 'required',
            'calories' => 'required|integer'
        ]);

        Nutrition::create([
            'user_id' => Auth::id(),
            'food_name' => $request->food_name,
            'calories' => $request->calories,
            'meal_type' => $request->meal_type,
            'date' => $request->date ?? Carbon::today(),
        ]);

        return back()->with('success', 'Makanan berhasil dicatat! Jaga nutrisimu 🥗');
    }

    public function storeProgress(Request $request)
    {
        $request->validate([
            'weight' => 'required|numeric',
            'date' => 'required|date'
        ]);

        ProgressLog::create([
            'user_id' => Auth::id(),
            'weight' => $request->weight,
            'waist' => $request->waist,
            'date' => $request->date,
        ]);

        return back()->with('success', 'Progress tubuh berhasil diupdate! 📈');
    }

    // --- LOGIKA MENGHAPUS DATA (DELETE) ---
    
    public function destroyEntity($type, $id)
    {
        // Cek tipe data apa yang mau dihapus
        if ($type == 'workout') {
            Workout::where('id', $id)->where('user_id', Auth::id())->delete();
        }
        
        if ($type == 'nutrition') {
            Nutrition::where('id', $id)->where('user_id', Auth::id())->delete();
        }
        
        return back()->with('success', 'Data berhasil dihapus.');
    }

    // --- UPDATE PROFILE ---

    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        $user->update([
            'name' => $request->name,
            'age' => $request->age,
            'gender' => $request->gender,
            'job' => $request->job,
            'target_weight' => $request->target_weight,
            'fitness_goal' => $request->fitness_goal,
        ]);
        
        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}