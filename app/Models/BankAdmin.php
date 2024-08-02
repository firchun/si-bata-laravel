<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BankAdmin extends Model
{
    use HasFactory;
    protected $table = 'bank_admin';
    protected $guarded = [];
    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class, 'id_bank');
    }
}
