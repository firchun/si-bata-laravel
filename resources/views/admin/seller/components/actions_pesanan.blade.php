<div class="btn-group">
    @if ($Pesanan->is_verified == 0)
        <a class="btn btn-sm btn-primary" href="{{ route('seller.terima', $Pesanan->id) }}">Terima</a>
    @else
        {{-- @if ($Pesanan->lunas == 0)
            <a class="btn btn-sm btn-primary" href="{{ route('seller.lunas', $Pesanan->id) }}">Lunas</a>
        @else
            selesai
        @endif --}}
        diterima
    @endif
</div>
