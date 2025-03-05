<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="text-center">Add New Pensioner Information</h3>
                <button type="button" class="btn-close text-black" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4"style="background-color:lavender; height: 20px;"></div>
                        <div class="col-md-4"style="background-color:lavenderblush; height: 20px;"></div>
                        <div class="col-md-4"style="background-color:lavender; height: 20px;" ></div>
                    </div>
                    <form action="" method="post">

                        <div class="row">

                            <div class="col-md-4" style="background-color:lavender;">

                                <div class="form-group">
                                    <label for="bdno"><b>Service No</b></label>
                                    <input type="text" id="bdno" value="" class="form-control" placeholder="Service No" style="width:61%; float:right;">
                                </div>
                                <div class="form-group">
                                    <label for="rank"><b>Rank</b></label>
                                    <select type="text" class="form-control form-select" id="rank_select" style="width:61%; float:right;">
                                        <option value="">Select Rank</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name"><b>Name</b></label>
                                    <input type="text" class="form-control" id="name"  placeholder="Enter Name" value=""style="width:61%; float:right;" >
                                </div>
                                <div class="form-group">
                                    <label for="trade"><b>Trade</b></label>
                                    <select id="trade_select" class="form-control form-select" style="width:61%; float:right;">
                                        <option value="">Select Trade</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="retd_type"><b>Type of Retd</b></label>
                                    <select id="retd_type_select" class="form-control form-select" style="width:61%; float:right;">
                                        <option value="">Select Retd Type</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="last_unit"><b>Last Unit</b></label>
                                    <input type="text" class="form-control" id="last_unit"  placeholder="Enter Last Unit" value=""style="width:61%; float:right;" >
                                </div>
                                <div class="form-group">
                                    <label for="dob"><b>DOB</b></label>
                                    <input type="date" class="form-control" id="dob" placeholder="Enter Date Of Birth" value=""style="width:61%; float:right;" >
                                </div>
                                <div class="form-group">
                                    <label for="nid"><b>NID Card</b></label>
                                    <input type="text" class="form-control" id="nid"  placeholder="Enter Nid Card" value=""style="width:61%; float:right;" >
                                </div>
                                <div class="form-group">
                                    <label for="mobile_no"><b>Mobile No</b></label>
                                    <input type="text" class="form-control" id="mobile_no"  placeholder="Enter Mobile No" value=""style="width:61%; float:right;" >
                                </div>
                                <div class="form-group">
                                    <label for="sod"><b>SOD</b></label>
                                    <input type="date" class="form-control" id="sod"  value=""style="width:61%; float:right;" >
                                </div>
                                <div class="form-group">
                                    <label for="sos"><b>SOS</b></label>
                                    <input type="date" class="form-control" id="sos" value=""style="width:61%; float:right;" >
                                </div>
                                <div class="form-group">
                                    <label for="reg_ser_no"><b>Reg Ser No</b></label>
                                    <input type="text" class="form-control" id="reg_ser_no" value=""style="width:61%; float:right;">
                                </div>
                            </div>
                            <div class="col-md-4" style="background-color:lavenderblush;">

                                <div class="form-group">
                                    <label for="subs_dspf"><b>Sub for DSPF</b></label>
                                    <input type="date" class="form-control" id="subs_dspf" value=""style="width:61%; float:right;">
                                </div>
                                <div class="form-group">
                                    <label for="sub_dspf_amount"><b>DSPF Sub Amount</b></label>
                                    <input type="text" class="form-control" id="sub_dspf_amount" value=""style="width:61%; float:right;">
                                </div>
                                <div class="form-group">
                                    <label for="dsp_cheque"><b>DSPF Cheque Rec Dt</b></label>
                                    <input type="date" class="form-control" id="dsp_cheque" value=""style="width:61%; float:right;">
                                </div>
                                <div class="form-group">
                                    <label for="rec_dspf_amount"><b>DSPF Rec Amount</b></label>
                                    <input type="text" class="form-control" id="rec_dspf_amount" value=""style="width:61%; float:right;">
                                </div>
                                <div class="form-group">
                                    <label for="sub_lump"><b>Sub for LUMP</b></label>
                                    <input type="date" class="form-control" id="sub_lump" value=""style="width:61%; float:right;">
                                </div>
                                <div class="form-group">
                                    <label for="sub_lump_amount"><b>LUMP Sub Amount</b></label>
                                    <input type="text" class="form-control" id="sub_lump_amount" value=""style="width:61%; float:right;">
                                </div>
                                <div class="form-group">
                                    <label for="lump_cheque"><b>LUMP Cheque Rec Dt</b></label>
                                    <input type="date" class="form-control" id="lump_cheque" value=""style="width:61%; float:right;">
                                </div>
                                <div class="form-group">
                                    <label for="rec_lump_amount"><b>LUMP Rec Amount</b></label>
                                    <input type="text" class="form-control" id="rec_lump_amount" value=""style="width:61%; float:right;">
                                </div>
                                <div class="form-group">
                                    <label for="cmb"><b>Med Docu Sent To CMB</b></label>
                                    <input type="date" class="form-control" id="cmb" value=""style="width:61%; float:right;">
                                </div>
                                <div class="form-group">
                                    <label for="rec"><b>Med Docu Rec From CMB</b></label>
                                    <input type="date" class="form-control" id="rec" value=""style="width:61%; float:right;">
                                </div>
                                <div class="form-group">
                                    <label for="rec_from_sfc"><b>Docu Rec From SFC</b></label>
                                    <input type="date" class="form-control" id="rec_from_sfc" value=""style="width:61%; float:right;">
                                </div>
                                <div class="form-group">
                                    <label for="sent_for_lpc"><b>Docu Sent For LPC</b></label>
                                    <input type="date" class="form-control" id="sent_for_lpc" value=""style="width:61%; float:right;">
                                </div>
                            </div>
                            <div class="col-md-4" style="background-color:lavender;"class="form-control">


                                <div class="form-group">
                                    <label for="lpc_rcvd"><b>LPC Rec From SFC</b></label>
                                    <input type="date" class="form-control" id="lpc_rcvd" value=""style="width:61%; float:right;">
                                </div>
                                <div class="form-group">
                                    <label for="assesment_ready"><b>Assesment Ready</b></label>
                                    <input type="date" class="form-control" id="assesment_ready" value=""style="width:61%; float:right;">
                                </div>
                                <div class="form-group">
                                    <label for="assesment_sfc_audit"><b>Sent To SFC Audit</b></label>
                                    <input type="date" class="form-control" id="assesment_sfc_audit" value=""style="width:61%; float:right;">
                                </div>
                                <div class="form-group">
                                    <label for="audit_rcvd"><b>Audit Rec From SFC</b></label>
                                    <input type="date" class="form-control" id="audit_rcvd" value=""style="width:61%; float:right;">
                                </div>
                                <div class="form-group">
                                    <label for="senc_sent_dtefin"><b>Sanc Sent To D Fin</b></label>
                                    <input type="date" class="form-control" id="senc_sent_dtefin" value=""style="width:61%; float:right;">
                                </div>
                                <div class="form-group">
                                    <label for="senc_rcvd_dtefin"><b>Sanc Rec From D Fin</b></label>
                                    <input type="date" class="form-control" id="senc_rcvd_dtefin" value=""style="width:61%; float:right;">
                                </div>
                                <div class="form-group">
                                    <label for="commbill_to_sfc"><b>Commu Bill Sub to SFC</b></label>
                                    <input type="date" class="form-control" id="commbill_to_sfc" value=""style="width:61%; float:right;">
                                </div>
                                <div class="form-group">
                                    <label for="comm_amount_sent"><b>Commu Amount Sent</b></label>
                                    <input type="text" class="form-control" id="comm_amount_sent" value=""style="width:61%; float:right;">
                                </div>
                                <div class="form-group">
                                    <label for="cheque_rcvd"><b>Cheque Rec From SFC</b></label>
                                    <input type="date" class="form-control" id="cheque_rcvd" value=""style="width:61%; float:right;">
                                </div>
                                <div class="form-group">
                                    <label for="comm_amount"><b>Commu Amount Rec</b></label>
                                    <input type="text" class="form-control" id="comm_amount" value=""style="width:61%; float:right;">
                                </div>
                                <div class="form-group">
                                    <label for="status"><b>Pension Status</b></label>
                                    <select name="status" id="status" class="form-control form-select" style="width:61%; float:right;">

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="remarks"><b>Remarks</b></label>
                                    <textarea type="text" class="form-control" rows="2" id="remarks" value=""style="width:61%; float:right;"></textarea>
                                </div>


                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn bg-gradient-success" onclick="save()">Create</button>
            </div>
        </div>
    </div>
