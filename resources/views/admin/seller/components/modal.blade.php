<div class="modal fade" id="tarikSaldo" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Ajukan Penarikan Saldo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="formTarikSaldo">
                    <input type="hidden" name="id_seller" value="{{ $seller->id }}">
                    <div class="mb-3">
                        <label>Jumlah dana yang akan di tarik</label>
                        <input type="number" class="form-control" name="jumlah" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="tarikSaldoBtn">Ajukan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tambahStok" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Tambah Stok</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="formTambahStok">
                    <input type="hidden" value="{{ $seller->id }}" name="id_seller">
                    <input type="hidden" value="Masuk" name="jenis">
                    <div class="mb-3">
                        <div class="form-group">
                            <label>Jumlah Stok</label>
                            <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                <input id="demo5" type="number" class="form-control" name="jumlah" value="1">
                                <span class="input-group-addon bootstrap-touchspin-postfix input-group-append">
                                    <span class="input-group-text">Buah</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="tambahStokBtn">Tambah</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="updateRekening" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Update Rekening</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="formUpdateRekening">
                    @if ($rekening)
                        <input type="hidden" value="{{ $rekening->id }}" name="id">
                    @endif
                    <input type="hidden" value="{{ $seller->id }}" name="id_seller">
                    <div class="mb-3">
                        <label for="formCustomerName" class="form-label">Bank</label>
                        <select class="form-control" name="id_bank" required>
                            @foreach (App\Models\Bank::all() as $item)
                                <option value="{{ $item->id }}">{{ $item->bank }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="formCustomerName" class="form-label">Nama Pemilik Rekening</label>
                        <input type="text" class="form-control" name="nama" required
                            value="{{ $rekening->nama ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="formCustomerPhone" class="form-label">Nomor Rekening</label>
                        <input type="number" class="form-control" name="no_rek"
                            value="{{ $rekening->no_rek ?? '' }}" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="updateRekeningBtn">Simpan</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="alertRekening" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-danger text-white">
            <div class="modal-body text-center">
                <h3 class="text-white mb-15"><i class="fa fa-exclamation-triangle"></i> Maaf..</h3>
                <p>Anda belum mengisi rekening penarikan, harap isi terlebih dahulu..</p>
                <button type="button" class="btn btn-light" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="alertSaldo" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-danger text-white">
            <div class="modal-body text-center">
                <h3 class="text-white mb-15"><i class="fa fa-exclamation-triangle"></i> Maaf..</h3>
                <p>Saldo anda belum dapat dilakukan pengajuan penarikan</p>
                <button type="button" class="btn btn-light" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>
