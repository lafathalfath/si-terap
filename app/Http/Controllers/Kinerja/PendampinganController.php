<?php

namespace App\Http\Controllers\Kinerja;

use App\Http\Controllers\Controller;
use App\Models\Pendampingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class PendampinganController extends Controller
{
    public function get() {
        $pendampingan = Pendampingan::get();
        return $pendampingan;
        // return view('<pendampingan view>', ['pendampingan' => $pendampingan]);
    }

    public function getById($id) {
        $pendampingan = Pendampingan::find(Crypt::decryptString($id));
        if (!$pendampingan) return back()->withErrors('data not found');
        return $pendampingan;
        // return view('<pendampingan detail view>', ['pendampingan' => $pendampingan]);
    }

    public function store(Request $request) {
        $request->validate([
            'bsip_id' => 'required',
            'tanggal' => 'required|date',
            'nama_lembaga' => 'required|string',
            'lembaga_id' => 'required',
            'skala' => 'required|integer',
            'unit_skala' => 'required|in:ton,ha,unit', // enum ['ton', 'ha', 'unit']
            'lpk' => 'required|string',
            'jenis_standard_id' => 'required',
            'kelompok_standard_id' => 'required',
            'nomor_standard' => 'required|string',
            'judul_standard' => 'required|string',
            'capaian_kegiatan' => 'required|in:belum dapat sertifikat,sertifikat bina UMKM,sertifikat SNI',
        ], [
            'bsip_id.required' => 'BSIP cannot be null',
            'tanggal.required' => 'Tanggal cannot be null',
            'tanggal.date' => 'Tanggal must be a date',
            'nama_lembaga.required' => 'Nama Lembaga cannot be null',
            'nama_lembaga.string' => 'Nama Lembaga must be a string',
            'lembaga_id.required' => 'Lembaga cannot be null',
            'skala.required' => 'Skala cannot be null',
            'skala.integer' => 'Skala must be an integer',
            'unit_skala.required' => 'Unit Skala cannot be null',
            'unit_skala.in' => 'Unit Skala must be one of the following: ton, ha, unit',
            'lpk.required' => 'LPK cannot be null',
            'lpk.string' => 'LPK must be a string',
            'jenis_standard_id.required' => 'Jenis Standard cannot be null',
            'kelompok_standard_id.required' => 'Kelompok Standard cannot be null',
            'nomor_standard.required' => 'Nomor Standard cannot be null',
            'nomor_standard.string' => 'Nomor Standard must be a string',
            'judul_standard.required' => 'Judul Standard cannot be null',
            'judul_standard.string' => 'Judul Standard must be a string',
            'capaian_kegiatan.required' => 'Capaian Kegiatan cannot be null',
            'capaian_kegiatan.in' => 'Capaian Kegiatan must be one of the following: belum dapat sertifikat, sertifikat bina UMKM, sertifikat SNI',
        ]);
        $data_pendampingan = [
            'bsip_id' => $request->bsip_id,
            'tanggal' => $request->tanggal,
            'nama_lembaga' => $request->nama_lembaga,
            'lembaga_id' => $request->lembaga_id,
            'skala' => $request->skala,
            'unit_skala' => $request->unit_skala,
            'lpk' => $request->lpk,
            'jenis_standard_id' => $request->jenis_standard_id,
            'kelompok_standard_id' => $request->kelompok_standard_id,
            'nomor_standard' => $request->nomor_standard,
            'judul_standard' => $request->judul_standard,
            'capaian_kegiatan' => $request->capaian_kegiatan,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ];
        Pendampingan::create($data_pendampingan);
        // return back()->with('success', 'created');
        return redirect()->route('kinerja.pendampingan.view')->with('success', 'created');
    }

    public function update($id, Request $request) {
        $pendampingan = Pendampingan::find(Crypt::decryptString($id));
        if (!$pendampingan) return back()->withErrors('data not found');
        $request->validate([
            'bsip_id' => 'required',
            'tanggal' => 'required|date',
            'nama_lembaga' => 'required|string',
            'lembaga_id' => 'required',
            'skala' => 'required|integer',
            'unit_skala' => 'required|in:ton,ha,unit', // enum ['ton', 'ha', 'unit']
            'lpk' => 'required|string',
            'jenis_standard_id' => 'required',
            'kelompok_standard_id' => 'required',
            'nomor_standard' => 'required|string',
            'judul_standard' => 'required|string',
            'capaian_kegiatan' => 'required|in:belum dapat sertifikat,sertifikat bina UMKM,sertifikat SNI',
        ], [
            'bsip_id.required' => 'BSIP cannot be null',
            'tanggal.required' => 'Tanggal cannot be null',
            'tanggal.date' => 'Tanggal must be a date',
            'nama_lembaga.required' => 'Nama Lembaga cannot be null',
            'nama_lembaga.string' => 'Nama Lembaga must be a string',
            'lembaga_id.required' => 'Lembaga cannot be null',
            'skala.required' => 'Skala cannot be null',
            'skala.integer' => 'Skala must be an integer',
            'unit_skala.required' => 'Unit Skala cannot be null',
            'unit_skala.in' => 'Unit Skala must be one of the following: ton, ha, unit',
            'lpk.required' => 'LPK cannot be null',
            'lpk.string' => 'LPK must be a string',
            'jenis_standard_id.required' => 'Jenis Standard cannot be null',
            'kelompok_standard_id.required' => 'Kelompok Standard cannot be null',
            'nomor_standard.required' => 'Nomor Standard cannot be null',
            'nomor_standard.string' => 'Nomor Standard must be a string',
            'judul_standard.required' => 'Judul Standard cannot be null',
            'judul_standard.string' => 'Judul Standard must be a string',
            'capaian_kegiatan.required' => 'Capaian Kegiatan cannot be null',
            'capaian_kegiatan.in' => 'Capaian Kegiatan must be one of the following: belum dapat sertifikat, sertifikat bina UMKM, sertifikat SNI',
        ]);
        $data_pendampingan = [
            'bsip_id' => $request->bsip_id,
            'tanggal' => $request->tanggal,
            'nama_lembaga' => $request->nama_lembaga,
            'lembaga_id' => $request->lembaga_id,
            'skala' => $request->skala,
            'unit_skala' => $request->unit_skala,
            'lpk' => $request->lpk,
            'jenis_standard_id' => $request->jenis_standard_id,
            'kelompok_standard_id' => $request->kelompok_standard_id,
            'nomor_standard' => $request->nomor_standard,
            'judul_standard' => $request->judul_standard,
            'capaian_kegiatan' => $request->capaian_kegiatan,
            'updated_by' => Auth::user()->id,
        ];
        $pendampingan->update($data_pendampingan);
        // return back()->with('success', 'updated');
        return redirect()->route('kinerja.pendampingan.view')->with('success', 'updated');
    }
    
    public function destroy($id) {
        $pendampingan = Pendampingan::find(Crypt::decryptString($id));
        if (!$pendampingan) return back()->withErrors('data not found');
        $pendampingan->delete();
        // return back()->with('success', 'deleted');
        return redirect()->route('kinerja.pendampingan.view')->with('success', 'deleted');
    }
}
