<div class="modal animated zoomIn" id="audio-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Massage To <span id="pertircular"></span></h5>
            </div>
            <div class="modal-body">
                <div class="container-fluid m-0 p-0 text-center">
                    <div class="row m-0 p-0">
                        <div class="col-md-6 p-2">
                            <button id="recordButton" class="btn btn-primary">রেকডিং শুরু করুন</button>
                        </div>
                        <div class="col-md-6 p-2">
                            <button id="stopButton" class="btn btn-danger">রেকডিং শেষ করুন</button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3" align="right"><b>রেকডিং শেষে প্লে বাটন চেপে একবার শুনুন<span style='font-size:15px;'>&#129094;</span></b></div>
                        <div class="col-lg-6" align="center">
                            <audio id="audioPlayback" controls></audio>
                            <form id="audioForm">
                                @csrf
                                <input type="hidden" id="audioBlob" name="audioBlob">
                                <input type="file" id="audioFile" name="audio" style="display: none;">
                                <input name="" type="text" class="d-none" id="audioID">
                            </form>
                        </div>
                        <div class="col-lg-3"></div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button id="audio-update-modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="AudioSubmitData()" type="submit" id="audio-update-btn" class="btn bg-gradient-success" >Update</button>
                </div>

            </div>
        </div>
    </div>
</div>


<script>
    async function FillUpAudioUpdateForm(id) {
        // console.log(id);
    document.getElementById('audioID').value=id;
}

//Submit Audio
    async function AudioSubmitData() {
        const audioID = document.getElementById('audioID').value;
        const fileInput = document.getElementById('audioFile');
        const file = fileInput.files[0];

        if (!file) {
            return errorToast('Please record or select an audio file.');
        }

        const allowedTypes = ['audio/mpeg', 'audio/mp3'];
        if (!allowedTypes.includes(file.type)) {
            return errorToast('Only audio files (MP3) are allowed.');
        }
        if (file.size > 2 * 1024 * 1024) { // 2MB limit
            return errorToast('File size exceeds the 2MB limit.');
        }

        const formData = new FormData();
        formData.append('id', audioID);
        formData.append('audio', file);

        // Hide modal
        const modalElement = document.getElementById('audio-modal');
            const modalInstance = bootstrap.Modal.getInstance(modalElement);
            modalInstance.hide();
        try {
            showLoader();
            const res = await axios.post('/conversation-audio-from-admin', formData, {
                headers: { 'Content-Type': 'multipart/form-data' },
            });
            hideLoader();
            console.log(res);

            if (res.status === 200 && res.data?.status === 'success') {
                successToast(res.data.message);
                fileInput.value = ''; // Clear file input
                await getList();
            } else {
                errorToast(res.data?.message || 'Submission failed.');
            }
        } catch (error) {
            hideLoader();
            if (error.response) {
                errorToast(error.response.data?.message || 'Server error occurred.');
            } else if (error.request) {
                errorToast('No response from the server.');
            } else {
                errorToast('An error occurred: ' + error.message);
            }
        }
    }
//Audio Create
    document.addEventListener('DOMContentLoaded', () => {
    let mediaRecorder;
    let audioChunks = [];

    document.getElementById('recordButton').onclick = async () => {
        const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
        mediaRecorder = new MediaRecorder(stream);

        mediaRecorder.ondataavailable = event => {
            audioChunks.push(event.data);
        };

        mediaRecorder.start();
    };

    document.getElementById('stopButton').onclick = () => {
        mediaRecorder.stop();
        mediaRecorder.onstop = () => {
            const audioBlob = new Blob(audioChunks, { type: 'audio/mpeg' });
            const audioUrl = URL.createObjectURL(audioBlob);
            document.getElementById('audioPlayback').src = audioUrl;

            const file = new File([audioBlob], "recording.mp3", { type: 'audio/mpeg' });
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            document.getElementById('audioFile').files = dataTransfer.files;

            // Reset audioChunks for next recording
            audioChunks = [];
        };
    };
});






</script>
