@extends('layouts.header_navbar_footer_lab')

@section('content')
    <style>
        .content.stylish-content {
            padding: 20px;
        }

        .page-title {
            text-align: center;
            font-size: 2em;
            color: #00452C;
            margin: 20px 0;
        }

        .stylish-button {
            display: block;
            width: fit-content;
            margin: 20px auto;
            padding: 12px 25px;
            color: white;
            background-color: #006633;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            font-size: 1.1em;
        }

        .stylish-button:hover {
            background-color: #009144;
        }

        .stylish-content {
            margin: 0 auto;
            max-width: 1200px;
            padding: 40px 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #00452C;
            color: white;
        }

        .filter-container {
            margin-bottom: 20px;
        }

        .filter-container select, .filter-container input {
            padding: 8px;
            font-size: 1em;
            margin-right: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .filter-container button {
            padding: 8px 15px;
            background-color: #00452C;
            color: white;
            border: none;
            border-radius: 5px;
        }

        .filter-container button:hover {
            background-color: #006633;
        }

        .action-buttons {
            display: flex;
            gap: 5px;
            justify-content: center;
        }

        .btn {
            padding: 5px 10px;
            border-radius: 4px;
            text-decoration: none;
            color: white;
            font-size: 0.9em;
        }

        .btn-primary {
            background-color: #006633;
        }

        .btn-warning {
            background-color: #FFC107;
        }

        .btn-danger {
            background-color: #DC3545;
        }

        .btn-info {
            background-color: #17A2B8;
        }

        .btn:hover {
            opacity: 0.9;
        }
    </style>

    <div class="content stylish-content">
        <!-- Filter Section -->
        <form class="filter-container">
            <label for="bpsip">BPSIP:</label>
            <select id="bpsip" name="bsip_id">
                <option value="">Semua BPSIP</option>
                @foreach ($bsip as $bs)
                    <option value="{{ $bs->id }}" {{ request()->bsip_id == $bs->id ? 'selected' : '' }}>{{ $bs->name }}</option>
                @endforeach
            </select>

            <label for="year">Tahun:</label>
            <select id="year" name="tahun">
                <option value="">Semua Tahun</option>
                @for ($i = now()->year; $i >= 2000; $i--)
                    <option value="{{ $i }}" {{ request()->tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
            

            <button type="submit">Filter</button>
        </form>

        <div style="display: flex; align-items: center; justify-content: space-between; padding: 10px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 20px;">
            <div style="display: flex; flex-direction: column; gap: 5px;">
                <h2 style="margin: 0;">Data Lab</h2>
                <span style="color: #666; font-size: 14px;">Informasi terkait laboratorium</span>
            </div>
            <a href="{{ route('form-Lab') }}" class="stylish-button" style="text-decoration: none; color: #fff;">
                Tambah Data Lab
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table border="1" id="kegiatan-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama BPSIP</th>
                    <th>Jenis Laboratorium</th>
                    <th>Masa Berlaku</th>
                    <th>No Akreditasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lab as $l)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $l->bsip->name }}</td>
                        <td>{{ $l->jenis_lab->name }}</td>
                        <td>{{ $l->masa_berlaku }}</td>
                        <td>{{ $l->no_akreditasi}}</td>
                        
                        <td class="action-buttons">
                        <a href="{{ route('labs.kegiatan.index', ['lab' => $l->id]) }}" class="btn btn-info">
        <i class="fas fa-calendar-alt"></i> Lihat Kegiatan Lab
    </a>
                            <a href="{{ route('lab.detail', $l->id) }}" class="btn btn-primary">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                            <a href="{{ route('lab.edit', Crypt::encryptString($l->id)) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('lab.destroy', Crypt::encryptString($l->id)) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection