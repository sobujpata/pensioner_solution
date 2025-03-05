<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update FAQ</h5>
            </div>
            <div class="modal-body">
                <div class="container-fluid m-0 p-0">
                    <div class="row m-0 p-0">
                        <div class="col-md-6 p-2">
                            <label>notice Name</label>
                            <input id="noticeNameUpdate" placeholder="notice Name" class="form-control" type="text" value="" />
                        </div>
                        <div class="col-md-6 p-2">
                            <label>description</label>
                            <input id="descriptionUpdate" placeholder="notice description" class="form-control" type="text" value="">
                        </div>
                        <div class="col-md-3 p-2">
                            <label>Notice Status</label>
                            <select name="remarks" id="remarksUpdate" class="form-control form-select">
                                <option value="" desable>Select One</option>
                                <option value="Complete">Complete</option>
                                <option value="Continue">Continue</option>
                            </select>

                        </div>
                        <div class="col-md-3 p-2">
                            <label>Published On</label>
                            <input type="date" class="form-control" id="publishedOnUpdate">
                        </div>
                        <div class="col-md-2 p-2 ">
                            <img class="w-60" id="oldImg" src="{{asset('images/default.jpg')}}"/>
                        </div>
                        <div class="col-md-4 p-2">
                            <label class="form-label">Image</label>
                            <input oninput="oldImg.src=window.URL.createObjectURL(this.files[0])" type="file" class="form-control" id="noticeImageUpdate">
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
        document.getElementById('oldImg').src=filePath;


        showLoader();
        // await UpdateFillCategoryDropDown();

        let res=await axios.post("/notice-by-id",{id:id})
        hideLoader();
        console.log(res);

        document.getElementById('noticeNameUpdate').value=res.data['name'];
        document.getElementById('descriptionUpdate').value=res.data['subject'];
        document.getElementById('remarksUpdate').value=res.data['remarks'];
        document.getElementById('publishedOnUpdate').value=res.data['published_on'];
        // document.getElementById('noticeImageUpdate').value=res.data['file_url'];

    }

    async function update() {
        let noticeNameUpdate = document.getElementById('noticeNameUpdate').value;
        let descriptionUpdate = document.getElementById('descriptionUpdate').value;
        let remarksUpdate = document.getElementById('remarksUpdate').value;
        let publishedOnUpdate = document.getElementById('publishedOnUpdate').value;
        let updateID = document.getElementById('updateID').value;  // Corrected variable name
        let noticeImageUpdate = document.getElementById('noticeImageUpdate').files[0];


        // Validation checks
        if (noticeNameUpdate.length === 0) {
            errorToast("Full Name Required!");
        } else if (descriptionUpdate.length === 0) {
            errorToast("Description Required!");
        } else if (remarksUpdate.length === 0) {
            errorToast("Remarks Required!");
        } else if (publishedOnUpdate.length === 0) {
            errorToast("Published Date Required!");
        } else if (!noticeImageUpdate) {
            errorToast("Image is Required!");
        } else {
            // Proceed with the update process
            let formData = new FormData();
            formData.append('id', updateID);
            formData.append('name', noticeNameUpdate);
            formData.append('subject', descriptionUpdate);
            formData.append('remarks', remarksUpdate);
            formData.append('published_on', publishedOnUpdate);
            formData.append('image_url', noticeImageUpdate);

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
                let res = await axios.post("/notice-update", formData, config);
                console.log(res)
                hideLoader();

                if (res.status === 200) {
                    successToast('Update completed');
                    document.getElementById("noticeNameUpdate").value = "";
                    document.getElementById("descriptionUpdate").value = "";
                    document.getElementById("remarksUpdate").value = "";
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
