<div class="container" style="margin-top: 80px">
    <h2 style="text-align: center;">
        <span style="padding: 5px 10px; border-radius: 5px;">Employe List</span>
    </h2>
    </br>
    <div class="row">
        <div class="col-lg-12 text-center">

            <table id="tableData" width="100%" class="table table-hover table-striped table-responsive">
                <thead class="table-dark">
                    <tr>
                        <th>S/No</th>
                        <th>Name</th>
                        <th>Organaization</th>
                        <th>Contact No</th>
                    </tr>
                </thead>
                <tbody id="tableList">

                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    getList();

    async function getList() {

        showLoader();
        let res = await axios.get("/employer-list-user");
        hideLoader();
        let tableList = $("#tableList");
        let tableData = $("#tableData");

        if ($.fn.DataTable.isDataTable('#tableData')) {
            tableData.DataTable().destroy();
        }

        tableList.empty();

        res.data.forEach(function(item, index) {
            let row = `<tr>
                        <td>${index + 1}</td>
                        <td align="left">${item['fname']}, ${item['designation']}</td>
                        <td align="left">${item['org_name']}</td>
                        <td align="left">${item['email']} <br> ${item['mobile']}</td>
                    </tr>`;
            tableList.append(row);
        });

        new DataTable('#tableData', {
            order: [
                [0, 'asc']
            ],
            lengthMenu: [10, 15, 20, 30]
        });
    }
</script>
