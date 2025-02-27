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
        <h2 class="header-title">Form Direktori SDM</h2>

        <form action="{{ route('direktori_penyuluh.penyuluh.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nama Penyuluh</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="contact">Nomor Kontak</label>
                <input type="text" id="contact" name="contact" required>
            </div>

            <div class="form-group">
                <label for="fungsional">Fungsional</label>
                <select id="fungsional" name="fungsional_id" required>
                    <option value="" selected disabled>-- Pilih Fungsional --</option>
                    @foreach ($fungsional as $fn)
                        <option value="{{ $fn->id }}">{{ $fn->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="jenjang_pendidikan">Jenjang Pendidikan</label>
                <select id="jenjang_pendidikan" name="jenjang_pendidikan" required>
                    <option value="" selected disabled>-- Pilih Jenjang Pendidikan --</option>
                    <option value="SLTA">SLTA</option>
                    <option value="Diploma">Diploma</option>
                    <option value="Sarjana">Sarjana</option>
                    <option value="Magister">Magister</option>
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
