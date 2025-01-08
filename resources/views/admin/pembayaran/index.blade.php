@extends('layouts.backend.admin')

@section('content')
    @include('layouts.backend.alert')
    <div class="dt-action-buttons text-end pt-3 pt-md-0 mb-4">
        <div class=" btn-group " role="group">
            <button class="btn btn-secondary refresh btn-default" type="button">
                <span>
                    <i class="bi bi-arrow-clockwise me-sm-1"> </i>
                    <span class="d-none d-sm-inline-block">Refresh Data</span>
                </span>
            </button>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card-box mb-30">
                <div class="card-body">
                    <h2>{{ $title }}</h2>
                </div>
                <table id="datatable-pembayaran" class="table table-h0ver  display mb-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Bukti</th>
                            <th>Pelanggan</th>
                            <th>No Invoice</th>
                            <th>Jumlah</th>
                            <th>Verifikasi</th>
                            <th>action</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Bukti</th>
                            <th>Pelanggan</th>
                            <th>No Invoice</th>
                            <th>Jumlah</th>
                            <th>Verifikasi</th>
                            <th>action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(function() {
            $('#datatable-pembayaran').DataTable({
                processing: true,
                serverSide: false,
                responsive: false,
                ajax: '{{ url('pembayaran-datatable') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },

                    {
                        data: 'bukti',
                        name: 'bukti'
                    },
                    {
                        data: 'user.name',
                        name: 'user.name'
                    },
                    {
                        data: 'pesanan.no_invoice',
                        name: 'pesanan.no_invoice'
                    },

                    {
                        data: 'jumlah',
                        name: 'jumlah'
                    },
                    {
                        data: 'is_verified',
                        name: 'is_verified',
                        render: function(data, type, row) {
                            if (data == 1) {
                                return '<span class="badge badge-success">Terverifikasi</span>';
                            } else if (data == 2) {
                                return '<span class="badge badge-danger">Ditolak</span>';
                            } else if (data == 0) {
                                return '<span class="badge badge-warning">Menunggu</span>';
                            } else {
                                return '<span class="badge badge-secondary">Tidak Diketahui</span>';
                            }
                        }
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },

                ]
            });

            $('.refresh').click(function() {
                $('#datatable-pembayaran').DataTable().ajax.reload();
            });

        });
    </script>
@endpush
