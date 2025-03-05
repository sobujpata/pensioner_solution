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
        <div class="row align-items-center mt-md-5">
            <div class="log-logo col-md-7">
                <h3 class="text-center" style="color:#007bff;">EX-AIRMEN & MODC(AIR) PASSWORD SET</h3>
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
                <div class="card px-3 py-3">
                    <h4>SET NEW PASSWORD</h4>
                    <br/>
                    <label style="text-align:left;">New Password</label>
                    <input id="password" placeholder="New Password" class="form-control" type="password"/>
                    <br/>
                    <label style="text-align:left;">Confirm Password</label>
                    <input id="cpassword" placeholder="Confirm Password" class="form-control" type="password"/>
                    <br/>
                    <button onclick="ResetPass()" class="btn w-100 bg-gradient-primary">Next</button>
                </div>

                {{-- End login form --}}

            </div>
        </div>
    </div>
<br>

<script>
  async function ResetPass() {
        let password = document.getElementById('password').value;
        let cpassword = document.getElementById('cpassword').value;

        if(password.length===0){
            errorToast('Password is required')
        }
        else if(cpassword.length===0){
            errorToast('Confirm Password is required')
        }
        else if(password!==cpassword){
            errorToast('Password and Confirm Password must be same')
        }
        else{
          showLoader()
          let res=await axios.post("/reset-password",{password:password});
          hideLoader();
          if(res.status===200 && res.data['status']==='success'){
              successToast(res.data['message']);
              setTimeout(function () {
                  window.location.href="/userLogin";
              },1000);
          }
          else{
            errorToast(res.data['message'])
          }
        }

    }
</script>
