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
        $penarikan = 0;
        return $masuk - $penarikan;
    }
}
