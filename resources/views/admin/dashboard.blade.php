@extends('layouts.backend.admin')

@section('content')
    @include('layouts.backend.alert')
    <div class="title pb-20">
        <h2 class="h3 mb-0">Dashboard Overview</h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8 mb-4">
            <div class="card">
                <div class="card-body">
                    <canvas id="incomeChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
    @if (Auth::user()->role == 'Admin')
        <div class="row justify-content-center">
            <div class="col-12 text-center mb-4">
                <h4>Data Toko</h4>
            </div>
            @foreach (App\Models\Seller::all() as $item)
                @include('admin.dashboard_component.card_toko', [
                    'harga_batu' => $item->harga_batu,
                    'harga_pengantaran' => $item->harga_pengantaran,
                    'title' => $item->nama,
                    'pesanan' => App\Models\Pesanan::getCountPesananSeller($item->id),
                    'saldo' => App\Models\Saldo::getSaldoSeller($item->id),
                    'color' => 'success',
                    'icon' => 'shop',
                ])
            @endforeach

        </div>
        <hr>
        <div class="row justify-content-center">
            <div class="col-12 text-center mb-4">
                <h4>Data Keungan</h4>
            </div>
            @include('admin.dashboard_component.card2', [
                'count' => $pendapatan,
                'title' => 'Pendapatan',
                'subtitle' => 'Total pendapatan semua seller',
                'color' => 'primary',
                'icon' => 'money',
            ])
            @include('admin.dashboard_component.card2', [
                'count' => $penarikan,
                'title' => 'Penarikan',
                'subtitle' => 'Total penarikan semua seller',
                'color' => 'danger',
                'icon' => 'money',
            ])
            @include('admin.dashboard_component.card2', [
                'count' => $pengajuan_penarikan,
                'title' => 'Pengajuan Penarikan',
                'subtitle' => 'Total pengajuan penarikan semua seller',
                'color' => 'danger',
                'icon' => 'money',
            ])
            @include('admin.dashboard_component.card2', [
                'count' => $saldo,
                'title' => 'Sisa Saldo',
                'subtitle' => 'Total saldo',
                'color' => 'warning',
                'icon' => 'money',
            ])
        </div>

        <hr>
        <div class="row justify-content-center">
            @include('admin.dashboard_component.card1', [
                'count' => $penjual,
                'title' => 'Penjual',
                'subtitle' => 'Total penjual batu bata',
                'color' => 'primary',
                'icon' => 'user',
            ])
            @include('admin.dashboard_component.card1', [
                'count' => $pelanggan,
                'title' => 'Pengguna/pelanggan',
                'subtitle' => 'Total pengguna/pelanggan',
                'color' => 'success',
                'icon' => 'user',
            ])
            @include('admin.dashboard_component.card1', [
                'count' => $bank,
                'title' => 'Rekening Pembayaran',
                'subtitle' => 'Total rekening pemabayaran',
                'color' => 'danger',
                'icon' => 'money',
            ])
            @include('admin.dashboard_component.card1', [
                'count' => $toko,
                'title' => 'Toko/seller',
                'subtitle' => 'Total toko/seller',
                'color' => 'primary',
                'icon' => 'shop',
            ])
            @include('admin.dashboard_component.card1', [
                'count' => $pesanan,
                'title' => 'Pesanan',
                'subtitle' => 'Total pesanan pada penjual',
                'color' => 'warning',
                'icon' => 'layers',
            ])
            @include('admin.dashboard_component.card1', [
                'count' => $pengantaran,
                'title' => 'Pengantaran',
                'subtitle' => 'Total pengantaran',
                'color' => 'danger',
                'icon' => 'truck',
            ])
        </div>
    @else
        @include('admin.dashboard_component.seller')
    @endif
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        async function fetchAndDisplayChart() {
            try {
                const response = await fetch('/daily-income');
                const data = await response.json();

                // Memproses data untuk digunakan di Chart.js
                const labels = data.map(item => item.date); // Tanggal
                const totalIncomes = data.map(item => item.total_income); // Total pendapatan

                // Buat grafik dengan Chart.js
                const ctx = document.getElementById("incomeChart").getContext("2d");
                const incomeChart = new Chart(ctx, {
                    type: "line", // Menggunakan grafik garis
                    data: {
                        labels: labels,
                        datasets: [{
                            label: "Pendapatan Harian",
                            data: totalIncomes,
                            backgroundColor: "rgba(75, 192, 192, 0.2)",
                            borderColor: "rgba(75, 192, 192, 1)",
                            borderWidth: 2,
                            fill: true,
                            tension: 0.4 // Membuat garis lebih halus
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Grafik Pendapatan Harian'
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Pendapatan (dalam rupiah)'
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Tanggal'
                                }
                            }
                        }
                    }
                });
            } catch (error) {
                console.error("Gagal mengambil data:", error);
            }
        }

        // Memanggil fungsi untuk menampilkan grafik setelah halaman dimuat
        fetchAndDisplayChart();
    </script>
@endpush
