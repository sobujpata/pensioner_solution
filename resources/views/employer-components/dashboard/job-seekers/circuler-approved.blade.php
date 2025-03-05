<div class="modal animated zoomIn" id="approve-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3 class=" mt-3 text-warning">Circuler Status !</h3>
                <p class="mb-3">Do you want to circuler status Update?</p>
                <select name="statusUpdate" id="statusUpdate" class="form-control form-select">
                    <option value="1">Published</option>
                    <option value="0">Not Published</option>
                </select>
                <input class="d-none" id="approveID"/>

            </div>
            <div class="modal-footer justify-content-end">
                <div>
                    <button type="button" id="approve-modal-close" class="btn bg-gradient-success mx-2" data-bs-dismiss="modal">Cancel</button>
                    <button onclick="itemapprove()" type="button" id="confirmapprove" class="btn bg-gradient-danger" >approve</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
     async  function  itemapprove(){
            let id=document.getElementById('approveID').value;
            let statusUpdate=document.getElementById('statusUpdate').value;

            document.getElementById('approve-modal-close').click();
            showLoader();
            let res=await axios.post("/circuler-status",{id:id,status:statusUpdate})
            hideLoader();
            console.log(res);
            if(res.data['status']==='success'){
                successToast("Circuler Status Updated Successfully.");
                await getList();
            }
            else{
                errorToast("Request fail!")
            }
     }
</script>
