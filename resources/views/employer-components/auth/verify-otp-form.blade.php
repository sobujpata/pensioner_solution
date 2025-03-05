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
    <div class="container text-center pt-md-6 registration">
        <div class="row align-items-center pt-md-5">
            <div class="log-logo col-md-7">

                <h3 class="text-center" style="color:#007bff;">Employer VERIFY</h3>
                <h5 class="text-center" style="color:#007bff;">BAF RECORD OFFICE</h5>

                <span id='alertMessage'></span>
                <hr>
                <br>
                <img class="login_logo" src="{{ asset('users/images/ro.png') }}" alt="BAF logo">
                <p align="center" class="about-brand"style="font-family:Arial, Helvetica, sans-serif"
                    style="font-size:12px">PENSIONER SOLUTION BAF RO</p>

            </div>

            <div class="col-md-5">
                {{-- Start login form --}}
                <div class="card px-3 py-4">
                    <h4>ENTER OTP CODE</h4>
                    <br/>
                    <label style="text-align: left;">6 Digit Code Here</label>
                    <input id="otp" placeholder="Code" class="form-control" type="text"/>
                    <br/>
                    <button onclick="VerifyOtp()"  class="btn w-100 float-end bg-gradient-primary">Next</button>
                </div>

                {{-- End login form --}}

            </div>
        </div>
    </div>

<script>
   async function VerifyOtp() {
        let otp = document.getElementById('otp').value;
        if(otp.length !==6){
           errorToast('Invalid OTP')
        }
        else{
            showLoader();
            let res=await axios.post('/verify-otp-employer', {
                otp: otp,
                email:sessionStorage.getItem('email')
            })
            hideLoader();

            if(res.status===200 && res.data['status']==='success'){
                successToast(res.data['message'])
                sessionStorage.clear();
                setTimeout(() => {
                    window.location.href='/resetPassword-employer'
                }, 1000);
            }
            else{
                errorToast(res.data['message'])
            }
        }
    }
</script>
