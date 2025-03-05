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
                            <label>Slider Title</label>
                            <input id="titleUpdate" placeholder="Slider Update" class="form-control" type="text" value="" />
                        </div>
                        <div class="col-md-6 p-2">
                            <label>Description</label>
                            <input id="descriptionUpdate" placeholder="form description" class="form-control" type="text" value="">
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

        let res=await axios.post("/slider-by-id",{id:id})
        hideLoader();

        document.getElementById('titleUpdate').value=res.data['title'];
        document.getElementById('descriptionUpdate').value=res.data['short_des'];

    }

    async function update() {
        let titleUpdate = document.getElementById('titleUpdate').value;
        let descriptionUpdate = document.getElementById('descriptionUpdate').value;
        let updateID = document.getElementById('updateID').value;  // Corrected variable name
        let formImageUpdate = document.getElementById('formImageUpdate').files[0];


        // Validation checks
        if (titleUpdate.length === 0) {
            errorToast("Title is Required!");
        } else if (descriptionUpdate.length === 0) {
            errorToast("Short Des Required!");
        } else {
            // Proceed with the update process
            let formData = new FormData();
            formData.append('id', updateID);
            formData.append('title', titleUpdate);
            formData.append('short_des', descriptionUpdate);
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
                let res = await axios.post("/slider-update", formData, config);
                // console.log(res)
                hideLoader();

                if (res.status === 200) {
                    successToast('Update completed');
                    document.getElementById("titleUpdate").value = "";
                    document.getElementById("descriptionUpdate").value = "";
                    document.getElementById("filePath").value = "";
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
