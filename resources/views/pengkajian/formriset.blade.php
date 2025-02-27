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
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        .btn-submit {
            background-color: #28a745; /* Green background */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1rem;
        }

        .btn-submit:hover {
            background-color: #218838;
        }
    </style>

    <div class="container">
        <h2 class="header-title">Form Data Pengkajian Spesifik Lokasi</h2>

        <form action="{{ route('direktori_penyuluh.riset.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="judul">Judul Pengkajian</label>
                <input type="text" id="judul" name="judul" required>
            </div>

            <div class="form-group">
                <label for="sip">Sub Sektor</label>
                <select id="sip" name="sip_id" required>
                    <option value="" selected disabled>-- Pilih Sub Sektor --</option>
                    @foreach ($sip as $sp)
                        <option value="{{ $sp->id }}">{{ $sp->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="komoditas">Komoditas</label>
                <input type="text" id="komoditas" name="komoditas" placeholder="Masukkan komoditas" required>
            </div>

            <div class="form-group">
                <label for="tahun">Tahun</label>
                <select id="tahun" name="tahun" required>
                    <option value="" selected disabled>-- Pilih Tahun --</option>
                    @for ($i = now()->year; $i >= 2000; $i--)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div class="form-group">
                <label for="provinsi">Provinsi</label>
                <select id="provinsi" name="provinsi_id" required>
                    <option value="" selected disabled>-- Pilih Provinsi --</option>
                    @foreach ($provinsi as $pr)
                        <option value="{{ $pr->id }}">{{ $pr->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="kabupaten">Kabupaten</label>
                <select id="kabupaten" name="kabupaten_id" required>
                    <option value="" selected disabled>-- Pilih Kabupaten --</option>
                    @foreach ($kabupaten as $kb)
                        <option value="{{ $kb->id }}">{{ $kb->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="kecamatan">Kecamatan</label>
                <select id="kecamatan" name="kecamatan_id" required>
                    <option value="" selected disabled>-- Pilih Kecamatan --</option>
                    @foreach ($kecamatan as $kc)
                        <option value="{{ $kc->id }}">{{ $kc->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn-submit">Submit</button>
        </form>
    </div>
@endsection
