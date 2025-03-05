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
            top: 25%;
            transform: translateY(-50%);
            cursor: pointer;
        }
</style>

<body style="background-color:#f0f2f5;">
    <div class="container text-center pt-md-6 registration">
        <div class="row align-items-center mt-md-5">
            <div class="log-logo col-md-7">

                <h3 class="ex-login-header">EX-AIRMEN & MODC(AIR) REGISTRATION</h3>
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
                        {{-- <label>Person Type</label> --}}
                        <select class="form-select form-control" id="person_type_select" aria-label="Default select example">
                            <option selected>Select Person Type</option>
                            <!-- Options will be populated here dynamically -->
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <input id="bdno" placeholder="BD No" class="form-control" type="number"/>
                            </div>
                            <div class="col-6">
                                <select class="form-select form-control" id="rank_select" aria-label="Default select example">
                                    <option selected>Select rank</option>
                                    <!-- Options will be populated here dynamically -->
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <input id="fname" placeholder="Name" class="form-control" type="text" autofocus/>
                    </div>
                    <div class="form-group">
                        <select class="form-select form-control" id="trade_select" aria-label="Default select example">
                            <option selected>Select trade</option>
                            <!-- Options will be populated here dynamically -->
                        </select>
                    </div>
                    <div class="form-group">
                        <input id="email" placeholder="Enter Email" class="form-control" type="Email" autofocus/>
                    </div>
                    <div class="form-group">
                        <input id="mobile" placeholder="User Mobile" class="form-control" type="Mobile" autofocus/>
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
                <button onclick="onRegistration()" class="btn mt-3 w-100  bg-gradient-info">Sign Up</button>

                <hr>
                <p style="margin-top: 25px;"><a href="{{url('/userLogin')}}" class="btn btn-outline-dark">Already have an account?</a></p>
            </div>
        </div>
    </div>
    <br>

<script>
   getData();

async function getData() {
    showLoader();
    try {
        let res = await axios.get("/person-type");
        hideLoader();

        if (res.status === 200 && res.data['status'] === 'success') {
            let data = res.data['data'];

            // Get the select element
            let select = document.getElementById('person_type_select');


            // Clear any existing options (optional, if you plan to refill it)
            select.innerHTML = '<option selected>Select Person Type</option>';

            // Loop through the data and create an option for each person_type
            data.forEach(function (personType) {
                let option = document.createElement('option');
                option.value = personType; // Assuming personType is the value
                option.text = personType;  // Display personType as the text
                select.appendChild(option);
            });
        } else {
            errorToast(res.data['message']);
        }
    } catch (error) {
        hideLoader();
        errorToast('An error occurred while fetching data');
        console.error(error);
    }
    try {
        let res = await axios.get("/rank");
        hideLoader();
        // console.log(res);
        if (res.status === 200 && res.data['status'] === 'success') {
            let data = res.data['data'];

            // Get the select element
            let select = document.getElementById('rank_select');


            // Clear any existing options (optional, if you plan to refill it)
            select.innerHTML = '<option selected>Select Rank</option>';

            // Loop through the data and create an option for each person_type
            data.forEach(function (rank) {
                let option = document.createElement('option');
                option.value = rank; // Assuming rank is the value
                option.text = rank;  // Display rank as the text
                select.appendChild(option);
            });
        } else {
            errorToast(res.data['message']);
        }
    } catch (error) {
        hideLoader();
        errorToast('An error occurred while fetching data');
        console.error(error);
    }
    try {
        let res = await axios.get("/trade");
        hideLoader();
        // console.log(res);
        if (res.status === 200 && res.data['status'] === 'success') {
            let data = res.data['data'];

            // Get the select element
            let select = document.getElementById('trade_select');


            // Clear any existing options (optional, if you plan to refill it)
            select.innerHTML = '<option selected>Select trade</option>';

            // Loop through the data and create an option for each person_type
            data.forEach(function (trade) {
                let option = document.createElement('option');
                option.value = trade; // Assuming trade is the value
                option.text = trade;  // Display trade as the text
                select.appendChild(option);
            });
        } else {
            errorToast(res.data['message']);
        }
    } catch (error) {
        hideLoader();
        errorToast('An error occurred while fetching data');
        console.error(error);
    }
}

async function onRegistration() {
    let person_type = document.getElementById('person_type_select').value;
    let bdno = document.getElementById('bdno').value;
    let rank = document.getElementById('rank_select').value;
    let fname = document.getElementById('fname').value;
    let trade = document.getElementById('trade_select').value; // Corrected
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


    if(person_type.length === 0){
        errorToast('Person type is required');
    }
    else if(bdno.length === 0){
        errorToast('BD no is required');
    }
    else if(rank.length === 0){
        errorToast('Rank is required');
    }
    else if(fname.length === 0){
        errorToast('Full Name is required');
    }
    else if(trade.length === 0){
        errorToast('Trade is required');
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
        formData.append('person_type', person_type);
        formData.append('bdno', bdno);
        formData.append('rank', rank);
        formData.append('fname', fname);
        formData.append('trade', trade); // Now correctly fetches trade
        formData.append('email', email);
        formData.append('mobile', mobile);
        formData.append('password', password);

        try {
            showLoader();
            let res = await axios.post("/user-registration", formData, {
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
                    window.location.href = '/userLogin';
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
