<div class="modal animated zoomIn" id="pass-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Password</h5>
            </div>
            <div class="modal-body">
                <div class="container-fluid m-0 p-0">
                    <div class="row m-0 p-0">
                        <div class="col-12 p-2">
                            <label>New Password</label>
                            <input id="newPass" placeholder="New Password" class="form-control" type="password" value=""/>
                        </div>
                        <div class="col-12 p-2">
                            <label>Confirm Password</label>
                            <input id="confirmPass" placeholder="Confirm Password" class="form-control" type="password" value=""/>
                        </div>

                        <input type="text" id="updateIDPass" class="d-none">
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn bg-gradient-success" onclick="updatePass()">Update</button>
            </div>
        </div>
    </div>
</div>
<script>

    async function UpdatePassForm(id){
        document.getElementById('updateIDPass').value=id;
    }



    async function updatePass() {
        let newPass = document.getElementById('newPass').value;
        let confirmPass = document.getElementById('confirmPass').value;
        let updateIDPass = document.getElementById('updateIDPass').value;

        // Regular expression for password validation
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/;

        // Validation checks
        if (newPass.length === 0) {
            errorToast("New Password is required!");
            return;
        }
        if (confirmPass.length === 0) {
            errorToast("Confirm Password is required!");
            return;
        }
        if (!passwordRegex.test(newPass)) {
            errorToast(
                "Password must be at least 6 characters, include 1 uppercase letter, 1 lowercase letter, 1 number, and 1 special character!"
            );
            return;
        }
        if (newPass !== confirmPass) {
            errorToast("New Password and Confirm Password do not match!");
            return;
        }

        // Proceed with the update process
        let formData = new FormData();
        formData.append('id', updateIDPass);
        formData.append('password', newPass);

        const config = {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
        };

        // Hide modal
        const modalElement = document.getElementById('pass-modal');
        const modalInstance = bootstrap.Modal.getInstance(modalElement);
        modalInstance.hide();

        showLoader();
        try {
            let res = await axios.post("/update-user-password", formData, config);
            hideLoader();

            if (res.status === 200) {
                successToast('Password updated successfully!');
                document.getElementById("newPass").value = "";
                document.getElementById("confirmPass").value = "";
                await getList(); // Refresh the user list
            } else {
                errorToast("Failed to update password!");
            }
        } catch (error) {
            hideLoader();
            console.error("Error:", error);
            errorToast("Update failed!");
        }
    }
</script>
