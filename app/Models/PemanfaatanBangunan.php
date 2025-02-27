<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PemanfaatanBangunan extends Model
{
    use HasFactory;
    protected $table = 'pemanfaatan_bangunan';
    protected $guarded = [];

    // public function pemanfaatan_sip() : BelongsTo {
    //     return $this->belongsTo(PemanfaatanSIP::class, 'pemanfaatan_sip_id', 'id');
    // }
}
