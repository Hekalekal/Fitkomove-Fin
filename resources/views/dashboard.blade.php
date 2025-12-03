@extends('layouts.app')

@section('title', 'Dashboard - Fitkomove')

@section('content')
<!-- Library Grafik Chart.js (Wajib Ada) -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container py-5">

    <!-- Header Dashboard -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="text-white fw-bold mb-0" style="font-family: 'Teko', sans-serif; letter-spacing: 1px;">DASHBOARD SAYA</h2>
            <p class="text-secondary mb-0">Halo, <span class="text-danger fw-bold">{{ $user->name }}</span>! Ayo capai targetmu hari ini.</p>
        </div>
        <!-- Tombol Logout -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-outline-danger btn-sm rounded-0 fw-bold" style="border-width: 2px;">LOGOUT</button>
        </form>
    </div>

    <!-- Alert Notifikasi Sukses -->
    @if (session('success'))
        <div class="alert alert-success border-0 text-white mb-4 shadow d-flex align-items-center" style="background-color: #198754;">
            <i class="bi bi-check-circle-fill me-2 fs-5"></i> 
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        
        <!-- SIDEBAR MENU (KIRI) -->
        <div class="col-lg-3">
            <div class="custom-card p-3 h-100 shadow-sm">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist">
                    <!-- 1. Tombol Overview -->
                    <button class="nav-link active text-start mb-2" id="tab-overview" data-bs-toggle="pill" data-bs-target="#content-overview" type="button">
                        <i class="bi bi-grid-1x2-fill me-2"></i> Ringkasan
                    </button>
                    
                    <!-- 2. Tombol Workout -->
                    <button class="nav-link text-start mb-2" id="tab-workout" data-bs-toggle="pill" data-bs-target="#content-workout" type="button">
                        <i class="bi bi-activity me-2"></i> Latihan (Workout)
                    </button>
                    
                    <!-- 3. Tombol Nutrition -->
                    <button class="nav-link text-start mb-2" id="tab-nutrition" data-bs-toggle="pill" data-bs-target="#content-nutrition" type="button">
                        <i class="bi bi-egg-fried me-2"></i> Nutrisi & Makanan
                    </button>
                    
                    <!-- 4. Tombol Progress -->
                    <button class="nav-link text-start mb-2" id="tab-progress" data-bs-toggle="pill" data-bs-target="#content-progress" type="button">
                        <i class="bi bi-graph-up-arrow me-2"></i> Grafik Progress
                    </button>
                    
                    <!-- 5. Tombol Profile -->
                    <button class="nav-link text-start" id="tab-profile" data-bs-toggle="pill" data-bs-target="#content-profile" type="button">
                        <i class="bi bi-person-gear me-2"></i> Edit Profil
                    </button>
                </div>
            </div>
        </div>

        <!-- KONTEN UTAMA (KANAN) -->
        <div class="col-lg-9">
            <div class="tab-content" id="v-pills-tabContent">
                
                <!-- 1. TAB OVERVIEW (RINGKASAN) -->
                <div class="tab-pane fade show active" id="content-overview">
                    <div class="row g-3">
                        <!-- Kartu Kalori Masuk -->
                        <div class="col-md-6">
                            <div class="custom-card p-4 text-center border-success position-relative overflow-hidden" style="border-width: 2px;">
                                <div class="position-absolute top-0 end-0 p-3 text-success opacity-25"><i class="bi bi-plus-circle-fill fs-1"></i></div>
                                <h5 class="text-secondary text-uppercase small fw-bold">Kalori Masuk (Makan)</h5>
                                <!-- Menggunakan ?? 0 agar tidak error jika variabel null -->
                                <h1 class="display-4 fw-bold text-success my-2">{{ $totalCaloriesIn ?? 0 }}</h1>
                                <small class="text-muted">kcal</small>
                            </div>
                        </div>
                        <!-- Kartu Kalori Keluar -->
                        <div class="col-md-6">
                            <div class="custom-card p-4 text-center border-danger position-relative overflow-hidden" style="border-width: 2px;">
                                <div class="position-absolute top-0 end-0 p-3 text-danger opacity-25"><i class="bi bi-dash-circle-fill fs-1"></i></div>
                                <h5 class="text-secondary text-uppercase small fw-bold">Kalori Keluar (Latihan)</h5>
                                <h1 class="display-4 fw-bold text-danger my-2">{{ $totalCaloriesOut ?? 0 }}</h1>
                                <small class="text-muted">kcal</small>
                            </div>
                        </div>
                    </div>

                    <!-- List Aktivitas Hari Ini -->
                    <div class="mt-4 custom-card p-4">
                        <h5 class="text-white mb-4 ps-3 border-start border-4 border-light">Aktivitas Hari Ini ({{ date('d M Y') }})</h5>
                        
                        @if(($todaysWorkouts->isEmpty() ?? true) && ($todaysNutrition->isEmpty() ?? true))
                            <div class="text-center py-5 text-muted fst-italic border border-secondary rounded border-dashed opacity-50">
                                <i class="bi bi-clipboard-data fs-1 d-block mb-2"></i>
                                Belum ada data hari ini. <br> Mulai catat latihan atau makananmu!
                            </div>
                        @else
                            <ul class="list-group list-group-flush">
                                <!-- List Workout -->
                                @foreach($todaysWorkouts as $w)
                                    <li class="list-group-item bg-transparent text-white border-secondary d-flex justify-content-between align-items-center px-0">
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-danger me-3 p-2"><i class="bi bi-activity"></i></span>
                                            <div>
                                                <div class="fw-bold">{{ $w->activity }}</div>
                                                <div class="small text-secondary">{{ $w->duration }} menit</div>
                                            </div>
                                        </div>
                                        <span class="text-danger fw-bold">-{{ $w->calories }} kcal</span>
                                    </li>
                                @endforeach
                                <!-- List Nutrisi -->
                                @foreach($todaysNutrition as $n)
                                    <li class="list-group-item bg-transparent text-white border-secondary d-flex justify-content-between align-items-center px-0">
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-success me-3 p-2"><i class="bi bi-egg-fried"></i></span>
                                            <div>
                                                <div class="fw-bold">{{ $n->food_name }}</div>
                                                <div class="small text-secondary">{{ $n->meal_type }}</div>
                                            </div>
                                        </div>
                                        <span class="text-success fw-bold">+{{ $n->calories }} kcal</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                <!-- 2. TAB WORKOUT -->
                <div class="tab-pane fade" id="content-workout">
                    <div class="custom-card p-4">
                        <h4 class="text-white mb-4 ps-3 border-start border-4 border-danger">INPUT LATIHAN BARU</h4>
                        <form action="{{ route('workout.store') }}" method="POST" class="row g-3">
                            @csrf
                            <div class="col-md-6">
                                <label class="text-secondary small mb-1">Jenis Latihan</label>
                                <input type="text" name="activity" class="form-control" placeholder="Contoh: Lari Pagi, Gym, Renang" required>
                            </div>
                            <div class="col-md-3">
                                <label class="text-secondary small mb-1">Durasi (Menit)</label>
                                <input type="number" name="duration" class="form-control" placeholder="30" required>
                            </div>
                            <div class="col-md-3">
                                <label class="text-secondary small mb-1">Kalori Terbakar</label>
                                <input type="number" name="calories" class="form-control" placeholder="150" required>
                            </div>
                            <div class="col-12 mt-4">
                                <button class="btn btn-red w-100 fw-bold py-2"><i class="bi bi-plus-lg me-1"></i> SIMPAN LATIHAN</button>
                            </div>
                        </form>

                        <hr class="border-secondary my-5 opacity-25">

                        <h5 class="text-white mb-3"><i class="bi bi-clock-history me-2"></i> Riwayat Latihan Hari Ini</h5>
                        <div class="table-responsive">
                            <table class="table table-dark table-hover align-middle border-secondary">
                                <thead>
                                    <tr class="text-secondary small text-uppercase">
                                        <th>Aktivitas</th>
                                        <th>Durasi</th>
                                        <th>Kalori</th>
                                        <th class="text-end">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($todaysWorkouts as $w)
                                    <tr>
                                        <td class="fw-bold text-white">{{ $w->activity }}</td>
                                        <td>{{ $w->duration }} min</td>
                                        <td><span class="text-danger fw-bold">-{{ $w->calories }}</span></td>
                                        <td class="text-end">
                                            <form action="{{ route('entity.destroy', ['workout', $w->id]) }}" method="POST" onsubmit="return confirm('Hapus data ini?');">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-dark text-danger border-0 py-1 px-2 hover-red"><i class="bi bi-trash-fill"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="4" class="text-center text-muted fst-italic py-4">Belum ada latihan hari ini.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- 3. TAB NUTRITION -->
                <div class="tab-pane fade" id="content-nutrition">
                    <div class="custom-card p-4">
                        <h4 class="text-white mb-4 ps-3 border-start border-4 border-success">CATAT MAKANAN</h4>
                        <form action="{{ route('nutrition.store') }}" method="POST" class="row g-3">
                            @csrf
                            <div class="col-md-5">
                                <label class="text-secondary small mb-1">Nama Makanan</label>
                                <input type="text" name="food_name" class="form-control" placeholder="Nasi Goreng, Salad..." required>
                            </div>
                            <div class="col-md-3">
                                <label class="text-secondary small mb-1">Waktu Makan</label>
                                <select name="meal_type" class="form-select">
                                    <option value="Breakfast">Sarapan</option>
                                    <option value="Lunch">Makan Siang</option>
                                    <option value="Dinner">Makan Malam</option>
                                    <option value="Snack">Camilan</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="text-secondary small mb-1">Kalori</label>
                                <input type="number" name="calories" class="form-control" placeholder="0" required>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button class="btn btn-success w-100 fw-bold py-2"><i class="bi bi-plus-lg"></i> ADD</button>
                            </div>
                        </form>

                        <hr class="border-secondary my-5 opacity-25">

                        <h5 class="text-white mb-3"><i class="bi bi-basket2 me-2"></i> Daftar Makanan Hari Ini</h5>
                        <ul class="list-group list-group-flush">
                            @forelse($todaysNutrition as $n)
                                <li class="list-group-item bg-transparent text-white border-secondary d-flex justify-content-between align-items-center px-0 py-3">
                                    <div>
                                        <span class="badge bg-secondary me-2">{{ $n->meal_type }}</span> 
                                        <span class="fw-bold">{{ $n->food_name }}</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="text-success fw-bold">+{{ $n->calories }} kcal</span>
                                        <form action="{{ route('entity.destroy', ['nutrition', $n->id]) }}" method="POST" onsubmit="return confirm('Hapus data ini?');">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-dark text-danger border-0 p-1"><i class="bi bi-trash-fill"></i></button>
                                        </form>
                                    </div>
                                </li>
                            @empty
                                <li class="list-group-item bg-transparent text-muted text-center fst-italic py-4">Belum ada makanan dicatat.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                <!-- 4. TAB PROGRESS -->
                <div class="tab-pane fade" id="content-progress">
                    <div class="custom-card p-4">
                        <div class="row">
                            <div class="col-md-4 border-end border-secondary">
                                <h4 class="text-white mb-4">Update Data Tubuh</h4>
                                <form action="{{ route('progress.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="text-secondary small mb-1">Berat Badan (kg)</label>
                                        <div class="input-group">
                                            <input type="number" step="0.1" name="weight" class="form-control" required placeholder="70.5">
                                            <span class="input-group-text bg-dark text-white border-secondary">kg</span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="text-secondary small mb-1">Lingkar Perut (cm) <small class="text-muted">(Opsional)</small></label>
                                        <input type="number" step="0.1" name="waist" class="form-control" placeholder="80">
                                    </div>
                                    <div class="mb-4">
                                        <label class="text-secondary small mb-1">Tanggal Pencatatan</label>
                                        <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}">
                                    </div>
                                    <button class="btn btn-red w-100 fw-bold py-2">SIMPAN PROGRESS</button>
                                </form>
                            </div>
                            <div class="col-md-8 ps-md-5">
                                <h5 class="text-white text-center mb-4">Grafik Berat Badan (7 Hari Terakhir)</h5>
                                <div class="p-3 rounded" style="background-color: rgba(255,255,255,0.05);">
                                    <div style="position: relative; height:300px; width:100%">
                                        <!-- Canvas untuk Grafik Chart.js -->
                                        <canvas id="weightChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 5. TAB PROFILE -->
                <div class="tab-pane fade" id="content-profile">
                    <div class="custom-card p-4">
                        <h4 class="text-white mb-4 ps-3 border-start border-4 border-primary">EDIT DATA PRIBADI</h4>
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf @method('PUT')
                            
                            <div class="row g-4">
                                <!-- Bagian Data Diri -->
                                <div class="col-12"><h6 class="text-white border-bottom border-secondary pb-2 mb-0">Informasi Dasar</h6></div>
                                
                                <div class="col-md-6">
                                    <label class="text-secondary small mb-1">Nama Lengkap</label>
                                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-secondary small mb-1">Pekerjaan</label>
                                    <input type="text" name="job" class="form-control" value="{{ $user->job }}" placeholder="Mahasiswa, Karyawan...">
                                </div>
                                <div class="col-md-6">
                                    <label class="text-secondary small mb-1">Umur (Tahun)</label>
                                    <input type="number" name="age" class="form-control" value="{{ $user->age }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="text-secondary small mb-1">Gender</label>
                                    <select name="gender" class="form-select">
                                        <option value="" class="text-muted">Pilih...</option>
                                        <option value="Laki-laki" {{ $user->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ $user->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>

                                <!-- Bagian Target Fitness -->
                                <div class="col-12 mt-4"><h6 class="text-white border-bottom border-secondary pb-2 mb-0">Target & Tujuan</h6></div>

                                <div class="col-md-4">
                                    <label class="text-secondary small mb-1">Target Berat Badan (kg)</label>
                                    <input type="number" name="target_weight" class="form-control" value="{{ $user->target_weight }}" placeholder="Target kg">
                                </div>
                                <div class="col-md-8">
                                    <label class="text-secondary small mb-1">Tujuan Fitness Utama</label>
                                    <input type="text" name="fitness_goal" class="form-control" value="{{ $user->fitness_goal }}" placeholder="Contoh: Menurunkan berat badan, Menambah massa otot">
                                </div>
                                
                                <div class="col-12 mt-4">
                                    <button class="btn btn-primary w-100 fw-bold py-2">SIMPAN PERUBAHAN PROFIL</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- DATA CONTAINER TERSEMBUNYI (SOLUSI ANTI ERROR JSON) -->
<!-- Data disimpan di atribut HTML, bukan disisipkan langsung ke script -->
<div id="chart-data-storage" 
     data-labels="{{ json_encode($chartLabels ?? []) }}" 
     data-weight="{{ json_encode($chartData ?? []) }}"
     style="display: none;">
</div>

<!-- SCRIPT UNTUK CHART.JS -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('weightChart');
        
        // --- PROSES PENGAMBILAN DATA YANG AMAN ---
        // Kita ambil data dari atribut div tersembunyi, lalu di-parse.
        const dataStorage = document.getElementById('chart-data-storage');
        let labels = [];
        let dataWeight = [];

        try {
            // Ambil string JSON dari atribut
            const rawLabels = dataStorage.dataset.labels;
            const rawWeight = dataStorage.dataset.weight;
            
            // Ubah string JSON menjadi Array JavaScript asli
            if (rawLabels) labels = JSON.parse(rawLabels);
            if (rawWeight) dataWeight = JSON.parse(rawWeight);
            
        } catch (error) {
            console.error("Gagal memproses data grafik:", error);
            // Jika error, grafik tetap jalan tapi kosong (tidak bikin blank page)
        }

        if(ctx) {
            new Chart(ctx, {
                type: 'line', // Jenis grafik garis
                data: {
                    labels: labels, // Tanggal (Sumbu X)
                    datasets: [{
                        label: 'Berat Badan (kg)',
                        data: dataWeight, // Data Berat (Sumbu Y)
                        borderColor: '#E60000', // Warna Merah Fitkomove
                        backgroundColor: 'rgba(230, 0, 0, 0.1)', // Arsiran Merah
                        borderWidth: 3,
                        tension: 0.3, // Garis lengkung
                        fill: true,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#E60000',
                        pointRadius: 5,
                        pointHoverRadius: 7
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: { 
                            beginAtZero: false, 
                            grid: { color: '#333' }, // Grid gelap
                            ticks: { color: '#ccc' } // Angka abu
                        },
                        x: { 
                            grid: { color: '#333' }, 
                            ticks: { color: '#ccc' } 
                        }
                    },
                    plugins: { 
                        legend: { labels: { color: '#fff' } } // Legenda putih
                    }
                }
            });
        }
    });
</script>

<style>
    /* Styling Tabs */
    .nav-pills .nav-link { 
        color: var(--text-muted); 
        border-radius: 8px; 
        margin-bottom: 8px; 
        padding: 12px 20px;
        transition: all 0.3s ease; 
        border: 1px solid transparent;
        font-weight: 500;
    }
    
    .nav-pills .nav-link:hover { 
        background-color: rgba(255,255,255,0.05); 
        color: var(--primary-red); 
        border-color: var(--primary-red);
        transform: translateX(5px);
    }
    
    .nav-pills .nav-link.active { 
        background-color: var(--primary-red); 
        color: white; 
        font-weight: bold; 
        box-shadow: 0 4px 15px rgba(230, 0, 0, 0.4);
    }
    
    .nav-pills .nav-link i { 
        width: 25px; 
        display: inline-block; 
        text-align: center; 
    }

    /* Hover effect table delete button */
    .hover-red:hover {
        background-color: #dc3545 !important;
        color: white !important;
    }
</style>
@endsection