<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class mKecamatan extends Model
{
    use HasFactory;
    protected $table = 'm_kecamatan';
    protected $guarded = [];

    public function kabupaten() : BelongsTo {
        return $this->belongsTo(mKabupaten::class, 'kabupaten_id', 'id');
    }
}