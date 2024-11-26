@extends('layouts.backend.admin')

@section('content')
    @include('layouts.backend.alert')
    <div class="row">

        <div class="col-md-12 ">
            <div class="card-box mb-30">
                <div class="card-body">
                    <h2>{{ $title ?? '' }}</h2>
                </div>
                <hr>
                <div class="m-2">
                    <div class="my-2">
                        <label>Filter data : </label>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text">Tanggal</span>
                                <input type="date" class="form-control" name="from_date" id="fromDate">
                                <span class="input-group-text">Sampai</span>
                                <input type="date" class="form-control" name="to_date" id="toDate">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" name="is_verified" id="selectStatus">
                                <option value="">Pilih Status</option>
                                <option value="0">Menunggu</option>
                                <option value="1">Diterima</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary" id="btnFilter"><i
                                    class="bi bi-filter"></i>Filter</button>
                        </div>
                    </div>
                </div>
                <hr>
                <table id="datatable-pesanan" class="table table-hover display table-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tanggal</th>
                            <th>Pemesan</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Tagihan</th>
                            <th>Pengantaran</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Tanggal</th>
                            <th>Pemesan</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Tagihan</th>
                            <th>Pengantaran</th>
                            <th>Status</th>
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

            table = $('#datatable-pesanan').DataTable({
                processing: true,
                serverSide: false,
                responsive: false,
                ajax: {
                    url: '{{ url('pesanan-datatable', $seller->id) }}',
                    data: function(d) {
                        d.from_date = $('#fromDate').val();
                        d.to_date = $('#toDate').val();
                        d.is_verified = $('#selectStatus').val();
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },

                    {
                        data: 'user.name',
                        name: 'user.name'
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
                        data: 'total_harga',
                        name: 'total_harga'
                    },
                    {
                        data: 'pengantaran',
                        name: 'pengantaran',
                        render: function(data, type, row) {
                            return data == 1 ? 'Diantar' : 'Ambil ditempat';
                        }
                    },
                    {
                        data: 'is_verified',
                        name: 'is_verified',
                        render: function(data, type, row) {
                            return data == 1 ? 'Diterima' : 'Menunggu';
                        }
                    },
                ],

                dom: 'lBfrtip',
                buttons: [{
                    extend: 'pdf',
                    text: '<i class=" i bi-file-pdf"> </i> PDF ',
                    className: 'btn-danger mx-3',
                    action: function(e, dt, button, config) {
                        var from_date = document.getElementById('fromDate').value;
                        var to_date = document.getElementById('toDate').value;
                        var status = document.getElementById('selectStatus').value;
                        var url = '{{ url('report/print_seller', $seller->id) }}' +
                            '?from_date=' +
                            encodeURIComponent(from_date) + '&to_date=' + encodeURIComponent(
                                to_date) + '&is_verified=' + encodeURIComponent(
                                status);
                        window.open(url, '_blank');
                    }
                }, {
                    extend: 'excelHtml5',
                    text: '<i class="bi bi-file-excel"></i> Excel',
                    className: 'btn-success',
                    // exportOptions: {
                    //     columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                    // }
                }]
            });
            $('#btnFilter').click(function() {
                table.ajax.reload();
            });
            $('.refresh').click(function() {
                $('#formDate').val('');
                $('#toDate').val('');
                table.ajax.reload();
            });


        })
    </script>
    <!-- Moment.js CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- JS DataTables Buttons -->
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
@endpush
