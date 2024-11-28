@extends('layouts.frontend.app')
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Menambahkan efek hover pada bintang */
        .star {
            cursor: pointer;
            font-size: 1.5rem;
        }

        .star:hover,
        .star:hover~.star {
            color: gold !important;
        }

        .star.active {
            color: gold !important;
        }
    </style>
@endpush
@section('content')
    <section class="section">
        <div class="container">
            <div class="my-3 d-flex">
                <a href="{{ route('pesanan_user') }}" class="btn btn-secondary mx-2">
                    Semua Pesanan</a>
                {{-- <a href="https://wa.me/{{ $pesanan->seller->no_hp }}" target="__blank" class="btn btn-success mx-2">Hubungi
                    Toko</a> --}}
                {{-- @if ($rating <= 0)
                    <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#ratingModal">
                        <i class="fa fa-star"></i> Rating dan Ulasan
                    </a>
                @endif --}}
                @if ($pesanan->lunas == 0)
                    @php
                        $check_pembayaran = App\Models\Pembayaran::where('id_pesanan', $pesanan->id)->get();
                    @endphp
                    @if ($check_pembayaran->count() == 0)
                        <a href="{{ route('bukti_bayar', $pesanan->no_invoice) }}" class="btn btn-primary ">Upload bukti
                            pembayaran</a>
                    @endif
                @else
                    @if ($rating <= 0)
                        <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#ratingModal">
                            <i class="fa fa-star"></i> Rating dan Ulasan
                        </a>
                    @endif
                @endif
            </div>
            @if ($pesanan->lunas == 0)
                @if ($check_pembayaran->count() == 0)
                    <div class="my-3">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>PANDUAN PEMBAYARAN</strong>
                            <p>
                                Setiap pemesanan dapat dibayarkan menggunakan metode transfer bank sebagai berikut :
                            <ol>
                                <li>Menuju ATM bank / membuka aplikasi mobile banking</li>
                                <li>Mengisi nomor rekening tujuan (yang tertera di bawah ini)</li>
                                <li>Mengisi kolom jumlah pembayaran sesuai dengan invoice <b>(Rp
                                        {{ number_format($pesanan->total_harga) }})</b></li>
                                <li>Mengisi berita acara = <b>BAYAR {{ $pesanan->no_invoice }}</b></li>
                                <li>submit pembayaran</li>
                            </ol>
                            </p>
                            <strong>Nomor Rekening Pembayaran :</strong>
                            <ol>
                                @foreach (App\Models\BankAdmin::all() as $item)
                                    <li>{{ $item->bank->bank }} - An. {{ $item->nama }} ({{ $item->no_rek }})</li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                @endif
                @if ($check_pembayaran->count() != 0)
                    @if ($check_pembayaran->first())
                        <div class="my-3">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Pembayaran anda menunggu untuk di konfirmasi oleh admin</strong>
                            </div>
                        </div>
                    @endif
                @endif
            @else
                <div class="my-3">
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <strong>Pesanan anda telah lunas, terimakasih telah memesan..</strong>
                    </div>
                </div>
            @endif
            @if ($rating > 0)
                <div class="my-3">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>terimakasih telah memberikan rating :
                        </strong><br>
                        <b>{{ $isi_rating->rating }}</b> <i class="fa fa-star"></i>
                        <p>Ulasan : " {{ $isi_rating->ulasan }} "</p>
                    </div>
                </div>
            @endif
            @if ($pesanan->pengantaran == 1)
                @if ($pesanan->diantar == 0)
                    <div class="my-3">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Pesanan anda sedang disiapkan untuk diantar, harap menunggu..</strong>
                        </div>
                    </div>
                @else
                    <div class="my-3">
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <strong>Pesanan anda telah diantar pada alamat yang telah disertakan pada saat
                                pemesanan...</strong>
                        </div>
                    </div>
                @endif
            @endif
            <div class="p-3 shadow rounded">
                <div class="row justify-content-between px-3">
                    <h4 class="py-2">{{ $title }}</h4>
                    <h4 class="py-2 text-danger">Rp {{ number_format($pesanan->total_harga) }}</h4>
                </div>
                <hr>
                <table class="table table-hover">
                    <tr>
                        <td><strong>No. Invoice</strong></td>
                        <td>:</td>
                        <td><strong class="text-danger">{{ $pesanan->no_invoice }}</strong></td>
                    </tr>
                    <tr>
                        <td><strong>Nama Pemesan</strong></td>
                        <td>:</td>
                        <td>{{ $pesanan->user->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Nama Toko</strong></td>
                        <td>:</td>
                        <td>{{ $pesanan->seller->nama }}</td>
                    </tr>
                    <tr>
                        <td><strong>Jumlah Pemesanan</strong></td>
                        <td>:</td>
                        <td><strong class="text-danger h4">{{ $pesanan->jumlah }}</strong> Ret</td>
                    </tr>
                    <tr>
                        <td><strong>Pengantaran</strong></td>
                        <td>:</td>
                        <td><strong
                                class="text-danger">{{ $pesanan->pengantaran == 1 ? 'Diantar' : 'Ambil ditempat' }}</strong>
                        </td>
                    </tr>
                    @if ($pesanan->pengantaran == 1)
                        <tr>
                            <td><strong>Nomor Penerima</strong></td>
                            <td>:</td>
                            <td>{{ $pesanan->nomor_penerima }}
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Alamat Pengantaran</strong></td>
                            <td>:</td>
                            <td>{{ $pesanan->alamat_pengantaran }}
                            </td>
                        </tr>
                    @endif
                </table>
            </div>
            @if ($pesanan->pengantaran == 1)
                <div class="p-3 shadow rounded mt-4">
                    <div class="p-2">
                        <h5>Pengantaran</h5>
                    </div>

                    <table class="table table-hover">
                        <tr>
                            <td><strong>Nomor Penerima</strong></td>
                            <td>:</td>
                            <td>{{ $pesanan->nomor_penerima }}
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Alamat Pengantaran</strong></td>
                            <td>:</td>
                            <td>{{ $pesanan->alamat_pengantaran }}
                            </td>
                        </tr>
                    </table>
                </div>
            @endif
            <div class="p-3 shadow rounded mt-4">
                <div class="p-2">
                    <h5>Biaya</h5>
                </div>

                <table class="table table-hover">
                    <tr>
                        <td><strong>Harga Batu Bata</strong></td>
                        <td>:</td>
                        <td><strong class="text-danger">Rp {{ number_format($pesanan->seller->harga_batu) }}</strong> x
                            {{ $pesanan->jumlah }} Ret
                        </td>
                    </tr>
                    @if ($pesanan->pengantaran == 1)
                        <tr>
                            <td><strong>Harga Pengantaran</strong></td>
                            <td>:</td>
                            <td><strong class="text-danger">Rp
                                    {{ number_format($pesanan->seller->harga_pengantaran) }}</strong>
                            </td>
                        </tr>
                    @endif
                    <tr class="table-danger">
                        <td><strong>Total</strong></td>
                        <td>:</td>
                        <td><strong class="text-danger h4 font-weight-bold">Rp
                                {{ number_format($pesanan->total_harga) }}</strong>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </section>
    {{-- modal rating --}}
    <!-- Modal -->
    <div class="modal fade" id="ratingModal" tabindex="-1" aria-labelledby="ratingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ratingModalLabel">Berikan Rating dan Ulasan</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">x</button>
                </div>
                <div class="modal-body">
                    <form id="ratingForm" action="{{ route('rating.store') }}" enctype="multipart/form-data"
                        method="POST">
                        @csrf
                        <input type="hidden" name="id_user" value="{{ Auth::id() }}">
                        <input type="hidden" name="id_seller" value="{{ $pesanan->id_seller }}">
                        <input type="hidden" name="id_pesanan" value="{{ $pesanan->id }}">
                        <!-- Rating -->
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating:</label>
                            <div id="rating" class="d-flex">
                                <i class="fa fa-star text-secondary star" data-value="1"></i>
                                <i class="fa fa-star text-secondary star" data-value="2"></i>
                                <i class="fa fa-star text-secondary star" data-value="3"></i>
                                <i class="fa fa-star text-secondary star" data-value="4"></i>
                                <i class="fa fa-star text-secondary star" data-value="5"></i>
                            </div>
                            <input type="hidden" name="rating" id="ratingInput" value="0">
                        </div>
                        <!-- Ulasan -->
                        <div class="mb-3">
                            <label for="review" class="form-label">Ulasan:</label>
                            <textarea class="form-control" id="review" name="ulasan" rows="4"
                                placeholder="Tuliskan ulasan Anda di sini..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-warning w-100">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const stars = document.querySelectorAll(".star");
            const ratingInput = document.getElementById("ratingInput");

            stars.forEach((star, index) => {
                star.addEventListener("click", function() {
                    const value = parseInt(this.getAttribute("data-value"));
                    ratingInput.value = value;

                    // Aktifkan semua bintang hingga indeks yang dipilih
                    stars.forEach((s, i) => {
                        if (i < value) {
                            s.classList.add("active");
                        } else {
                            s.classList.remove("active");
                        }
                    });
                });
            });

            // Event untuk submit form
            const form = document.getElementById("ratingForm");
            form.addEventListener("submit", function(e) {
                e.preventDefault();
                const rating = ratingInput.value;
                const review = document.getElementById("review").value;

                if (rating === "0") {
                    alert("Harap memberikan rating sebelum mengirim.");
                    return;
                }

                // Proses pengiriman data (AJAX atau ke backend)
                alert(`Rating: ${rating}\nUlasan: ${review}`);
                form.submit();

                // Reset bintang setelah submit
                stars.forEach((s) => s.classList.remove("active"));
                document.getElementById("ratingModal").querySelector(".btn-close").click();
            });
        });
    </script>
@endpush
