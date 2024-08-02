<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Keranjang extends Model
{
    use HasFactory;
    protected $table = 'keranjang';
    protected $guarded = [];
    protected $casts = [
        'data' => 'array', // Mengonversi JSON ke array secara otomatis
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class, 'id_seller');
    }
    static function getCountKeranjangUser($id_user)
    {
        $jumlah = Self::where('id_user', $id_user)->count();
        return $jumlah;
    }
}
