<div class="container-fluid">
    <div class="row">
        <h4 class="text-center">Users List</h4>
        <table class="table table-striped" id="tableData">
            <thead class="bg-dark text-white">
                <tr>
                    <th>Ser No</th>
                    <th>Image</th>
                    <th>BD No</th>
                    <th>Name</th>
                    <th>Trade</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Status</th>
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
        let res = await axios.get(`/user-list`);
        hideLoader();
        let tableList = $("#tableList");
        let tableData = $("#tableData");

        if ($.fn.DataTable.isDataTable('#tableData')) {
            tableData.DataTable().destroy();
        }

        tableList.empty();

        res.data.data.forEach(function (item, index) {
            const createdAt = new Date(item.created_at);
            const formattedDate = createdAt.toLocaleString('en-GB', {
                timeZone: 'Asia/Dhaka',
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',

            }); // '2024-10-10'
            let row = `<tr>
                        <td>${index + 1}</td>
                        <td align="left"><img style="width:60px !important;" src="${item['profile_image']}" alt="${item['fname']}" class="img rounded-2"> </td>
                        <td align="left">${item['bdno']}</td>
                        <td align="left">${item['rank']} ${item['fname']}</td>
                        <td align="left">${item['trade']}</td>
                        <td align="left">${item['email']}</td>
                        <td align="left">${item['mobile']}</td>
                        <td align="left">
                            <button data-path="" data-id="${item['id']}" class="btn approvedBtn p-1
                                ${item['status'] === '1'?'btn-info':''}
                                ${item['status'] === '0'?'btn-success':''}
                                ${item['status'] === '2'?'btn-danger':''}
                            ">
                                ${item['status'] === '1'?'Approved':''}
                                ${item['status'] === '0'?'Not Approved':''}
                                ${item['status'] === '2'?'Rejected':''}
                            </button>
                        </td>
                        <td align="left">${formattedDate}</td>
                        <td align="left">
                            <button data-path="" data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success">Edit</button>
                            <button data-id="${item['id']}" class="btn passBtn btn-sm btn-outline-info">Change Pass</button>
                            <button data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-primary">Delete</button>
                        </td>
                    </tr>`;
            tableList.append(row);
        });
        $('.editBtn').on('click', async function () {
            let id= $(this).data('id');
            await UpdateForm(id)
            $("#update-modal").modal('show');
        })
        $('.passBtn').on('click', async function () {
            let id= $(this).data('id');
            await UpdatePassForm(id)
            $("#pass-modal").modal('show');
        })
        $('.deleteBtn').on('click', async function () {
            let id= $(this).data('id');
            await DeleteUser(id)
            $("#delete-modal").modal('show');
        })
        $('.approvedBtn').on('click', async function () {
            let id= $(this).data('id');
            $("#approve-modal").modal('show');
            $("#approveID").val(id);
        })

        new DataTable('#tableData', {
            order: [[0, 'desc']],
            lengthMenu: [ 20, 30, 50, 100]
        });
        }

</script>
