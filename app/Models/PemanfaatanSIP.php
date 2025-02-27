<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PemanfaatanSIP extends Model
{
    use HasFactory;
    protected $table = 'pemanfaatan_sip';
    protected $guarded = [];

    public function ip2sip() : BelongsTo {
        return $this->belongsTo(mIP2SIP::class, 'ip2sip_id', 'id');
    }

    public function pemanfaatan_diseminasi() : HasMany {
        return $this->hasMany(PemanfaatanDiseminasi::class, 'pemanfaatan_sip_id', 'id');
    }
}
