<?php

namespace App\Http\Controllers\Lab;

use App\Http\Controllers\Controller;
use App\Models\Laboratorium;
use App\Models\mBSIP;
use App\Models\mJenisLab;
use App\Models\Daftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class LaboratoriumController extends Controller
{
    public function index(Request $request) {
        $lab = new Laboratorium();
        $lab = $lab->with(['bsip', 'jenis_lab']);
        if ($request->bsip_id) $lab = $lab->where('bsip_id', $request->bsip_id);
        if ($request->tahun) $lab = $lab->where('tahun', $request->tahun);
        $lab = $lab->get();
        
        $bsip = mBSIP::select(['id', 'name'])->get();
        return view('laboratorium.berandaLab', [
            'lab' => $lab,
            'bsip' => $bsip,
        ]);
    }

    public function show(Request $request) {
        $lab = new Laboratorium();
        $lab = $lab->with(['bsip', 'jenis_lab']);
        if ($request->bsip_id) $lab = $lab->where('bsip_id', $request->bsip_id);
        if ($request->tahun) $lab = $lab->where('tahun', $request->tahun);
        $lab = $lab->get();
        
        $bsip = mBSIP::select(['id', 'name'])->get();
        return view('laboratorium.lab.beranda', [
            'lab' => $lab,
            'bsip' => $bsip,
        ]);
    }
    public function jadwalLab(Request $request) {
        $lab = new Laboratorium();
        $lab = $lab->with(['bsip', 'jenis_lab']);
        if ($request->bsip_id) $lab = $lab->where('bsip_id', $request->bsip_id);
        if ($request->tahun) $lab = $lab->where('tahun', $request->tahun);
        $lab = $lab->get();
        // Ambil daftar dengan relasi laboratorium dan bsip
    $daftar = Daftar::with('laboratorium.bsip')->get();
        $bsip = mBSIP::select(['id', 'name'])->get();
        return view('laboratorium.jadwal.jadwal_lab', [
            'lab' => $lab,
            'bsip' => $bsip,
            'daftar' => $daftar,
        ]);

    }
     

    public function create() {
        $bsip = mBSIP::select(['id', 'name'])->get();
        $jenis_lab = mJenisLab::select(['id', 'name'])->get();
        return view('laboratorium.lab.form_lab', [
            'bsip' => $bsip,
            'jenis_lab' => $jenis_lab,
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'bsip_id' => 'required|numeric',
            'jenis_lab_id' => 'required|numeric',
            'longitude' => 'required|string',
            'latitude' => 'required|string',
            'jenis_analisis' => 'required|string',
            'metode_analisis' => 'required|string',
            'analisis' => 'required|string',
            'kompetensi_personal' => 'required|string',
            'nama_pelatihan' => 'required|string',
            'tahun' => 'required|numeric',
            'masa_berlaku' => 'required|string',
            'no_akreditasi' => 'required|string',
            'jumlah_gedung' => 'required|integer',
            'gedung_memadai' => 'required|in:Ya,Tidak',
            'jenis_peralatan' => 'required|string',
            'foto_lab' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'alamat_lab' => 'required|string',
            'telepon_lab' => 'required|string',
        ], [
            'bsip_id.required' => 'BSIP tidak boleh kosong',
            'jenis_lab_id.required' => 'Jenis Lab tidak boleh kosong',
            'longitude.required' => 'Longtitude tidak boleh kosong',
            'latitude.required' => 'Latitude tidak boleh kosong',
            'jenis_analisis.required' => 'Jenis Analisis tidak boleh kosong',
            'metode_analisis.required' => 'Metode Analisis tidak boleh kosong',
            'analisis.required' => 'Analisis tidak boleh kosong',
            'kompetensi_personal.required' => 'Kompetensi Personal tidak boleh kosong',
            'nama_pelatihan.required' => 'Nama Pelatihan tidak boleh kosong',
            'tahun.required' => 'tahun tidak boleh kosong',
            'masa_berlaku.required' => 'Masa Berlaku tidak boleh kosong',
            'no_akreditasi.required' => 'No Akreditasi tidak boleh kosong',
            'jumlah_gedung.required' => 'Jumlah Gedung tidak boleh kosong',
            'gedung_memadai.required' => 'Gedung Memadai tidak boleh kosong',
            'jenis_peralatan.required' => 'Jenis Peralatan tidak boleh kosong',
            'foto_lab.required' => 'Foto Lab tidak boleh kosong',
            'alamat_lab.required' => 'Alamat Lab tidak boleh kosong',
            'telepon_lab.required' => 'Telepon Lab tidak boleh kosong',
        ]);

        $path = null;
        if ($request->hasFile('foto_lab')) {
            $file = $request->file('foto_lab');
            $path = $file->store('lab-images', 'public'); // hasilnya: lab-images/nama_file.jpg
        }
        $lab = Laboratorium::create([
            'bsip_id' => $request->bsip_id,
            'jenis_lab_id' => $request->jenis_lab_id,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'jenis_analisis' => $request->jenis_analisis,
            'metode_analisis' => $request->metode_analisis,
            'analisis' => $request->analisis,
            'kompetensi_personal' => $request->kompetensi_personal,
            'nama_pelatihan' => $request->nama_pelatihan,
            'tahun' => $request->tahun,
            'masa_berlaku' => $request -> masa_berlaku,
            'no_akreditasi' => $request -> no_akreditasi,
            'jumlah_gedung' => $request -> jumlah_gedung,
            'gedung_memadai' => $request -> gedung_memadai,
            'jenis_peralatan' => $request -> jenis_peralatan, 
            'foto_lab' => $path,
            'alamat_lab' => $request ->  alamat_lab,
            'telepon_lab' => $request -> telepon_lab,
        ]);
        
        if (!$lab) return back()->withErrors('failed to store data');
        return redirect()->route('data-Lab')->with('success', 'created');
    }

    public function update($id, Request $request) {
        $lab = Laboratorium::find(Crypt::decryptString($id));
        if (!$lab) return back()->withErrors('data not found');
        $request->validate([
            'bsip_id' => 'required|numeric',
            'jenis_lab_id' => 'required|numeric',
            'longitude' => 'required|string',
            'latitude' => 'required|string',
            'jenis_analisis' => 'required|string',
            'metode_analisis' => 'required|string',
            'analisis' => 'required|string',
            'kompetensi_personal' => 'required|string',
            'nama_pelatihan' => 'required|string',
            'tahun' => 'required|numeric',
            'masa_berlaku' => 'required|string',
            'no_akreditasi' => 'required|string',
            'jumlah_gedung' => 'required|integer',
            'gedung_memadai' => 'required|in:Ya,Tidak',
            'jenis_peralatan' => 'required|string',
            'foto_lab' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'alamat_lab' => 'required|string',
            'telepon_lab' => 'required|string',
        ], [
            'bsip_id.required' => 'BSIP tidak boleh kosong',
            'jenis_lab_id.required' => 'Jenis Lab tidak boleh kosong',
            'longitude.required' => 'Longtitude tidak boleh kosong',
            'latitude.required' => 'Latitude tidak boleh kosong',
            'jenis_analisis.required' => 'Jenis Analisis tidak boleh kosong',
            'metode_analisis.required' => 'Metode Analisis tidak boleh kosong',
            'analisis.required' => 'Analisis tidak boleh kosong',
            'kompetensi_personal.required' => 'Kompetensi Personal tidak boleh kosong',
            'nama_pelatihan.required' => 'Nama Pelatihan tidak boleh kosong',
            'tahun.required' => 'tahun tidak boleh kosong',
            'masa_berlaku.required' => 'Masa Berlaku tidak boleh kosong',
            'no_akreditasi.required' => 'No Akreditasi tidak boleh kosong',
            'jumlah_gedung.required' => 'Jumlah Gedung tidak boleh kosong',
            'gedung_memadai.required' => 'Gedung Memadai tidak boleh kosong',
            'jenis_peralatan.required' => 'Jenis Peralatan tidak boleh kosong',
            'foto_lab.required' => 'Foto Lab tidak boleh kosong',
            'alamat_lab.required' => 'Alamat Lab tidak boleh kosong',
            'telepon_lab.required' => 'Telepon Lab tidak boleh kosong',
        ]);
        $lab = $lab->update([
            'bsip_id' => $request->bsip_id,
            'jenis_lab_id' => $request->jenis_lab_id,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'jenis_analisis' => $request->jenis_analisis,
            'metode_analisis' => $request->metode_analisis,
            'analisis' => $request->analisis,
            'kompetensi_personal' => $request->kompetensi_personal,
            'nama_pelatihan' => $request->nama_pelatihan,
            'tahun' => $request->tahun,
            'masa_berlaku' => $request -> masa_berlaku,
            'no_akreditasi' => $request -> no_akreditasi,
            'jumlah_gedung' => $request -> jumlah_gedung,
            'gedung_memadai' => $request -> gedung_memadai,
            'jenis_peralatan' => $request -> jenis_peralatan,
            'foto_lab' => $request -> foto_lab,
            'alamat_lab' => $request ->  alamat_lab,
            'telepon_lab' => $request -> telepon_lab,
        ]);
        
        if (!$lab) return back()->withErrors('failed to update data');
        return redirect()->route('data-Lab')->with('success', 'updated');
    }

    public function destroy($id) {
        $lab = Laboratorium::find(Crypt::decryptString($id));
        if (!$lab) return back()->withErrors('data not found');
        $lab->delete();
        if ($lab) return back()->withErrors('failed to delete data');
        return redirect()->route('data-Lab')->with('success', 'deleted');
    }

    public function showDetail($id) {
        // $lab = Laboratorium::findOrFail($id);
        // // if (!$lab) return back()->withErrors('data not found');
        // return view('laboratorium.lab.detail', compact('lab'));
        $lab = Laboratorium::find($id);
        $kegiatans = $lab->kegiatanLabs()->latest()->get();
    // dd($lab); // Debugging
    return view('laboratorium.lab.detail', compact('lab', 'kegiatans'));
    }
    public function showFormId($id) {
        // $lab = Laboratorium::findOrFail($id);
        // // if (!$lab) return back()->withErrors('data not found');
        // return view('laboratorium.lab.detail', compact('lab'));
        $lab = Laboratorium::find($id);
    // dd($lab); // Debugging
    return view('laboratorium.jadwal.form_daftar', compact('lab'));
    }

    public function storeDaftar(Request $request)
{
    $request->validate([
        'laboratorium_id' => 'required|exists:laboratorium,id',
        'time_from' => 'required|date_format:Y-m-d H:i:s',
        'time_to' => 'required|date_format:Y-m-d H:i:s|after:time_from',
    ], [
        'laboratorium_id.required' => 'Nomer Lapangan harus dipilih',
        'time_from.required' => 'Jam Mulai harus diisi',
        'time_to.required' => 'Jam Berakhir harus diisi',
        'time_to.after' => 'Jam Berakhir harus setelah Jam Mulai',
    ]);

    Daftar::create([
        'laboratorium_id' => $request->laboratorium_id,
        'time_from' => $request->time_from,
        'time_to' => $request->time_to,
        'status' => 0, // Default status
    ]);

    return redirect()->route('jadwal.lab')->with('success', 'Pendaftaran berhasil!');
}

}
