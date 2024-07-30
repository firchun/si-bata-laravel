@extends('layouts.backend.admin')

@section('content')
    @include('layouts.backend.alert')
    <div class="row">
        <div class="col-lg-9 col-md-12">
            <div class="dt-action-buttons text-end pt-3 pt-md-0 mb-4">
                <div class=" btn-group " role="group">
                    <button class="btn btn-secondary refresh btn-default" type="button">
                        <span>
                            <i class="bi bi-arrow-clockwise me-sm-1"> </i>
                            <span class="d-none d-sm-inline-block">Refresh Data</span>
                        </span>
                    </button>
                    <a href="" class="btn btn-primary">List Pengantaran</a>
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

        <div class="col-lg-3 col-md-4">
            <div class="card-box mb-30">
                <div class="card-body">
                    <span>Saldo Toko</span>
                    <h5 class="text-danger">Rp 0</h5>
                </div>
            </div>
            <div class="card-box mb-30">
                <div class="card-body">
                    <span>Stok Batu</span>
                    <h3 class="text-danger">0</h3>
                </div>
                <div class="card-footer">
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                        <button type="button" class="btn btn-outline-primary">
                            Tambah Stok
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-box mb-30">
                <div class="card-body">
                    <h5>Informasi Toko</h5>
                </div>
                <table class="table table-hover">
                    <tr>
                        <td>Nama Toko</td>
                        <td>:</td>
                        <td>{{ $seller->nama }}</td>
                    </tr>
                    <tr>
                        <td>Pemilik Toko</td>
                        <td>:</td>
                        <td><strong>{{ $seller->user->name }}</strong><br><a
                                href="mailto:{{ $seller->user->email }}">{{ $seller->user->email }}</a></td>
                    </tr>
                    <tr>
                        <td>Nomor HP/WA</td>
                        <td>:</td>
                        <td>{{ $seller->no_hp }}</td>
                    </tr>
                    <tr>
                        <td>Alamat Toko</td>
                        <td>:</td>
                        <td>{{ $seller->alamat }}</td>
                    </tr>
                </table>
                <div class="card-footer">
                    <button type="button" class="btn btn-warning">Update data</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(function() {
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

        })
    </script>
@endpush
