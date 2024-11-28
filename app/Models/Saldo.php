<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saldo extends Model
{
    use HasFactory;
    protected $table = 'saldo';
    protected $guarded = [];

    static function getSaldoSeller($id_seller)
    {
        $masuk = Self::where('id_seller', $id_seller)->sum('jumlah');
        $penarikan = PenarikanSaldo::where('id_seller', $id_seller)->where('is_send', 1)->sum('jumlah');
        return $masuk - $penarikan;
    }
}
