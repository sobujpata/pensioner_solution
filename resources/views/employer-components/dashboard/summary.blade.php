<div class="container-fluid">
    <div class="row">

        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 animated fadeIn p-2">
            <div class="card card-plain h-100 bg-white">
                <div class="p-3">
                    <div class="row">
                        <div class="col-9 col-lg-8 col-md-8 col-sm-9">
                            <div>
                                <h5 class="mb-0 text-capitalize font-weight-bold">
                                    <span id="aprovedUser"></span>
                                </h5>
                                <p class="mb-0 text-sm">Aproved User</p>
                            </div>
                        </div>
                        <div class="col-3 col-lg-4 col-md-4 col-sm-3 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow float-end border-radius-md text-center">
                                <i class="bi bi-people-fill"  style="font-size: 2rem; color: cornflowerblue; top:0px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>




<script>
    getList();
    async function getList() {
        // showLoader();
        // let res=await axios.get("/summary");

        // document.getElementById('aprovedUser').innerText=res.data['usersAproved']



        // hideLoader();
    }
</script>
