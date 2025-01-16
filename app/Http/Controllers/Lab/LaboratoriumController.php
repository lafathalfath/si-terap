<?php

namespace App\Http\Controllers\Lab;

use App\Http\Controllers\Controller;
use App\Models\Laboratorium;
use App\Models\mBSIP;
use App\Models\mJenisLab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class LaboratoriumController extends Controller
{
    public function index(Request $request) {
        $lab = new Laboratorium();
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
        if ($request->bsip_id) $lab = $lab->where('bsip_id', $request->bsip_id);
        if ($request->tahun) $lab = $lab->where('tahun', $request->tahun);
        $lab = $lab->get();
        
        $bsip = mBSIP::select(['id', 'name'])->get();
        return view('laboratorium.lab.beranda', [
            'lab' => $lab,
            'bsip' => $bsip,
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
            'jenis_analisis' => 'required|string',
            'metode_analisis' => 'required|string',
            'analisis' => 'required|string',
            'kompetensi_personal' => 'required|string',
            'nama_pelatihan' => 'required|string',
            'tahun' => 'required|numeric',
        ], [
            'bsip_id.required' => 'BSIP tidak boleh kosong',
            'jenis_lab_id.required' => 'Jenis Lab tidak boleh kosong',
            'jenis_analisis.required' => 'Jenis Analisis tidak boleh kosong',
            'metode_analisis.required' => 'Metode Analisis tidak boleh kosong',
            'analisis.required' => 'Analisis tidak boleh kosong',
            'kompetensi_personal.required' => 'Kompetensi Personal tidak boleh kosong',
            'nama_pelatihan.required' => 'Nama Pelatihan tidak boleh kosong',
            'tahun.required' => 'tahun tidak boleh kosong',
        ]);
        $lab = Laboratorium::create([
            'bsip_id' => $request->bsip_id,
            'jenis_lab_id' => $request->jenis_lab_id,
            'jenis_analisis' => $request->jenis_analisis,
            'metode_analisis' => $request->metode_analisis,
            'analisis' => $request->analisis,
            'kompetensi_personal' => $request->kompetensi_personal,
            'nama_pelatihan' => $request->nama_pelatihan,
            'tahun' => $request->tahun,
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
            'jenis_analisis' => 'required|string',
            'metode_analisis' => 'required|string',
            'analisis' => 'required|string',
            'kompetensi_personal' => 'required|string',
            'nama_pelatihan' => 'required|string',
            'tahun' => 'required|numeric',
        ], [
            'bsip_id.required' => 'BSIP tidak boleh kosong',
            'jenis_lab_id.required' => 'Jenis Lab tidak boleh kosong',
            'jenis_analisis.required' => 'Jenis Analisis tidak boleh kosong',
            'metode_analisis.required' => 'Metode Analisis tidak boleh kosong',
            'analisis.required' => 'Analisis tidak boleh kosong',
            'kompetensi_personal.required' => 'Kompetensi Personal tidak boleh kosong',
            'nama_pelatihan.required' => 'Nama Pelatihan tidak boleh kosong',
            'tahun.required' => 'tahun tidak boleh kosong',
        ]);
        $lab = $lab->update([
            'bsip_id' => $request->bsip_id,
            'jenis_lab_id' => $request->jenis_lab_id,
            'jenis_analisis' => $request->jenis_analisis,
            'metode_analisis' => $request->metode_analisis,
            'analisis' => $request->analisis,
            'kompetensi_personal' => $request->kompetensi_personal,
            'nama_pelatihan' => $request->nama_pelatihan,
            'tahun' => $request->tahun,
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
        return view('laboratorium.lab.detail');
    }
    
}
