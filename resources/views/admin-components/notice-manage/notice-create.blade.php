<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create notice</h5>
            </div>
            <div class="modal-body">
                <div class="container-fluid m-0 p-0">
                    <div class="row m-0 p-0">
                        <div class="col-md-6 p-2">
                            <label>notice Name</label>
                            <input id="noticeName" placeholder="notice Name" class="form-control" type="text"
                                value="" />
                        </div>
                        <div class="col-md-6 p-2">
                            <label>description</label>
                            <input id="description" placeholder="notice description" class="form-control" type="text"
                                value="">
                        </div>
                        <div class="col-md-3 p-2">
                            <label>Notice Status</label>
                            <select name="remarks" id="remarks" class="form-control form-select">
                                <option value="" desable>Select One</option>
                                <option value="Complete">Complete</option>
                                <option value="Continue">Continue</option>
                            </select>

                        </div>
                        <div class="col-md-3 p-2">
                            <label>Published On</label>
                            <input type="date" class="form-control" id="publishedOn">
                        </div>

                        <div class="col-md-2 p-2 ">
                            <img class="w-60" id="newImg" src="{{ asset('images/default.jpg') }}" />
                        </div>
                        <div class="col-md-4 p-2">
                            <label class="form-label">Image</label>
                            <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])" type="file"
                                class="form-control" id="noticeImage">
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn bg-gradient-success" onclick="onnoticeCreate()">Create</button>
            </div>
        </div>
    </div>
</div>


<script>
    async function onnoticeCreate() {
        let noticeName = document.getElementById('noticeName').value;
        let description = document.getElementById('description').value;
        let remarks = document.getElementById('remarks').value;
        let published_on = document.getElementById('publishedOn').value;
        let noticeImage = document.getElementById('noticeImage').files[0];

        // Validation checks
        if (noticeName.length === 0) {
            errorToast("Name is Required!");
        } else if (description.length === 0) {
            errorToast("Description is Required!");
        } else if (remarks.length === 0) {
            errorToast("Resp section Required!");
        }else if (published_on.length === 0) {
            errorToast("Published on Required!");
        } else if (!noticeImage) {
            errorToast("Image is Required!");
        } else {
            // Proceed with the Create process
            let formData = new FormData();
            formData.append('name', noticeName);
            formData.append('subject', description);
            formData.append('published_on', published_on);
            formData.append('remarks', remarks);
            formData.append('image_url', noticeImage);

            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            };
            // console.log(formData)
            // Hide modal
            const modalElement = document.getElementById('create-modal');
            const modalInstance = bootstrap.Modal.getInstance(modalElement);
            modalInstance.hide();

            showLoader();
            try {
                let res = await axios.post("/notice-create", formData, config);
                hideLoader();

                if (res.status === 200) {
                    successToast('Created completed');
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
