<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Tutorial</h5>
            </div>
            <div class="modal-body">
                <div class="container-fluid m-0 p-0">
                    <div class="row m-0 p-0">
                        <div class="col-md-6 p-2">
                            <label for="title">Tutorial Title</label>
                            <input id="titleUpdate" placeholder="Tite" class="form-control" type="text" value="" />
                        </div>
                        <div class="col-md-6 p-2">
                            <label for="person_type">Help for person</label>
                            <input type="file" class="form-control" id="updateVedioUrl">
                        </div>

                        <input name="id" type="text" class="d-none" id="updateID">
                        {{-- <input name="id" type="text" class="d-none" id="updateFilePath"> --}}
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
    async function FillUpUpdateForm(id, fil_path){

        document.getElementById('updateID').value=id;
        showLoader();
        let res=await axios.post("/home-page-tutorial-by-id",{id:id})
        hideLoader();

        document.getElementById('titleUpdate').value=res.data['title'];

    }

    async function update() {
        let titleUpdate = document.getElementById('titleUpdate').value;
        let updateVedioUrl = document.getElementById('updateVedioUrl').files[0];
        let updateID = document.getElementById('updateID').value;  // Corrected variable name


        // Validation checks
        if (titleUpdate.length === 0) {
            errorToast("Title is Required!");
        } else {
            // Proceed with the update process
            let formData = new FormData();
            formData.append('id', updateID);
            formData.append('title', titleUpdate);
            formData.append('vedio_url', updateVedioUrl);

            // Show Progress Bar
            document.querySelector('.progress').style.display = "block";
            let progressBar = document.getElementById('uploadProgress');
            progressBar.style.width = "0%";

            const config = {
                headers: { 'Content-Type': 'multipart/form-data' },
                onUploadProgress: function (progressEvent) {
                    let percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                    progressBar.style.width = percentCompleted + "%";
                    progressBar.innerText = percentCompleted + "%";
                }
            };

            // Hide modal
            const modalElement = document.getElementById('update-modal');
            const modalInstance = bootstrap.Modal.getInstance(modalElement);
            modalInstance.hide();

            showLoader();
            try {
                let res = await axios.post("/home-page-tutorial-update", formData, config);
                // console.log(res)
                hideLoader();

                if (res.status === 203) {
                    successToast('Update completed');
                    document.getElementById("titleUpdate").value = "";
                    document.getElementById("updateVedioUrl").value = "";
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
