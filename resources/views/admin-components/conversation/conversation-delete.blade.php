<div class="modal animated zoomIn" id="delete-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3 class=" mt-3 text-warning">Delete !</h3>
                <p class="mb-3">Once delete, you can't get it back.</p>
                <input class="d-none" id="deleteID"/>
                <input class="d-none" id="deleteFilePath"/>
                <input class="d-none" id="deleteFilePath2"/>
                <input class="d-none" id="deleteFilePath3"/>
                <input class="d-none" id="deleteFilePath4"/>

            </div>
            <div class="modal-footer justify-content-end">
                <div>
                    <button type="button" id="delete-modal-close" class="btn bg-gradient-success mx-2" data-bs-dismiss="modal">Cancel</button>
                    <button onclick="itemDelete()" type="button" id="confirmDelete" class="btn bg-gradient-danger" >Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
     async  function  itemDelete(){
            let id=document.getElementById('deleteID').value;
            let deleteFilePath=document.getElementById('deleteFilePath').value;
            let deleteFilePath2=document.getElementById('deleteFilePath2').value;
            let deleteFilePath3=document.getElementById('deleteFilePath3').value;
            let deleteFilePath4=document.getElementById('deleteFilePath4').value;
            document.getElementById('delete-modal-close').click();
            showLoader();
            let res=await axios.post("/conversation-delete",{id:id, file_path:deleteFilePath,file_path2:deleteFilePath2,file_path3:deleteFilePath3,file_path4:deleteFilePath4})
            hideLoader();
            // console.log(res)
            if(res.data['status']==='success'){
                successToast(res.data['message'])
                await getList();
            }
            else{
                errorToast("Request fail!")
            }
     }
</script>
