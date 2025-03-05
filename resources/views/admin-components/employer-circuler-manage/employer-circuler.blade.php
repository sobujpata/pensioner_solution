<div class="container-fluid">
    <div class="row">
        <h4 class="text-center">Employer Circulers</h4>
        {{-- <div class="align-items-center col mb-2">
            <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-start btn m-0  bg-gradient-primary">Create Notice</button>
        </div> --}}
    </div>
    <div class="row">
        <table class="table table-striped table-responsive" id="tableData" style="width: 100% !important;">
            <thead class="bg-dark text-white">
                <tr>
                    <th>Ser No</th>
                    <th>Org Name</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Emp Status</th>
                    <th>Admin Status</th>
                    <th>Created At</th>
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
        let res = await axios.get(`/employer-circuler-show`);
        hideLoader();

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
                        <td align="left" style="vertical-align:middle;">
                            ${item['employer']['fname']},
                            ${item['employer']['designation']},<br>
                            ${item['employer']['org_name']},<br>
                            ${item['office_location']},<br>
                            ${item['employer']['email']},<br>
                            ${item['employer']['mobile']},

                        </td>
                        <td align="left" style="vertical-align:middle;">${item['job_title']}</td>
                        <td align="left" style="vertical-align:middle; width:20% !important;">${item['description']}</td>
                        <td align="left" style="vertical-align:middle;">
                            <button data-id="${item['id']}" class="btn approvedBtnByAdmin p-1
                                ${item['status'] === 1 ? 'btn-info' : ''}
                                ${item['status'] === 0 ? 'btn-success' : ''}">
                                ${item['status'] === 1 ? 'Published' : 'Not Published'}
                            </button>
                        </td>
                        <td align="left" style="vertical-align:middle;">
                            <button data-id="${item['id']}" class="btn approvedBtnAdmin p-1
                                ${item['admin_status'] === 1 ? 'btn-info' : ''}
                                ${item['admin_status'] === 0 ? 'btn-success' : ''}">

                                ${item['admin_status'] === 1 ? 'Published' : 'Not Published'}
                            </button>
                        <td align="left" style="vertical-align:middle;">${formattedDate}</td>

                        <td align="center" style="vertical-align:middle;">
                            <button class="btn p-2 btn-outline-primary"><a href="./storage/${item['circuler_file']}" target="_blank"><i class="fa fa-eye fa-lg"></i></a></button>
                            <button data-path="${item['circuler_file']}" data-id="${item['id']}" class="btn p-2 editBtn btn-outline-success"><i class="fa fa-pen fa-lg"></i></button>
                            <button data-path="${item['circuler_file']}" data-id="${item['id']}" class="btn p-2 deleteBtn btn-outline-danger"><i class="fa fa-trash fa-lg"></i></button>
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
            // console.log(filePath);
            $("#delete-modal").modal('show');
            $("#deleteID").val(id);
            $("#deleteFilePath").val(filePath);

        })
        $('.approvedBtnByAdmin').on('click', async function () {
            let id = $(this).data('id');
            $("#approve-modal").modal('show');
            $("#approveIDByAdmin").val(id);
        });
        $('.approvedBtnAdmin').on('click', async function () {
            let id = $(this).data('id');
            $("#approve-admin-modal").modal('show');
            $("#approveIDAdmin").val(id);
        });

        new DataTable('#tableData', {
            order: [[0, 'asc']],
            columnDefs: [{ width: '10%', targets: 3 }],
            lengthMenu: [ 10, 15, 20, 30, 50, 100]
        });
        }

</script>
