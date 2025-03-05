<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create FAQ</h5>
            </div>
            <div class="modal-body">
                <div class="container-fluid m-0 p-0">
                    <div class="row m-0 p-0">
                        <div class="col-md-6 p-2">
                            <label class="form-label">Job Title</label>
                            <input type="text" class="form-control" id="jobTitle">
                        </div>
                        <div class="col-md-6 p-2">
                            <label>Office Location</label>
                            <input id="officeLocation" placeholder="Office Location" class="form-control" type="text" value=""/>
                        </div>
                        <div class="col-md-12 p-2">
                            <label>Job Description</label>
                            <textarea id="description" placeholder="Job description" class="form-control" type="text" value="" rows="3"></textarea>
                        </div>
                        <div class="col-md-6 p-2">
                            <label>Area</label>
                            <input id="area" placeholder="Job Area" class="form-control" type="text"/>
                        </div>
                        <div class="col-md-6 p-2">
                            <label>Status</label>
                            <select id="status" placeholder="Circuler Status" class="form-control form-select" type="text">
                                <option value="">Select Status</option>
                                <option value="1">Published</option>
                                <option value="0">Not Published</option>
                            </select>
                        </div>
                        <div class="col-md-6 p-2">
                            <label class="form-label">Circuler File</label>
                            <input type="file" class="form-control" id="circulerFile">
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn bg-gradient-success" onclick="onCirculerCreate()">Create</button>
            </div>
        </div>
    </div>
</div>

<script>

async function onCirculerCreate() {
    let jobTitle = document.getElementById('jobTitle').value;
    let officeLocation = document.getElementById('officeLocation').value;
    let description = document.getElementById('description').value;
    let area = document.getElementById('area').value;
    let status = document.getElementById('status').value;
    let circulerFile = document.getElementById('circulerFile').files[0];

    // Validation checks
    if (jobTitle.trim() === "") {
        errorToast("Job title is required!");
        return;
    }
    if (officeLocation.trim() === "") {
        errorToast("Office location is required!");
        return;
    }
    if (description.trim() === "") {
        errorToast("Description is required!");
        return;
    }
    if (area.trim() === "") {
        errorToast("Area is required!");
        return;
    }
    if (status.trim() === "") {
        errorToast("Status is required!");
        return;
    }
    if (!circulerFile) {
        errorToast("Circuler file is required!");
        return;
    }
    if (circulerFile.type !== "application/pdf") {
        errorToast("Only PDF files are allowed!");
        return;
    }
    if (circulerFile.size > 4048 * 1024) {
        errorToast("File size must be less than 4 MB!");
        return;
    }

    // Proceed with the Create process
    let formData = new FormData();
    formData.append('title', jobTitle);
    formData.append('office_location', officeLocation);
    formData.append('description', description);
    formData.append('area', area);
    formData.append('status', status);
    formData.append('circuler_file', circulerFile);

    const config = {
        headers: {
            'Content-Type': 'multipart/form-data',
        },
    };

    showLoader();
        //Hide modal
        const modalElement = document.getElementById('create-modal');
        const modalInstance = bootstrap.Modal.getInstance(modalElement);
        modalInstance.hide();
    try {
        let res = await axios.post("/job-circuler-create", formData, config);
        hideLoader();
console.log(res);
        if (res.status === 200) {
            successToast('Created successfully!');
            document.getElementById("jobTitle").value = "";
            document.getElementById("officeLocation").value = "";
            document.getElementById("description").value = "";
            document.getElementById("area").value = "";
            document.getElementById("status").value = "";
            document.getElementById("circulerFile").value = "";

            // Update the list
            await getList();

            //Close the modal after successful creation
            const modalElement = document.getElementById('create-modal');
            const modalInstance = bootstrap.Modal.getInstance(modalElement);
            if (modalInstance) modalInstance.hide();
        } else {
            errorToast("Create failed!");
        }
    } catch (error) {
        hideLoader();
        if (error.response && error.response.data && error.response.data.message) {
            errorToast(error.response.data.message); // Server error message
        } else {
            errorToast("Create failed! Please try again.");
        }
        console.error("Error:", error);
    }
}


</script>
