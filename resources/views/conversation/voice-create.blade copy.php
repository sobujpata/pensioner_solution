@extends('layout.app1')
@section('content')
<div class="container mt-5" style="margin-top: 120px !important;">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card card-bg">
                <div class="card-body">
                    <h5 class="card-title" align="center"><b><u>ভয়েস মেসেজ অপশন</u></b></h5>
                    <br>
                    <p><b>(ভয়েস মেসেজ অপশন শুধুমাত্র যারা লিখতে অক্ষম তাদের জন্য)</b></p>
                    <p><b>বিঃদ্রঃ ভয়েস মেসেজ পাঠাতে হলে আপনার ল্যাপটপ/কম্পিউটারে মাইক্রোফোন সচল থাকতে হবে।</b></p>
                    <br>
                    <div class="row">
                        <div class="col-lg-3"> </div>
                        <div class="col-lg-3" align="right"><button id="recordButton" class="btn btn-primary">রেকডিং শুরু করুন</button></div>
                        <div class="col-lg-3" align="left"><button id="stopButton" class="btn btn-danger">রেকডিং শেষ করুন</button></div>
                        <div class="col-lg-3"> </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-3" align="right"><b>রেকডিং শেষে প্লে বাটন চেপে একবার শুনুন<span style='font-size:15px;'>&#129094;</span></b></div>
                        <div class="col-lg-6" align="center">
                            <audio id="audioPlayback" controls></audio>
                            <form id="uploadForm" method="POST" enctype="multipart/form-data" action="{{ route('upload.audio') }}">
                                @csrf
                                <input type="hidden" id="audioBlob" name="audioBlob">
                                <input type="file" id="audioFile" name="audio" style="display: none;">
                                <br>
                                <button type="submit" class="btn btn-warning"><b>ভয়েস মেসেজ রেকর্ড অফিসে পাঠিয়ে দিন</b></button>
                            </form>
                        </div>
                        <div class="col-lg-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
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
