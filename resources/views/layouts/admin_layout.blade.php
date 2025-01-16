<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Manage Website</title>
    <style>
        body {
            display: flex;
            margin: 0;
            padding: 0;
            font-family: poppins, sans-serif;
        }

        nav {
        width: 300px; /* Perbesar sesuai kebutuhan, misalnya 300px */
        min-width: 250px; /* memastikan minimal ukuran cukup untuk konten */
        background-color: #00452C;
        padding: 20px 0;
        overflow-y: auto;
        }

        nav > div {
            padding: 10px 20px;
            color: #fff;
        }
        
        .nav-item {
            width: 100%;
            font-size: 16px;
            padding: 10px 20px;
            text-decoration: none;
            color: #fff;
            background-color: #00452C;
            text-align: left;
            text-transform: capitalize;
            display: block;
        }

        .nav-item:hover{
            background-color: #006540;
        }

        .nav-item:active{
            background-color: #006540;
        }

        .group-child {
            display: flex;
            flex-direction: column;
            /* gap: 5px; Tambahkan jarak antar submenu */
            margin-left: 10px; 
        }
        
        .nav-child {
            font-size: 16px;
            padding: 10px 20px;
            text-decoration: none;
            color: #fff;
            border-left: none;
            border-right: none;
            text-align: left;
            text-transform: capitalize;
        }

        .nav-child:hover{
            background-color: #006540;
        }

        .body-content {
            width: 100%;
            height: 100vh;
            overflow-y: scroll;
        }

        .body-content > div {
            padding: 10px 20px;
            gap: 20px; 
        }

            img {
        width: 120px; /* Sesuaikan ukuran ini sesuai kebutuhan */
        height: auto; /* Agar proporsi gambar tetap terjaga */
        margin: 0 auto; /* Untuk memusatkan gambar (opsional) */
        display: block; /* Agar lebih mudah diatur */
        }


        button.nav-item {
            width: 100%;
            font-size: 16px;
            padding: 10px 0px;
            text-decoration: none;
            color: #fff;
            background-color: #00452C;
            border: none;
            text-align: left;
            text-transform: capitalize;
            display: block;
            cursor: pointer; /* Tampilkan pointer saat hover */
        }

        button.nav-item:hover {
            background-color: #006540;
        }

        button.nav-item:active {
            background-color: #006540;
        }

        /* Update elemen .group-child agar child tidak berbeda style */
        .group-child {
            margin-left: 0; /* Hilangkan indentasi */
        }

        .group-child .nav-item {
            padding-left: 20px; /* Tambahkan padding untuk indentasi */
            font-size: 15px; /* Sedikit lebih kecil untuk membedakan */
        }

        .group-child .nav-item:hover {
            background-color: #006540; /* Konsisten dengan hover */
        }
    </style>
</head>
@php
    $common = [
        ['name' => 'Jenis Standar', 'table' => 'm_jenis_standard'],
        ['name' => 'Kelompok Standar', 'table' => 'm_kelompok_standard'],
        ['name' => 'Lembaga', 'table' => 'm_lembaga'],
        ['name' => 'Metode', 'table' => 'm_metode'],
        ['name' => 'Sasaran', 'table' => 'm_sasaran'],
        ['name' => 'SIP', 'table' => 'm_sip'],
        ['name' => 'Komoditas', 'table' => 'm_komoditas'],
        ['name' => 'Kelas Benih', 'table' => 'm_kelas_benih'],
        ['name' => 'Fungsional', 'table' => 'm_fungsional'],
        ['name' => 'Jenis Lab', 'table' => 'm_jenis_lab'],
    ];
@endphp
<body>
    <nav>
        <div>
            <div>
                <a href="{{ route('home') }}">
                    <img src="/assets/img/logo_bsip.png" alt="app logo">
                </a>
            </div>
            <br>
            <div>
                {{ auth()->user()->name }}
            </div>
            <br>
            <div style="display: flex;flex-direction:column;">
                <a href="{{ route('manage.dashboard') }}" class="nav-item">Dashboard</a>
                <a href="{{ route('manage.service.view') }}" class="nav-item">Service</a>
                <a href="{{ route('manage.accounts.view') }}" class="nav-item">Accounts</a>
                <a href="{{ route('manage.cms.view') }}" class="nav-item">App Management</a>
                <button class="nav-item" onclick="showRegion()">Region &#11206;</button>
                <div id="region" class="group-child" style="display: none;flex-direction:column;">
                    <a href="{{ route('manage.provinsi.view') }}" class="nav-item">Provinsi</a>
                    <a href="{{ route('manage.kabupaten.view') }}" class="nav-item">Kabupaten</a>
                    <a href="{{ route('manage.kecamatan.view') }}" class="nav-item">Kecamatan</a>
                </div>
                <button class="nav-item" onclick="showCommon()">Common &#11206;</button>
                <div id="common" class="group-child" style="display: none;flex-direction:column;">
                    <a href="{{ route('manage.bsip.view') }}" class="nav-child">BSIP</a>
                    <a href="{{ route('manage.profile_bsip.index') }}" class="nav-child">BSIP Profile</a>
                    <a href="{{ route('manage.ip2sip.view') }}" class="nav-child">IP2SIP</a>
                    <a href="{{ route('manage.gallery.index') }}" class="nav-child">Gallery</a>
                    @foreach ($common as $cm)
                        <a href="{{ route('manage.data.common', ['name' => $cm['name'], 'table' => Crypt::encryptString($cm['table'])]) }}" class="nav-child">{{ $cm['name'] }}</a>
                    @endforeach
                </div>
            </div>
        </div>
        <div>
            <a href="{{ route('auth.logout') }}" class="nav-item">Logout</a>
        </div>
        <br><br>
    </nav>
    <div class="body-content">
        <div>
            @if ($errors->any())
                <button style="
                    padding: 5px 10px;
                    color: red;
                    border: 1px solid red;
                    border-radius: 5px;
                    background-color: #efbbbb;
                    width: 100%;
                    text-align: start;
                    display: flex;
                    flex-direction: column;
                    align-items: flex-start;
                    justify-content: center;
                " onclick="hideAlert(this)">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </button>
            @endif
            @if (session('success'))
                <button style="
                    padding: 5px 10px;
                    color: green;
                    border: 1px solid green;
                    border-radius: 5px;
                    background-color: #bbefbb;
                    width: 100%;
                    text-align: start;
                    display: flex;
                    flex-direction: column;
                    align-items: flex-start;
                    justify-content: center;
                " onclick="hideAlert(this)">
                    {{ session('success') }}
                </button>
            @endif
        </div>
        <div>
            @yield('content')
        </div>
    </div>

    <script>
        const showCommon = () => {
            const common = document.getElementById('common');
            common.style.display = common.style.display === 'flex' ? 'none' : 'flex';
        }
        const showRegion = () => {
            const region = document.getElementById('region');
            region.style.display = region.style.display === 'flex' ? 'none' : 'flex';
        }
        const hideAlert = (e) => {
            e.style.display = 'none';
        }
    </script>
</body>
</html>