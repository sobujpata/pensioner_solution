<div class="container-fluid">
    <div class="row">
        <h3 class="text-center text-decoration-underline">Pensioner Info</h3>
        <div class="align-items-center col mb-2">
            <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-start btn m-0  bg-gradient-primary">Add Pensioner</button>
        </div>
    </div>
    <div class="row">
        <table class="table table-striped table-responsive" id="tableData" style="width: 100% !important;">
            <thead class="bg-dark text-white">
                <tr>
                    <th style="width:2%; text-align:center;">Ser No</th>
                    <th>BD No</th>
                    <th>Rank</th>
                    <th style="width:10%">Name</th>
                    <th>Trade</th>
                    <th>Retd Type</th>
                    <th>Last Base/Unit</th>
                    <th>SOD</th>
                    <th>SOS</th>
                    <th>Status</th>
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
        let res = await axios.get(`/pensioner-show`);
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
            let tr = `<tr>
                        <td align="center" style="vertical-align:middle;">${index + 1}</td>
                        <td align="left" style="vertical-align:middle;">${item['bdno']}</td>
                        <td align="left" style="vertical-align:middle;">${item['rank']}</td>
                        <td align="left" style="vertical-align:middle;">${item['name']}</td>
                        <td align="left" style="vertical-align:middle;">${item['trade']}</td>
                        <td align="left" style="vertical-align:middle;">${item['retd_type']}</td>
                        <td align="left" style="vertical-align:middle;">${item['last_unit']}</td>
                        <td align="left" style="vertical-align:middle;">${item['sod']}</td>
                        <td align="left" style="vertical-align:middle;">${item['sos']}</td>
                        <td align="left" style="vertical-align:middle;">${item['status']}</td>
                        <td align="center" style="vertical-align:middle;">
                            <button data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success">Edit</button>
                            <button data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger">Delete</button>
                        </td>
                    </tr>`;
            tableList.append(tr);
        });
        $('.editBtn').on('click', async function () {
            let id= $(this).data('id');
           await FillUpUpdateForm(id)
           $("#update-modal").modal('show');
        })

        $('.deleteBtn').on('click',function () {
            let id= $(this).data('id');
            $("#delete-modal").modal('show');
            $("#deleteID").val(id);
        })

        new DataTable('#tableData', {
            order: [[0, 'asc']],
            columnDefs: [{ width: '10%', targets: 4 }],
            lengthMenu: [20, 30, 50, 100],
        });
        }

</script>
