<div class="container-fluid">
    <div class="row">
        <h4 class="text-center text-decoration-underline">Jobseeker List</h4>
        <table class="table table-striped" id="tableData">
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
    getList();
    async function getList() {

        showLoader();
        let res = await axios.get(`/jobseekers-list`);
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
            const formattedDate = createdAt.toLocaleString('en-GB', {
                timeZone: 'Asia/Dhaka',
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',

            }); // '2024-10-10'
            let row = `<tr>
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
                            <button data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-primary">Delete</button>
                        </td>
                    </tr>`;
            tableList.append(row);
        });
        $('.deleteBtn').on('click', async function () {
            let id= $(this).data('id');
            await deleteJobseeker(id)
            $("#delete-modal").modal('show');
        })

        new DataTable('#tableData', {
            order: [[0, 'desc']],
            lengthMenu: [20, 30, 50, 100]
        });
        }

</script>
