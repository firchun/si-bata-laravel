<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenarikanSaldo extends Model
{
    use HasFactory;
    protected $table = 'penarikan_saldo';
    protected $guarded = [];
    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class, 'id_seller');
    }
}
