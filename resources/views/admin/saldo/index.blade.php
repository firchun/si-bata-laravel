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
                <table id="datatable-seller" class="table table-h0ver  display mb-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Penjual</th>
                            <th>Pemilik</th>
                            <th>Alamat</th>
                            <th>saldo</th>

                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Penjual</th>
                            <th>Pemilik</th>
                            <th>Alamat</th>
                            <th>saldo</th>

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
            $('#datatable-seller').DataTable({
                processing: true,
                serverSide: false,
                responsive: false,
                ajax: '{{ url('seller-datatable') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },

                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'user.name',
                        name: 'user.name'
                    },

                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'saldo',
                        name: 'saldo'
                    },

                ]
            });

            $('.refresh').click(function() {
                $('#datatable-seller').DataTable().ajax.reload();
            });

        });
    </script>
@endpush
