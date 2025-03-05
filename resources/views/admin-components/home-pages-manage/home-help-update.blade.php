<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Slider</h5>
            </div>
            <div class="modal-body">
                <div class="container-fluid m-0 p-0">
                    <div class="row m-0 p-0">
                        <div class="col-md-6 p-2">
                            <label for="title">Help Title</label>
                            <input id="titleUpdate" placeholder="Tite" class="form-control" type="text" value="" />
                        </div>
                        <div class="col-md-6 p-2">
                            <label for="person_type">Help for person</label>
                            <select id="personTypeUpdate" class="form-control form-select">
                                <option value="" selected disabled>Select Person Type</option>
                                <option value="ex-airmen">Ex Aiemen</option>
                                <option value="employee">Employee</option>
                            </select>
                        </div>
                        <div class="col-md-12 p-2">
                            <label for="description">Description</label>
                            <textarea id="descriptionUpdate" placeholder="Description" class="form-control" type="text" value="" rows="8"></textarea>
                        </div>
                        <input name="id" type="text" class="d-none" id="updateID">
                    </div>

                </div>
                <div class="modal-footer">
                    <button id="update-modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="update()" type="submit" id="update-btn" class="btn bg-gradient-success" >Update</button>
                </div>

            </div>
        </div>
    </div>
</div>


<script>
    async function FillUpUpdateForm(id){

        document.getElementById('updateID').value=id;
        showLoader();
        let res=await axios.post("/home-page-help-by-id",{id:id})
        hideLoader();

        document.getElementById('titleUpdate').value=res.data['title'];
        document.getElementById('descriptionUpdate').value=res.data['description'];
        document.getElementById('personTypeUpdate').value=res.data['person_type'];

    }

    async function update() {
        let titleUpdate = document.getElementById('titleUpdate').value;
        let descriptionUpdate = document.getElementById('descriptionUpdate').value;
        let updateID = document.getElementById('updateID').value;  // Corrected variable name
        let personTypeUpdate = document.getElementById('personTypeUpdate').value;


        // Validation checks
        if (titleUpdate.length === 0) {
            errorToast("Title is Required!");
        } else if (descriptionUpdate.length === 0) {
            errorToast("Description Required!");

        } else if (personTypeUpdate.length === 0) {
            errorToast("Perosn Type Required!");
        } else {
            // Proceed with the update process
            let formData = new FormData();
            formData.append('id', updateID);
            formData.append('title', titleUpdate);
            formData.append('description', descriptionUpdate);
            formData.append('person_type', personTypeUpdate);
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
                let res = await axios.post("/home-page-help-update", formData, config);
                // console.log(res)
                hideLoader();

                if (res.status === 203) {
                    successToast('Update completed');
                    document.getElementById("titleUpdate").value = "";
                    document.getElementById("descriptionUpdate").value = "";
                    document.getElementById("personTypeUpdate").value = "";
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
