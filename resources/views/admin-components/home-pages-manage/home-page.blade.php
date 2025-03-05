<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <h2>Page Settings</h2>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 animated fadeIn p-2">
            <a href="{{ url('/slider-list') }}">
                <div class="card card-plain h-100 bg-white">
                    <div class="p-3">
                        <div class="row">
                            <div class="col-9 col-lg-8 col-md-8 col-sm-9">
                                <div>
                                    <h5 class="mb-0 text-capitalize font-weight-bold">
                                        {{-- <span id="aprovedUser"></span> --}}
                                    </h5>
                                    <h3 class="mb-0">Sliders</h3>
                                </div>
                            </div>
                            <div class="col-3 col-lg-4 col-md-4 col-sm-3 text-end">
                                <div
                                    class="icon icon-shape bg-gradient-primary shadow float-end border-radius-md text-center">
                                    <i class="bi bi-sliders"
                                        style="font-size: 2rem; color: cornflowerblue; top:0px;"></i>
                                    {{-- <i class="bi bi-house" style="font-size: 2rem; color: cornflowerblue; top:0px;"></i> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 animated fadeIn p-2">
            <a href="{{ url('/home-about-page') }}">
                <div class="card card-plain h-100 bg-white">
                    <div class="p-3">
                        <div class="row">
                            <div class="col-9 col-lg-8 col-md-8 col-sm-9">
                                <div>
                                    <h5 class="mb-0 text-capitalize font-weight-bold">
                                        {{-- <span id="NotapprovedUser"></span> --}}
                                    </h5>
                                    <h3 class="mb-0">About Home</h3>
                                </div>
                            </div>
                            <div class="col-3 col-lg-4 col-md-4 col-sm-3 text-end">
                                <div
                                    class="icon icon-shape bg-gradient-info shadow float-end border-radius-md text-center">
                                    <i class="bi bi-house"
                                        style="font-size: 2rem; color: rgb(44, 236, 60); top:0px;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 animated fadeIn p-2">
            <a href="{{ url('/home-help-page') }}">
                <div class="card card-plain h-100 bg-white">
                    <div class="p-3">
                        <div class="row">
                            <div class="col-9 col-lg-8 col-md-8 col-sm-9">
                                <div>
                                    <h5 class="mb-0 text-capitalize font-weight-bold">
                                        {{-- <span id="NotapprovedUser"></span> --}}
                                    </h5>
                                    <h3 class="mb-0">Help</h3>
                                </div>
                            </div>
                            <div class="col-3 col-lg-4 col-md-4 col-sm-3 text-end">
                                <div
                                    class="icon icon-shape bg-gradient-success shadow float-end border-radius-md text-center">
                                    <i class="bi bi-info-circle"
                                        style="font-size: 2rem; color: rgb(44, 165, 236); top:0px;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 animated fadeIn p-2">
            <a href="{{ url('/home-tutorial-page') }}">
                <div class="card card-plain h-100 bg-white">
                    <div class="p-3">
                        <div class="row">
                            <div class="col-9 col-lg-8 col-md-8 col-sm-9">
                                <div>
                                    <h5 class="mb-0 text-capitalize font-weight-bold">
                                        {{-- <span id="NotapprovedUser"></span> --}}
                                    </h5>
                                    <h3 class="mb-0">Tutorial</h3>
                                </div>
                            </div>
                            <div class="col-3 col-lg-4 col-md-4 col-sm-3 text-end">
                                <div
                                    class="icon icon-shape bg-gradient-secondary shadow float-end border-radius-md text-center">
                                    <i class="bi bi-youtube"
                                        style="font-size: 2rem; color: rgb(236, 44, 44); top:0px;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>



    </div>
</div>




<script>
    getList();
    async function getList() {
        showLoader();
        let res = await axios.get("/summary");

        // document.getElementById('aprovedUser').innerText=res.data['usersAproved']




        hideLoader();
    }
</script>
