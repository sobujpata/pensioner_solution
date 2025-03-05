<div class="container-fluid">
    <div class="row">
        <h3 class="text-center text-decoration-underline">Conversation Docu-IV</h3>

    </div>
    <div class="row">
        <table class="table table-striped table-responsive" id="tableData" style="width: 100% !important;">
            <thead class="bg-dark text-white text-bold">
                <tr>
                    <th style="text-align:center;">Ser No</th>
                    <th>Particuler</th>
                    <th>Respective Sec</th>
                    <th>To Massage</th>
                    <th>Created At</th>
                    <th>Reply Massage</th>
                    <th>Reply Dt</th>
                    <th>Replier</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody id="tableList">

            </tbody>
        </table>
    </div>
</div>

<script>
    getList();
    async function getList() {

        showLoader();
        let res = await axios.get(`/conversation-show-docu-IV`);
        hideLoader();
        // console.log(res);

        let tableList = $("#tableList");
        let tableData = $("#tableData");

        if ($.fn.DataTable.isDataTable('#tableData')) {
            tableData.DataTable().destroy();
        }

        tableList.empty();

        res.data.forEach(function (item, index) {
            const createdAt = new Date(item.created_at);
            const updatedAt = new Date(item.updated_at);
            const formattedDate = createdAt.toLocaleString('en-GB', {
                timeZone: 'Asia/Dhaka',
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',

            }); // '2024-10-10'
            const updatedAt1 = new Date(item.updated_at);
            const replyDate = updatedAt1.toLocaleString('en-GB', {
                timeZone: 'Asia/Dhaka',
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',

            }); // '2024-10-10'
            let tr = `<tr>
                        <td align="center" style="vertical-align:middle;">${index + 1}</td>
                        <td align="left" style="vertical-align:middle;">
                            BD/${item['user']['bdno']} <br>
                            ${item['user']['fname']}<br>
                            ${item['user']['mobile']}
                        </td>
                        <td align="left" style="vertical-align:middle;">${item['title']}</td>
                        <td align="left" style="vertical-align:middle;">

                            ${item['content'] === null ? '' : `
                            ${item['content']}<br>`}
                            ${item['filename'] === null ? '' : `
                            <img src="${item['filename']}" width="60px">`}
                            ${item['voic_send'] === null ? '' : `
                            <audio controls>
                                <source src="${item['voic_send']}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>`}
                        </td>
                        <td align="left" style="vertical-align:middle;">${formattedDate}</td>
                        <td align="left" style="vertical-align:middle;">
                            ${item['reply'] === null ? '' : `
                            ${item['reply']}<br>`}
                            ${item['reply_file'] === null ? '' : `
                            <img src="${item['reply_file']}" width="60px">`}
                            ${item['voic_reply'] === null ? '' : `
                            <audio controls>
                                <source src="${item['voic_reply']}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>`}
                        </td>
                        <td align="left" style="vertical-align:middle;">${replyDate}</td>
                        <td align="left" style="vertical-align:middle;">${item['reply_from']}</td>

                        <td align="center" style="vertical-align:middle;">
                            <button data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success">Text Reply</button>
                            <button data-id="${item['id']}" class="btn audioBtn btn-sm btn-outline-primary">Audio Reply</button>
                            <button data-path="${item['filename']}" data-path2="${item['voic_send']}" data-path3="${item['voic_reply']}" data-path4="${item['reply_file']}" data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger">Delete</button>
                        </td>
                    </tr>`;
            tableList.append(tr);
        });
        $('.editBtn').on('click', async function () {
            let id= $(this).data('id');
            // let filePath= $(this).data('path');
           await FillUpUpdateForm(id)
           $("#update-modal").modal('show');
        })

        $('.audioBtn').on('click', async function () {
            let id= $(this).data('id');
            // console.log(id)
           await FillUpAudioUpdateForm(id)
           $("#audio-modal").modal('show');
        })

        $('.deleteBtn').on('click',function () {
            let id= $(this).data('id');
            let filePath= $(this).data('path');
            let filePath2= $(this).data('path2');
            let filePath3= $(this).data('path3');
            let filePath4= $(this).data('path4');
            // console.log(filePath3);
            $("#delete-modal").modal('show');
            $("#deleteID").val(id);
            $("#deleteFilePath").val(filePath);
            $("#deleteFilePath2").val(filePath2);
            $("#deleteFilePath3").val(filePath3);
            $("#deleteFilePath4").val(filePath4);

        })

        new DataTable('#tableData', {
            order: [[0, 'DESC']],
            columnDefs: [{ width: '10%', targets: 3 }],
            lengthMenu: [ 10, 15, 20, 30, 50, 100]
        });
        }

</script>
