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
                            <label class="form-label">Category</label>
                            <select type="text" class="form-control form-select" id="FaqCategoryUpdate">
                                <option value="">Select Category</option>
                            </select>
                        </div>
                        <div class="col-md-6 p-2">
                            <label>FAQ Name</label>
                            <input id="faqNameUpdate" placeholder="FAQ Name" class="form-control" type="text" value=""/>
                        </div>
                        <div class="col-md-12 p-2">
                            <label>description</label>
                            <textarea id="descriptionUpdate" placeholder="FAQ description" class="form-control" type="text" value="" rows="3"></textarea>
                        </div>
                        <div class="col-md-6 p-2">
                            <label>Resp Sec</label>
                            <input id="RespSecCreateUpdate" placeholder="User Resp Sec" class="form-control" type="Resp Sec"/>
                        </div>
                        <div class="col-md-2 p-2 ">
                            <img class="w-60" id="oldImg" src="{{asset('images/default.jpg')}}"/>
                        </div>
                        <div class="col-md-4 p-2">
                            <label class="form-label">Image</label>
                            <input oninput="oldImg.src=window.URL.createObjectURL(this.files[0])" type="file" class="form-control" id="FaqImageUpdate">
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



    FillCategoryDropDownUpdate();

    async function FillCategoryDropDownUpdate(){
        let res = await axios.get("/list-category")
        res.data.forEach(function (item,i) {
            let option=`<option value="${item['id']}">${item['name']}</option>`
            $("#FaqCategoryUpdate").append(option);
        })
    }


    async function FillUpUpdateForm(id,filePath){

        document.getElementById('updateID').value=id;
        document.getElementById('filePath').value=filePath;
        document.getElementById('oldImg').src=filePath;


        showLoader();

        let res=await axios.post("/faq-by-id",{id:id})
        hideLoader();

        document.getElementById('FaqCategoryUpdate').value=res.data['category_id'];
        document.getElementById('faqNameUpdate').value=res.data['name'];
        document.getElementById('descriptionUpdate').value=res.data['description'];
        document.getElementById('RespSecCreateUpdate').value=res.data['respective_section'];

    }

    async function update() {
        let FaqCategoryUpdate = document.getElementById('FaqCategoryUpdate').value;
        let descriptionUpdate = document.getElementById('descriptionUpdate').value;
        let faqNameUpdate = document.getElementById('faqNameUpdate').value;
        let RespSecCreateUpdate = document.getElementById('RespSecCreateUpdate').value;
        let updateID = document.getElementById('updateID').value;  // Corrected variable name
        let FaqImageUpdate = document.getElementById('FaqImageUpdate').files[0];


        // Validation checks
        if (FaqCategoryUpdate.length === 0) {
            errorToast("Full Name Required!");
        } else if (descriptionUpdate.length === 0) {
            errorToast("Description Required!");
        } else if (faqNameUpdate.length === 0) {
            errorToast("Name Required!");
        } else if (RespSecCreateUpdate.length === 0) {
            errorToast("Respective Section Required!");
        } else if (!FaqImageUpdate) {
            errorToast("Image is Required!");
        } else {
            // Proceed with the update process
            let formData = new FormData();
            formData.append('id', updateID);
            formData.append('category_id', FaqCategoryUpdate);
            formData.append('subject', descriptionUpdate);
            formData.append('name', faqNameUpdate);
            formData.append('respective_section', RespSecCreateUpdate);
            formData.append('image_url', FaqImageUpdate);

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
                let res = await axios.post("/faq-update", formData, config);
                console.log(res)
                hideLoader();

                if (res.status === 200) {
                    successToast('Update completed');

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
