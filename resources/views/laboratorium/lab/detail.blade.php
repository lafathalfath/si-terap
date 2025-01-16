@extends('layouts.header_navbar_footer_lab')

@section('content')

<div class="container">
    <h1>Detail Laboratorium</h1>

    <style>
        .card {
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header, .card-footer {
            padding: 1rem 1.5rem;
            background-color: #f8f9fa;
            border-bottom: 1px solid #ddd;
        }

        .card-body {
            padding: 1.5rem;
        }

        .sections {
            padding: 1rem 1.5rem;
        }

        h1, h2, h3 {
            margin-bottom: 1rem;
        }

        .btn-gr {
            background-color: #006400;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-gr:hover {
            background-color: #004c00; /* Warna lebih gelap saat hover */
        }

    </style>

    @php
        $lab = (object)[
            'name' => 'Laboratorium Kimia',
            'jenis_analisis' => 'Kuantitatif',
            'metode_analisis' => 'Titrasi',
            'analisis' => 'Pengukuran kadar asam',
            'kompetensi_personal' => 'Kimia Analitik',
            'nama_pelatihan' => 'Pelatihan Titrasi Asam-Basa',
            'tahun' => 2024,
            'akreditasi' => 'Terakreditasi',
            'masa_berlaku' => '2025-12-31',
            'no_akreditasi' => 'LAB123456',
            'pelatihan' => [
                ['nama' => 'Pelatihan Titrasi', 'jenis' => 'Titrasi Asam-Basa', 'waktu' => '2024-03-01'],
                ['nama' => 'Pelatihan Kimia Analitik', 'jenis' => 'Kimia Analitik Dasar', 'waktu' => '2024-06-15']
            ],
            'auditor_internal' => 'Dr. Siti Aisyah, M.Sc.',
            'fungsional_lainnya' => 'Asisten Kimia, Peneliti Junior',
            'gedung' => ['jumlah' => 3, 'memadai' => 'Memadai'],
            'jenis_peralatan' => 'Mikroskop, Alat Titrasi, pH Meter, Perangkat Lunak Analisis Data',
            'alamat_lab' => 'Jl. Ilmiah No. 123, Kota Riset',
            'telepon_lab' => '+62 123 456 7890'
        ];
    @endphp

    <div class="card mt-5">
        <div class="card-header text-center">
            <h3>{{ $lab->name }}</h3>
        </div>
        <div class="d-flex flex-column flex-md-row">
            <div class="col-md-4 d-flex flex-column">
                <img src="https://istscientific.com/wp-content/uploads/2023/10/Top-7-Lab-Supplies-Every-Laboratory-Needs.jpg" class="img-fluid rounded-start" alt="Lab Image">
            </div>
            <div class="col-md-8 d-flex flex-column">
                <div class="card-body">
                    <p><strong>Jenis Analisis:</strong> {{ $lab->jenis_analisis }}</p>
                    <p><strong>Metode Analisis:</strong> {{ $lab->metode_analisis }}</p>
                    <p><strong>Analisis:</strong> {{ $lab->analisis }}</p>
                    <p><strong>Kompetensi Personal:</strong> {{ $lab->kompetensi_personal }}</p>
                    <p><strong>Nama Pelatihan:</strong> {{ $lab->nama_pelatihan }}</p>
                    <p><strong>Tahun:</strong> {{ $lab->tahun }}</p>
                </div>
            </div>
        </div>

        <div class="sections mt-5 d-flex flex-column">

            <div id="akreditasi" class="section mb-4">
                <h2>Akreditasi</h2>
                <p><strong>Status Akreditasi:</strong> {{ $lab->akreditasi }}</p>
                <p><strong>Masa Berlaku:</strong> {{ $lab->masa_berlaku }}</p>
                <p><strong>No Akreditasi:</strong> {{ $lab->no_akreditasi }}</p>
            </div>

            <div id="facilities" class="section mb-4">
                <h2>Fasilitas</h2>
                <h4>Pelatihan dan Auditor Internal</h4>
                <p><strong>Pelatihan:</strong></p>
                <ul>
                    @foreach($lab->pelatihan as $item)
                        <li>{{ $item['nama'] }} ({{ $item['jenis'] }}) - Waktu: {{ $item['waktu'] }}</li>
                    @endforeach
                </ul>
                <p><strong>Auditor Internal:</strong> {{ $lab->auditor_internal }}</p>
                <p><strong>Fungsional Lainnya:</strong> {{ $lab->fungsional_lainnya }}</p>
                <h4>Sarana dan Prasarana:</h4>
                <p><strong>Gedung:</strong> Jumlah: {{ $lab->gedung['jumlah'] }} - Status: {{ $lab->gedung['memadai'] }}</p>
                <p><strong>Jenis Peralatan:</strong> {{ $lab->jenis_peralatan }}</p>
            </div>

            <div id="contact" class="section mb-4">
                <h2>Kontak Kami</h2>
                <p><strong>Alamat:</strong> {{ $lab->alamat_lab }}</p>
                <p><strong>Telepon:</strong> {{ $lab->telepon_lab }}</p>
            </div>

        </div>

        <div class="card-footer text-center">
            <a href="{{ route('data-Lab') }}" class="btn btn-gr">Kembali ke Daftar Laboratorium</a>
        </div>
    </div>

</div>

@endsection
