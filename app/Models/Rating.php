<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    use HasFactory;
    protected $table = 'rating';
    protected $guarded = [];
    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class, 'id_seller');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function pesanan(): BelongsTo
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }
    static function getRatingSeller($id_seller)
    {
        $averageRating = self::where('id_seller', $id_seller)
            ->avg('rating');
        return round($averageRating, 1) ?: 0;
    }
    static function getUlasanSeller($id_seller)
    {
        $total = self::where('id_seller', $id_seller)
            ->count();
        return $total;
    }
    static function getIsiUlasanSeller($id_seller)
    {
        $ulasan = self::where('id_seller', $id_seller)->get();
        return $ulasan;
    }
}
