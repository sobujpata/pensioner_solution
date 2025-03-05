<style>
    .navbar .nav-link {

        /* font-size: 1rem; */
    }
    .nav-link{
        font-size: 16px !important;
        padding: 15px 9px 15px 9px !important;
        margin: 2px;
        border-radius: 5px;
        color:white;
        font-weight: bold !important;
        /* background-color: #CB0C9F; */
    }
    .navbar .nav-link:hover{
        border-bottom: 2px solid #CB0C9F;
        transition: 0.2s;
        background-color: #F3D9EC;
        color:black !important;
    }
    .dropdown-item:hover{
        border-bottom: 2px solid #CB0C9F;
        transition: 0.2s;
        background-color: #F3D9EC;
        color:black !important;
    }
    .dropdown-item{
        padding: 1rem 1rem !important;
        color: white;
    }


    @media only screen and (min-width: 600px) {
    .only-mobile {
        display: none;
    }
    .desktop-view{
        display: block;
    }

    }
    @media only screen and (max-width: 600px) {
    .only-mobile {
        display: block;
    }
    .registration{
        margin-top:80px !important;
    }
    .desktop-view{
        display: none;
    }
    }
    .text-black{
        color:black !important;
    }
</style>
<nav class="navbar navbar-dark bg-dark fixed-top only-mobile">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><img style="width: 9rem; height: 40px;" src="{{asset('users/images/ro_logo2.png')}}" alt="BAF RO" /></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title text-black" id="offcanvasDarkNavbarLabel"><img style="width: 9rem; height: 40px;" src="{{asset('users/images/ro_logo1.png')}}" alt="BAF RO" /></a></h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link active text-black" aria-current="page" href="{{url('/')}}">Home<span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-black" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Help
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item text-black" href="{{url('/about-jiggasha/ex-airmen')}}">Ex-Airmen & MODC (Air) Registration Process</a></li>
                <hr class="dropdown-divider">
                <li><a class="dropdown-item text-black" href="{{url('/about-jiggasha/employee')}}">Employers Registration Process</a></li>
              </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link text-black" href="{{url('/tutorial-videos')}}">Tutorial<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-black" href="{{url('/userLogin')}}">Login<span class="sr-only">(current)</span></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
</nav>


<nav class="desktop-view navbar navbar-expand-sm navbar-expand-md fixed-top shadow-lg" style="background:rgb(38 38 39 / 29%) !important; padding:0px;">
    <div class="container" style="padding: 0px;">
        <a class="navbar-brand navbar-desktop" href="{{url('/')}}">
            <img class="navbar-imgs" style="" src="{{asset('users/images/ro_logo1.png')}}" alt="BAF RO" />
        </a>
        <div class="collapse navbar-collapse" >
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('/')}}">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown1">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Help
                    </a>
                    <div class="dropdown-content1 bg-white" style="text-align:left;">
                      <a class="dropdown-item text-dark" href="{{url('/about-jiggasha/ex-airmen')}}">Ex-Airmen & MODC (Air) Registration Process</a>
                      <a class="dropdown-item text-dark" href="{{url('/about-jiggasha/employee')}}">Employers Registration Process</a>
                    </div>
                  </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('/tutorial-videos')}}">Tutorial<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('/userLogin')}}">Login<span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
