<link rel="stylesheet" href="{{asset('users/css/login.css')}}">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 animated fadeIn col-lg-6 center-screen ">
            <div class="card w-90  p-4 bg-dark">
                <div class="card-body text-center">
                    <img src="{{asset('/users/images/ro.png')}}" alt="RO LOGO" class="w-20">
                    <h4 class="text-decoration-underline text-white">ADMIN LOGIN</h4>
                    <br/>
                    <input id="email" placeholder="User Email" class="form-control" type="email"/>
                    <br/>
                    <input id="password" placeholder="User Password" class="form-control" type="password"/>
                    <br/>
                    <button onclick="SubmitLogin()" class="btn w-100 bg-gradient-primary">Next</button>

                </div>
            </div>
        </div>
    </div>
</div>


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
            let res = await axios.post("/admin-login", { email: email, password: password });

            hideLoader(); // Hide loading animation

            if (res.status === 200 && res.data.status === 'success') {
                window.location.href = "/dashboard"; // Redirect to dashboard on success
            } else {
                errorToast(res.data.message || "Login failed. Please try again.");
            }
        } catch (error) {
            hideLoader(); // Hide loader on error

            if (error.response) {
                if (error.response.status === 401) {
                    errorToast("Unauthorized: Incorrect email or password.");
                } else if (error.response.status === 403) {
                    errorToast("Your account is not approved yet.");
                } else {
                    errorToast("An error occurred. Please try again.");
                }
            } else {
                errorToast("Network error. Please check your connection.");
            }
        }
    }
</script>

