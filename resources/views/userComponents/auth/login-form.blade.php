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
                    <h3 class="ex-login-header">EX-AIRMEN & MODC(AIR) LOGIN</h3>
                    <h5 class="ex-login-header2">BAF RECORD OFFICE</h5>

                    <span id='alertMessage'></span>
                    <hr>
                    <br>
                    <img class="login_logo" src="{{ asset('users/images/ro.png') }}" alt="BAF logo">
                    <p align="center" class="about-brand"style="font-family:Arial, Helvetica, sans-serif"
                        style="font-size:12px">PENSIONER SOLUTION BAF RO</p>

                </div>

                <div class="col-md-5">
                    {{-- Start login form --}}
                    <div class="card px-3 py-2">
                        <form action="" method="post">
                            @csrf
                            <div class="form-group">
                                <input id="email" placeholder="Email Address" class="form-control" type="email"
                                    autofocus />
                            </div>
                            <div class="form-group">
                                <div class="password-wrapper">
                                    <input id="password" placeholder="Password" class="form-control" type="password"
                                    autofocus />
                                    <span id="togglePassword" class="toggle-icon">👁️</span>
                                </div>

                            </div>
                        </form>
                        <div class="form-group">
                            {{-- <input class="btn btn-primary" type="submit" value="Log in" onclick="SubmitLogin()"> --}}
                            <button onclick="SubmitLogin()" class="btn w-100 btn-primary">Log in</button>
                        </div>
                        {{-- End login form --}}
                        <p style="line-height: 3rem;"><a href="{{ url('/sendOtp') }}">Forgot Password</a></p>
                        <hr>
                        <button style.display='block' class="btn btn-info"><a href="{{ url('/userRegistration') }}">Sign Up</a></button>
                        <p style="margin-top: 25px;"><a href="{{url('/employer-login')}}" class="btn btn-outline-dark">Employers Login</a></p>
                    </div>

                </div>
            </div>
        </div>
        <br>
        <script>
            async function SubmitLogin() {
                let email = document.getElementById('email').value.trim();
                let password = document.getElementById('password').value.trim();

                // Input validation
                if (!email) {
                    errorToast("Email is required");
                    return;
                }
                if (!password) {
                    errorToast("Password is required");
                    return;
                }

                showLoader(); // Show loading animation

                try {
                    let res = await axios.post("/user-login", {
                        email: email,
                        password: password
                    });

                    hideLoader(); // Hide loading animation

                    if (res.status === 200 && res.data.status === 'success') {
                        // Successful login, redirect to dashboard
                        window.location.href = "/user-dashboard";
                    } else {
                        // Handle approval message for unapproved users
                        let approvalMessage = res.data.approve_status || res.data.message;

                        if (approvalMessage) {
                            document.getElementById('alertMessage').innerHTML = `
                                <div class="alert alert-danger text-white text-center" role="alert">
                                    ${approvalMessage}
                                </div>`;
                        }

                        errorToast(res.data.message || "Login failed");
                    }
                } catch (error) {
                    hideLoader(); // Hide loader on error

                    if (error.response) {
                        if (error.response.status === 401) {
                            errorToast("Unauthorized. Incorrect email or password.");
                        } else if (error.response.status === 403) {
                            errorToast("Your account has not been approved yet.");
                        } else {
                            errorToast("An error occurred. Please try again.");
                        }
                    } else {
                        errorToast("Network error. Please check your connection.");
                    }
                }
            }

            // Function to get a specific cookie by name
            function getCookie(name) {
                const cookieArr = document.cookie.split(';');
                for (let i = 0; i < cookieArr.length; i++) {
                    const cookiePair = cookieArr[i].split('=');
                    if (name.trim() === cookiePair[0].trim()) { // Match cookie name
                        return decodeURIComponent(cookiePair[1]);
                    }
                }
                return null; // Return null if cookie is not found
            }

            // Check for the 'approvalMessage' cookie and display alert
            const message = getCookie('approvalMessage');
            if (message) {
                errorToast("Please wait for admin approval of your account.");
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
