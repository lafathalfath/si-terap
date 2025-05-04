@extends('layouts.header_navbar_footer_lab')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Back Button -->
            <div class="mb-3">
                <a href="{{ route('labs.kegiatan.index', $lab->id) }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
            
            <!-- Main Card -->
            <div class="card shadow-lg border-0 rounded-3 overflow-hidden">
                <!-- Activity Header -->
                <div class="card-header bg-primary text-white p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-0 fw-bold">{{ $kegiatan->nama_kegiatan }}</h3>
                            <p class="mb-0 opacity-75">{{ $lab->nama_lab }}</p>
                        </div>
                        <span class="badge bg-white text-primary px-3 py-2 rounded-pill shadow-sm">
                            <i class="fas fa-calendar-alt me-1"></i>
                            {{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->format('d F Y') }}
                        </span>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <!-- Person in Charge -->
                    <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                        <div class="bg-light rounded-circle p-2 me-3">
                            <i class="fas fa-user-tie text-primary"></i>
                        </div>
                        <div>
                            <small class="text-muted">Penanggung Jawab</small>
                            <h5 class="mb-0">{{ $kegiatan->penanggung_jawab }}</h5>
                        </div>
                    </div>
                    
                    <div class="row">
                        <!-- Description Section -->
                        <div class="col-lg-8 pe-lg-4">
                            <div class="mb-4">
                                <h5 class="text-dark mb-3 d-flex align-items-center">
                                    <span class="bg-primary bg-opacity-10 p-2 rounded-circle me-2">
                                        <i class="fas fa-align-left text-primary"></i>
                                    </span>
                                    Deskripsi Kegiatan
                                </h5>
                                <div class="ps-2 ms-4 border-start border-3 border-primary">
                                    <p class="text-justify text-muted">{{ $kegiatan->deskripsi }}</p>
                                </div>
                            </div>
                            
                            <!-- Documentation Section -->
                            @if ($kegiatan->dokumentasi_path)
                            <div class="mb-4">
                                <h5 class="text-dark mb-3 d-flex align-items-center">
                                    <span class="bg-primary bg-opacity-10 p-2 rounded-circle me-2">
                                        <i class="fas fa-camera text-primary"></i>
                                    </span>
                                    Dokumentasi
                                </h5>
                                <div class="mt-3">
                                    <img src="{{ asset($kegiatan->dokumentasi_path) }}" 
                                         alt="Dokumentasi Kegiatan" 
                                         class="img-fluid rounded-3 shadow-sm" 
                                         style="max-height: 400px; width: auto;">
                                </div>
                            </div>
                            @endif
                        </div>
                        
                        <!-- Results Section -->
                        <div class="col-lg-4">
                            <div class="card bg-light border-0 rounded-3 shadow-sm h-100">
                                <div class="card-body p-4">
                                    <h5 class="text-dark mb-3 d-flex align-items-center">
                                        <span class="bg-success bg-opacity-10 p-2 rounded-circle me-2">
                                            <i class="fas fa-clipboard-check text-success"></i>
                                        </span>
                                        Hasil Kegiatan
                                    </h5>
                                    <div class="ps-2 ms-4 border-start border-2 border-success">
                                        <p class="text-muted">{{ $kegiatan->hasil_kegiatan ?? 'Belum ada hasil kegiatan' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection