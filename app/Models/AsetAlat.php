<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AsetAlat extends Model
{
    use HasFactory;
    protected $table = 'aset_alat';
    protected $guarded = [];

    public function ip2sip() : BelongsTo {
        return $this->belongsTo(mIP2SIP::class, 'ip2sip_id', 'id');
    }
}