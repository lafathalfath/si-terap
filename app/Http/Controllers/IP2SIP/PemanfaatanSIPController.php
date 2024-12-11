<?php

namespace App\Http\Controllers\IP2SIP;

use App\Http\Controllers\Controller;
use App\Models\mBSIP;
use App\Models\mIP2SIP;
use App\Models\PemanfaatanSIP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemanfaatanSIPController extends Controller
{
    public function index() {
        $pemanfaatan_sip = PemanfaatanSIP::get();
        return view('lp2tp.pemanfaatan.pemanfaatan_kp', [
            'pemanfaatan_sip' => $pemanfaatan_sip,
        ]);
    }

    public function create() {
        $ip2sip = mIP2SIP::get();
        return view('lp2tp.pemanfaatan.create', [
            'ip2sip' => $ip2sip,
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'ip2sip_id' => 'required|integer|unique:pemanfaatan_sip',
            'luas_sip' => 'required|numeric',
            'jumlah_sdm' => 'required|numeric',
            'agro_ekosistem' => 'required|string|max:255',
            'nomor_sertifikat' => 'required|string',
            'pj_sertifikat' => 'required|string',
            'pemanfaatan_bangunan' => 'required|array',
            'pemanfaatan_bangunan.*' => 'required|array',
            'pemanfaatan_bangunan.*.name' => 'required',
            'pemanfaatan_bangunan.*.luas' => 'required',
            'pemanfaatan_diseminasi' => 'required|array',
            'pemanfaatan_diseminasi.*' => 'required|array',
            'pemanfaatan_diseminasi.*.name' => 'required',
            'pemanfaatan_diseminasi.*.luas' => 'required',
        ], [
            'ip2sip_id.required' => 'ID IP2SIP tidak boleh kosong',
            'ip2sip_id.integer' => 'ID IP2SIP harus berupa angka',
            'ip2sip_id.unique' => 'ID IP2SIP sudah digunakan',
            'luas_sip.required' => 'Luas SIP tidak boleh kosong',
            'luas_sip.numeric' => 'Luas SIP harus berupa angka',
            'jumlah_sdm.required' => 'Jumlah SDM tidak boleh kosong',
            'jumlah_sdm.numeric' => 'Jumlah SDM harus berupa angka',
            'agro_ekosistem.required' => 'Agro Eksosistem tidak boleh kosong',
            'agro_ekosistem.max' => 'Agro Eksosistem tidak boleh melebihi 255 karakter',
            'nomor_sertifikat.required' => 'Nomor Sertifikat tidak boleh kosong',
            'nomor_sertifikat.string' => 'Nomor Sertifikat harus bertipe string',
            'pj_sertifikat.required' => 'PJ Sertifikat tidak boleh kosong',
            'pj_sertifikat.string' => 'PJ Sertifikat harus bertipe string',
            'pemanfaatan_bangunan.required' => 'Pemanfaatan Bangunan tidak boleh kosong',
            'pemanfaatan_bangunan.array' => 'Pemanfaatan Bangunan harus bertipe array',
            'pemanfaatan_bangunan.*.name.required' => 'Nama Pemanfaatan bangunan tidak boleh kosong',
            'pemanfaatan_bangunan.*.luas.required' => 'Luas Pemanfaatan bangunan tidak boleh kosong',
            'pemanfaatan_bangunan.required' => 'Pemanfaatan Bangunan tidak boleh kosong',
            'pemanfaatan_diseminasi.array' => 'Pemanfaatan Bangunan harus bertipe array',
            'pemanfaatan_diseminasi.*.name.required' => 'Nama Pemanfaatan diseminasi tidak boleh kosong',
            'pemanfaatan_diseminasi.*.luas.required' => 'Luas Pemanfaatan diseminasi tidak boleh kosong',
        ]);
        $pemanfaatan_sip = PemanfaatanSIP::create([
            'ip2sip_id' => $request->ip2sip_id,
            'luas_sip' => $request->luas_sip,
            'jumlah_sdm' => $request->jumlah_sdm,
            'agro_ekosistem' => $request->agro_ekosistem,
            'nomor_sertifikat' => $request->nomor_sertifikat,
            'pj_sertifikat' => $request->pj_sertifikat,
        ]);
        $pemanfaatan_sip_id = $pemanfaatan_sip->id;
        $pemanfaatan_bangunan = [];
        foreach ($request->pemanfaatan_bangunan as $item) {
            $pemanfaatan_bangunan[] = [
                'pemanfaatan_sip_id' => $pemanfaatan_sip_id,
                'name' => $item['name'],
                'luas' => $item['luas'],
            ];
        }
        $pemanfaatan_diseminasi = [];
        foreach ($request->pemanfaatan_diseminasi as $item) {
            $pemanfaatan_diseminasi[] = [
                'pemanfaatan_sip_id' => $pemanfaatan_sip_id,
                'name' => $item['name'],
                'luas' => $item['luas'],
            ];
        }
        DB::table('pemanfaatan_bangunan')->insert($pemanfaatan_bangunan);
        DB::table('pemanfaatan_diseminasi')->insert($pemanfaatan_diseminasi);
        return response()->json(['message' => 'Data berhasil disimpan', 'data' => $pemanfaatan_sip], 201);
    }
}