</div>

<script>

    FillCategoryDropDown();

    async function FillCategoryDropDown(){
        try {
        let res = await axios.get("/rank");
        hideLoader();
        // console.log(res);
        if (res.status === 200 && res.data['status'] === 'success') {
            let data = res.data['data'];

            // Get the select element
            let select = document.getElementById('rank_select');


            // Clear any existing options (optional, if you plan to refill it)
            select.innerHTML = '<option selected>Select Rank</option>';

            // Loop through the data and create an option for each person_type
            data.forEach(function (rank) {
                let option = document.createElement('option');
                option.value = rank; // Assuming rank is the value
                option.text = rank;  // Display rank as the text
                select.appendChild(option);
            });
        } else {
            errorToast(res.data['message']);
        }
        } catch (error) {
            hideLoader();
            errorToast('An error occurred while fetching data');
            console.error(error);
        }

        try {
        let res = await axios.get("/trade");
        hideLoader();
        // console.log(res);
        if (res.status === 200 && res.data['status'] === 'success') {
            let data = res.data['data'];

            // Get the select element
            let select = document.getElementById('trade_select');


            // Clear any existing options (optional, if you plan to refill it)
            select.innerHTML = '<option selected>Select trade</option>';

            // Loop through the data and create an option for each person_type
            data.forEach(function (trade) {
                let option = document.createElement('option');
                option.value = trade; // Assuming trade is the value
                option.text = trade;  // Display trade as the text
                select.appendChild(option);
            });
        } else {
            errorToast(res.data['message']);
        }
        } catch (error) {
            hideLoader();
            errorToast('An error occurred while fetching data');
            console.error(error);
        }
        try {
        let res = await axios.get("/retd-type");
        hideLoader();
        // console.log(res);
        if (res.status === 200 && res.data['status'] === 'success') {
            let data = res.data['data'];

            // Get the select element
            let select = document.getElementById('retd_type_select');


            // Clear any existing options (optional, if you plan to refill it)
            select.innerHTML = '<option selected>Select Retd Type</option>';

            // Loop through the data and create an option for each person_type
            data.forEach(function (retd_type) {
                let option = document.createElement('option');
                option.value = retd_type; // Assuming retd_type is the value
                option.text = retd_type;  // Display retd_type as the text
                select.appendChild(option);
            });
        } else {
            errorToast(res.data['message']);
        }
        } catch (error) {
            hideLoader();
            errorToast('An error occurred while fetching data');
            console.error(error);
        }
        try {
        let res = await axios.get("/pension-status");
        hideLoader();
        // console.log(res);
        if (res.status === 200 && res.data['status'] === 'success') {
            let data = res.data['data'];

            // Get the select element
            let select = document.getElementById('status');


            // Clear any existing options (optional, if you plan to refill it)
            // select.innerHTML = '<option selected>Select Status</option>';

            // Loop through the data and create an option for each person_type
            data.forEach(function (status) {
                let option = document.createElement('option');
                option.value = status; // Assuming status is the value
                option.text = status;  // Display status as the text
                select.appendChild(option);
            });
        } else {
            errorToast(res.data['message']);
        }
        } catch (error) {
            hideLoader();
            errorToast('An error occurred while fetching data');
            console.error(error);
        }


    }
