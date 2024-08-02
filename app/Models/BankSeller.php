<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BankSeller extends Model
{
    use HasFactory;
    protected $table = 'bank_seller';
    protected $guarded = [];
    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class, 'id_bank');
    }
    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class, 'id_seller');
    }
}
