<div class="container-fluid">
    <div class="row">
        <h4 class="text-center">Admin List</h4>
        <div class="align-items-center col mb-2">
            <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-start btn m-0  bg-gradient-primary">Create Admin</button>
        </div>
        <table class="table table-striped" id="tableData">
            <thead class="bg-dark text-white">
                <tr>
                    <th>Ser No</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Role</th>
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
        let res = await axios.get(`/admin-list`);
        hideLoader();
console.log(res)
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
                        <td align="left">${item['fname']}</td>
                        <td align="left">${item['email']}</td>
                        <td align="left">${item['mobile']}</td>
                        <td align="left">${item['role']}</td>
                        <td align="left">${formattedDate}</td>
                        <td align="left">
                            <button data-path="" data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success">Edit</button>
                            <button data-id="${item['id']}" class="btn passBtn btn-sm btn-outline-primary">Change Pass</button>
                            <button data-path="" data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger">Delete</button>
                        </td>
                    </tr>`;
            tableList.append(row);
        });

        $('.editBtn').on('click', async function () {
            let id= $(this).data('id');
            // console.log(id);
            await UpdateForm(id)
            $("#update-modal").modal('show');
        })

        $('.passBtn').on('click', async function () {
            let id= $(this).data('id');
            await UpdatePassForm(id)
            $("#pass-modal").modal('show');
        })

        $('.deleteBtn').on('click',function () {
            let id= $(this).data('id');
            $("#delete-modal").modal('show');
            $("#deleteID").val(id);

        })
        new DataTable('#tableData', {
            order: [[0, 'asc']],
            lengthMenu: [ 10, 15, 20, 30]
        });
        }

</script>