async function save() {
    let bdno = document.getElementById('bdno').value;
    let rank = document.getElementById('rank_select').value;
    let name = document.getElementById('name').value;
    let trade_select = document.getElementById('trade_select').value;
    let retd_type_select = document.getElementById('retd_type_select').value;
    let last_unit = document.getElementById('last_unit').value;
    let dob = document.getElementById('dob').value;
    let nid = document.getElementById('nid').value;
    let mobile_no = document.getElementById('mobile_no').value;
    let sod = document.getElementById('sod').value;
    let sos = document.getElementById('sos').value;
    let reg_ser_no = document.getElementById('reg_ser_no').value;

    let subs_dspf = document.getElementById('subs_dspf').value;
    let sub_dspf_amount = document.getElementById('sub_dspf_amount').value;
    let dsp_cheque = document.getElementById('dsp_cheque').value;
    let rec_dspf_amount = document.getElementById('rec_dspf_amount').value;
    let sub_lump = document.getElementById('sub_lump').value;
    let sub_lump_amount = document.getElementById('sub_lump_amount').value;
    let lump_cheque = document.getElementById('lump_cheque').value;
    let rec_lump_amount = document.getElementById('rec_lump_amount').value;
    let cmb = document.getElementById('cmb').value;
    let rec = document.getElementById('rec').value;
    let rec_from_sfc = document.getElementById('rec_from_sfc').value;
    let sent_for_lpc = document.getElementById('sent_for_lpc').value;

    let lpc_rcvd = document.getElementById('lpc_rcvd').value;
    let assesment_ready = document.getElementById('assesment_ready').value;
    let assesment_sfc_audit = document.getElementById('assesment_sfc_audit').value;
    let audit_rcvd = document.getElementById('audit_rcvd').value;
    let senc_sent_dtefin = document.getElementById('senc_sent_dtefin').value;
    let senc_rcvd_dtefin = document.getElementById('senc_rcvd_dtefin').value;
    let commbill_to_sfc = document.getElementById('commbill_to_sfc').value;
    let comm_amount_sent = document.getElementById('comm_amount_sent').value;
    let cheque_rcvd = document.getElementById('cheque_rcvd').value;
    let comm_amount = document.getElementById('comm_amount').value;
    let status = document.getElementById('status').value;
    let remarks = document.getElementById('remarks').value;

    // Validation checks
    if (bdno.length === 0) {
        errorToast("Category is Required!");
    } else if (rank.length === 0) {
        errorToast("id is Required!");
    } else if (name.length === 0) {
        errorToast("Name is Required!");
    } else if (trade_select.length === 0) {
        errorToast("Resp section Required!");
    }
    else if (retd_type_select.length===0) {
        errorToast("Retd Type is Required!");
    }
    else if (last_unit.length===0) {
        errorToast("Last Base/Unit is Required!");
    }
    else if (dob.length===0) {
        errorToast("DOB is Required!");
    }
    else if (nid.length===0) {
        errorToast("NID No is Required!");
    }
    else if (mobile_no.length===0) {
        errorToast("Mobile No is Required!");
    }
    else {
        // Proceed with the Create process
        let formData = new FormData();
        formData.append('bdno', bdno);
        formData.append('rank', rank);
        formData.append('name', name);
        formData.append('trade', trade_select);
        formData.append('retd_type', retd_type_select);
        formData.append('last_unit', last_unit);
        formData.append('dob', dob);
        formData.append('nid', nid);
        formData.append('mobile_no', mobile_no);
        formData.append('sod', sod);
        formData.append('sos', sos);

        formData.append('reg_ser_no', reg_ser_no);
        formData.append('subs_dspf', subs_dspf);
        formData.append('sub_dspf_amount', sub_dspf_amount);
        formData.append('dsp_cheque', dsp_cheque);
        formData.append('rec_dspf_amount', rec_dspf_amount);
        formData.append('sub_lump', sub_lump);
        formData.append('sub_lump_amount', sub_lump_amount);
        formData.append('lump_cheque', lump_cheque);
        formData.append('rec_lump_amount', rec_lump_amount);
        formData.append('cmb', cmb);
        formData.append('rec', rec);

        formData.append('rec_from_sfc', rec_from_sfc);
        formData.append('sent_for_lpc', sent_for_lpc);
        formData.append('lpc_rcvd', lpc_rcvd);
        formData.append('assesment_ready', assesment_ready);
        formData.append('assesment_sfc_audit', assesment_sfc_audit);
        formData.append('audit_rcvd', audit_rcvd);
        formData.append('senc_sent_dtefin', senc_sent_dtefin);
        formData.append('senc_rcvd_dtefin', senc_rcvd_dtefin);
        formData.append('commbill_to_sfc', commbill_to_sfc);
        formData.append('comm_amount_sent', comm_amount_sent);
        formData.append('cheque_rcvd', cheque_rcvd);
        formData.append('comm_amount', comm_amount);
        formData.append('status', status);
        formData.append('remarks', remarks);

// console.log([...formData.entries()]);
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
            let res = await axios.post("/pensioner-create", formData, config);
            hideLoader();
console.log(res);
            if (res.status === 200) {
                successToast('Pensioner Created completed');
                await getList();
            } else {
                errorToast("Create failed!");
                errorToast(res.data.message || "Failed to create pensioner!");
                errorToast(res.data.pensioner || "Failed to create pensioner!");
            }
        } catch (error) {
            hideLoader();
            console.error("Error:", error);
            errorToast("Create failed!");
        }
    }
}
</script>
