@extends('layouts.backend.admin')

@section('content')
    @include('layouts.backend.alert')
    <div class="row">
        <div class="col-lg-3 col-md-4">
            <div class="card-box mb-30">
                <div class="card-body">
                    <span>Saldo Toko</span>
                    <h5 class="text-success">Rp {{ number_format(App\Models\Saldo::getSaldoSeller($seller->id)) }}
                        <span style="font-size: 14px;"
                            class="text-danger">{{ $pending_penarikan ? ' - ' . number_format($pending_penarikan) : '' }}</span>
                    </h5>
                </div>
                <div class="card-footer">
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                            data-target="#{{ $rekening ? 'tarikSaldo' : 'alertRekening' }}">
                            Tarik Saldo
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4">
            <div class="card-box mb-30">
                <div class="card-body">
                    <span>Stok Batu</span>
                    <h5 class="text-danger"><span id="textJumlahStok"></span> Ret</h5>
                </div>
                <div class="card-footer">
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                            data-target="#tambahStok">
                            Tambah Stok
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-4">
            <div class="card-box">
                <div class="card-body">
                    <span>Nomor Rekening Penarikan</span><br>
                    @if ($rekening)
                        <h5>{{ $rekening->bank->bank }} - {{ $rekening->nama }} - <b
                                class="text-danger">{{ $rekening->no_rek }}</b></h5>
                    @else
                        <p class="text-danger">Anda belum mengisi rekening penarikan</p>
                    @endif
                </div>
                <div class="card-footer">
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                            data-target="#updateRekening">
                            Ubah Rekening
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 ">
            <div class="dt-action-buttons text-end pt-3 pt-md-0 mb-4">
                <div class=" btn-group " role="group">
                    <button class="btn btn-secondary refresh btn-default" type="button">
                        <span>
                            <i class="bi bi-arrow-clockwise me-sm-1"> </i>
                            <span class="d-none d-sm-inline-block">Refresh Data</span>
                        </span>
                    </button>
                    <a href="{{ route('seller.update') }}" class="btn btn-warning"> <i class="bi bi-pencil me-sm-1">
                        </i>Update data toko</a>
                    <a href="{{ url('/detail', $seller->id) }}" class="btn btn-success"> <i class="bi bi-shop me-sm-1">
                        </i>Lihat toko</a>
                </div>
            </div>
            <div class="card-box mb-30">
                <div class="card-body">
                    <h2>Data Pemesanan</h2>
                </div>
                <table id="datatable-pesanan" class="table table-hover display table-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>WA</th>
                            <th>Pemesan</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Pengantaran</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>WA</th>
                            <th>Pemesan</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Pengantaran</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    @include('admin.seller.components.modal')
@endsection
@push('js')
    <script>
        $(function() {
            function fetchStockQuantity() {
                $.ajax({
                    type: 'GET',
                    url: '/stok/jumlah/' + {{ $seller->id }},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {

                        $('#textJumlahStok').text(response.jumlah);
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            }
            $('#datatable-pesanan').DataTable({
                processing: true,
                serverSide: false,
                responsive: false,
                ajax: '{{ url('pesanan-datatable', $seller->id) }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'wa',
                        name: 'wa'
                    },
                    {
                        data: 'pemesan',
                        name: 'pemesan'
                    },
                    {
                        data: 'jumlah',
                        name: 'jumlah'
                    },
                    {
                        data: 'harga',
                        name: 'harga'
                    },
                    {
                        data: 'pengantaran',
                        name: 'pengantaran'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },

                ]
            });
            $('.refresh').click(function() {
                $('#datatable-pesanan').DataTable().ajax.reload();
            });
            $('#tambahStokBtn').click(function() {
                var formData = $('#formTambahStok').serialize();

                $.ajax({
                    type: 'POST',
                    url: '/stok/store',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.success);
                        // $('#datatable-pesanan').DataTable().ajax.reload();
                        $('#tambahStok').modal('hide');
                        fetchStockQuantity();
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            });
            $('#updateRekeningBtn').click(function() {
                var formData = $('#formUpdateRekening').serialize();

                $.ajax({
                    type: 'POST',
                    url: '/bank/store-seller',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message);
                        // $('#datatable-pesanan').DataTable().ajax.reload();
                        $('#updateRekening').modal('hide');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            });
            $('#tarikSaldoBtn').click(function() {
                var formData = $('#formTarikSaldo').serialize();

                $.ajax({
                    type: 'POST',
                    url: '/saldo/store-penarikan',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message);
                        // $('#datatable-pesanan').DataTable().ajax.reload();
                        $('#tarikSaldo').modal('hide');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            });


            fetchStockQuantity();
        })
    </script>
@endpush
