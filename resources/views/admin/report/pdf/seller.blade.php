<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan Seller</title>
    <meta http-equiv="Content-Type" content="charset=utf-8" />
    <link rel="stylesheet" href="{{ public_path('css') }}/pdf/bootstrap.min.css" media="all" />
    <style>
        body {
            font-family: 'times new roman';
            font-size: 12px;
        }

        .page_break {
            page-break-before: always;
        }

        table.table_custom th,
        table.table_custom td {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid;
            padding: 5px;
            width: 100%;
        }
    </style>
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css"> --}}
</head>

<body>
    <main class="mt-0">
        {{-- laporan masyarakat --}}
        <table class="" style="font-size: 16px; padding:5px; width:100%; border:0px;">
            <tr>
                <td style="width: 30%">
                    <img style="width: 50%;" src="{{ public_path('img') }}/logo.png">
                </td>
                <td class="text-center" style="width: 50%"><b>SISTEM INFORMASI<br>
                        PENJUALAN BATU BATA</b>
                </td>
                <td style="width: 30%"></td>
            </tr>
        </table>
        <hr style="border: 1px solid black;">
        <div class="my-3">
            <strong>Laporan Pemesanan Seller</strong>
        </div>

        <table class="table_custom" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Pemesan</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Tagihan</th>
                    <th>Pengantaran</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>{{ $item->harga }}</td>
                        <td>{{ $item->total_harga }}</td>
                        <td>{{ $item->pengantaran == 1 ? 'Diantar' : 'Ambil ditempat' }}</td>
                        <td>{{ $item->is_verified == 1 ? 'Diterima' : 'Menunggu' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </main>

</body>

</html>
