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
                    <th style="">Particulars</th>
                    <th style="">Home District</th>
                    <th style="">Experience</th>
                    <th style="">Expected Location</th>
                    <th style="">Expected Job</th>
                    <th style="">CV View</th>
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
        let res = await axios.get(`/job-seekers-list`);
        hideLoader();
console.log(res)
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
                        <td align="left" style="vertical-align:middle;">
                            ${item['user']['rank']} ${item['user']['fname']}<br>
                            ${item['user']['email']}<br>
                            ${item['user']['mobile']}
                        </td>
                        <td align="left" style="vertical-align:middle;">
                            ${item['district']}
                        </td>
                        <td align="left" style="vertical-align:middle;">${item['experience']}</td>
                        <td align="left" style="vertical-align:middle;">${item['jobarea']}</td>
                        <td align="left" style="vertical-align:middle;">${item['jobchoice']}</td>
                        <td align="left" style="vertical-align:middle;">
                            <a href="/${item['resume']}" target="_blank" class="btn btn-primary btn-sm">View</a>
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
            order: [[0, 'desc']],
            lengthMenu: [20, 30, 50, 100]
        });
    }
</script>

