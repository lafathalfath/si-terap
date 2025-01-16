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
        <h2 class="header-title">Direktori SDM</h2>

        <!-- Filter Section -->
        <form action="{{ route('sdm') }}" class="form-row" id="form-filter">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="name" id="nama">
            </div>
            <div class="form-group">
                <label for="fungsional">Fungsional</label>
                <select id="fungsional" name="fungsional_id">
                    <option value="">All</option>
                    @foreach ($fungsional as $fn)
                        <option value="{{ $fn->id }}" {{ request()->fungsional_id == $fn->id ? 'selected' : '' }}>{{ $fn->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="jenjang">Jenjang Pendidikan</label>
                <select id="jenjang" name="jenjang_id">
                    <option value="">All</option>
                    {{-- @foreach ($jenjang as $jj)
                        <option value="{{ $jj->id }}" {{ request()->jenjang_id == $jj->id ? 'selected' : '' }}>{{ $jj->name }}</option>
                    @endforeach --}}
                </select>
            </div>
            <div class="form-group">
                <label for="provinsi-input">Provinsi</label>
                <select id="provinsi-input" name="provinsi_id" onchange="handleInputProvinsi()">
                    <option value="">All</option>
                    @foreach ($provinsi as $pr)
                        <option value="{{ $pr->id }}" {{ request()->provinsi_id == $pr->id ? 'selected' : '' }}>{{ $pr->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="kabupaten-input">Kabupaten</label>
                <select id="kabupaten-input" name="kabupaten_id" onchange="handleInputKabupaten()">
                    <option value="">All</option>
                    @foreach ($kabupaten as $kb)
                        <option value="{{ $kb->id }}" {{ request()->kabupaten_id == $kb->id ? 'selected' : '' }}>{{ $kb->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="kecamatan-input">Kecamatan</label>
                <select id="kecamatan-input" name="kecamatan_id" onchange="handleInputKecamatan()">
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
            <a href="{{ route('formsdm') }}" class="btn-search">Isi Form</a>
        </div>

        <!-- Table Section -->
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Fungsional</th>
                    <th>Jenjang Pendidikan</th>
                    <th>Nomor Kontak</th>
                    <th>Provinsi</th>
                    <th>Kabupaten</th>
                    <th>Kecamatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penyuluh as $pn)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pn->name }}</td>
                        <td>{{ $pn->fungsional->name }}</td>
                        <td>{{ $pn->jenjang->name }}</td>
                        <td>{{ $pn->contact }}</td>
                        <td>{{ $pn->kecamatan->kabupaten->provinsi->name }}</td>
                        <td>{{ $pn->kecamatan->kabupaten->name }}</td>
                        <td>{{ $pn->kecamatan->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        const input_provinsi = document.getElementById('provinsi-input')
        const input_kabupaten = document.getElementById('kabupaten-input')
        const input_kecamatan = document.getElementById('kecamatan-input')
        const formFilter = document.getElementById('form-filter')

        const handleInputProvinsi = () => {
            input_kabupaten.value = ''
            input_kecamatan.value = ''
        }

        const handleInputKabupaten = () => {
            input_provinsi.value = ''
            input_kecamatan.value = ''
        }

        const handleInputKecamatan = () => {
            input_provinsi.value = ''
            input_kabupaten.value = ''
        }

        const submitFilter = () => {
            formFilter.submit()
        }
    </script>
@endsection
