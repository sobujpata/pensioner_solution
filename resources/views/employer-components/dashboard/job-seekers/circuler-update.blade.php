<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Circuler</h5>
            </div>
            <div class="modal-body">
                <div class="container-fluid m-0 p-0">
                    <div class="row m-0 p-0">
                        <div class="col-md-6 p-2">
                            <label class="form-label">Job Title</label>
                            <input type="text" class="form-control" id="jobTitleUpdate">
                        </div>
                        <div class="col-md-6 p-2">
                            <label>Office Location</label>
                            <input id="officeLocationUpdate" placeholder="Office Location" class="form-control" type="text" value=""/>
                        </div>
                        <div class="col-md-12 p-2">
                            <label>Job Description</label>
                            <textarea id="descriptionUpdate" placeholder="Job description" class="form-control" type="text" value="" rows="3"></textarea>
                        </div>
                        <div class="col-md-6 p-2">
                            <label>Area</label>
                            <input id="areaUpdate" placeholder="Job Area" class="form-control" type="text"/>
                        </div>
                        <div class="col-md-6 p-2">
                            <label>Status</label>
                            <select id="statusUpdate" name="statusUpdate" placeholder="Circuler Status" class="form-control form-select" type="text">
                                <option value="" disabled>Select Status</option>
                                <option value="1">Published</option>
                                <option value="0">Not Published</option>
                            </select>
                        </div>

                        <div class="col-md-4 p-2">
                            <label class="form-label">Circuler File(Pdf)</label>
                            <input type="file" class="form-control" id="ImageUpdate">
                            <input name="filePath" type="text" class="" id="filePath">
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

    async function FillUpUpdateForm(id,filePath){

        document.getElementById('updateID').value=id;
        document.getElementById('filePath').value=filePath;
        // document.getElementById('oldFile').value=filePath;

        showLoader();

        let res=await axios.post("/circuler-by-id",{id:id})
        hideLoader();
console.log(res);
        document.getElementById('jobTitleUpdate').value=res.data['job_title'];
        document.getElementById('officeLocationUpdate').value=res.data['office_location'];
        document.getElementById('descriptionUpdate').value=res.data['description'];
        document.getElementById('areaUpdate').value=res.data['area'];
        document.getElementById('statusUpdate').value=res.data['status'];

    }

    async function update() {
        let jobTitleUpdate = document.getElementById('jobTitleUpdate').value;
        let officeLocationUpdate = document.getElementById('officeLocationUpdate').value;
        let descriptionUpdate = document.getElementById('descriptionUpdate').value;
        let areaUpdate = document.getElementById('areaUpdate').value;
        let statusUpdate = document.getElementById('statusUpdate').value;
        let updateID = document.getElementById('updateID').value;  // ✅ Fixed variable
        let filePath = document.getElementById('filePath').value;
        let ImageUpdate = document.getElementById('ImageUpdate').files[0];

        // ✅ Improved validation checks
        if (!jobTitleUpdate.trim()) {
            return errorToast("Job title is required!");
        }
        if (!descriptionUpdate.trim()) {
            return errorToast("Description is required!");
        }
        if (!officeLocationUpdate.trim()) {
            return errorToast("Office location is required!");
        }
        if (!areaUpdate.trim()) {
            return errorToast("Area is required!");
        }

        let formData = new FormData();
        formData.append('id', updateID);
        formData.append('title', jobTitleUpdate);
        formData.append('description', descriptionUpdate);
        formData.append('office_location', officeLocationUpdate);
        formData.append('area', areaUpdate);
        formData.append('status', statusUpdate);

        // ✅ Handle file upload properly
        if (ImageUpdate) {
            formData.append('circuler_file', ImageUpdate);
        } else {
            formData.append('filePath', filePath); // Keep existing file if no new one is uploaded
        }

        const config = {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        };

        // ✅ Improved Bootstrap modal close logic
        let modalInstance = bootstrap.Modal.getInstance(document.getElementById('update-modal'));
        if (modalInstance) {
            modalInstance.hide();
        }

        showLoader();
        try {
            let res = await axios.post("/job-circuler-update", formData, config);
            // console.log(res);
            hideLoader();

            if (res.status === 200) {
                successToast('Updated successfully!');

                // ✅ Reset form fields properly
                document.getElementById("jobTitleUpdate").value = "";
                document.getElementById("officeLocationUpdate").value = "";
                document.getElementById("descriptionUpdate").value = "";
                document.getElementById("areaUpdate").value = "";
                document.getElementById("statusUpdate").value = "";
                document.getElementById("ImageUpdate").value = "";

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

</script>
