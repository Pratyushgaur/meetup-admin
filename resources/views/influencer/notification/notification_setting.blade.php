@extends('influencer.login_pages.app')

@section('content')
<header>
    <nav class="navbar--verify">
        <div class="back--nav">
            <a href="#" onclick="history.back()" class="back--btn">
                <img src="{{ asset('assets/images/back-arrow.png') }}" alt="" class="back--arrow">
            </a>
            <span class="header-text verify--text--nav nav-link"></span>
        </div>
    </nav>
</header>

<main class="mb-70">

    <div class="container-fluid">
        <div class="main-notification-section">
            <form action="#">
                <p class="notification-haeding">Send Push Notification to Subscribers</p>

                <input type="text" class="form-control notification-title" placeholder="Title">

                <textarea name="" id="" rows="3" class="form-control notification-title" placeholder="Body"></textarea>
                <button class="notification-send-btn">
                    Send Now
                </button>
            </form>
        </div>


        <div class="main-notification-section">
            <form action="#">
                <p class="notification-haeding">Broadcast Private Message to Fans</p>

                <input type="text" class="form-control notification-title" placeholder="Title">

                <div class="or--section--notification">OR</div>

                <div class="record--section border">
                    <button type="button" id="record" class="btn">
                        <img src="{{ asset('assets/images/chat-record.png') }}" alt="" height="25px">
                        <span id="btn--text">Record</span>
                    </button>
                </div>
                
                <div id="AudioSection">
                    <audio id="audio" src=""></audio>
                </div>
                <button class="notification-send-btn">
                    Send Now
                </button>
            </form>
        </div>

    </div>

</main>
@endsection

@push('js')
<script>
    var record = document.getElementById("record");
    var mainContainer = document.getElementById("AudioSection");
    var BtnText = document.getElementById("btn--text");

    if (navigator.mediaDevices) {
        console.log("getUserMedia supported.");

        const constraints = {
            audio: true
        };
        let chunks = [];

        navigator.mediaDevices
            .getUserMedia(constraints)
            .then((stream) => {
                const mediaRecorder = new MediaRecorder(stream);

                record.onclick = () => {
                    if(mediaRecorder.state === `inactive`){
                        mediaRecorder.start();
                        record.style.background = "red";
                        record.style.color = "black";
                        BtnText.innerText = "Recording...";
                    }else{
                        mediaRecorder.stop();
                        record.style.background = "black";
                        record.style.color = "#ffffff";
                        BtnText.innerText = "Record";
                    }
                    
                };
                
                mediaRecorder.onstop = (e) => {
                    console.log(mainContainer.childNodes.length);

                    var audio = document.getElementById("audio");
                    
                    audio.setAttribute("controls", "");

                    audio.controls = true;
                    const blob = new Blob(chunks, {
                        type: "audio/ogg; codecs=opus"
                    });
                    chunks = [];
                    const audioURL = URL.createObjectURL(blob);
                    audio.src = audioURL;
                    console.log("recorder stopped");
                };

                mediaRecorder.ondataavailable = (e) => {
                    chunks.push(e.data);
                };
            })
            .catch((err) => {
                console.error(`The following error occurred: ${err}`);
            });
    }
</script>
@endpush