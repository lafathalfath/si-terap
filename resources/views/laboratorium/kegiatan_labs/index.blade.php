@extends('layouts.header_navbar_footer_lab')

@section('content')
<div class="container">
    <div class="row justify-content-between align-items-center mb-4">
        <div class="col-md-6">
            <h2>Dokumentasi Kegiatan Lab {{ $lab->nama_lab }}</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('labs.kegiatan.create', $lab->id) }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Kegiatan
            </a>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">
    <i class="fas fa-arrow-left"></i> Kembali
</a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            @if ($kegiatans->isEmpty())
                <div class="alert alert-info">Belum ada kegiatan yang tercatat.</div>
            @else
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kegiatan</th>
                                <th>Tanggal</th>
                                <th>Penanggung Jawab</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kegiatans as $index => $kegiatan)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $kegiatan->nama_kegiatan }}</td>
                                    <td>{{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->format('d F Y') }}</td>
                                    <td>{{ $kegiatan->penanggung_jawab }}</td>
                                    <td>
                                        <a href="{{ route('labs.kegiatan.show', [$lab->id, $kegiatan->id]) }}" 
                                           class="btn btn-sm btn-info" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('labs.kegiatan.edit', [$lab->id, $kegiatan->id]) }}" 
                                           class="btn btn-sm btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('labs.kegiatan.destroy', [$lab->id, $kegiatan->id]) }}" 
                                              method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')" 
                                                    title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection