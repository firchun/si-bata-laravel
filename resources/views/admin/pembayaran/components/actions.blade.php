<div class="btn-group">
    @if (App\Models\Pesanan::find($pembayaran->id_pesanan)->is_verified == 1)
        @if ($pembayaran->is_verified == 0)
            <a href="{{ route('pembayaran.terima', $pembayaran->id) }}" class="btn btn-sm btn-primary mx-2">Terima</a>
            <a href="{{ route('pembayaran.tolak', $pembayaran->id) }}" class="btn btn-sm btn-danger">Tolak</a>
        @endif
    @else
        Menunggu verifikasi penjual
    @endif
</div>
