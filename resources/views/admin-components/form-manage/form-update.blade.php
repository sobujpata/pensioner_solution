<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Form</h5>
            </div>
            <div class="modal-body">
                <div class="container-fluid m-0 p-0">
                    <div class="row m-0 p-0">
                        <div class="col-md-6 p-2">
                            <label>Form Name</label>
                            <input id="formNameUpdate" placeholder="Form Name" class="form-control" type="text" value="" />
                        </div>
                        <div class="col-md-6 p-2">
                            <label>description</label>
                            <input id="descriptionUpdate" placeholder="form description" class="form-control" type="text" value="">
                        </div>

                        <div class="col-md-6 p-2">
                            <label>Published On</label>
                            <input type="date" class="form-control" id="publishedOnUpdate">
                        </div>

                        <div class="col-md-6 p-2">
                            <label class="form-label">Image</label>
                            <input type="file" class="form-control" id="formImageUpdate">
                        </div>
                        <input name="id" type="text" class="d-none" id="updateID">
                        <input name="filePath" type="text" class="d-none" id="filePath">
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



    async function FillUpUpdateForm(id,filePath){

        document.getElementById('updateID').value=id;
        document.getElementById('filePath').value=filePath;


        showLoader();

        let res=await axios.post("/form-by-id",{id:id})
        hideLoader();

        document.getElementById('formNameUpdate').value=res.data['name'];
        document.getElementById('descriptionUpdate').value=res.data['subject'];
        document.getElementById('publishedOnUpdate').value=res.data['published_on'];

    }

    async function update() {
        let formNameUpdate = document.getElementById('formNameUpdate').value;
        let descriptionUpdate = document.getElementById('descriptionUpdate').value;
        let publishedOnUpdate = document.getElementById('publishedOnUpdate').value;
        let updateID = document.getElementById('updateID').value;  // Corrected variable name
        let formImageUpdate = document.getElementById('formImageUpdate').files[0];


        // Validation checks
        if (formNameUpdate.length === 0) {
            errorToast("Full Name Required!");
        } else if (descriptionUpdate.length === 0) {
            errorToast("Description Required!");
        } else if (publishedOnUpdate.length === 0) {
            errorToast("Published Date Required!");
        } else if (!formImageUpdate) {
            errorToast("Image is Required!");
        } else {
            // Proceed with the update process
            let formData = new FormData();
            formData.append('id', updateID);
            formData.append('name', formNameUpdate);
            formData.append('subject', descriptionUpdate);
            formData.append('published_on', publishedOnUpdate);
            formData.append('image_url', formImageUpdate);

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
                let res = await axios.post("/form-update", formData, config);
                // console.log(res)
                hideLoader();

                if (res.status === 200) {
                    successToast('Update completed');
                    document.getElementById("formNameUpdate").value = "";
                    document.getElementById("descriptionUpdate").value = "";
                    document.getElementById("publishedOnUpdate").value = "";
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
