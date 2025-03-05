<div class="container" style="margin-top:80px;">
    <div class="row">
        <div class="col-12 text-decoration-underline">
            <h2>Circulars From Employee</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
		    <div class="form-group col-lg-12">
			    <table id="tableData" width="100%" class="table table-hover table-striped table-responsive">
                    <thead class="table-dark">
					    <tr>
                            <th>S/No</th>
                            <th>Job Title</th>
                            <th>Description</th>
                            <th>Published From</th>
                            <th>View</th>
                        </tr>
                    </thead>
                    <tbody id="tableList">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    const baseUrl = "{{ url('/storage') }}/"; //Correct way to get Laravel base URL
    getList();
    async function getList() {
        showLoader();
        let res = await axios.get(`/job-circuler-list-user`);
        hideLoader();
console.log(res.data)
        let tableList = $("#tableList");
        let tableData = $("#tableData");

        if ($.fn.DataTable.isDataTable('#tableData')) {
            tableData.DataTable().destroy();
        }

        tableList.empty();

        res.data.forEach(function (item, index) {
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
                        <td align="left" style="vertical-align:middle;">${item['job_title']}</td>
                        <td align="left" style="vertical-align:middle;">${item['description']}</td>
                        <td align="left" style="vertical-align:middle;">
                            ${item['employer']['designation']}
                            ${item['employer']['fname']}
                            ${item['employer']['org_name']}
                            ${item['employer']['email']}
                            ${item['employer']['mobile']}
                        </td>
                        <td align="left" style="vertical-align:middle;">
                            <a href="/storage/${item['circuler_file']}" target="_blank" class="btn btn-primary btn-sm">View</a>

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
