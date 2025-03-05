<div class="container-fluid">
    <div class="row">
        <h4 class="text-center text-decoration-underline">Circuler Info</h4>
        <div class="align-items-center col mb-2">
            <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-start btn m-0  bg-gradient-primary">Create Circuler</button>
        </div>
    </div>
    <div class="row">
        <table class="table table-striped table-responsive" id="tableData" style="width: 100% !important;">
            <thead class="bg-dark text-white">
                <tr>
                    <th style="text-align:center;">Ser No</th>
                    <th style="">Publisher</th>
                    <th style="">Title</th>
                    <th style="">Description</th>
                    <th style="">Office Location</th>
                    <th style="">Area</th>
                    <th style="">Publish At</th>
                    <th style="">Status</th>
                    <th style="">Action</th>
                </tr>
            </thead>

            <tbody id="tableList">

            </tbody>
        </table>
    </div>
</div>

<script>
    const baseUrl = "{{ url('/storage') }}/"; //Correct way to get Laravel base URL
    getList();
    async function getList() {
        showLoader();
        let res = await axios.get(`/job-circuler-list`);
        hideLoader();

        let tableList = $("#tableList");
        let tableData = $("#tableData");

        if ($.fn.DataTable.isDataTable('#tableData')) {
            tableData.DataTable().destroy();
        }

        tableList.empty();

        res.data.data.forEach(function (item, index) {
            const fileUrl = `${baseUrl}${item['circuler_file']}`; // Construct file URL
            const createdAt = new Date(item.created_at);
            const formattedDate = createdAt.toLocaleString('en-GB', {
                timeZone: 'Asia/Dhaka',
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
            });

            let tr = `<tr>
                        <td align="center" style="vertical-align:middle;">${index + 1}</td>
                        <td align="left" style="vertical-align:middle;">${item['employer']['fname']}</td>
                        <td align="left" style="vertical-align:middle;">${item['job_title']}</td>
                        <td align="left" style="vertical-align:middle;">${item['description']}</td>
                        <td align="left" style="vertical-align:middle;">${item['office_location']}</td>
                        <td align="left" style="vertical-align:middle;">${item['area']}</td>
                        <td align="left" style="vertical-align:middle;">${formattedDate}</td>
                        <td align="left" style="vertical-align:middle;">
                            <button data-path="" data-id="${item['id']}" class="btn approvedBtn p-1
                                ${item['status'] === 1 ? 'btn-info' : ''}
                                ${item['status'] === 0 ? 'btn-success' : ''}">
                                ${item['status'] === 1 ? 'Published' : 'Not Published'}
                            </button>
                        </td>
                        <td align="center" style="vertical-align:middle;">
                            <button class="btn viewBtn btn-sm btn-outline-success">
                                <a href="${fileUrl}" target="_blank" style="text-decoration:none; color:inherit;">View</a>
                            </button>
                            <button data-path="${item['circuler_file']}" data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success">Edit</button>
                            <button data-path="${item['circuler_file']}" data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger">Delete</button>
                        </td>
                    </tr>`;

            tableList.append(tr);
        });

        $('.editBtn').on('click', async function () {
            let id = $(this).data('id');
            let filePath = $(this).data('path');
            await FillUpUpdateForm(id, filePath);
            $("#update-modal").modal('show');
        });

        $('.deleteBtn').on('click', function () {
            let id = $(this).data('id');
            let filePath = $(this).data('path');
            $("#delete-modal").modal('show');
            $("#deleteID").val(id);
            $("#deleteFilePath").val(filePath);
        });

        $('.approvedBtn').on('click', async function () {
            let id = $(this).data('id');
            $("#approve-modal").modal('show');
            $("#approveID").val(id);
        });

        new DataTable('#tableData', {
            order: [[0, 'asc']],
            lengthMenu: [10, 15, 20, 30, 50, 100]
        });
    }
</script>

