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
        padding: 10px;
        font-size: 16px;
    }
    .form-select{
        padding: 10px;
        font-size: 16px;
    }
    .password-wrapper {
            position: relative;
            display: inline-block;
        }
        .toggle-icon {
            position: absolute;
            right: 18px;
            top: 35%;
            transform: translateY(-50%);
            cursor: pointer;
        }
</style>

<body style="background-color:#f0f2f5;">
    <div class="container text-center pt-md-6 registration">
        <div class="row align-items-center pt-md-5">
            <div class="log-logo col-md-7">

                <h3 class="ex-login-header">EMPLOYERS REGISTRATION</h3>
                <h5 class="ex-login-header2">BAF RECORD OFFICE</h5>


                <hr>
                <br>
                <img class="login_logo" src="{{ asset('users/images/ro.png') }}" alt="BAF logo">
                <p align="center" class="about-brand"style="font-family:Arial, Helvetica, sans-serif"
                    style="font-size:12px">PENSIONER SOLUTION BAF RO</p>
            </div>

            <div class="col-md-5">
                {{-- Start login form --}}
                <form action="" method="post">
                    @csrf

                    <div class="form-group">
                        <input id="fname" placeholder="Full Name" class="form-control" type="text" autofocus/>
                    </div>
                    <div class="form-group">
                        <input id="orgName" placeholder="Organaization Name" class="form-control" type="text" autofocus/>
                    </div>
                    <div class="form-group">
                        <input type="text" id="designation" name="designation" placeholder="Designation" class="form-control" autofocus>
                    </div>
                    <div class="form-group">
                        <input id="email" placeholder="Enter Email" class="form-control" type="Email" autofocus/>
                    </div>
                    <div class="form-group">
                        <input id="mobile" placeholder="Mobile No" class="form-control" type="Mobile" autofocus/>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6 password-wrapper">
                                <input id="password" placeholder="Password" class="form-control" type="password"/>
                                <span id="togglePassword" class="toggle-icon">👁️</span>
                                <span style="font-size: 11px !important">Password must be 6 digit with special character.</span>
                            </div>
                            <div class="col-6">
                                <input id="profile_image" placeholder="Image" class="form-control" type="file" title="Profile Image"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                    </div>
                </form>
                <button onclick="onRegistrationEmployer()" class="btn mt-3 w-100  bg-gradient-info">Sign Up</button>

                <hr>
                <p style="margin-top: 25px; font-size:20px; color:rgb(9, 98, 139);"><a href="{{url('/employer-login')}}" class="btn btn-outline-dark">Already have an account?</a></p>
            </div>
        </div>
    </div>
    <br>

<script>
async function onRegistrationEmployer() {

    let fname = document.getElementById('fname').value;
    let orgName = document.getElementById('orgName').value;
    let designation = document.getElementById('designation').value;
    let email = document.getElementById('email').value;
    let mobile = document.getElementById('mobile').value;
    let password = document.getElementById('password').value;

        // Check if the password field is empty
        if (password.length === 0) {
            errorToast('Password is required');
            return false;
        }

        // Check password length
        if (password.length < 6) {
            errorToast('Password must be at least 6 characters long');
            return false;
        }

        // Check if the password contains at least one uppercase letter
        if (!/[A-Z]/.test(password)) {
            errorToast('Password must contain at least one uppercase letter');
            return false;
        }
        // Check if the password contains at least one uppercase letter
        if (!/[a-z]/.test(password)) {
            errorToast('Password must contain at least one lowercase letter');
            return false;
        }

        // Check if the password contains at least one number
        if (!/[0-9]/.test(password)) {
            errorToast('Password must contain at least one number');
            return false;
        }

        // Check if the password contains at least one special character
        if (!/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
            errorToast('Password must contain at least one special character');
            return false;
        }

    if(fname.length === 0){
        errorToast('Full Name is required');
    }
    else if(orgName.length === 0){
        errorToast('Organaization Name is required');
    }
    else if(designation.length === 0){
        errorToast('Designation is required');
    }
    else if(email.length === 0){
        errorToast('Email is required');
    }
    else if(mobile.length === 0){
        errorToast('Mobile is required');
    }
    else if(password.length === 0){
        errorToast('Password is required');
    }
    else {
        let profile_image = document.getElementById('profile_image').files[0];
        let formData = new FormData();
        formData.append('profile_image', profile_image);
        formData.append('fname', fname);
        formData.append('orgName', orgName); // Now correctly fetches orgName
        formData.append('designation', designation); // Now correctly fetches orgName
        formData.append('email', email);
        formData.append('mobile', mobile);
        formData.append('password', password);

        try {
            showLoader();
            let res = await axios.post("/employer-registration", formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            });
            hideLoader();
            console.log(res);
            if (res.status === 200 && res.data['status'] === 'success') {
                successToast(res.data['message']);
                setTimeout(function () {
                    function setCookie(name, value, minutes) {
                        const date = new Date();
                        date.setTime(date.getTime() + (minutes * 60 * 1000)); // Convert minutes to milliseconds
                        const expires = "expires=" + date.toUTCString();
                        document.cookie = `${name}=${value}; ${expires}; path=/`;
                    }

                    // Set the cookie with a 24-hour expiration
                    setCookie("approvalMessage", "Please wait for Admin Approval", 30);


                    // Redirect to the user login page
                    window.location.href = '/employer-login';
                }, 2000);
            } else {
                errorToast(res.data['message']);
            }

        } catch (error) {
            hideLoader();
            if (error.response) {
                // Server responded with a status other than 2xx
                errorToast(error.response.data.message);
                console.error('Error response data:', error.response.data);
            } else if (error.request) {
                // No response was received
                errorToast('No response from the server.');
                console.error('Error request:', error.request);
            } else {
                // Other errors
                errorToast('An error occurred: ' + error.message);
                console.error('Error message:', error.message);
            }
        }

    }
}

</script>
<script>
    // Get password input and toggle icon
    const passwordInput = document.getElementById('password');
    const togglePassword = document.getElementById('togglePassword');

    // Add click event to toggle icon
    togglePassword.addEventListener('click', function () {
        // Toggle password visibility
        const type = passwordInput.type === 'password' ? 'text' : 'password';
        passwordInput.type = type;

        // Change icon (optional)
        this.textContent = type === 'password' ? '👁️' : '🙈';
    });
</script>
