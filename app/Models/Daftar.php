<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Daftar extends Model
{
    use HasFactory;

    protected $table = 'daftar';
    protected $guarded = [
        'id'
    ];

    public function laboratorium()
    {
        return $this->belongsTo(Laboratorium::class, 'laboratorium_id');
    }
}
