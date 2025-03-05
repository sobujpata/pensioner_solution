@extends('layout.app1')
@section('content')
<div class="container" style="margin-top: 80px;">
	<div class="row justify-content-center">
		<div class="col-md-12">
            @if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
			<div class="card">
				<div class="card-header px-2 py-0">
                    <img class='profile-img1' alt='salim' src='{{$image}}'/>
                        <h2 style="margin-top: 16px; font-weight: bold;text-transform: uppercase;">Submit Your valuable Suggestion</h2>
                </div>
				<div class="card-body">
					<form class="" action="{{ route('suggestion.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
						<div class="row">
							<div class="col-lg-12">
								<textarea required name="content" class="form-control" id="content" placeholder="Please enter your valuable suggestion here..." rows="3"></textarea>
								<span class="error"><?php //echo $contentErr;?></span>
							</div>
                        </div>
						<div class="row mt-3">
							<div class="col-md-4">
								<p style="color: #49f51e; margin-top: 10px;"><b>Attach Supporting Docu (If any) <i class="fa fa-arrow-right" aria-hidden="true"></i></b></p>
							</div>
							<div class="col-md-4">
								<input type="file" class="form-control" name="filename" id="filename">
							</div>
							<div class="col-md-4">
								<div class="form-group" style="margin-top:-7px">
									<input type="submit" name="submit" class="btn btn-primary wlSubmit" value="Submit" onclick="submitData()">
                                    <button type="clear" name="clear" class="btn btn-danger wlSubmit" ><b>Clear</b></button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
<script>
   async function submitData(event){
    event.preventDefault(); // Prevent form from submitting the default way

    let content = document.getElementById('content').value;
    let filename = document.getElementById('filename').files[0]; // Corrected to 'files'

    if(content.length === 0){
        errorToast("No suggestion available.");
        return;
    }

    let formData = new FormData(); // Capitalize 'FormData'
    formData.append('content', content);

    if(filename){
        const allowedTypes = ['application/pdf']; // Correct MIME type for PDF
        if(!allowedTypes.includes(filename.type)){
            return errorToast("Only PDF files are allowed.");
        }
        if(filename.size > 2 * 1024 * 1024){ // 2MB size limit
            return errorToast("File size exceeds 2MB limit.");
        }
        formData.append('filename', filename);
    }

    showLoader();
    try {
        let res = await axios.post("/suggestions", formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });
        hideLoader();

        if(res.status === 200 && res.data.status === 'success'){
            successToast(res.data.message);
        } else {
            errorToast(res.data.message);
        }
    } catch (error) {
        hideLoader();
        console.error("Error occurred:", error);
        errorToast("An error occurred while submitting the suggestion.");
    }
}

</script>
