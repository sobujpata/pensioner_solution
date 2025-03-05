<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
            </div>
            <div class="modal-body">
                <div class="container-fluid m-0 p-0">
                    <div class="row m-0 p-0">
                        <div class="col-md-4 p-2">
                            <label>Full Name</label>
                            <input id="fnameUpdate" placeholder="Full Name" class="form-control" type="text" value=""/>
                        </div>
                        <div class="col-md-4 p-2">
                            <label>Email Address</label>
                            <input id="emailUpdate" placeholder="User Email" class="form-control" type="email" value=""/>
                        </div>
                        <div class="col-md-4 p-2">
                            <label>Mobile Number</label>
                            <input id="mobileUpdate" placeholder="Mobile" class="form-control" type="text" value=""/>
                        </div>
                        <div class="col-md-4 p-2">
                            <label>Status</label>
                            <select name="status" id="statusUpdate" class="form-select">
                                <option selected disabled value="">Select status</option>
                                <option value="0">Not Approved</option>
                                <option value="1">Approved</option>
                                <option value="2">Reject</option>
                            </select>
                        </div>
                        <input type="text" id="updateID" class="d-none">
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn bg-gradient-success" onclick="update()">Update</button>
            </div>
        </div>
    </div>
</div>
<script>

    async function UpdateForm(id){
        document.getElementById('updateID').value=id;
        showLoader();
        let res=await axios.post("/user-by-id",{id:id})
        hideLoader();
        document.getElementById('fnameUpdate').value=res.data.data['fname'];
        document.getElementById('emailUpdate').value=res.data.data['email'];
        document.getElementById('mobileUpdate').value=res.data.data['mobile'];
        document.getElementById('statusUpdate').value=res.data.data['status'];

    }



    async function update() {
    let fnameUpdate = document.getElementById('fnameUpdate').value;
    let emailUpdate = document.getElementById('emailUpdate').value;
    let mobileUpdate = document.getElementById('mobileUpdate').value;
    let updateID = document.getElementById('updateID').value;  // Corrected variable name
    let statusUpdate = document.getElementById('statusUpdate').value;

    // Validation checks
    if (fnameUpdate.length === 0) {
        errorToast("Full Name Required!");
    } else if (emailUpdate.length === 0) {
        errorToast("Email Required!");
    } else if (mobileUpdate.length === 0) {
        errorToast("Mobile Number Required!");
    }  else if (statusUpdate.length === 0) {
        errorToast("Role Required!");
    } else {
        // Proceed with the update process
        let formData = new FormData();
        formData.append('id', updateID);
        formData.append('fname', fnameUpdate);
        formData.append('email', emailUpdate);
        formData.append('mobile', mobileUpdate);
        formData.append('status', statusUpdate);


        const config = {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        };

        // Hide modal
        const modalElement = document.getElementById('update-modal');
        const modalInstance = bootstrap.Modal.getInstance(modalElement);
        modalInstance.hide();

        showLoader();
        try {
            let res = await axios.post("/update-user", formData, config);
            hideLoader();

            if (res.status === 200) {
                successToast('Update completed');
                document.getElementById("fnameUpdate").value = "";
                document.getElementById("emailUpdate").value = "";
                document.getElementById("mobileUpdate").value = "";
                document.getElementById("statusUpdate").value = "";
                await getList();
            } else {
                errorToast("Update failed!");
            }
        } catch (error) {
            hideLoader();
            console.error("Error:", error);
            errorToast("Update failed!");
        }
    }
}

</script>
