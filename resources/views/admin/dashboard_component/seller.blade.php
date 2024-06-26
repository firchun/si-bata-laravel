@if (App\Models\Seller::where('id_user', Auth::id())->count() == 0)
    <div class="row justify-content-center">
        <div class="col-lg-8  col-md-8">

            <div class="card-box mb-30">
                <div class="card-body">
                    <h5>Form Pendaftaran Toko</h5>
                    <hr>
                    <form action="{{ route('seller.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Nama Toko <span class="text-danger">*</span></label>
                                    <input type="text" name="nama" class="form-control" placeholder="Nama Toko"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Nomor HP/WA <span class="text-danger">*</span></label>
                                    <input type="text" name="no_hp" class="form-control" value="+62" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Harga Batu <span class="text-danger">*</span></label>
                                    <input type="number" name="harga_batu" class="form-control" value="0"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Harga Pengantaran</label>
                                    <input type="number" name="harga_pengantaran" class="form-control" value="0">
                                </div>
                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Foto Batu Bata 1 <span class="text-danger">*</span></label>
                                    <input type="file" name="foto_1" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Foto Batu Bata 2</label>
                                    <input type="file" name="foto_2" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Foto Batun Bata 3</label>
                                    <input type="file" name="foto_3" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Pengantaran <span class="text-danger">*</span></label>
                                    <select name="pengantaran" class="form-control">
                                        <option value="1">Pengantaran</option>
                                        <option value="0">Ambil Ditempat</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label>Alamat Toko <span class="text-danger">*</span></label>
                                    <textarea name="alamat" class="form-control" required></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-block btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="title pb-20">
        <h2 class="h3 mb-0">Dashboard Overview</h2>
    </div>
@endif
