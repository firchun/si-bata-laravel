@extends('layouts.backend.admin')

@section('content')
    @include('layouts.backend.alert')
    <div class="row">
        <div class="col-md-12 ">
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
            <div class="card-box mb-30">
                <div class="card-body">
                    <h2>Data Pengantaran</h2>
                </div>
                <table id="datatable-pengantaran" class="table table-hover display table-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Pemesan</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Pengantaran</th>
                            <th>action</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Pemesan</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Pengantaran</th>
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

            $('#datatable-pengantaran').DataTable({
                processing: true,
                serverSide: false,
                responsive: false,
                ajax: '{{ url('pengantaran-datatable', $seller->id) }}',
                columns: [{
                        data: 'id',
                        name: 'id'
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
                $('#datatable-pengantaran').DataTable().ajax.reload();
            });

        })
    </script>
@endpush
