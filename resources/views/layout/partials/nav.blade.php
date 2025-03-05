<style>
    .nav-link{
        font-size: 16px;
        padding: 15px 9px 15px 9px !important;
        margin: 2px;
        border-radius: 5px;
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
    }
    nav{
        background:#2196F3 !important;
        margin-top: 40px; height: 60px;
    }
    @media only screen and (max-width: 768px) {
    .nav-navbg {
        height: 5rem;
    }
}
</style>
<nav class="navbar navbar-expand-md navbar-dark nav-navbg bg-green fixed-top" style="">
    <a class="navbar-brand" href="{{ url('/user-dashboard') }}">
      <img class="img-nam-practise" src="{{ asset('users/images/ro_logo1.png') }}" alt="BAF RO" />
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent" style="background:#2196F3 !important;">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link text-white" href="{{ url('/user-dashboard') }}">Home<span class="sr-only">(current)</span></a>
        </li>
        <div class="nav-item dropdown1 active">
          <a class="nav-link text-white dropdown-toggle" href="#" data-toggle="dropdown">Message</a>
          <div class="dropdown-content2" style="background:#2196F3; width:200px;">
            <a class="dropdown-item text-white" href="{{ url('/message/COAS') }}">COAS</a>
            <hr class="user-dropdown-divider1"/>
            <a class="dropdown-item text-white" href="{{ url('/message/ACOAS (A)') }}">ACAS (A)</a>
          </div>
        </div>

       <div class="nav-item dropdown1 active">
          <a class="nav-link text-white dropdown-toggle" href="#" data-toggle="dropdown">Common Q&A</a>
          <div class="dropdown-content2" style="background:#2196F3; width:200px;">
            <a class="dropdown-item text-white faq" id="1" href="{{ url('/faq-info/1') }}">Common Info To All</a>
            <hr class="user-dropdown-divider1"/>
            <a class="dropdown-item text-white faq" id="2" href="{{ url('/faq-info/2') }}">Pension Related Info</a>
            <hr class="user-dropdown-divider1"/>
            <a class="dropdown-item text-white faq" id="3" href="{{ url('/faq-info/3') }}">Welfare Related Info</a>
                <hr class="user-dropdown-divider1"/>
            <a class="dropdown-item text-white" href="{{url('/pension-steps')}}">Pension Processing Steps</a></li>
          </div>
        </div>

       <li class="nav-item dropdown active">
          <a class="nav-link text-white" href="{{url('/forms-info')}}">Forms<span class="sr-only">(current)</span></a>
        </li>

       <li class="nav-item dropdown active">
          <a class="nav-link text-white" href="/pension-traking">Pension Tracking<span class="sr-only">(current)</span></a>
        </li>

       <div class="nav-item dropdown1 active">
          <a class="nav-link text-white dropdown-toggle" href="#" data-toggle="dropdown">Circular</a>
          <div class="dropdown-content2" style="background:#2196F3; width:200px;">
            <a class="dropdown-item text-white" href="{{url('/circular-from-ro')}}">Circular From BAF RO</a>
             <hr class="user-dropdown-divider1"/>
            <a class="dropdown-item text-white" href="{{url('/circular-from-employers')}}">Circular From Emoloyers</a>
            <hr class="user-dropdown-divider1"/>
            <a class="dropdown-item text-white" href="{{url('/employers-list')}}">Registered Employers List</a>

          </div>
        </div>
          <div class="nav-item dropdown1 active">
          <a class="nav-link text-white dropdown-toggle" href="#" data-toggle="dropdown">Job Seeker</a>
          <div class="dropdown-content2" style="background:#2196F3">
            <a class="dropdown-item text-white" href="{{url('/job-application')}}">Apply Now</a>
            {{-- <hr class="user-dropdown-divider1"/>
            <a class="dropdown-item text-white" href="{{url('/job-sheekers')}}">Job Seekers List</a> --}}
          </div>
        </div>

        <li class="nav-item dropdown active">
          <a class="nav-link text-white" href="{{url('/conversation')}}">Online Q&A<span class="sr-only">(current)</span></a>
        </li>
        {{-- <li class="nav-item dropdown active">
          <a class="nav-link text-white" href="{{url('/voice-conversation')}}">Voice<span class="sr-only">(current)</span></a>
        </li> --}}
        <li class="nav-item dropdown active">
          <a class="nav-link text-white" href="{{url('/suggetions')}}">Suggestion<span class="sr-only">(current)</span></a>
        </li>

        <li class="nav-item active">
          <a class="nav-link text-white" href="{{ url('/logout-user') }}">Logout<span class="sr-only">(current)</span></a>
        </li>
      </ul>
    </div>
  </nav>

  <Script>
    /*scroll window  javascript*/
    $(window).scroll(function () {
    if ($(window).scrollTop() >= 50) {
        $('nav').css('background','white');
        $('nav').css('opacity','90%');
        $('nav').css('margin-top','0px');
        // $('#navbarSupportedContent').css('background','white');
        $('#navbarSupportedContent').css('opacity','white');
        $('.nav-link').css('color','#2196F3');
    } else {
        $('nav').css('background','#2196F3');
        $('nav').css('margin-top','40px');
        // $('#navbarSupportedContent').css('background','#2196F3');
        $('.nav-link').css('color','white');
        $('body').css('color','black');
    }
    });
</Script>
