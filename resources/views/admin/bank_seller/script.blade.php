@push('js')
    <script>
        $(function() {
            $('#datatable-bank').DataTable({
                processing: true,
                serverSide: false,
                responsive: false,
                ajax: '{{ url('bank-seller-datatable') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },

                    {
                        data: 'seller.nama',
                        name: 'seller.nama'
                    },
                    {
                        data: 'bank.bank',
                        name: 'bank.bank'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'no_rek',
                        name: 'no_rek'
                    },

                ]
            });
            $('.create-new').click(function() {
                $('#create').modal('show');
            });
            $('.refresh').click(function() {
                $('#datatable-bank').DataTable().ajax.reload();
            });
            window.editCustomer = function(id) {
                $.ajax({
                    type: 'GET',
                    url: '/bank/edit/' + id,
                    success: function(response) {
                        $('#formBankId').val(response.id);
                        $('#formBankBank').val(response.bank);
                        $('#formBankWarna').val(response.warna);
                        $('#customersModal').modal('show');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            };
            $('#saveCustomerBtn').click(function() {
                var formData = $('#userForm').serialize();

                $.ajax({
                    type: 'POST',
                    url: '/bank/store',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message);
                        // Refresh DataTable setelah menyimpan perubahan
                        $('#datatable-bank').DataTable().ajax.reload();
                        $('#customersModal').modal('hide');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            });
            $('#createCustomerBtn').click(function() {
                var formData = $('#createUserForm').serialize();

                $.ajax({
                    type: 'POST',
                    url: '/bank/store',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message);
                        $('#datatable-bank').DataTable().ajax.reload();
                        $('#create').modal('hide');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            });
            window.deleteCustomers = function(id) {
                if (confirm('Apakah Anda yakin ingin menghapus bank ini?')) {
                    $.ajax({
                        type: 'DELETE',
                        url: '/bank/delete/' + id,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // alert(response.message);
                            $('#datatable-bank').DataTable().ajax.reload();
                        },
                        error: function(xhr) {
                            alert('Terjadi kesalahan: ' + xhr.responseText);
                        }
                    });
                }
            };
        });
    </script>
@endpush
