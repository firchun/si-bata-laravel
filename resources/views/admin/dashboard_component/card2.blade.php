<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
    <div class="card-box height-100-p widget-style3">
        <div class="d-flex flex-wrap">
            <div class="widget-data">
                <div class="weight-700 font-24 text-dark">Rp {{ number_format($count ?? 0) }}</div>
                <div class="font-14 text-{{ $color ?? 'primary' }} weight-500">
                    {{ $title ?? 'Title' }}
                </div>
                <small class="text-muted">{{ $subtitle ?? 'Subtitle' }}</small>
            </div>

        </div>
    </div>
</div>
