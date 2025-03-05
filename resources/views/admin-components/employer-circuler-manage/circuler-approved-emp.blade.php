<div class="modal animated zoomIn" id="approve-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3 class="mt-3 text-warning">Circular Status</h3>
                <p class="mb-3">Do you want to update the circular status?</p>
                <select id="statusUpdateByAdmin" class="form-control form-select">
                    <option value="1">Published</option>
                    <option value="0">Not Published</option>
                </select>
                <input class="d-none" id="approveIDByAdmin"/>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn bg-gradient-success mx-2" data-bs-dismiss="modal">Cancel</button>
                <button onclick="itemapproveByAdmin()" type="button" id="confirmapprove" class="btn bg-gradient-danger">Approve</button>
            </div>
        </div>
    </div>
</div>

<script>
    async function itemapproveByAdmin() {
        try {
            let id = document.getElementById('approveIDByAdmin').value;
            let statusUpdateByAdmin = document.getElementById('statusUpdateByAdmin').value;

            let modalInstance = bootstrap.Modal.getInstance(document.getElementById('approve-modal'));
            if (modalInstance) {
                modalInstance.hide();
            }
            showLoader();
            let res = await axios.post("/circuler-status-approved-by-admin", {
                id: id,
                status: statusUpdateByAdmin
            });

            hideLoader();

            if (res.data?.status === 'success') {
                successToast("Circular Status Updated Successfully.");
                await getList();
            } else {
                errorToast("Request failed!");
            }
        } catch (error) {
            hideLoader();
            console.error("Error updating status:", error);
            errorToast("Something went wrong. Please try again.");
        }
    }
</script>
