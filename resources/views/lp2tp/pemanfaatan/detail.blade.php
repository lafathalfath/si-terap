@extends('layouts.layoutIp2tp')

@section('content')
<style>
    body {
        background-color: #ffffff;
    }

    /* Styling untuk konten profil */
    .profil-section {
        margin: 40px auto;
        text-align: center;
    }

    .profil-section h1 {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 30px;
    }

    .profil-section .description {
        font-size: 16px;
        line-height: 1.6;
        margin-bottom: 30px;
        text-align: justify;
    }

    .profil-section img {
        width: 100%;
        border-radius: 8px;
        object-fit: cover;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        align-items: flex-start;
    }

    .table-container {
        margin: 0 auto;
        padding: 0 20px; /* Tambahkan jarak dari kanan dan kiri */
        max-width: 1200px; /* Batasi lebar maksimum tabel */
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 0 auto;
    }

    th, td {
        text-align: center;
        padding: 10px;
        border: 1px solid #ddd;
    }

    th {
        background-color: #28a745; /* Warna hijau */
        color: white; /* Warna teks putih */
    }

    td {
        background-color: #e6ffe6; /* Latar belakang hijau muda */
        color: #000; /* Warna teks hitam */
    }

    tr:nth-child(even) td {
        background-color: #ccffcc; /* Hijau lebih terang untuk baris genap */
    }
</style>

<body>
<div class="container profil-section">
    <h1>Profil Instalasi Penelitian dan Pengkajian Teknologi Pertanian KP.Gayo</h1>
    <div class="row">
        <div style="max-width: 400px; overflow: hidden;">
            <img src="/assets/img/kp-gayo.jpg" alt="Gambar BBPSIP">
            <p class="mt-2 text-center text-warning">
                <b><span style="color: black;">📍 KP Aceh </span></b><br> 
                <span style="color: green;">Kepala IP2SIP Aceh - Andi Supriyanto, S.Pt</span>
            </p>
        </div>
        <div style="max-width: 600px;">
            <p class="description">
                Sejarah singkat asal usul Kebun Percobaan ini berawal dari adanya proyek IDAP (1976-1986) kerjasama Indonesia dengan kerajaan Belanda. Pada tahun 1980 masyarakat petani kopi di Aceh Tengah tergantung kehidupannya pada komoditi kopi sementara produksi hanya 500 kg/hektar dalam setahun. Selain itu, mutu kopi juga masih rendah akibat tidak adanya prosesing yang baik sehingga pada tahun 1984 dibangun pabrik prosesing kopi arabika dengan kapasitas 15 ton kopi glondong merah perharinya. Hal ini bertujuan untuk meningkatkan kualitas mutu kopi sehingga meningkatkan pendapatan masyarakat tani sekitarnya.
            </p>
        </div>
    </div>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">BPSIP</th>
                <th rowspan="2">IP2SIP (Menurut Kepmentan No.93/2019)</th>
                <th rowspan="2">Luas IP2SIP (Ha)</th>
                <th rowspan="2">Jumlah SDM</th>
                <th colspan="6">Jenis Kegiatan Kerja Sama dan Jumlah Luasan Pemanfaatan IP2SIP TA 2024</th>
                <th rowspan="2">Total Luas Pemanfaatan (Ha)</th>
            </tr>
            <tr>
                <th>Pengkajian, Produksi, SDG, dll</th>
                <th>(Ha)</th>
                <th>Keg. Perbenihan</th>
                <th>(Ha)</th>
                <th>Keg. Kerja Sama</th>
                <th>(Ha)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Aceh</td>
                <td>KP. Gayo</td>
                <td>19.8</td>
                <td>7</td>
                <td>Pengkajian<br>Plasma Nutfah<br>Kebun Produksi<br>Visitor Plot</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>19.8</td>
            </tr>
        </tbody>
    </table>
</div>
</body>
@endsection
