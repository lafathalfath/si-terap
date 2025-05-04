<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use App\Models\KegiatanLab;
use App\Models\Laboratorium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KegiatanLabController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }


    public function index(Laboratorium $lab)
    {
        $kegiatans = $lab->kegiatanLabs()->latest()->get();
        return view('laboratorium.kegiatan_labs.index', compact('lab', 'kegiatans'));
        
    }

    public function create(Laboratorium $lab)
    {
        return view('laboratorium.kegiatan_labs.create', compact('lab'));
    }

    public function store(Request $request, Laboratorium $lab)
{
    $request->validate([
        'nama_kegiatan' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'tanggal_kegiatan' => 'required|date',
        'penanggung_jawab' => 'required|string|max:255',
        'hasil_kegiatan' => 'nullable|string',
        'dokumentasi' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $data = $request->except('dokumentasi');
    $data['laboratorium_id'] = $lab->id;

    if ($request->hasFile('dokumentasi')) {
        $path = $request->file('dokumentasi')->store('public/dokumentasi_kegiatan');
        $data['dokumentasi_path'] = str_replace('public/', 'storage/', $path);
    }

    KegiatanLab::create($data);

    return redirect()->route('labs.kegiatan.index', $lab->id)
        ->with('success', 'Kegiatan lab berhasil ditambahkan');
}
    public function update(Request $request, Laboratorium $lab, KegiatanLab $kegiatan)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_kegiatan' => 'required|date',
            'penanggung_jawab' => 'required|string|max:255',
            'hasil_kegiatan' => 'nullable|string',
            'dokumentasi' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('dokumentasi');
        if ($request->hasFile('dokumentasi')) {
            if ($kegiatan->dokumentasi_path) {
                Storage::delete(str_replace('storage/', 'public/', $kegiatan->dokumentasi_path));
            }
            $path = $request->file('dokumentasi')->store('public/dokumentasi_kegiatan');
            $data['dokumentasi_path'] = str_replace('public/', 'storage/', $path);
        }

        $kegiatan->update($data);

        return redirect()->route('labs.kegiatan.index', $lab->id)
            ->with('success', 'Kegiatan lab berhasil diperbarui');
    }
    public function destroy(Laboratorium $lab, KegiatanLab $kegiatan)
    {
        if ($kegiatan->dokumentasi_path) {
            Storage::delete(str_replace('storage/', 'public/', $kegiatan->dokumentasi_path));
        }
        $kegiatan->delete();

        return redirect()->route('labs.kegiatan.index', $lab->id)
            ->with('success', 'Kegiatan lab berhasil dihapus');
    }

    public function show(Laboratorium $lab, KegiatanLab $kegiatan)
    {
        return view('laboratorium.kegiatan_labs.show', compact('lab', 'kegiatan'));
    }

    public function edit(Laboratorium $lab, KegiatanLab $kegiatan)
    {
        return view('laboratorium.kegiatan_labs.edit', compact('lab', 'kegiatan'));
    }  }