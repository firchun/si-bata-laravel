<!-- Modal for Create and Edit -->
<div class="modal fade" id="customersModal" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Update Harga</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="userForm">
                    <input type="hidden" id="formCustomerId" name="id">
                    <input type="hidden" name="id_seller" value="{{ $id_seller }}">
                    <div class="mb-3">
                        <label for="formCustomerName" class="form-label">Area </label>
                        <input type="text" class="form-control" id="formArea" name="area" required>
                    </div>
                    <div class="mb-3">
                        <label for="formCustomerPhone" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="formHarga" name="harga" required>
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
                <h5 class="modal-title" id="userModalLabel">Tambah Harga</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="createUserForm">
                    <input type="hidden" name="id_seller" value="{{ $id_seller }}">
                    <div class="mb-3">
                        <label for="formCustomerName" class="form-label">Area</label>
                        <input type="text" class="form-control" id="formCreateArea" name="area" required>
                    </div>
                    <div class="mb-3">
                        <label for="formCustomerPhone" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="formCreateHarga" name="harga" required>
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
