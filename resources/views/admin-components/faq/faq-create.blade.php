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
                            <label class="form-label">Category</label>
                            <select type="text" class="form-control form-select" id="FaqCategory">
                                <option value="">Select Category</option>
                            </select>
                        </div>
                        <div class="col-md-6 p-2">
                            <label>FAQ Name</label>
                            <input id="faqName" placeholder="FAQ Name" class="form-control" type="text" value=""/>
                        </div>
                        <div class="col-md-12 p-2">
                            <label>description</label>
                            <textarea id="description" placeholder="FAQ description" class="form-control" type="text" value="" rows="3"></textarea>
                        </div>
                        <div class="col-md-6 p-2">
                            <label>Resp Sec</label>
                            <input id="RespSecCreate" placeholder="User Resp Sec" class="form-control" type="Resp Sec"/>
                        </div>
                        <div class="col-md-2 p-2 ">
                            <img class="w-60" id="newImg" src="{{asset('images/default.jpg')}}"/>
                        </div>
                        <div class="col-md-4 p-2">
                            <label class="form-label">Image</label>
                            <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])" type="file" class="form-control" id="FaqImage">
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn bg-gradient-success" onclick="onFaqCreate()">Create</button>
            </div>
        </div>
    </div>
</div>

<script>

FillCategoryDropDown();

    async function FillCategoryDropDown(){
        let resCategory = await axios.get("/list-category")
        // console.log(resCategory)
        resCategory.data.forEach(function (item,i) {
            let option=`<option value="${item['id']}">${item['name']}</option>`
            $("#FaqCategory").append(option);
        })
    }
async function onFaqCreate() {
    let FaqCategory = document.getElementById('FaqCategory').value;
    let faqName = document.getElementById('faqName').value;
    let description = document.getElementById('description').value;
    let RespSecCreate = document.getElementById('RespSecCreate').value;
    let FaqImage = document.getElementById('FaqImage').files[0];

    // Validation checks
    if (FaqCategory.length === 0) {
        errorToast("Category is Required!");
    } else if (faqName.length === 0) {
        errorToast("Name is Required!");
    } else if (description.length === 0) {
        errorToast("Description is Required!");
    } else if (RespSecCreate.length === 0) {
        errorToast("Resp section Required!");
    } else if (!FaqImage) {
        errorToast("Image is Required!");
    } else {
        // Proceed with the Create process
        let formData = new FormData();
        formData.append('category_id', FaqCategory);
        formData.append('name', faqName);
        formData.append('description', description);
        formData.append('respective_section', RespSecCreate);
        formData.append('image_url', FaqImage);


        const config = {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        };

        // Hide modal
        const modalElement = document.getElementById('create-modal');
        const modalInstance = bootstrap.Modal.getInstance(modalElement);
        modalInstance.hide();

        showLoader();
        try {
            let res = await axios.post("/faq-create", formData, config);
            hideLoader();

            if (res.status === 200) {
                successToast('Created completed');
                document.getElementById("FaqCategory").value = "";
                document.getElementById("faqName").value = "";
                document.getElementById("description").value = "";
                document.getElementById("RespSecCreate").value = "";
                document.getElementById("FaqImage").value = "";
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
