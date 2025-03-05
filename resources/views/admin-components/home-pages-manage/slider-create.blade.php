<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">slider Create</h5>
            </div>
            <div class="modal-body">
                <div class="container-fluid m-0 p-0">
                    <div class="row m-0 p-0">
                        <div class="col-md-6 p-2">
                            <label>Slider Title</label>
                            <input id="title" placeholder="form Name" class="form-control" type="text"
                                value="" />
                        </div>
                        <div class="col-md-6 p-2">
                            <label>ShortDes</label>
                            <input id="ShortDes" placeholder="form ShortDes" class="form-control" type="text"
                                value="">
                        </div>

                        <div class="col-md-6 p-2">
                            <label class="form-label">Image</label>
                            <input type="file" class="form-control" id="sliderImage">
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
        let ShortDes = document.getElementById('ShortDes').value;
        let sliderImage = document.getElementById('sliderImage').files[0];

        // Validation checks
        if (title.length === 0) {
            errorToast("Title is Required!");
        } else if (ShortDes.length === 0) {
            errorToast("Short Description is Required!");
        }  else if (!sliderImage) {
            errorToast("Image is Required!");
        } else {
            // Proceed with the Create process
            let formData = new FormData();
            formData.append('title', title);
            formData.append('short_des', ShortDes);
            formData.append('image_url', sliderImage);

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
                let res = await axios.post("/slider-create", formData, config);
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
