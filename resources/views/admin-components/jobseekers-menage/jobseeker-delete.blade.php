<div class="modal animated zoomIn" id="delete-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3 class=" mt-3 text-warning">delete !</h3>
                <p class="mb-3">Do you want delete jobseeker?</p>
                <input class="d-none" id="deleteID"/>

            </div>
            <div class="modal-footer justify-content-end">
                <div>
                    <button type="button" id="delete-modal-close" class="btn bg-gradient-success mx-2" data-bs-dismiss="modal">Cancel</button>
                    <button onclick="itemdelete()" type="button" id="confirmdelete" class="btn bg-gradient-danger" >delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    async function deleteJobseeker(id){
        document.getElementById('deleteID').value=id;
    }
     async  function  itemdelete(){
            let id=document.getElementById('deleteID').value;
            document.getElementById('delete-modal-close').click();
            showLoader();
            let res=await axios.post("/delete-jobseeker",{id:id})
            hideLoader();
            console.log(res);
            if(res.data===1){
                successToast("jobseeker deleted Successfully.");
                await getList();
            }
            else{
                errorToast("Request fail!")
            }
     }
</script>
