@extends('layouts.header_navbar_footer_lab')

@section('content')
<style>
    .container {
        max-width: 1200px;
        margin: auto;
        font-family: 'Poppins', sans-serif;
    }

    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .card-header {
        border-radius: 0 !important;
    }

    .bg-primary {
        background-color: #00452C !important;
    }

    .bg-info {
        background-color: #006a44 !important;
    }

    .btn-primary {
        background-color: #00452C;
        border-color: #00452C;
    }

    .btn-primary:hover {
        background-color: #006a44;
        border-color: #006a44;
        box-shadow: 0 4px 8px rgba(0, 100, 70, 0.3);
    }

    .btn-outline-primary {
        border-color: #00452C;
    }

    .btn-outline-primary:hover {
        background-color: #00452C;
        border-color: #00452C;
    }

    .alert-success {
        background-color: #d4edda;
        border-color: #c3e6cb;
    }

    .alert-warning {
        background-color: #fff3cd;
        border-color: #ffeeba;
    }

    .badge {
        padding: 0.5em 0.75em;
        font-weight: 600;
    }

    .bg-success {
        background-color: #28a745 !important;
    }

    .bg-warning {
        background-color: #ffc107 !important;
    }

    .border-bottom {
        border-bottom: 2px solid #00452C !important;
    }

    .shadow-lg {
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
    }

    /* Map container styling */
    #map {
        border-radius: 0 0 6px 6px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .card-body .row > div {
            margin-bottom: 1rem;
        }
    }
</style>
<div class="container py-4">
    <h1 class="text-center mb-4">Detail Laboratorium</h1>

    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center py-3">
            <h2>{{ $lab->name }}</h2>
        </div>
        
        <div class="row g-0">
            <!-- Lab Image Column -->
            <div class="col-md-4">
                <div class="p-3 h-100 d-flex flex-column">
                    <img src="{{ asset('storage/' . $lab->foto_lab) }}" class="img-fluid rounded mb-3" alt="Lab Image" style="max-height: 300px; object-fit: cover;">
                    
                    <!-- Contact Info Box -->
                    <div class="card bg-light mb-3">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">Kontak Kami</h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-2"><i class="fas fa-map-marker-alt"></i> <strong>Alamat:</strong> {{ $lab->alamat_lab }}</p>
                            <p class="mb-0"><i class="fas fa-phone"></i> <strong>Telepon:</strong> {{ $lab->telepon_lab }}</p>
                        </div>
                    </div>
                    
                    <!-- Location Map -->
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">Lokasi</h5>
                        </div>
                        <div class="card-body p-0">
                            <div id="map" style="height: 200px; width: 100%;"></div>
                            <div class="p-2 text-end">
                                <a href="https://www.google.com/maps?q={{ $lab->latitude }},{{ $lab->longitude }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-map-marked-alt"></i> Buka di Google Maps
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
            <!-- Lab Details Column -->
            <div class="col-md-8">
                <div class="card-body">
                    <div class="mb-4">
                        <h3 class="border-bottom pb-2">Informasi Analisis</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Jenis Analisis:</strong> {{ $lab->jenis_analisis }}</p>
                                <p><strong>Metode Analisis:</strong> {{ $lab->metode_analisis }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Analisis:</strong> {{ $lab->analisis }}</p>
                                <p><strong>Kompetensi Personal:</strong> {{ $lab->kompetensi_personal }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <h3 class="border-bottom pb-2">Pelatihan</h3>
                        <p><strong>Nama Pelatihan:</strong> {{ $lab->nama_pelatihan }}</p>
                        <p><strong>Tahun:</strong> {{ $lab->tahun }}</p>
                    </div>
                    
                    <div class="mb-4">
                        <h3 class="border-bottom pb-2">Akreditasi</h3>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="alert {{ $lab->akreditasi ? 'alert-success' : 'alert-warning' }}">
                                    <strong>Status:</strong> {{ $lab->akreditasi ? 'Terakreditasi' : 'Belum Akreditasi' }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Masa Berlaku:</strong> {{ $lab->masa_berlaku }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>No Akreditasi:</strong> {{ $lab->no_akreditasi }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <h3 class="border-bottom pb-2">Fasilitas</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Bangunan</h5>
                                <p><strong>Jumlah Gedung:</strong> {{ $lab->jumlah_gedung }}</p>
                                <p><strong>Kecukupan Gedung:</strong> 
                                    <span class="badge bg-{{ $lab->gedung_memadai ? 'success' : 'warning' }}">
                                        {{ $lab->gedung_memadai ? 'Memadai' : 'Perlu Perbaikan' }}
                                    </span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h5>Peralatan</h5>
                                <p><strong>Jenis Peralatan:</strong> {{ $lab->jenis_peralatan }}</p>
                                <p><strong>Auditor Internal:</strong> {{ $lab->auditor_internal }}</p>
                                <p><strong>Fungsional Lainnya:</strong> {{ $lab->fungsional_lainnya }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card-footer text-center py-3">
            <a href="{{ route('data-Lab') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar Laboratorium
            </a>
        </div>
    </div>
</div>

<!-- Leaflet CSS -->
@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
 integrity="sha256-sA+e2Tu4h3JZfZ3wP5c8QHJm0MoZ++nNNJknTCd3/WY=" crossorigin=""/>
@endpush

<!-- Leaflet JS -->

  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" 
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

        <script>
    var map = L.map('map').setView([{{ $lab->latitude }}, {{ $lab->longitude }}], 13);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    var marker = L.marker([{{ $lab->latitude }}, {{ $lab->longitude }}]).addTo(map);
   
</script>


@endsection