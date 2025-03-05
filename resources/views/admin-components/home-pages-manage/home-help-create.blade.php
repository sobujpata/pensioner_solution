<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Help Create</h5>
            </div>
            <div class="modal-body">
                <div class="container-fluid m-0 p-0">
                    <div class="row m-0 p-0">
                        <div class="col-md-6 p-2">
                            <label for="title">Help Title</label>
                            <input id="title" placeholder="Tite" class="form-control" type="text" value="" />
                        </div>
                        <div class="col-md-6 p-2">
                            <label for="person_type">Help for person</label>
                            <select id="person_type" class="form-control form-select">
                                <option value="" selected disabled>Select Person Type</option>
                                <option value="ex-airmen">Ex Aiemen</option>
                                <option value="employee">Employee</option>
                            </select>
                        </div>
                        <div class="col-md-12 p-2">
                            <label for="description">Description</label>
                            <textarea id="description" placeholder="Description" class="form-control" type="text" value="" rows="8"></textarea>
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
        let title = document.getElementById('title').value;
        let description = document.getElementById('description').value;
        let person_type = document.getElementById('person_type').value;

        // Validation checks
        if (title.length === 0) {
            errorToast("Title is Required!");
        } else if (description.length === 0) {
            errorToast("Description is Required!");

        } else if (person_type.length === 0) {
            errorToast("Person type is Required!");
        } else {
            // Proceed with the Create process
            let formData = new FormData();
            formData.append('title', title);
            formData.append('description', description);
            formData.append('person_type', person_type);

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
                let res = await axios.post("/home-page-help-create", formData, config);
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
