<!-- Modal for Create and Edit -->
<div class="modal fade" id="customersModal" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Update Bank</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="userForm">
                    <input type="hidden" id="formBankId" name="id">
                    <div class="mb-3">
                        <label for="formCustomerName" class="form-label">Bank</label>
                        <select class="form-control" name="id_bank" required id="formIdBank">
                            @foreach (App\Models\Bank::all() as $item)
                                <option value="{{ $item->id }}">{{ $item->bank }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="formCustomerName" class="form-label">Nama Pemilik Rekening</label>
                        <input type="text" class="form-control" name="nama" id="formNama" required>
                    </div>
                    <div class="mb-3">
                        <label for="formCustomerPhone" class="form-label">Nomor Rekening</label>
                        <input type="number" class="form-control" name="no_rek" id="formNoRek" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveCustomerBtn">Save</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Tambah Bank</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="createUserForm">
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
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="formCustomerPhone" class="form-label">Nomor Rekening</label>
                        <input type="number" class="form-control" name="no_rek" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="createCustomerBtn">Save</button>
            </div>
        </div>
    </div>
</div>
