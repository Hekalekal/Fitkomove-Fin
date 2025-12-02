@extends('layouts.app')

@section('content')
<div class="position-relative d-flex align-items-center" style="min-height: 90vh; background-image: url('https://images.unsplash.com/photo-1517836357463-d25dfeac3438?ixlib=rb-4.0.3&w=1920&q=80'); background-size: cover; background-position: center;">
    <div class="position-absolute top-0 start-0 w-100 h-100 hero-overlay"></div>
    
    <div class="container position-relative z-2">
        <div class="row">
            <div class="col-lg-7">
                <h1 class="display-2 fw-bold text-white mb-3" style="line-height: 1;">
                    LIMIT IS JUST AN <span style="color: var(--primary-red);">ILLUSION</span>
                </h1>
                <p class="lead text-light mb-4 w-75">
                    Platform monitoring performa olahraga #1. Pantau detak jantung, jarak lari, dan kalori secara real-time.
                </p>
                <div class="d-flex gap-3">
                    <a href="{{ route('register') }}" class="btn btn-red btn-lg">MULAI SEKARANG</a>
                    <a href="#fitur" class="btn btn-outline-red btn-lg">PELAJARI</a>
                </div>
            </div>
        </div>
    </div>
</div>

<section id="fitur" class="py-5 bg-black">
    <div class="container py-5">
        <div class="row g-4 text-center">
            <div class="col-md-4">
                <div class="custom-card p-4 h-100">
                    <div class="display-4 text-danger mb-3">🔥</div>
                    <h3 class="text-white">Calorie Tracking</h3>
                    <p class="text-secondary">Perhitungan akurat kalori yang terbakar berdasarkan intensitas latihan Anda.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="custom-card p-4 h-100">
                    <div class="display-4 text-danger mb-3">⚡</div>
                    <h3 class="text-white">Real-time Stats</h3>
                    <p class="text-secondary">Data langsung disajikan tanpa delay untuk evaluasi cepat saat latihan.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="custom-card p-4 h-100">
                    <div class="display-4 text-danger mb-3">🏆</div>
                    <h3 class="text-white">Leaderboard</h3>
                    <p class="text-secondary">Bersaing dengan teman dan atlet lain di seluruh dunia.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection