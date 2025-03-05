@extends('layout.app1')
@section('content')

@push('custom-css')
    <style>
            body,html{
            height: 100%;
            margin: 0;
            background: #7F7FD5;
        background: -webkit-linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5);
            background: linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5);
        }

        .chat{
            margin-top: auto;
            margin-bottom: auto;
        }
        .card{
            height: 700px;
            border-radius: 15px !important;
            background-color: rgba(0,0,0,0.4) !important;
        }
        .contacts_body{
            padding:  0.75rem 0 !important;
            overflow-y: auto;
            white-space: nowrap;
        }
        .msg_card_body{
            overflow-y: auto;
        }
        .card-header{
            border-radius: 15px 15px 0 0 !important;
            border-bottom: 0 !important;
        }
        .card-footer{
            border-radius: 0 0 15px 15px !important;
                border-top: 0 !important;
        }
        .container{
            align-content: center;
        }
        .search{
            border-radius: 15px 0 0 15px !important;
            background-color: rgba(0,0,0,0.3) !important;
            border:0 !important;
            color:white !important;
        }
        .search:focus{
            box-shadow:none !important;
        outline:0px !important;
        }
        .type_msg{
            background-color: rgba(0,0,0,0.3) !important;
            border:0 !important;
            color:white !important;
            height: 60px !important;
            overflow-y: auto;
        }
            .type_msg:focus{
            box-shadow:none !important;
        outline:0px !important;
        }
        .attach_btn{
            border-radius: 15px 0 0 15px !important;
            background-color: rgba(0,0,0,0.3) !important;
            border:0 !important;
            color: white !important;
            cursor: pointer;
        }
        .send_btn{
            border-radius: 0 15px 15px 0 !important;
            background-color: rgba(0,0,0,0.3) !important;
            border:0 !important;
            color: white !important;
            cursor: pointer;
        }
        .search_btn{
            border-radius: 0 15px 15px 0 !important;
            background-color: rgba(0,0,0,0.3) !important;
            border:0 !important;
            color: white !important;
            cursor: pointer;
        }
        .contacts{
            list-style: none;
            padding: 0;
        }

        .user_img{
            height: 70px;
            width: 70px;
            border:1.5px solid #f5f6fa;

        }
        .user_img_msg{
            height: 40px;
            width: 40px;
            border:1.5px solid #f5f6fa;

        }
        .img_cont{
            position: relative;
            height: 70px;
            width: 70px;
        }
        .img_cont_msg{
            height: 40px;
            width: 40px;
        }
        .online_icon{
        position: absolute;
        height: 15px;
        width:15px;
        background-color: #4cd137;
        border-radius: 50%;
        bottom: 0.2em;
        right: 0.4em;
        border:1.5px solid white;
        }
        .offline{
            background-color: #c23616 !important;
        }
        .user_info{
            margin-top: auto;
            margin-bottom: auto;
            margin-left: 15px;
        }
        .user_info span{
            font-size: 20px;
            color: white;
        }
        .user_info p{
        font-size: 10px;
        color: rgba(255,255,255,0.6);
        }
        .video_cam{
            margin-left: 50px;
            margin-top: 5px;
        }
        .video_cam span{
            color: white;
            font-size: 20px;
            cursor: pointer;
            margin-right: 20px;
        }
        .msg_cotainer{
            margin-top: auto;
            margin-bottom: auto;
            margin-left: 10px;
            border-radius: 25px;
            background-color: #82ccdd;
            padding: 10px;
            position: relative;
        }
        .msg_cotainer_send{
        margin-top: auto;
        margin-bottom: auto;
        margin-right: 10px;
        border-radius: 25px;
        background-color: #78e08f;
        padding: 10px;
        position: relative;
        }
        .msg_time{
            position: absolute;
            left: 0;
            bottom: -15px;
            color: rgba(255,255,255,0.5);
            font-size: 10px;
        }
        .msg_time_send{
            position: absolute;
            right:0;
            bottom: -15px;
            color: rgba(255,255,255,0.5);
            font-size: 10px;
        }
        .msg_head{
            position: relative;
        }
        #action_menu_btn{
        position: absolute;
        right: 10px;
        top: 10px;
        color: white;
        cursor: pointer;
        font-size: 20px;
        }
        .action_menu{
            z-index: 1;
            position: absolute;
            padding: 15px 0;
            background-color: rgba(0,0,0,0.5);
            color: white;
            border-radius: 15px;
            top: 30px;
            right: 15px;
            display: none;
        }
        .action_menu ul{
            list-style: none;
            padding: 0;
        margin: 0;
        }
        .action_menu ul li{
            width: 100%;
            padding: 10px 15px;
            margin-bottom: 5px;
        }
        .action_menu ul li i{
            padding-right: 10px;

        }
        .action_menu ul li:hover{
            cursor: pointer;
            background-color: rgba(0,0,0,0.2);
        }
        @media(max-width: 576px){
        .contacts_card{
            margin-bottom: 15px !important;
        }
        }
        .scroller{
            overflow: auto;
            height: 100px;
            direction: flex;
            flex-direction: column-reverse;
            overflow-anchor: auto !important;
        }
        .scroller .scroller-content .item {
            transform: translate(0);
        }
    </style>
@endpush
	<body>
		<div class="container-fluid h-100 mt-6">
			<div class="row justify-content-center h-100">
				<div class="col-md-8 col-xl-6 chat">
					<div class="card">
						<div class="card-header msg_head py-0 px-2">
                            <h5 class="text-white">BAF RO MESSENGER</h5>
							<div class="d-flex bd-highlight">

								<div class="img_cont">
									<img id="profileImage" src="" class="rounded-circle user_img">
									<span class="online_icon"></span>
								</div>
								<div class="user_info">
									<span id="welcome"></span>
									<p><span id="messageCount"></span> Messages</p>
								</div>

							</div>
							{{-- <span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
							<div class="action_menu">
								<ul>
									<li><i class="fas fa-user-circle"></i> View profile</li>
									<li><i class="fas fa-users"></i> Add to close friends</li>
									<li><i class="fas fa-plus"></i> Add to group</li>
									<li><i class="fas fa-ban"></i> Block</li>
								</ul>
							</div> --}}
						</div>
						<div class="card-body scroller msg_card_body" >
                            <div class="scroller-content" id="tableList">

                            </div>
						</div>
						<div class="card-footer" >
                            <form action="" enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <div class="input-group mb-1">
                                    <div class="input-group-append" style="width: 95%;">
                                        <select name="title" style="padding-left: 2.5rem;" class="form-control type_msg" id="title" required >
                                            <option value="" style="color:red;">আপনি যে বিষয়ে  জানতে চান</option>
                                        </select>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text send_btn" style="width: 40px;"><a href="{{url('/voice-conversation')}}"><i class="fas fa-microphone fa-1x"></i></a></span>
                                    </div>
                                </div>
                                <div class="input-group" style="width: 95%;">
                                    <div class="input-group-append">
                                        <span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
                                        <input type="file" id="filename" style="display:none;" name="filename"> <!-- Hidden file input -->
                                    </div>
                                    <textarea name="content" id="content" class="form-control type_msg" placeholder="Type your message..."></textarea>
                                    <div class="input-group-append">
                                        <button type="submit" name="submit" class="input-group-text send_btn" style="width: 40px" onclick="SubmitData()" ><i class="fas fa-location-arrow fa-1x"></i></button>
                                    </div>
                                </div>
                            </form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
<script>
    document.querySelector('.attach_btn').addEventListener('click', function() {
    document.getElementById('filename').click(); // Triggers file input click
    });

	$(document).ready(function(){
        $('#action_menu_btn').click(function(){
            $('.action_menu').toggle();
        });
	});

    getSection()
    async function getSection(){
        let resSec = await axios.get('/section');
        // console.log(resSec);
        resSec.data.data.forEach(function (item,i) {
            let option=`<option value="${item['section']}">${item['job_title']}</option>`
            $("#title").append(option);
        })
    }
</script>

