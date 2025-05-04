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
        color: #00452C;
    }

    .btn-outline-primary:hover {
        background-color: #00452C;
        border-color: #00452C;
        color: white;
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

    /* Activity cards styling */
    .activity-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
    }
    
    .activity-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    
    .activity-date {
        font-size: 0.85rem;
    }
    
    .tabs-container .nav-link {
        color: #495057;
        border: none;
        border-bottom: 3px solid transparent;
        font-weight: 500;
    }
    
    .tabs-container .nav-link.active {
        color: #00452C;
        background-color: transparent;
        border-bottom: 3px solid #00452C;
    }
    
    .tabs-container .nav-link:hover:not(.active) {
        border-bottom: 3px solid #e9ecef;
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

    <!-- Main Lab Info Card -->
    <div class="card shadow-lg mb-4">
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
                    <!-- Tabs Navigation -->
                    <div class="tabs-container mb-4">
                        <ul class="nav nav-tabs" id="labDetailsTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab" aria-controls="info" aria-selected="true">
                                    <i class="fas fa-info-circle me-1"></i> Informasi Lab
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="facilities-tab" data-bs-toggle="tab" data-bs-target="#facilities" type="button" role="tab" aria-controls="facilities" aria-selected="false">
                                    <i class="fas fa-building me-1"></i> Fasilitas
                                </button>
                            </li>
                        </ul>
                    </div>
                    
                    <!-- Tabs Content -->
                    <div class="tab-content" id="labDetailsTabsContent">
                        <!-- Info Tab -->
                        <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
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
                        </div>
                        
                        <!-- Facilities Tab -->
                        <div class="tab-pane fade" id="facilities" role="tabpanel" aria-labelledby="facilities-tab">
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
            </div>
        </div>
        
        <div class="card-footer d-flex justify-content-between py-3">
            <a href="{{ route('data-Lab') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar Laboratorium
            </a>
            <a href="{{ route('labs.kegiatan.create', $lab->id) }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Tambah Kegiatan Baru
            </a>
        </div>
    </div>
    
    <!-- Lab Activities Section -->
    <div class="card shadow-lg">
        <div class="card-header bg-info text-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Kegiatan Laboratorium</h3>
                <div class="input-group" style="max-width: 300px;">
                    <input type="text" class="form-control" id="searchActivities" placeholder="Cari kegiatan...">
                    <button class="btn btn-light" type="button"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
        
        <div class="card-body p-4">
            <!-- Filter and Sort Options -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <label class="me-2">Filter:</label>
                    <select class="form-select-sm me-2" id="filterYear">
                        <option value="">Semua Tahun</option>
                        <!-- Dynamically generate years from activities -->
                        @php
                            $years = [];
                            foreach($kegiatans as $kegiatan) {
                                $year = Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->format('Y');
                                if(!in_array($year, $years)) {
                                    $years[] = $year;
                                }
                            }
                            sort($years);
                        @endphp
                        @foreach($years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="me-2">Urut:</label>
                    <select class="form-select-sm" id="sortActivities">
                        <option value="newest">Terbaru</option>
                        <option value="oldest">Terlama</option>
                        <option value="az">A-Z</option>
                        <option value="za">Z-A</option>
                    </select>
                </div>
            </div>
            
            <!-- Activities List -->
            <div class="row" id="activitiesList">
                @if($kegiatans->count() > 0)
                    @foreach($kegiatans as $kegiatan)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <a href="{{ route('labs.kegiatan.show', [$lab->id, $kegiatan->id]) }}" class="text-decoration-none">
                                <div class="card h-100 activity-card">
                                    @if($kegiatan->dokumentasi_path)
                                        <div class="position-relative">
                                            <img src="{{ asset($kegiatan->dokumentasi_path) }}" 
                                                class="card-img-top" 
                                                alt="Dokumentasi Kegiatan" 
                                                style="height: 180px; object-fit: cover;">
                                            <div class="position-absolute bottom-0 end-0 m-2">
                                                <span class="badge bg-light text-dark">
                                                    <i class="fas fa-calendar-day"></i> 
                                                    {{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->format('d M Y') }}
                                                </span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="card-header bg-light">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <i class="fas fa-flask fa-2x text-secondary"></i>
                                                <span class="badge bg-light text-dark activity-date">
                                                    <i class="fas fa-calendar-day"></i> 
                                                    {{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->format('d M Y') }}
                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title text-primary">{{ $kegiatan->nama_kegiatan }}</h5>
                                        <p class="card-text text-muted mb-2 small">
                                            <i class="fas fa-user-tie"></i> {{ $kegiatan->penanggung_jawab }}
                                        </p>
                                        <p class="card-text small">
                                            {{ \Illuminate\Support\Str::limit($kegiatan->deskripsi, 100) }}
                                        </p>
                                    </div>
                                    <div class="card-footer bg-white border-top-0">
                                        <button class="btn btn-sm btn-outline-primary w-100">
                                            <i class="fas fa-eye me-1"></i> Lihat Detail
                                        </button>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 text-center py-5">
                        <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                        <h4>Belum Ada Kegiatan</h4>
                        <p class="text-muted">Belum ada kegiatan yang ditambahkan untuk laboratorium ini.</p>
                        <a href="{{ route('labs.kegiatan.create', $lab->id) }}" class="btn btn-primary mt-2">
                            <i class="fas fa-plus"></i> Tambah Kegiatan Baru
                        </a>
                    </div>
                @endif
            </div>
            
            <!-- Pagination if needed -->
            @if($kegiatans->count() > 0 && method_exists($kegiatans, 'links'))
                <div class="d-flex justify-content-center mt-4">
                    {{ $kegiatans->links() }}
                </div>
            @endif
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
    // Map initialization
    document.addEventListener('DOMContentLoaded', function() {
        var map = L.map('map').setView([{{ $lab->latitude }}, {{ $lab->longitude }}], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var marker = L.marker([{{ $lab->latitude }}, {{ $lab->longitude }}]).addTo(map);
        
        // Search functionality
        document.getElementById('searchActivities').addEventListener('keyup', function() {
            filterActivities();
        });
        
        // Filter and sort functionality
        document.getElementById('filterYear').addEventListener('change', function() {
            filterActivities();
        });
        
        document.getElementById('sortActivities').addEventListener('change', function() {
            filterActivities();
        });
        
        function filterActivities() {
            var searchText = document.getElementById('searchActivities').value.toLowerCase();
            var yearFilter = document.getElementById('filterYear').value;
            var sortOption = document.getElementById('sortActivities').value;
            
            var activities = document.querySelectorAll('#activitiesList .col-md-6');
            var activitiesArray = Array.from(activities);
            
            // Filter by search text and year
            activitiesArray.forEach(function(item) {
                var title = item.querySelector('.card-title').textContent.toLowerCase();
                var description = item.querySelector('.card-text:last-child').textContent.toLowerCase();
                var date = item.querySelector('.activity-date').textContent;
                var year = date.match(/\d{4}/);
                year = year ? year[0] : '';
                
                var matchesSearch = title.includes(searchText) || description.includes(searchText);
                var matchesYear = yearFilter === '' || year === yearFilter;
                
                if (matchesSearch && matchesYear) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
            
            // Sort the visible items
            var visibleItems = activitiesArray.filter(function(item) {
                return item.style.display !== 'none';
            });
            
            if (sortOption === 'newest') {
                visibleItems.sort(function(a, b) {
                    var dateA = new Date(a.querySelector('.activity-date').textContent.replace(/[^\d/]/g, ''));
                    var dateB = new Date(b.querySelector('.activity-date').textContent.replace(/[^\d/]/g, ''));
                    return dateB - dateA;
                });
            } else if (sortOption === 'oldest') {
                visibleItems.sort(function(a, b) {
                    var dateA = new Date(a.querySelector('.activity-date').textContent.replace(/[^\d/]/g, ''));
                    var dateB = new Date(b.querySelector('.activity-date').textContent.replace(/[^\d/]/g, ''));
                    return dateA - dateB;
                });
            } else if (sortOption === 'az') {
                visibleItems.sort(function(a, b) {
                    var titleA = a.querySelector('.card-title').textContent.toLowerCase();
                    var titleB = b.querySelector('.card-title').textContent.toLowerCase();
                    return titleA.localeCompare(titleB);
                });
            } else if (sortOption === 'za') {
                visibleItems.sort(function(a, b) {
                    var titleA = a.querySelector('.card-title').textContent.toLowerCase();
                    var titleB = b.querySelector('.card-title').textContent.toLowerCase();
                    return titleB.localeCompare(titleA);
                });
            }
            
            // Reattach the visible items in the new order
            var container = document.getElementById('activitiesList');
            visibleItems.forEach(function(item) {
                container.appendChild(item);
            });
        }
    });
</script>
@endsection