<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Laboratorium extends Model
{
    use HasFactory;
    protected $table = 'laboratorium';
    protected $guarded = [];

    public function bsip() : BelongsTo {
        return $this->belongsTo(mBSIP::class, 'bsip_id', 'id');
    }

    public function jenis_lab() : BelongsTo {
        return $this->belongsTo(mJenisLab::class, 'bsip_id', 'id');
    }
}
