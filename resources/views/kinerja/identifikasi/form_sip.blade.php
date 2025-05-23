@extends('layouts.layoutKinerja')
@section('content')
    <style>
        .form-container {
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            font-family: 'Poppins', sans-serif;
            color: #333;
            margin-bottom: 50px; 
        }

        .form-title {
            font-size: 2em;
            font-weight: bold;
            color: #00452C;
            text-align: center;
            margin-bottom: 25px;
            text-transform: uppercase;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
            color: #333;
        }

        select, input[type="text"], input[type="number"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #ccc;
            border-radius: 6px;
            font-size: 1em;
            transition: border-color 0.3s ease;
        }

        select:focus, input[type="text"]:focus, input[type="number"]:focus {
            border-color: #00452C;
            outline: none;
        }

        .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .radio-group {
            display: flex;
            gap: 20px;
        }

        .submit-button {
            background-color: #00452C;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            font-size: 1.1em;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            text-align: center;
        }

        .submit-button:hover {
            background-color: #006a44;
            box-shadow: 0 4px 8px rgba(0, 100, 70, 0.3);
        }

        .form-group input[type="checkbox"] {
            margin-right: 5px;
        }

        .form-group input[type="radio"] {
            margin-right: 5px;
        }
    </style>

    <div class="form-container">
        <h2 class="form-title"> Form Data identifikasi Standar Instrumen Pertanian</h2>
        <form action="{{ route('kinerja.identifikasi.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="bsip">BSIP</label>
                <select name="bsip_id" id="bsip" required>
                    <option value="" disabled selected>Pilih Daerah BSIP</option>
                    @foreach ($bsip as $b)
                        <option value="{{ $b->id }}">{{ $b->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="sip">SIP</label>
                {{-- <input type="text" name="sip" id="sip" placeholder="Masukkan Daerah SIP" required> --}}
                <div class="checkbox-group">
                    @foreach ($sip as $sp)
                        <label><input type="checkbox" name="sip_id[]" id="sip" value="{{ $sp->id }}">{{ $sp->name }}</label>
                    @endforeach
                </div>
            </div>

            <div class="form-group">
                <label for="metode">Metode Identifikasi</label>
                <select name="metode_id" id="metode" required>
                    <option value="" disabled selected>Pilih Metode Identifikasi</option>
                    @foreach ($metode as $met)
                        <option value="{{ $met->id }}">{{ $met->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tahun">Tahun</label>
                <select name="tahun" id="tahun" required>
                    <option value="" disabled selected>Pilih Tahun</option>
                    @for ($year = now()->year; $year >= 2000; $year--)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endfor
                </select>
            </div>

            <div class="form-group">
                <label>Sasaran Penerap</label>
                <div class="checkbox-group">
                    @foreach ($sasaran as $sr)
                        <label><input type="checkbox" name="sasaran_id[]" value="{{ $sr->id }}">{{ $sr->name }}</label>
                    @endforeach
                </div>
            </div>

            <div class="form-group">
                <label>Jenis Usulan</label>
                <div class="radio-group">
                    <label><input type="radio" name="jenis_usulan" value="revisi" required> Revisi</label>
                    <label><input type="radio" name="jenis_usulan" value="baru" required> Baru</label>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="submit-button">Kirim Data</button>
            </div>
        </form>
    </div>
@endsection
