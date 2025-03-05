<div class="container-fluid">
    <div class="row">
        <h3 class="text-center">Home Page About Settings</h3>
        <div class="align-items-center col mb-2">
            <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-start btn m-0  bg-gradient-primary">Create Home Page About</button>
        </div>
    </div>
    <div class="row">
        <table class="table table-striped table-responsive" id="tableData" style="width: 100% !important;">
            <thead class="bg-dark text-white">
                <tr>
                    <th style="width:3%; text-align:center;">Ser No</th>
                    <th style="width:10%">Title</th>
                    <th style="width:10%">Description</th>
                    <th style="width:5%">View Image</th>
                    <th style="width:10%">Action</th>
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
        let res = await axios.get(`/home-page-about`);
        hideLoader();
        console.log(res);

        let tableList = $("#tableList");
        let tableData = $("#tableData");

        if ($.fn.DataTable.isDataTable('#tableData')) {
            tableData.DataTable().destroy();
        }

        tableList.empty();

        res.data.forEach(function (item, index) {
            const createdAt = new Date(item.created_at);
            const formattedDate = createdAt.toLocaleString('en-GB', {
                timeZone: 'Asia/Dhaka',
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',

            }); // '2024-10-10'
            let tr = `<tr>
                        <td align="center" style="vertical-align:middle;">${index + 1}</td>
                        <td align="left" style="vertical-align:middle;">${item['title']}</td>
                        <td align="left" style="vertical-align:middle;">${item['short_des']}</td>

                        <td align="left" style="vertical-align:middle;">
                            <a href="${item['image']}" target="_blank" class="">
                                <img src="${item['image']}" style="width:300px; border-radius:5px;">
                            </a>
                        </td>

                        <td align="center" style="vertical-align:middle;">
                            <button data-path="${item['image']}" data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success">Edit</button>
                            <button data-path="${item['image']}" data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger">Delete</button>
                        </td>
                    </tr>`;
            tableList.append(tr);
        });
        $('.editBtn').on('click', async function () {
            let id= $(this).data('id');
            let filePath= $(this).data('path');
           await FillUpUpdateForm(id,filePath)
           $("#update-modal").modal('show');
        })

        $('.deleteBtn').on('click',function () {
            let id= $(this).data('id');
            let filePath= $(this).data('path');
            $("#delete-modal").modal('show');
            $("#deleteID").val(id);
            $("#deleteFilePath").val(filePath);

        })

        new DataTable('#tableData', {
            order: [[0, 'DESC']],
            columnDefs: [{ width: '10%', targets: 3 }],
            lengthMenu: [ 10, 15, 20, 30, 50, 100]
        });
        }

</script>
