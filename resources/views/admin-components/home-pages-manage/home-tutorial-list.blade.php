<div class="container-fluid">
    <div class="row">
        <h3 class="text-center">Tutorial Settings</h3>
        <!-- Progress Bar -->
        <div class="progress mt-2" style="height: 20px; display: none;">
            <div id="uploadProgress" class="progress-bar bg-success" style="width: 0%; height: 20px;"></div>
        </div>
        <div class="align-items-center col mb-2">
            <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-start btn m-0  bg-gradient-primary">Upload Tutorial</button>
        </div>
    </div>
    <div class="row">
        <table class="table table-striped table-responsive" id="tableData" style="width: 100% !important;">
            <thead class="bg-dark text-white">
                <tr>
                    <th style="text-align:center;">Ser No</th>
                    <th style="">Title</th>
                    <th style="">Vedio</th>
                    <th style="">Action</th>
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
        let res = await axios.get(`/home-page-tutorial`);
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
                        <td align="left" style="vertical-align:middle;">${item['title']}</td>
                        <td align="left" style="vertical-align:middle;">
                            <video class="tutorial_video transform_header w-50 rounded-2" controls>
                                <source src="${item['vedio_url']}" type="video/mp4">
                                <source src="movie.ogg" type="video/ogg">
                                Your browser does not support the video tag.
                            </video>
                            </td>
                        <td align="center" style="vertical-align:middle;">
                            <button data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success">Edit</button>
                            <button data-id="${item['id']}" data-path="${item['vedio_url']}" class="btn deleteBtn btn-sm btn-outline-danger">Delete</button>
                        </td>
                    </tr>`;
            tableList.append(tr);
        });
        $('.editBtn').on('click', async function () {
            let id= $(this).data('id');
            console.log(id)
           await FillUpUpdateForm(id)
           $("#update-modal").modal('show');
        })

        $('.deleteBtn').on('click',function () {
            let id= $(this).data('id');
            let vedio_url= $(this).data('path');
            $("#delete-modal").modal('show');
            $("#deleteID").val(id);
            $("#deletePath").val(vedio_url);

        })

        new DataTable('#tableData', {
            order: [[0, 'DESC']],
            columnDefs: [{ width: '10%', targets: 3 }],
            lengthMenu: [ 10, 30, 50, 100]
        });
        }

</script>
