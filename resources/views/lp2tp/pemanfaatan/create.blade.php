@extends('layouts.layoutIp2tp')

@section('content')
<style>
    .form-container {
        max-width: 800px;
        margin: auto;
        background-color: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        font-family: 'Poppins', sans-serif;
        color: #333;
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
        margin-bottom: 20px;
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

    .dynamic-input-container {
        border: 1px solid #ccc;
        padding: 15px;
        margin-bottom: 15px;
        border-radius: 6px;
    }

    .dynamic-input {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
    }

    .add-button {
        background-color: #00452C;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        font-size: 1em;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .add-button:hover {
        background-color: #006a44;
        box-shadow: 0 4px 8px rgba(0, 100, 70, 0.3);
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
</style>

<div class="form-container">
    <h2 class="form-title">Form Input Pemanfaatan Kebun Percobaan</h2>
    <form action="{{ route('lp2tp.pemanfaatan_kp.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="ip2sip_id">IP2SIP</label>
            <select name="ip2sip_id" id="ip2sip_id" required>
                <option value="" disabled selected>-- Pilih IP2SIP --</option>
                @foreach($ip2sip as $ip)
                    <option value="{{ $ip->id }}">BPSIP {{ $ip->bsip->name }} - IP2SIP {{ $ip->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="luas_sip">Luas Standar Instrumen Pertanian</label>
            <input type="number" name="luas_sip" id="luas_sip" min="0" step="0.001" required>
        </div>

        <div class="form-group">
            <label for="jumlah_sdm">Jumlah Sumber Daya Manusia</label>
            <input type="number" name="jumlah_sdm" id="jumlah_sdm" min="0" required>
        </div>

        <div class="form-group">
            <label for="agro_ekosistem">Agroekosistem</label>
            <input type="text" name="agro_ekosistem" id="agro_ekosistem" required>
        </div>

        {{-- <div class="form-group">
            <label for="nomor_sertifikat">Nomor Sertifikat</label>
            <input type="text" name="nomor_sertifikat" id="nomor_sertifikat" required>
        </div>

        <div class="form-group">
            <label for="pj_sertifikat">Penanggung Jawab Sertifikat</label>
            <input type="text" name="pj_sertifikat" id="pj_sertifikat" required>
        </div>

        <div class="form-group">
            <label>Pemanfaatan Bangunan</label>
            <div id="input_bangunan_container" class="dynamic-input-container">
                <div class="dynamic-input">
                    <input type="text" name="pemanfaatan_bangunan[0][name]" placeholder="Nama" required>
                    <input type="number" name="pemanfaatan_bangunan[0][luas]" min="0" step="0.001" placeholder="Luas (Ha)" required>
                </div>
                <button type="button" class="add-button" onclick="addInputBangunan()">+ Tambah Bangunan</button>
            </div>
        </div> --}}

        <div class="form-group">
            <label>Pemanfaatan Diseminasi</label>
            <div id="input_diseminasi_container" class="dynamic-input-container">
                <div class="dynamic-input">
                    <input type="text" name="pemanfaatan_diseminasi[0][name]" placeholder="Nama" required>
                    <input type="number" name="pemanfaatan_diseminasi[0][luas]" min="0" step="0.001" placeholder="Luas (Ha)" required>
                </div>
                <button type="button" class="add-button" onclick="addInputDiseminasi()">+ Tambah Diseminasi</button>
            </div>
        </div>

        <button type="submit" class="submit-button">Simpan Data</button>
    </form>
</div>

<script>
    // let currentIndexBangunan = 0;
    let currentIndexDiseminasi = 0;

    // const addInputBangunan = () => {
    //     currentIndexBangunan++;
    //     const container = document.getElementById('input_bangunan_container');
    //     const newInput = document.createElement('div');
    //     newInput.className = 'dynamic-input';
    //     newInput.innerHTML = `
    //         <input type="text" name="pemanfaatan_bangunan[${currentIndexBangunan}][name]" placeholder="Nama" required>
    //         <input type="number" name="pemanfaatan_bangunan[${currentIndexBangunan}][luas]" min="0" step="0.001" placeholder="Luas (Ha)" required>
    //     `;
    //     container.insertBefore(newInput, container.lastElementChild);
    // };

    const addInputDiseminasi = () => {
        currentIndexDiseminasi++;
        const container = document.getElementById('input_diseminasi_container');
        const newInput = document.createElement('div');
        newInput.className = 'dynamic-input';
        newInput.innerHTML = `
            <input type="text" name="pemanfaatan_diseminasi[${currentIndexDiseminasi}][name]" placeholder="Nama" required>
            <input type="number" name="pemanfaatan_diseminasi[${currentIndexDiseminasi}][luas]" min="0" step="0.001" placeholder="Luas (Ha)" required>
        `;
        container.insertBefore(newInput, container.lastElementChild);
    };
</script>
@endsection