<script>
    getList()
    async function getList() {
    try {
        // showLoader();
        let res = await axios.get(`/conversation-get`);
        // hideLoader();

        // console.log(res.data);  // Check what the API returns

        let tableList = $("#tableList");
        tableList.empty();

        // Ensure data is available
        if (!res.data || res.data.length === 0) {
            tableList.append('No conversations found');
            return;
        }

        // Accessing the conversations and user data
        let conversations = res.data.data || res.data;
        let userData = res.data.userData || res.userData;

        // console.log(conversations.length);
        //content count
        document.getElementById('messageCount').innerHTML = `${conversations.length}`;
        // Display user details (bdno, profile image)
        document.getElementById('welcome').innerHTML = `${userData['fname']}`;
        if (userData['profile_image']) {
            document.getElementById('profileImage').src = userData['profile_image'];
        } else {
            document.getElementById('profileImage').src = 'default-image.png';
        }

        // Loop through conversations and append them to the list
        if (Array.isArray(conversations) && conversations.length > 0) {
            conversations.forEach(function (item, index) {
                // let createdDate = new Date(item['created_at']).toLocaleDateString();
                // let updatedDate = new Date(item['updated_at']).toLocaleDateString();
                    // Define options for date and time formatting
                    let options = {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric',
                                hour: '2-digit',
                                minute: '2-digit',
                                hour12: true // Change to false for 24-hour format
                            };

                            // Format created_at and updated_at dates and times
                            let createdDateTime = new Date(item['created_at']).toLocaleString(options);
                            let updatedDateTime = new Date(item['updated_at']).toLocaleString(options);

                            let row = '';

                    if (item['content'] === null) {
                        row = `
                        <div class="d-flex justify-content-start mb-4">
                            <div class="img_cont_msg">
                                <img src="${userData['profile_image']}" class="rounded-circle user_img_msg">
                            </div>
                            <div class="msg_cotainer" style="text-align: left;">
                                <audio controls>
                                    <source src="${item['voic_send']}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                                <span class="msg_time">${createdDateTime}</span>
                            </div>
                        </div>
                        `;
                    } else {
                        const imageTag = item['filename'] !== null ? `<img style="width:100px;" src="${item['filename']}" alt="Image">` : '';
                        row = `
                        <div class="d-flex justify-content-start mb-4">
                            <div class="img_cont_msg">
                                <img src="${userData['profile_image']}" class="rounded-circle user_img_msg">
                            </div>
                            <div class="msg_cotainer" style="text-align: left;">
                                ${imageTag} <br>
                                ${item['content']}
                                <span class="msg_time">${createdDateTime}</span>
                            </div>
                        </div>
                        `;
                    }



                // Check if 'reply' is not null or undefined before appending the reply block
                if (item['reply'] === null) {
                    if(item['voic_reply']===null){

                    }else{
                    row +=`
                        <div class="d-flex justify-content-end mb-4">
                        <div class="msg_cotainer_send">
                            <audio controls>
                                <source src="${item['voic_reply']}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                            <span class="msg_time_send">${updatedDateTime}</span>
                        </div>
                        <div class="img_cont_msg">
                            <img src="{{asset('/users/images/ro.png')}}" class="rounded-circle user_img_msg">
                        </div>
                    </div>
                    `;
                    }

                }else{
                    const imageTagReply = item['reply_file'] !== null ? `<img style="width:100px;" src="${item['reply_file']}" alt="Image">` : '';

                    row += `
                    <div class="d-flex justify-content-end mb-4">
                        <div class="msg_cotainer_send">
                            ${imageTagReply} <br>
                            ${item['reply']}
                            <span class="msg_time_send">${updatedDateTime}</span>
                        </div>
                        <div class="img_cont_msg">
                            <img src="{{asset('/users/images/ro.png')}}" class="rounded-circle user_img_msg">
                        </div>
                    </div>
                    `;
                }

                // Append the constructed row to the table list
                tableList.append(row);

            });
        } else {
            tableList.append('No conversations available');
        }
    } catch (error) {
        hideLoader();
        if (error.response) {
            console.error('Error response:', error.response.data);
            errorToast(error.response.data.message || 'Server error occurred.');
        } else if (error.request) {
            console.error('Error request:', error.request);
            errorToast('No response from the server.');
        } else {
            console.error('Error message:', error.message);
            errorToast('An error occurred: ' + error.message);
        }
    }
}


    async function SubmitData(){
        let title = document.getElementById('title').value;
        let content = document.getElementById('content').value;
        // console.log(content);
        if(title.length===0){
                errorToast("Select any title.");
                return false;
            }else if(content.length ===0){
                errorToast('Content is Required');
            }else{
                let filename = document.getElementById('filename').files[0];

                let formData = new FormData();
                formData.append('title', title);
                formData.append('content', content);
                // Only append the file if one is selected
                if (filename) {
                    // Correct MIME types for image files
                    const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];

                    if (!allowedTypes.includes(filename.type)) {
                        return errorToast('Only image files (JPEG, PNG) are allowed.');
                    }
                    if (filename.size > 2 * 1024 * 1024) { // 2MB limit
                        return errorToast('File size exceeds the 2MB limit.');
                    }

                    // Append file to FormData
                    formData.append('filename', filename);
                }


                try {
                    // console.log(formData);
                    // showLoader();
                    let res = await axios.post("/conversation-post", formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    });
                    // hideLoader();

                    if (res.status === 200 && res.data['status'] === 'success') {
                        successToast(res.data['message']);
                        document.getElementById('title').value = '';
                        document.getElementById('content').value = '';
                        document.getElementById('filename').value = null;
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

@endsection
