<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
    <div class="card-box height-100-p widget-style3">
        <div class="d-flex flex-wrap">
            <div class="widget-data">
                <strong class="weight-700 font-24 text-{{ $color ?? 'primary' }}">{{ $title ?? 'Title' }}
                </strong>
                <small class="text-muted">Harga Batu : <b>{{ number_format($harga_batu) ?? '0' }}</b></small><br>
                <small class="text-muted">Pengantaran : <b>{{ number_format($harga_batu) ?? '0' }}</b></small><br>
                <small class="text-muted">Terjual : <b>{{ number_format($pesanan) ?? '0' }} Ret</b></small><br>
                <small class="text-muted">Saldo : <b class="text-danger">Rp {{ number_format($saldo) ?? '0' }}</b></small>
            </div>
        </div>
    </div>
</div>
