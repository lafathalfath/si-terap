@extends('layouts.header_navbar_footer_lab')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Kegiatan Lab {{ $lab->nama_lab }}</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('labs.kegiatan.update', [$lab->id, $kegiatan->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                            <input type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror" 
                                   id="nama_kegiatan" name="nama_kegiatan" value="{{ old('nama_kegiatan', $kegiatan->nama_kegiatan) }}" required>
                            @error('nama_kegiatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi Kegiatan</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" name="deskripsi" rows="3" required>{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_kegiatan" class="form-label">Tanggal Kegiatan</label>
                            <input type="date" class="form-control @error('tanggal_kegiatan') is-invalid @enderror" 
                                   id="tanggal_kegiatan" name="tanggal_kegiatan" value="{{ old('tanggal_kegiatan', \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->format('Y-m-d')) }}" required>
                            @error('tanggal_kegiatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="penanggung_jawab" class="form-label">Penanggung Jawab</label>
                            <input type="text" class="form-control @error('penanggung_jawab') is-invalid @enderror" 
                                   id="penanggung_jawab" name="penanggung_jawab" value="{{ old('penanggung_jawab', $kegiatan->penanggung_jawab) }}" required>
                            @error('penanggung_jawab')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="hasil_kegiatan" class="form-label">Hasil Kegiatan (Opsional)</label>
                            <textarea class="form-control @error('hasil_kegiatan') is-invalid @enderror" 
                                      id="hasil_kegiatan" name="hasil_kegiatan" rows="3">{{ old('hasil_kegiatan', $kegiatan->hasil_kegiatan) }}</textarea>
                            @error('hasil_kegiatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="dokumentasi" class="form-label">Dokumentasi (Opsional)</label>
                            <input type="file" class="form-control @error('dokumentasi') is-invalid @enderror" 
                                   id="dokumentasi" name="dokumentasi" accept="image/*">
                            @error('dokumentasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Format: JPEG, PNG, JPG, GIF (Maksimal 2MB)</small>
                            
                            @if ($kegiatan->dokumentasi_path)
                                <div class="mt-2">
                                    <img src="{{ asset($kegiatan->dokumentasi_path) }}" 
                                         alt="Dokumentasi Saat Ini" 
                                         class="img-thumbnail" 
                                         style="max-height: 150px;">
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" 
                                               id="hapus_dokumentasi" name="hapus_dokumentasi">
                                        <label class="form-check-label" for="hapus_dokumentasi">
                                            Hapus dokumentasi saat ini
                                        </label>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('labs.kegiatan.index', $lab->id) }}" class="btn btn-secondary me-md-2">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection