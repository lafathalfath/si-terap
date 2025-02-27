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
    public function index(Request $request) {
        $pemanfaatan_sip = new PemanfaatanSIP();
        if ($request->bsip_id) {
            $ip2sip_id = mIP2SIP::where('bsip_id', $request->bsip_id)->distinct()->pluck('id');
            $pemanfaatan_sip = PemanfaatanSIP::whereIn('ip2sip_id', $ip2sip_id);
        }
        $pemanfaatan_sip = $pemanfaatan_sip->paginate(10);

        $all_bsip = mBSIP::select(['id', 'name'])->get();
        return view('lp2tp.pemanfaatan.pemanfaatan_kp', [
            'pemanfaatan_sip' => $pemanfaatan_sip,
            'all_bsip' => $all_bsip,
        ]);
    }

    public function create() {
        $existed_ip2sip = PemanfaatanSIP::distinct()->pluck('id');
        $ip2sip = mIP2SIP::whereNotIn('id', $existed_ip2sip)->get();
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
            'pemanfaatan_diseminasi' => 'required|array',
            'pemanfaatan_diseminasi.*.name' => 'required|string',
            'pemanfaatan_diseminasi.*.luas' => 'required|numeric',
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
            'pemanfaatan_diseminasi.array' => 'Pemanfaatan Bangunan harus bertipe array',
            'pemanfaatan_diseminasi.*.name.required' => 'Nama Pemanfaatan diseminasi tidak boleh kosong',
            'pemanfaatan_diseminasi.*.luas.required' => 'Luas Pemanfaatan diseminasi tidak boleh kosong',
        ]);
        // dd($request->pemanfaatan_diseminasi);
        $pemanfaatan_sip = PemanfaatanSIP::create([
            'ip2sip_id' => $request->ip2sip_id,
            'luas_sip' => $request->luas_sip,
            'jumlah_sdm' => $request->jumlah_sdm,
            'agro_ekosistem' => $request->agro_ekosistem
        ]);
        $pemanfaatan_sip->pemanfaatan_diseminasi()->createMany($request->pemanfaatan_diseminasi);
        return response()->json(['message' => 'Data berhasil disimpan', 'data' => $pemanfaatan_sip], 201);
    }
}
