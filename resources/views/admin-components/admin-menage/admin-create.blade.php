<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Admin</h5>
            </div>
            <div class="modal-body">
                <div class="container-fluid m-0 p-0">
                    <div class="row m-0 p-0">
                        <div class="col-md-4 p-2">
                            <label>Full Name</label>
                            <input id="fnameCreate" placeholder="Full Name" class="form-control" type="text" value=""/>
                        </div>
                        <div class="col-md-4 p-2">
                            <label>Email Address</label>
                            <input id="emailCreate" placeholder="User Email" class="form-control" type="email" value=""/>
                        </div>
                        <div class="col-md-4 p-2">
                            <label>Mobile Number</label>
                            <input id="mobileCreate" placeholder="Mobile" class="form-control" type="text" value=""/>
                        </div>
                        <div class="col-md-4 p-2">
                            <label>Password</label>
                            <input id="passwordCreate" placeholder="User Password" class="form-control" type="password"/>
                        </div>
                        <div class="col-md-4 p-2">
                            <label>Role</label>
                            <select name="role" id="roleCreate" class="form-select">
                                <option selected disabled value="">Select Role</option>
                                <option value="1">Admin</option>
                                <option value="2">Pension</option>
                                <option value="3">Doc I-II</option>
                                <option value="4">Doc III</option>
                                <option value="5">Doc IV-V</option>
                            </select>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn bg-gradient-success" onclick="onRegistration()">Create</button>
            </div>
        </div>
    </div>
</div>

<script>


async function onRegistration() {
    let fnameCreate = document.getElementById('fnameCreate').value;
    let emailCreate = document.getElementById('emailCreate').value;
    let mobileCreate = document.getElementById('mobileCreate').value;
    let passwordCreate = document.getElementById('passwordCreate').value;
    let roleCreate = document.getElementById('roleCreate').value;

    // Validation checks
    if (fnameCreate.length === 0) {
        errorToast("Full Name Required!");
    } else if (emailCreate.length === 0) {
        errorToast("Email Required!");
    } else if (mobileCreate.length === 0) {
        errorToast("Mobile Number Required!");
    } else if (passwordCreate.length === 0) {
        errorToast("Password Required!");
    } else if (roleCreate.length === 0) {
        errorToast("Role Required!");
    } else {
        // Proceed with the Create process
        let formData = new FormData();
        formData.append('fname', fnameCreate);
        formData.append('email', emailCreate);
        formData.append('mobile', mobileCreate);
        formData.append('password', passwordCreate);
        formData.append('role', roleCreate);


        const config = {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        };

        // Hide modal
        const modalElement = document.getElementById('create-modal');
        const modalInstance = bootstrap.Modal.getInstance(modalElement);
        modalInstance.hide();

        showLoader();
        try {
            let res = await axios.post("/admin-create", formData, config);
            hideLoader();
console.log(res);
            if (res.status === 200) {
                successToast('Created completed');
                document.getElementById("fnameCreate").value = "";
                document.getElementById("emailCreate").value = "";
                document.getElementById("mobileCreate").value = "";
                document.getElementById("passwordCreate").value = "";
                document.getElementById("roleCreate").value = "";
                await getList();
            } else {
                errorToast("Create failed!");
            }
        } catch (error) {
            hideLoader();
            console.error("Error:", error);
            errorToast("Create failed!");
        }
    }
}
</script>
