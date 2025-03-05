<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create form</h5>
            </div>
            <div class="modal-body">
                <div class="container-fluid m-0 p-0">
                    <div class="row m-0 p-0">
                        <div class="col-md-6 p-2">
                            <label>Form Name</label>
                            <input id="formName" placeholder="form Name" class="form-control" type="text"
                                value="" />
                        </div>
                        <div class="col-md-6 p-2">
                            <label>Description</label>
                            <input id="description" placeholder="form description" class="form-control" type="text"
                                value="">
                        </div>

                        <div class="col-md-6 p-2">
                            <label>Published On</label>
                            <input type="date" class="form-control" id="publishedOn">
                        </div>


                        <div class="col-md-6 p-2">
                            <label class="form-label">Image</label>
                            <input type="file" class="form-control" id="formImage">
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn bg-gradient-success" onclick="onformCreate()">Create</button>
            </div>
        </div>
    </div>
</div>


<script>
    async function onformCreate() {
        let formName = document.getElementById('formName').value;
        let description = document.getElementById('description').value;
        let published_on = document.getElementById('publishedOn').value;
        let formImage = document.getElementById('formImage').files[0];

        // Validation checks
        if (formName.length === 0) {
            errorToast("Name is Required!");
        } else if (description.length === 0) {
            errorToast("Description is Required!");
        } else if (published_on.length === 0) {
            errorToast("Published on Required!");
        } else if (!formImage) {
            errorToast("Image is Required!");
        } else {
            // Proceed with the Create process
            let formData = new FormData();
            formData.append('name', formName);
            formData.append('subject', description);
            formData.append('published_on', published_on);
            formData.append('image_url', formImage);

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
                let res = await axios.post("/form-create", formData, config);
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
