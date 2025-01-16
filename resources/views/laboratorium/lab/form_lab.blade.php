@extends('layouts.header_navbar_footer_lab')
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

        .form-section-title {
            font-size: 1.5em;
            font-weight: bold;
            color: #00452C;
            margin-top: 30px;
            margin-bottom: 15px;
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

        select, input[type="text"], input[type="number"], textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #ccc;
            border-radius: 6px;
            font-size: 1em;
            transition: border-color 0.3s ease;
        }

        select:focus, input[type="text"]:focus, input[type="number"]:focus, textarea:focus {
            border-color: #00452C;
            outline: none;
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
        <h2 class="form-title">Form Data Laboratorium</h2>
        <form action="{{ route('lab.store') }}" method="POST">
            @csrf
            <!-- Bagian Nama BPSIP -->
            <div class="form-group">
                <label for="nama_bpsip">Nama BPSIP</label>
                <select id="nama_bpsip" name="bsip_id" required>
                    <option value="" selected disabled>-- Pilih BSIP --</option>
                    @foreach ($bsip as $bs)
                        <option value="{{ $bs->id }}">{{ $bs->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Bagian Jenis Laboratorium -->
            <div class="form-group">
                <label for="jenis_lab">Jenis Laboratorium</label>
                <select name="jenis_lab_id" id="jenis_lab" required>
                    <option value="" selected disabled>-- Pilih Jenis Laboratorium --</option>
                    @foreach ($jenis_lab as $jb)
                        <option value="{{ $jb->id }}">{{ $jb->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Ruang Lingkup Analisis -->
            <div class="form-section-title">Ruang Lingkup Analisis</div>
            <div class="form-group">
                <label for="jenis_analisis">Jenis Analisis</label>
                <textarea name="jenis_analisis" id="jenis_analisis" rows="3" placeholder="Masukkan jenis analisis yang dilakukan" required></textarea>
            </div>
            <div class="form-group">
                <label for="metode_analisis">Metode Analisis</label>
                <textarea name="metode_analisis" id="metode_analisis" rows="3" placeholder="Masukkan metode analisis" required></textarea>
            </div>

            <!-- Dukungan SDM Laboratorium -->
            <div class="form-section-title">Dukungan SDM Laboratorium</div>
            <div class="form-group">
                <label for="analisis">Analisis</label>
                <textarea name="analisis" id="analisis" rows="3" placeholder="Masukkan analisis yang dilakukan" required></textarea>
            </div>
            <div class="form-group">
                <label for="kompetensi_personal">Kompetensi Personal</label>
                <textarea name="kompetensi_personal" id="kompetensi_personal" rows="2" placeholder="Masukkan informasi kompetensi personal" required></textarea>
            </div>

            <!-- Pelatihan -->
            <div class="form-section-title">Pelatihan</div>
            <div class="form-group">
                <label for="pelatihan">Nama Pelatihan</label>
                <textarea name="nama_pelatihan" id="pelatihan" rows="3" placeholder="Masukkan nama dan jenis pelatihan" required></textarea>
            </div>
            <div class="form-group">
                <label for="waktu">Waktu</label>
                <select name="tahun" id="waktu" required>
                    <option value="" disabled selected>-- Pilih Tahun --</option>
                    @for ($year = now()->year; $year >= 2000; $year--)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endfor
                </select>
            </div>

            <!-- Akreditasi -->
            <div class="form-section-title">Akreditasi</div>
            <div class="form-group">
                <label for="masa_berlaku">Masa Berlaku</label>
                <input type="text" name="masa_berlaku" id="masa_berlaku" placeholder="Masukkan masa berlaku akreditasi" required>
            </div>
            <div class="form-group">
                <label for="no_akreditasi">No Akreditasi</label>
                <input type="text" name="no_akreditasi" id="no_akreditasi" placeholder="Masukkan nomor akreditasi" required>
            </div>

            <!-- Sarana dan Prasarana Laboratorium -->
            <div class="form-section-title">Sarana dan Prasarana Laboratorium</div>
            <div class="form-group">
                <label for="gedung">Jumlah Gedung</label>
                <input type="number" name="jumlah_gedung" id="gedung" placeholder="Masukkan jumlah gedung" required>
            </div>
            <div class="form-group">
                <label for="memadai">Gedung Memadai</label>
                <select name="gedung_memadai" id="memadai" required>
                    <option value="" disabled selected>-- Pilih Status Gedung --</option>
                    <option value="Ya">Ya</option>
                    <option value="Tidak">Tidak</option>
                </select>
            </div>
            <div class="form-group">
                <label for="jenis_peralatan">Jenis Peralatan</label>
                <textarea name="jenis_peralatan" id="jenis_peralatan" rows="3" placeholder="Masukkan jenis peralatan yang dimiliki" required></textarea>
            </div>

            <!-- Kontak -->
            <div class="form-section-title">Kontak</div>
            <div class="form-group">
                <label for="foto_lab">Foto Laboratorium</label>
                <input type="file" name="foto_lab" id="foto_lab" required>
            </div>
            <div class="form-group">
                <label for="alamat_lab">Alamat Laboratorium</label>
                <textarea name="alamat_lab" id="alamat_lab" rows="3" placeholder="Masukkan alamat laboratorium" required></textarea>
            </div>
            <div class="form-group">
                <label for="telepon_lab">Nomor Telepon Laboratorium</label>
                <input type="text" name="telepon_lab" id="telepon_lab" placeholder="Masukkan nomor telepon" required>
            </div>

            <!-- Tombol Submit -->
            <div class="form-group">
                <button type="submit" class="submit-button">Kirim Data</button>
            </div>
        </form>
    </div>
@endsection
