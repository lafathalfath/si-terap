<?php
namespace App\Http\Controllers\Lab;

use Illuminate\Http\Request;
use App\Models\Daftar;
use App\Http\Controllers\Controller;
use App\Models\Laboratorium;
use Illuminate\Support\Facades\Log;

class DaftarController extends Controller
{
    public function store(Request $request)
    {
        // Validasi terlebih dahulu
        $validated = $request->validate([
            'laboratorium_id' => 'required|exists:laboratorium,id',
            'time_from' => 'required|date',
             'time_to' => 'required|date|after:time_from',
        ]);
     
          // Tambahan validasi untuk memastikan tidak ada jadwal bentrok
    $conflict = Daftar::where('laboratorium_id', $request->laboratorium_id)
    ->where(function($query) use ($request) {
        $query->whereBetween('time_from', [$request->time_from, $request->time_to])
            ->orWhereBetween('time_to', [$request->time_from, $request->time_to])
            ->orWhere(function($q) use ($request) {
                $q->where('time_from', '<', $request->time_from)
                  ->where('time_to', '>', $request->time_to);
            });
    })
    ->exists();

if ($conflict) {
    return back()->withErrors(['time_from' => 'Jadwal bentrok dengan pemesanan lain']);
}

// Simpan data
Daftar::create($request->all());

return redirect()->route('jadwal.jadwal_lab')->with('message', 'Pendaftaran berhasil');
    }
}
