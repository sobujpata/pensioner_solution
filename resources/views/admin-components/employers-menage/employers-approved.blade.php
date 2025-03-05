<div class="modal animated zoomIn" id="approve-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3 class=" mt-3 text-warning">Approve !</h3>
                <p class="mb-3">Do you want approve employer?</p>
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
            document.getElementById('approve-modal-close').click();
            showLoader();
            let res=await axios.post("/approve-employer",{id:id})
            hideLoader();
            // console.log(res);
            if(res.data['status']==='success'){
                successToast("Employer Approved and Mail Sent to Employer Successfully.");
                await getList();
            }
            else{
                errorToast("Request fail!")
            }
     }
</script>
