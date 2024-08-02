<div class="btn-group">
    @if ($Pesanan->is_verified == 1)
        <button class="btn btn-sm btn-primary" onclick="editCustomer({{ $Pesanan->id }})">Cetak</button>
    @else
        <small class="text-danger">Menunggu verifikasi</small>
    @endif
</div>
