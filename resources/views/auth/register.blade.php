@extends('layouts.app')

@section('content')
<div class="container d-flex align-items-center justify-content-center" style="min-height: 85vh;">
    <div class="col-12 col-md-6 col-lg-5">
        <div class="custom-card p-4 shadow-lg" style="background-color: #141414; border: 1px solid #333;">
            <div class="text-center mb-4">
                <h2 class="text-white fw-bold">BUAT AKUN BARU</h2>
                <p class="text-secondary">Bergabunglah dengan Fitkomove</p>
            </div>
            
            @if ($errors->any())
                <div class="alert alert-danger border-0 text-white mb-4" style="background-color: #cc0000;">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <div class="mb-3">
                    <label class="text-secondary mb-1">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required placeholder="Nama Anda">
                </div>

                <div class="mb-3">
                    <label class="text-secondary mb-1">Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="nama@email.com">
                </div>
                
                <div class="mb-3">
                    <label class="text-secondary mb-1">Password</label>
                    <input type="password" name="password" class="form-control" required placeholder="Minimal 8 karakter">
                </div>

                <div class="mb-4">
                    <label class="text-secondary mb-1">Ulangi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required placeholder="Ketik ulang password">
                </div>

                <button type="submit" class="btn btn-danger w-100 py-2 fw-bold text-uppercase">Daftar Sekarang</button>
            </form>

            <div class="text-center mt-4">
                <p class="text-secondary mb-0">Sudah punya akun?</p>
                <a href="{{ route('login') }}" class="text-danger text-decoration-none fw-bold">Login Disini</a>
            </div>
        </div>
    </div>
</div>
@endsection