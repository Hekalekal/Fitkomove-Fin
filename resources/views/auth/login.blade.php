@extends('layouts.app')

@section('content')
<div class="container d-flex align-items-center justify-content-center" style="min-height: 85vh;">
    <div class="col-12 col-md-6 col-lg-4">
        <div class="custom-card p-4 shadow-lg">
            <div class="text-center mb-4">
                <h2 class="text-white fw-bold">MEMBER LOGIN</h2>
                <p class="text-secondary">Welcome back, Athlete!</p>
            </div>
            
            @if ($errors->any())
                <div class="alert alert-danger text-white mb-4 border-0" style="background-color: #e60000;">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label class="text-secondary mb-1">Email Address</label>
                    <input type="email" name="email" class="form-control" 
                           placeholder="name@example.com" value="{{ old('email') }}" required>
                </div>
                
                <div class="mb-4">
                    <label class="text-secondary mb-1">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn btn-red w-100 py-2">LOGIN</button>
            </form>

            <div class="text-center mt-4">
                <p class="text-secondary mb-0">Belum punya akun?</p>
                <a href="{{ route('register') }}" class="text-danger text-decoration-none fw-bold">Daftar Sekarang</a>
            </div>
        </div>
    </div>
</div>
@endsection