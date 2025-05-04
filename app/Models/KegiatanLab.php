<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanLab extends Model
{
    use HasFactory;

    protected $fillable = [
        'laboratorium_id',
        'nama_kegiatan',
        'deskripsi',
        'tanggal_kegiatan',
        'penanggung_jawab',
        'hasil_kegiatan',
        'dokumentasi_path'
    ];

    protected $dates = ['tanggal_kegiatan' => 'date'];

    public function lab()
    {
        return $this->belongsTo(Laboratorium::class, 'laboratorium_id');
    }
}