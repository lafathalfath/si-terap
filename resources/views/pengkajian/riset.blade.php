@extends('layouts.layoutPengkajian')
@section('content')
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 10px;
            width: 100%;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group select,
        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 0.9rem;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 15px;
        }

        .form-row .form-group {
            flex: 1;
            min-width: 180px;
        }

        .btn-container {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-top: 15px;
        }

        .btn-search,
        .btn-isi-form {
            background-color: #28a745;  /* Green background */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1rem;
        }

        .btn-search:hover,
        .btn-isi-form:hover {
            background-color: #218838;  /* Darker green on hover */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
    </style>

    <div class="container">
        <h2 class="header-title">Pengkajian Spesifik Lokasi</h2>

        <!-- Filter Section -->
        <form action="{{ route('riset') }}" id="form-filter" class="form-row">
            <div class="form-group">
                <label for="tahun">Tahun</label>
                {{-- <input type="date" id="tanggal" name="tanggal"> --}}
                <select name="tahun" id="tahun">
                    <option value="">All</option>
                    @for ($i = now()->year; $i >= 2000; $i--)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="form-group">
                <label for="sip">Sub Sektor</label>
                <select id="sip" name="sip_id">
                    <option value="">All</option>
                    @foreach ($sip as $sp)
                        <option value="{{ $sp->id }}" {{ request()->sip_id == $sp->id ? 'selected' : '' }}>{{ $sp->name }}</option>
                    @endforeach
                </select>
            </div>
            {{-- <div class="form-group">
                <label for="komoditas">Komoditas</label>
                <select id="komoditas" name="komoditas_id">
                    <option value="">All</option>
                    @foreach ($komoditas as $kd)
                        <option value="{{ $kd->id }}" {{ request()->komoditas_id == $kd->id ? 'selected' : '' }}>{{ $kd->name }}</option>
                    @endforeach
                </select>
            </div> --}}
            <div class="form-group">
                <label for="provinsi-input">Provinsi</label>
                <select id="provinsi-input" name="provinsi_id" onchange="handleFilterProvinsi()">
                    <option value="">All</option>
                    @foreach ($provinsi as $pr)
                        <option value="{{ $pr->id }}" {{ request()->provinsi_id == $pr->id ? 'selected' : '' }}>{{ $pr->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="kabupaten-input">Kabupaten</label>
                <select id="kabupaten-input" name="kabupaten_id" onchange="handleFilterKabupaten()">
                    <option value="">All</option>
                    @foreach ($kabupaten as $kb)
                        <option value="{{ $kb->id }}" {{ request()->kabupaten_id == $kb->id ? 'selected' : '' }}>{{ $kb->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="kecamatan-input">Kecamatan</label>
                <select id="kecamatan-input" name="kecamatan_id" onchange="handleFilterKecamatan()">
                    <option value="">All</option>
                    @foreach ($kecamatan as $kc)
                        <option value="{{ $kc->id }}" {{ request()->kecamatan_id == $kc->id ? 'selected' : '' }}>{{ $kc->name }}</option>
                    @endforeach
                </select>
            </div>
        </form>

        <!-- Buttons Container -->
        <div class="btn-container">
            <button onclick="submitFilter()" class="btn-search">Cari</button>
            <a href="{{ route('formriset') }}" class="btn-search">Isi Form</a>
        </div>

        <!-- Table Section -->
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Pengkajian Spesifik Lokasi</th>
                    <th>Sub Sektor</th>
                    <th>Komoditas</th>
                    <th>Tahun</th>
                    <th>Provinsi</th>
                    <th>Kabupaten</th>
                    <th>Kecamatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riset as $rs)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $rs->judul }}</td>
                        <td>{{ $rs->sip->name }}</td>
                        <td>{{ $rs->komoditas->name }}</td>
                        <td>{{ $rs->tahun }}</td>
                        <td>{{ $rs->kecamatan->kabupaten->provinsi->name }}</td>
                        <td>{{ $rs->kecamatan->kabupaten->name }}</td>
                        <td>{{ $rs->kecamatan->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>

        const inputProvinsi = document.getElementById('provinsi-input')
        const inputKabupaten = document.getElementById('kabupaten-input')
        const inputKecamatan = document.getElementById('kecamatan-input')
        const formFilter = document.getElementById('form-filter')

        const handleFilterProvinsi = () => {
            inputKabupaten.value = ''
            inputKecamatan.value = ''
        }

        const handleFilterKabupaten = () => {
            inputProvinsi.value = ''
            inputKecamatan.value = ''
        }

        const handleFilterKecamatan = () => {
            inputProvinsi.value = ''
            inputKabupaten.value = ''
        }

        const submitFilter = () => {
            formFilter.submit()
        }
    </script>
@endsection
