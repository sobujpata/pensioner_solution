@extends('layout.app1')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card" style="background-color:#e5f3ef !important;">
				<div class="row" style="margin-top: 90px;">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<h4 align="center"><b>EDIT JOB APPLICATION FORM</b></h4>
						<h5 align="center"><b>(Retd Airmen & MODC only)</b></h5>
						<p align="center"><b>(Your Basic data has been taken from your registration option automatically)</b></p>
                        @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
					</div>
					<div class="col-md-2">
                        <img src="{{ asset($user->profile_image) }}" alt="Profile Image" style="width: 90px; border-radius:5px;">
					</div>
				</div>
				<hr style="border: 1px solid;">
				<div class="panel-body" style="width:96%; margin:0 auto;">

                        <form method="post" role="form" enctype="multipart/form-data" action="{{route('application.update', $job_data->id)}}">
                            @csrf
                            {{-- @method('pull') --}}
                            <fieldset>
                                <div class="container"></div>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="bdno"><b>BD No</b></label>
                                        <input type="text" id="bdno" class="form-control" name="bdno" placeholder="BD No" value="{{$user->bdno}}" readonly>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="rank"><b>Rank</b></label>
                                        <input type="text" id="rank" class="form-control" name="rank" placeholder="Rank" value="{{$user->rank}}" readonly>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="name"><b>Name</b></label>
                                        <input type="text" id="fname" class="form-control" name="name" placeholder="Name" value="{{$user->fname}}" readonly>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="trade"><b>Trade</b></label>
                                        <input type="text" id="trade" class="form-control" name="trade" placeholder="Trade" value="{{$user->trade}}" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="mobile"><b>Mobile No</b></label>
                                        <input type="text" id="mobile" class="form-control" name="mobile" placeholder="Mobile No" value="{{$user->mobile}}" readonly>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="email"><b>E-Mail Address</b></label>
                                        <input type="text" id="email" class="form-control" name="email" placeholder="E-Mail Address" value="{{$user->email}}" readonly>
                                    </div>


                                    <div class="form-group col-md-3">
                                        <label for="dob"><b>Date of Birth</b></label>
                                        <input type="date" id="dob" class="form-control" name="dob" placeholder="Dt Of Birth" value="{{$job_data->dob}}">
                                    </div>


                                    <div class="form-group col-md-3">
                                        <label for="nid"><b>NID No</b></label>
                                        <input type="text" id="nid" class="form-control" name="nid" placeholder="NID No" value="{{$job_data->nid}}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="vill"><b>Permanent Address</b></label>
                                        <input type="text" id="vill" class="form-control" name="vill" placeholder="Village/Road" value="{{$job_data->vill}}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="po"><b>Post Office</b></label>
                                        <input type="text" id="po" class="form-control" name="po" placeholder="Post Office" value="{{$job_data->po}}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="ps"><b>Police Station</b></label>
                                        <input type="text" id="ps" class="form-control" name="ps" placeholder="Police Station" value="{{$job_data->ps}}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="district"><b>District</b></label>
                                        <input type="text" id="district" class="form-control" name="district" placeholder="District" value="{{$job_data->district}}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="present_address"><b>Present Address</b></label>
                                        <input type="text" id="present_address" class="form-control" name="present_address" placeholder="Present Address" value="{{$job_data->present_address}}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="qualification"><b>Edu Qualification (Latest)</b></label>
                                        <input type="text" id="qualification" class="form-control" name="qualification" placeholder="Edu Qualification (Latest)" value="{{$job_data->qualification}}">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="passingyear"><b>Passing Year</b></label>
                                        <input type="text" id="passingyear" class="form-control" name="passingyear" placeholder="Passing Year" value="{{$job_data->passingyear}}">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="jobchoice"><b>Choice Your Job</b></label>
                                        <select class="form-control" name="jobchoice" id="jobchoice">
                                                <option value="" disabled {{ $job_data->jobchoice == '' ? 'selected' : '' }}>Please Choice Your Job Type</b></option>
                                                <option {{ $job_data->jobchoice == 'Aircraft Technician (Fighter)' ? 'selected' : '' }}>Aircraft Technician (Fighter)</option>
                                                <option {{ $job_data->jobchoice == 'Aircraft Technician (Helicopter)' ? 'selected' : '' }}>Aircraft Technician (Helicopter)</option>
                                                <option {{ $job_data->jobchoice == 'Aircraft Technician (TPT)' ? 'selected' : '' }}>Aircraft Technician (TPT)</option>
                                                <option {{ $job_data->jobchoice == 'Radio & Telecommunication' ? 'selected' : '' }}>Radio & Telecommunication</option>
                                                <option {{ $job_data->jobchoice == 'Information Technology (IT)' ? 'selected' : '' }}>Information Technology (IT)</option>
                                                <option {{ $job_data->jobchoice == 'Air Conditioner Technician' ? 'selected' : '' }}>Air Conditioner Technician</option>
                                                <option {{ $job_data->jobchoice == 'Mechanical Transport Technician' ? 'selected' : '' }}>Mechanical Transport Technician</option>
                                                <option {{ $job_data->jobchoice == 'Accounting & Finance' ? 'selected' : '' }}>Accounting & Finance</option>
                                                <option {{ $job_data->jobchoice == 'Logistic Related' ? 'selected' : '' }}>Logistic Related</option>
                                                <option {{ $job_data->jobchoice == 'Secterial Assistant' ? 'selected' : '' }}>Secterial Assistant</option>
                                                <option {{ $job_data->jobchoice == 'Manager' ? 'selected' : '' }}>Manager</option>
                                                <option {{ $job_data->jobchoice == 'Legal' ? 'selected' : '' }}>Legal</option>
                                                <option {{ $job_data->jobchoice == 'Medical' ? 'selected' : '' }}>Medical</option>
                                                <option {{ $job_data->jobchoice == 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="jobarea"><b>Choice Job Area</b></label>
                                        <select class="form-control" name="jobarea" id="jobarea">
                                            <option disabled {{ $job_data->jobarea == '' ? 'selected' : '' }}><b style="color:red;">Please Choice Your Job Area</b></option>
                                            <option {{ $job_data->jobarea == 'Dhaka' ? 'selected' : '' }}>Dhaka</option>
                                            <option {{ $job_data->jobarea == 'Chattogram' ? 'selected' : '' }}>Chattogram</option>
                                            <option {{ $job_data->jobarea == 'Sylhet' ? 'selected' : '' }}>Sylhet</option>
                                            <option {{ $job_data->jobarea == 'Rajshahi' ? 'selected' : '' }}>Rajshahi</option>
                                            <option {{ $job_data->jobarea == 'Khulna' ? 'selected' : '' }}>Khulna</option>
                                            <option {{ $job_data->jobarea == 'Barishal' ? 'selected' : '' }}>Barishal</option>
                                            <option {{ $job_data->jobarea == 'Rangpur' ? 'selected' : '' }}>Rangpur</option>
                                            <option {{ $job_data->jobarea == 'Mymensingh' ? 'selected' : '' }}>Mymensingh</option>
                                            <option {{ $job_data->jobarea == 'Any Where in Bangladesh' ? 'selected' : '' }}>Any Where in Bangladesh</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="experience"><b>Job Experience in BAF</b></label>
                                        <input type="text" id="experience" class="form-control" name="experience" placeholder="Experience" value="{{$job_data->experience}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12" id="resume1">
                                        <label for="resume"><b>Attach your CV (pdf only)</b></label>
                                        <input type="file" name="resume" id="resume" accept="application/pdf" />
                                    </div>
                                </div>

                                <div class="text-center mb-1">
                                    <input class="btn btn-success" name="submit" type="submit" value="Submit">
                                    <input class="btn btn-warning" type="reset" value="Clear" name="reset" >
                                </div>
                            </fieldset>
                        </form>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection

<script>
    // async function UpdateData(){
    //     let dob = document.getElementById('dob').value;
    //     let nid = document.getElementById('nid').value;
    //     let vill = document.getElementById('vill').value;
    //     let po = document.getElementById('po').value;
    //     let ps = document.getElementById('ps').value;
    //     let district = document.getElementById('district').value;
    //     let present_address = document.getElementById('present_address').value;
    //     let qualification = document.getElementById('qualification').value;
    //     let passingyear = document.getElementById('passingyear').value;
    //     let jobchoice = document.getElementById('jobchoice').value;
    //     let jobarea = document.getElementById('jobarea').value;
    //     let experience = document.getElementById('experience').value;

    //          if(dob.length===0){
    //             errorToast("Date of Birth is required");
    //         }
    //         else if(nid.length===0){
    //             errorToast("Nid no is required");
    //         }
    //         else if(vill.length===0){
    //             errorToast("Village name is required");
    //         }
    //         else if(po.length===0){
    //             errorToast("PO name is required");
    //         }
    //         else if(ps.length===0){
    //             errorToast("PS name is required");
    //         }
    //         else if(district.length===0){
    //             errorToast("District name is required");
    //         }
    //         else if(present_address.length===0){
    //             errorToast("Present address is required");
    //         }
    //         else if(qualification.length===0){
    //             errorToast("Qualification is required");
    //         }
    //         else if(passingyear.length===0){
    //             errorToast("Passingyear is required");
    //         }
    //         else if(jobchoice.length===0){
    //             errorToast("Jobchoice is required");
    //         }
    //         else if(jobarea.length===0){
    //             errorToast("jobarea is required");
    //         }
    //         else if(experience.length===0){
    //             errorToast("experience is required");
    //         }
    //         else{
    //             let resume = document.getElementById('resume').files[0];
    //             let formData = new FormData();
    //             formData.append('resume', resume);
    //             formData.append('dob', dob);
    //             formData.append('nid', nid);
    //             formData.append('vill', vill);
    //             formData.append('po', po);
    //             formData.append('ps', ps);
    //             formData.append('district', district);
    //             formData.append('present_address', present_address);
    //             formData.append('qualification', qualification);
    //             formData.append('passingyear', passingyear);
    //             formData.append('jobchoice', jobchoice);
    //             formData.append('experience', experience);
    //             formData.append('jobarea', jobarea);
    //         try {
    //             console.log(formData);
    //             showLoader();
    //             let res = await axios.post("/job-application-update", formData, {
    //                 headers: {
    //                     'Content-Type': 'multipart/form-data'
    //                 }
    //             });
    //             hideLoader();

    //             if (res.status === 200 && res.data['status'] === 'success') {
    //                 successToast(res.data['message']);
    //                 setTimeout(function () {
    //                     window.location.href = '/job-application';
    //                 }, 2000);
    //             } else {
    //                 errorToast(res.data['message']);
    //             }
    //         } catch (error) {
    //             hideLoader();
    //             if (error.response) {
    //                 // Server responded with a status other than 2xx
    //                 errorToast(error.response.data.message);
    //                 console.error('Error response data:', error.response.data);
    //             } else if (error.request) {
    //                 // No response was received
    //                 errorToast('No response from the server.');
    //                 console.error('Error request:', error.request);
    //             } else {
    //                 // Other errors
    //                 errorToast('An error occurred: ' + error.message);
    //                 console.error('Error message:', error.message);
    //             }
    //         }
    //     }
    // }
</script>
