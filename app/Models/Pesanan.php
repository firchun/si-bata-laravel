<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = 'pesanan';
    protected $guarded = [];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class, 'id_seller');
    }
    static function getCountPesananUser($id_user)
    {
        $jumlah = Self::where('id_user', $id_user)->count();
        return $jumlah;
    }
    static function getCountPesananSeller($id_seller)
    {
        $jumlah = Self::where('id_seller', $id_seller)->count();
        return $jumlah;
    }
}
