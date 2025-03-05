<style>
    body {
        font: 14px sans-serif;
    }

    .wrapper {
        width: 360px;
        padding: 20px;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    input.form-control {
        padding: 14px;
    }
    .password-wrapper {
        position: relative;
        /* display: inline-block; */
    }
    .toggle-icon {
        position: absolute;
        right: 18px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
    }
</style>

<body style="background-color:#f0f2f5;">
    <div class="container text-center pt-md-6  registration">
        <div class="row align-items-center pt-md-5">
            <div class="log-logo col-md-7">
                <?php

                ?>
                <h3 class="ex-login-header text-uppercase">Employer RESET PASSWORD</h3>
                <h5 class="ex-login-header2">BAF RECORD OFFICE</h5>

                <span id='alertMessage'></span>
                <hr>
                <br>
                <img class="login_logo" src="{{ asset('users/images/ro.png') }}" alt="BAF logo">
                <p align="center" class="about-brand"style="font-family:Arial, Helvetica, sans-serif"
                    style="font-size:12px">PENSIONER SOLUTION BAF RO</p>

            </div>

            <div class="col-md-5 P-6">
                {{-- Start login form --}}
                <div class="card px-3">
                    <h4 style="font-weight: bold">EMAIL VERIFICATON</h4>
                    <br>
                    <label style="text-align: left;">Your email address</label>
                    <input id="email" placeholder="Email Address" class="form-control" type="email"/>
                    <br/>
                    <button onclick="VerifyEmail()"  class="btn w-100 float-end bg-gradient-primary">Submit</button>
                    <hr>
                    <button class="btn btn-info w-50 justify-center" style="margin: auto;"><a href="{{url('/employer-login')}}">Login</a></button>
                    <p class="pt-3">Or</p>
                    <button class="btn btn-success w-50" style="margin: auto;"><a href="{{url('/employerRegistration')}}">Sign Up</a></button>
                    <br>
                </div>


                {{-- End login form --}}

            </div>
        </div>
    </div>

<br>

<script>
   async function VerifyEmail() {
        let email = document.getElementById('email').value;
        if(email.length === 0){
           errorToast('Please enter your email address')
        }
        else{
            showLoader();
            let res = await axios.post('/send-otp-employer', {email: email});
            hideLoader();
            if(res.status===200 && res.data['status']==='success'){
                successToast(res.data['message'])
                sessionStorage.setItem('email', email);
                setTimeout(function (){
                    window.location.href = '/verifyOtp-employer';
                }, 1000)
            }
            else{
                errorToast(res.data['message'])
            }
        }

    }
</script>
