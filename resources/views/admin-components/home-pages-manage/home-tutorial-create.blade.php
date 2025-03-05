<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tutorial Create</h5>
            </div>
            <div class="modal-body">
                <div class="container-fluid m-0 p-0">
                    <div class="row m-0 p-0">
                        <div class="col-md-6 p-2">
                            <label for="title">Tutorial Title</label>
                            <input id="title" placeholder="Title" class="form-control" type="text" value="" />
                        </div>

                        <div class="col-md-6 p-2">
                            <label for="video_url">Video Upload</label>
                            <input id="video_url" class="form-control" type="file">
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
    let video_file = document.getElementById('video_url').files[0];

    // Validation checks
    if (!title.trim()) {
        errorToast("Title is Required!");
        return;
    }
    if (!video_file) {
        errorToast("Video is Required!");
        return;
    }

    // Prepare FormData
    let formData = new FormData();
    formData.append('title', title);
    formData.append('video_url', video_file);

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

    // Hide Modal
    const modalElement = document.getElementById('create-modal');
    const modalInstance = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
    modalInstance.hide();

    try {
        let res = await axios.post("/home-page-tutorial-create", formData, config);
        document.querySelector('.progress').style.display = "none"; // Hide progress bar after upload

        if (res.status === 200) {
            successToast('Upload completed!');
            await getList();
        } else {
            errorToast("Upload failed!");
        }
    } catch (error) {
        document.querySelector('.progress').style.display = "none"; // Hide progress bar on error
        console.error("Error:", error);
        errorToast("Upload failed!");
    }
}
</script>
