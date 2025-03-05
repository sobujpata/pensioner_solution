<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Massage To <span id="pertircular"></span></h5>
            </div>
            <div class="modal-body">
                <div class="container-fluid m-0 p-0">
                    <div class="row m-0 p-0">
                        <div class="col-md-6 p-2">
                            <label>Respective Sec</label>
                            <select name="respectiveSec" id="respectiveSec" class="form-control form-select">

                            </select>
                        </div>
                        <div class="col-md-6 p-2">
                            <label>Description</label>
                            <input id="descriptionUpdate" placeholder="form description" class="form-control" type="text" value="">
                        </div>

                        <div class="col-md-6 p-2">
                            <label for="replyContentUpdate">Reply Content</label>
                            <textarea class="form-control form-textarea" id="replyContentUpdate" rows="3"></textarea>
                        </div>

                        <div class="col-md-6 p-2">
                            <label class="form-label">Image</label>
                            <input type="file" class="form-control" id="ImageUpdate">
                        </div>
                        <input name="id" type="text" class="d-none" id="updateID">
                        {{-- <input name="filePath" type="text" class="d-none" id="filePath"> --}}
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
    getSection()
    async function getSection(){
        let resSec = await axios.get('/section-distinct');
        resSec.data.data.forEach(function (item,i) {
            let option=`<option value="${item['section']}">${item['section']}</option>`
            $("#respectiveSec").append(option);
        })
    }


    async function FillUpUpdateForm(id,filePath){

        document.getElementById('updateID').value=id;

        showLoader();

        let res=await axios.post("/conversation-by-id",{id:id})
        hideLoader();
        document.getElementById('pertircular').innerHTML=res.data['user_id'];
        document.getElementById('respectiveSec').value=res.data['title'];
        document.getElementById('descriptionUpdate').value=res.data['content'];
        document.getElementById('replyContentUpdate').value=res.data['reply'];

    }

    async function update() {
        let respectiveSec = document.getElementById('respectiveSec').value;
        let descriptionUpdate = document.getElementById('descriptionUpdate').value;
        let replyContentUpdate = document.getElementById('replyContentUpdate').value;
        let updateID = document.getElementById('updateID').value;  // Corrected variable name
        let formImageUpdate = document.getElementById('ImageUpdate').files[0];


        // Validation checks
        if (respectiveSec.length === 0) {
            errorToast("Full Name Required!");
        } else {
            // Proceed with the update process
            let formData = new FormData();
            formData.append('id', updateID);
            formData.append('title', respectiveSec);
            formData.append('content', descriptionUpdate);
            formData.append('reply', replyContentUpdate);
            formData.append('reply_file', formImageUpdate);

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
                let res = await axios.post("/conversation-update-from-admin", formData, config);
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
