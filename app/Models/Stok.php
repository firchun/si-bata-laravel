<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stok extends Model
{
    use HasFactory;
    protected $table = 'stok';
    protected $guarded = [];

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class, 'id_seller');
    }

    public static function getStok($id_seller)
    {
        $masuk = Self::where('id_seller', $id_seller)->where('jenis', 'Masuk')->sum('jumlah');
        $penjualan = Self::where('id_seller', $id_seller)->where('jenis', 'Penjualan')->sum('jumlah');

        return $masuk - $penjualan;
    }
    static function getStokSeller($id_seller){
        $masuk = Self::where('id_seller',$id_seller)->where('jenis','Masuk')->sum('jumlah');
        $penjualan = Self::where('id_seller',$id_seller)->where('jenis','Penjualan')->sum('jumlah');
        return $masuk - $penjualan ;
    }
}