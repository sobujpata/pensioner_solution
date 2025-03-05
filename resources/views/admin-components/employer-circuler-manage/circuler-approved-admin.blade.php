<div class="modal animated zoomIn" id="approve-admin-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3 class="mt-3 text-warning">Admin Approved!</h3>
                <p class="mb-3">Do you want to update the circular status?</p>
                <select id="statusUpdateAdmin" class="form-control form-select">
                    <option value="1">Published</option>
                    <option value="0">Not Published</option>
                </select>
                <input type="hidden" id="approveIDAdmin"/>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn bg-gradient-success mx-2" data-bs-dismiss="modal">Cancel</button>
                <button onclick="itemapprove()" type="button" id="confirmapprove" class="btn bg-gradient-danger">Approve</button>
            </div>
        </div>
    </div>
</div>

<script>
    async function itemapprove() {
        try {
            let id = document.getElementById('approveIDAdmin').value;
            let statusUpdate = document.getElementById('statusUpdateAdmin').value;

            let modalInstance = bootstrap.Modal.getInstance(document.getElementById('approve-admin-modal'));
            if (modalInstance) {
                modalInstance.hide();
            }
            showLoader();

            let res = await axios.post("/circuler-admin-status-approved", {
                id: id,
                status: statusUpdate
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
