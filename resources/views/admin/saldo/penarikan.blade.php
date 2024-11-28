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
                <table id="datatable-penarikan" class="table table-h0ver  display mb-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Penjual</th>
                            <th>Jumlah</th>
                            <th>action</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Penjual</th>
                            <th>Jumlah</th>
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
            $('#datatable-penarikan').DataTable({
                processing: true,
                serverSide: false,
                responsive: false,
                ajax: '{{ url('penarikan-datatable') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'seller.nama',
                        name: 'seller.nama'
                    },

                    {
                        data: 'jumlah',
                        name: 'jumlah'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },

                ]
            });

            $('.refresh').click(function() {
                $('#datatable-penarikan').DataTable().ajax.reload();
            });

        });
    </script>
    <script>
        $(document).on('click', '#konfirmasiBtn', function() {
            var id = $(this).data('id'); // Ambil ID dari tombol

            $.ajax({
                url: '{{ url('penarikan/konfirmasi') }}', // Endpoint untuk konfirmasi
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // Tambahkan CSRF token untuk keamanan
                    id: id
                },
                success: function(response) {
                    if (response.success) {
                        alert('Konfirmasi berhasil!');
                        $('#datatable-penarikan').DataTable().ajax.reload(); // Reload tabel
                    } else {
                        alert('Konfirmasi gagal: ' + response.message);
                    }
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan saat mengonfirmasi.');
                }
            });
        });

        $(document).on('click', '#berhasilBtn', function() {
            var id = $(this).data('id'); // Ambil ID dari tombol

            $.ajax({
                url: '{{ url('penarikan/update-berhasil') }}', // Endpoint untuk update berhasil
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // Tambahkan CSRF token untuk keamanan
                    id: id
                },
                success: function(response) {
                    if (response.success) {
                        alert('Status berhasil diperbarui!');
                        $('#datatable-penarikan').DataTable().ajax.reload(); // Reload tabel
                    } else {
                        alert('Pembaruan gagal: ' + response.message);
                    }
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan saat memperbarui status.');
                }
            });
        });
    </script>
@endpush
