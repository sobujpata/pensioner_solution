<div class="container px-0" style="margin-top: 80px">
    <h2 style="text-align: center;">
        <span style="padding: 5px 10px; background: #182d3f; color: white; border-radius: 5px;">Download Forms</span>
    </h2>
    </br>

    <table id="tableData" width="100%" class="table table-hover table-striped table-responsive">
        <thead class="table-dark">
            <tr>
                <th>S/No</th>
                <th>Form Name</th>
                <th>Uploaded On</th>
                <th>View</th>
            </tr>
        </thead>
        <tbody id="tableList">

        </tbody>
    </table>

</div>
<script>
    getList();

    async function getList() {

        showLoader();
        let res = await axios.get("/form-get");
        hideLoader();
        console.log(res);
        let tableList = $("#tableList");
        let tableData = $("#tableData");

        if ($.fn.DataTable.isDataTable('#tableData')) {
            tableData.DataTable().destroy();
        }

        tableList.empty();

        res.data.forEach(function(item, index) {
            let row = `<tr>
                        <td>${index + 1}</td>
                        <td align="left">${item['subject']}</td>
                        <td align="left">${item['published_on']}</td>
                        <td width="20%" align="center"><a href="${item['file_name']}" target="_blank"><i class="fa fa-file-pdf" style="font-size:28px;color:red"></i></a></td>

                    </tr>`;
            tableList.append(row);
        });

        new DataTable('#tableData', {
            order: [
                [0, 'asc']
            ],
            lengthMenu: [15, 20, 30, 100]
        });
    }
</script>
