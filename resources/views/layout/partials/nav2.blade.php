<style>
    #toggole-icon{
        display: none;
    }
    #sideNavRef{
        display: none;
    }
    .nav-logo-user{
        width: auto;
        height: 50px;
        position: absolute;
    }
    .nav-bar-to a{
        font-size: 16px;
        padding: 8px;
        margin: 2px;
        border-radius: 5px;
    }
    .nav-bar-to a:hover{
        border-left: 4px solid #CB0C9F;
        transition: 0.2s;
        background-color: #F3D9EC;
    }
    li{
        list-style-type: none
    }
    @media screen and (max-width: 480px) {
        #toggole-icon{
            display: block;
        }
        #sideNavRef{
            display: block;
        }
        .nav-logo-user{
        width: auto;
        height: 50px;
        position: relative;
        }
        .nav-bar-to{
            display: none;
        }
    }
    @media screen and (max-width: 900px) {
        .nav-bar-to{
            font-size: 12px;
        }
    }
</style>
<nav class="navbar fixed-top px-0 shadow-sm bg-white">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <span id="toggole-icon" class="icon-nav m-0 h5" onclick="MenuBarClickHandler()">
                <img class="nav-logo-sm mx-2"  src="{{asset('images/menu.svg')}}" alt="logo"/>
            </span>
        </a>
        <img class="nav-logo-user  mx-2"  src="{{asset('users/images/ro_logo1.png')}}" alt="logo"/>
            <div class="nav-bar-to">
                <a href="" class="nav-bar">Home</a>
                <div class="user-dropdown1">
                    <a href="" class="nav-bar dropdown-toggle" >Message</a>
                    <div class="user-dropdown-content1">
                       <a class="side-bar-item" href="#">
                            <span class="side-bar-item-caption">COAS</span>
                       </a>
                        <hr class="user-dropdown-divider1"/>
                       <a class="side-bar-item" href="#">
                            <span class="side-bar-item-caption">ACOAS (A)</span>
                       </a>

                    </div>
                </div>
                <div class="user-dropdown1">
                    <a href="" class="nav-bar dropdown-toggle">Common Q&A</a>
                    <div class="user-dropdown-content1">
                       <a class="side-bar-item" href="#">
                            <span class="side-bar-item-caption">Common Info To All</span>
                       </a>
                        <hr class="user-dropdown-divider1"/>
                       <a class="side-bar-item" href="#">
                            <span class="side-bar-item-caption">Pension Releted Info</span>
                       </a>
                        <hr class="user-dropdown-divider1"/>
                       <a class="side-bar-item" href="#">
                            <span class="side-bar-item-caption">Welfare Releted Info</span>
                       </a>
                        <hr class="user-dropdown-divider1"/>
                       <a class="side-bar-item" href="#">
                            <span class="side-bar-item-caption">Pension Processing Steps</span>
                       </a>
                    </div>
                </div>

                <a href="" class="nav-bar">Form</a>
                <a href="" class="nav-bar">Pension Tracking</a>
                <div class="user-dropdown1">
                    <a href="" class="nav-bar dropdown-toggle">Circuler</a>
                    <div class="user-dropdown-content1">
                       <a class="side-bar-item" href="#">
                            <span class="side-bar-item-caption">Circuler From BAF RO</span>
                       </a>
                        <hr class="user-dropdown-divider1"/>
                       <a class="side-bar-item" href="#">
                            <span class="side-bar-item-caption">Circuler From Emloyers</span>
                       </a>
                        <hr class="user-dropdown-divider1"/>
                       <a class="side-bar-item" href="#">
                            <span class="side-bar-item-caption">Registerd Employers list</span>
                       </a>

                    </div>
                </div>
                <div class="user-dropdown1">
                    <a href="" class="nav-bar dropdown-toggle">Job Seeker</a>
                    <div class="user-dropdown-content1">
                       <a class="side-bar-item" href="#">
                            <span class="side-bar-item-caption">Apply Now</span>
                       </a>
                        <hr class="user-dropdown-divider1"/>
                       <a class="side-bar-item" href="#">
                            <span class="side-bar-item-caption">Job Seekers List</span>
                       </a>

                    </div>
                </div>
                <a href="" class="nav-bar">Online Q&A</a>
                <a href="" class="nav-bar">Suggession</a>
            </div>
        <div class="float-right h-auto d-flex">

            <div class="user-dropdown">
                <img class="icon-nav-img" src="{{asset('images/user.webp')}}" alt=""/>
                <div class="user-dropdown-content ">
                    <div class="mt-4 text-center">
                        <img class="icon-nav-img" src="{{asset('images/user.webp')}}" alt=""/>
                        <h6>User Name</h6>
                        <hr class="user-dropdown-divider  p-0"/>
                    </div>
                    <a href="{{url('/wp-admin/userProfile')}}" class="side-bar-item">
                        <span class="side-bar-item-caption">Profile</span>
                    </a>
                    <a href="{{url("/logout")}}" class="side-bar-item">
                        <span class="side-bar-item-caption">Logout</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
<div id="loader" class="LoadingOverlay d-none">
    <div class="Line-Progress">
        <div class="indeterminate"></div>
    </div>
</div>

<div id="sideNavRef" class="side-nav-open">
    <a href="" class="side-bar-item">
        <i class="bi bi-graph-up"></i>
        <span class="side-bar-item-caption">Dashboard</span>
    </a>
    <a href="#" class="side-bar-item">
        <i class="bi bi-people"></i>
        <span class="side-bar-item-caption">Users</span>
    </a>


</div>
<script>
    function MenuBarClickHandler() {
        let sideNav = document.getElementById('sideNavRef');
        let content = document.getElementById('contentRef');
        if (sideNav.classList.contains("side-nav-open")) {
            sideNav.classList.add("side-nav-close");
            sideNav.classList.remove("side-nav-open");
            // content.classList.add("content-expand");
            // content.classList.remove("content");
        } else {
            sideNav.classList.remove("side-nav-close");
            sideNav.classList.add("side-nav-open");
            // content.classList.remove("content-expand");
            // content.classList.add("content");
        }
    }
</script>
