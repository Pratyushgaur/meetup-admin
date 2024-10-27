@extends('influencer.login_pages.app')

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    
.video-call-container {
  position: relative;
  width: 100%;
  height: 100vh;
  background-color: black;
}

.remote-video {
  position: absolute;
  width: 100%;
  height: 100%;
  background-color: black;
  display: flex;
  justify-content: center;
  align-items: center;
}

.local-video {
  position: absolute;
  width: 120px;
  height: 150px;
  top: 20px;
  right: 20px;
  border: 2px solid white;
  background-color: black;
  z-index: 10;
}

.controls {
  position: absolute;
  bottom: 30px;
  width: 100%;
  display: flex;
  justify-content: center;
  gap: 20px;
}

.control-btn {
  background-color: rgba(255, 255, 255, 0.1);
  border: none;
  color: white;
  font-size: 24px;
  padding: 15px;
  border-radius: 50%;
  box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
  cursor: pointer;
  transition: background-color 0.3s, box-shadow 0.3s;
}

.control-btn:hover {
  background-color: rgba(255, 255, 255, 0.2);
  box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.5);
}

.control-btn.end {
  background-color: #ff3b3b;
}

.control-btn.end:hover {
  background-color: #ff6161;
}
.button-box{
    padding:10px;
    display:flex;
    gap:12px;
    justify-content:center;
}
.animate-record{
    animation: kreep 0.7s ease infinite alternate;
    
}
.timer-counter{
    display:flex;
    justify-content:center;
}
.audio-container{
    width: 50%;
}
.audio-container audio{
    width:220px; 
    padding:5px 2px 5px 2px;
}

@keyframes kreep {
    0% {-webkit-transform: scale(1.1,.9);
        transform: scale(1.1,.9);}
   50% { -webkit-transform: scale(.9,1.1) translateY(-.5rem)}
   70% { -webkit-transform: scale(1);
         transform: scale(1);}
}

</style>
@endpush
@section('content')
<header>
    <nav class="Chat--nav">
        <div class="back--nav">
            <a href="javascript:void(0)"  onclick="history.back()" class="back--btn">
                <img src="{{ asset('assets/images/back-arrow.png') }}" alt="" class="back--arrow">
            </a>
            <span class="header-text verify--text--nav nav-link">Chat</span>
        </div>
    </nav>
</header>
<main>
    <div class="container-fluid">
        <div class="header--chat">
            <div class="row">
                <div class="col-6 chat--header--details">
                    <p class="header--chat--heading text-truncate">Pratyush Gaur</p>
                    <p class="header--chat--text text-truncate">Spent : <span> ₹1000.00</span></p>
                    <p class="header--chat--text text-truncate">Wallet Balance : <span> ₹1000.00</span></p>
                    <!-- <p class="header--chat--text text-truncate">Last seen : <span> 10 Minutes ago</span></p> -->
                </div>
                <div class="col-6 chat--header--links">
                    <div class="header--chat--link--section">
                        <!-- <div class="header--link--box" style="background-color: #e9f122;">
                            <img src="{{ asset('assets/images/gift-chat.png') }}" alt="" class="header--link--box--image">
                        </div> -->
                        <div class="header--link--box" style="background-color: #22f14b;">
                            <img src="{{ asset('assets/images/call-chat.png') }}" alt="" class="header--link--box--image">
                        </div>
                        <div class="header--link--box make-call" data-id="{{ $userdata->id }}"  style="background-color: #fff;">
                            <img src="{{ asset('assets/images/video-chat.png') }}" alt="" class="header--link--box--image" style="width: 50% !important;height:35% !important;">
                        </div>
                    </div>
                    <div class="header--chat--button--section">
                        <a href="javascript:void(0)" class="btn header--chat--button changeMsgPriceBtn">
                            Change Per Msg Price
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <div class="message--chat--box">

            <div class="messages-chat">

            @foreach($chatlist as $key =>$value)
                @if($value->sender == \Auth::id())
                <div class="message--response">
                    <div class="message--text">
                        
                        @if($value->message_type == 'message')
                        
                        {{$value->message}}
                        
                        @elseif($value->message_type == 'audio')
                        
                        <div class='audio-container'>
                            <audio controls><source src='{{ URL::TO('chat-audio') }}/{{$value->message_file_path}}' type='audio/wav'></audio>
                        </div>

                        @else
                        <img src="{{URL::TO('/')}}/chat_files/{{ $value->message_file_path }}" alt="" width="50">
                        
                        @endif
                        
                        <p class="message--time">
                        {{ date('d/m/y h:i A',strtotime($value->created_at)) }}
                        </p>
                    </div>
                    <div class="photo--response" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);">
                        <div class="online"></div>
                    </div>
                </div>

                @else
                <div class="message--receive">
                    <div class="photo--receive" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);">
                        <div class="online"></div>
                    </div>
                    <div class="message--text--receive">
                        @if($value->message_type == 'message')
                        
                        {{$value->message}}
                        
                        @else
                        <img src="{{URL::TO('/')}}/chat_files/{{ $value->message_file_path }}" alt="" width="50">
                        
                        @endif
                        <p class="message--time">
                            {{ date('d/m/y h:i A',strtotime($value->created_at)) }}
                        </p>
                    </div>
                </div>
                @endif
            @endforeach  

            
        </div>
        <div id="recordingIndicator" class="recording-indicator" style="display: none;">
            <p>Recording...</p>
        </div>
        <div class="footer-chat">
            <input type="text" class="write-message" placeholder="Type your message here" />
            <button id="btnMediaUpload" class="btn chat--input--btn">
                <img src="{{ asset('assets/images/chat-attachment.png')}}" alt="" style="height: 24px;width: 24px;">
            </button>
            <input type="file" id="attechment--input--chat" name="" accept="video/*,image/*">
            <!-- <button id="btnRecordSound" class="btn chat--input--btn" modifier="large" disable-auto-styling>
                <img src="{{ asset('assets/images/chat-record.png')}}" alt="" style="height: 24px;width: 14px;">
            </button> -->

            <div class="btncbox">
                <button id="btnRecordSound" class="btn chat--input--btn" modifier="large" disable-auto-styling>
                    <img src="{{ asset('assets/images/chat-record.png')}}" alt="" style="height: 24px;width: 14px;">
                </button>
            </div>
        </div>

    </div>

    <div class="container-fluid chat--body" style="background-image: url({{ asset('assets/images/chat-background.AVIF') }});"></div>
</main>

<div id="createmodel">
    <div class="modelbox stream-model" style="min-height:150px;">
        <div class="modelnav">
            <div class="model--nav--head">Change Message Price</div>
            <div>
                <img src="{{ asset('assets/images/cross-icon.png') }}" class="model--close live--model--close closeModel" alt="">
            </div>
        </div>

        <div class="btn-change-cover-section"></div>

        <form method="post" action="{{ route("influencer.messagePrice.update",$userdata->id) }}">
            @csrf
            <div class="form-group pl-3 pr-3">
                <label for="Input1"> Amount </label>
                <input type="number" name="amount"  value="{{ $walletBalance->messagePrice }}" class="form-control live-stram-input" id="Input1" placeholder="Enter Amount You want to recharge " required>
            </div>
            
            
            
            <div class="btn-change-cover-section">
                <button type="submit" class="btn btn-cancel-create stream--btn--bg">
                    Upadate
                </button>
            </div>
        </form>
    </div>
</div>
<div id="recording-model">
    <div class="modelbox stream-model" style="min-height:150px;">
        <div class="modelnav">
            <div class="model--nav--head">Record</div>
            <div class="closeRecording">
                <img src="{{ asset('assets/images/cross-icon.png') }}" class="model--close live--model--close closeModel" alt="" >
            </div>
        </div>

        <div class="btn-change-cover-section">
            <img class="recordicon" src="{{ URL::TO('/microphone.png') }}" alt="" width="50" style="display:block">
            <img class="animate-record" src="{{ URL::TO('/rec-button.png') }}" alt="" width="50" style="display:none">
            <audio id="previde-recording" style="display:none" controls></audio>
            

        </div>
        <div class="timer-counter">
            
        </div>
        <div class="button-box">
            <button class="btn btn-cancel-create stream--btn--bg " id="start-recording">Start</button>
            <button class="btn btn-cancel-create stream--btn--bg " id="stop-recording" style="display:none">Stop</button>
            <button class="btn btn-cancel-create stream--btn--bg " id="send-recording" style="display:none">Send</button>
            <button class="btn btn-cancel-create stream--btn--bg closeRecording" >Cancel</button>
            
        </div>

        
    </div>
</div>



@endsection

@push('js')



<script src="https://cdn.socket.io/4.0.0/socket.io.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
     const socket = io('{{env('SOCKET_IO_SERVER_URL')}}'); // Replace with your server address

    // const socket = io('{{ env('SOCKET_IO_SERVER_URL') }}', {
    //     withCredentials: true, // This ensures that credentials like cookies are sent if needed
    //     transports: ['polling', 'websocket']
    // });
     let userId = "{{ auth()->id()}}";
     let sendButton = '<button id="btnRecordSound"  class="btnSendMessage btn chat--input--btn" modifier="large" disable-auto-styling><img src="{{ asset("assets/images/send.png")}}" alt="" style="height: 24px;width: 24px;"></button>';
            let recordButton = '<button id="btnRecordSound" class="btn chat--input--btn" modifier="large" disable-auto-styling><img src="{{ asset("assets/images/chat-record.png")}}" alt="" style="height: 24px;width: 14px;"></button>';
     socket.on('connect',()=>{
        
        socket.emit('client-connect',{userid:userId});
     });
</script>
    <script type="module">
        //$("#videocall-model").css('display', 'flex');
        
        scrollToBottomSmooth();
        
        let receiver = "{{ $userdata->id}}";
        let csrfToken = $('meta[name="csrf-token"]').attr('content');
        document.addEventListener("DOMContentLoaded", function() {
            socket.on("send-message-to-influencer",function(data){
                console.log(data)
                if(data.receiver == userId){
                        
                    let html = '';
                    if(data.type == 'message'){
                        html = '<div class="message--receive"><div class="photo--receive" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);"><div class="online"></div></div><div class="message--text--receive">'+data.message+'<p class="message--time">'+currentDateTime()+'</p></div></div>';  
                    }
                    if(data.type == 'gift'){
                        html = '<div class="message--receive"><div class="photo--receive" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);"><div class="online"></div></div><div class="message--text--receive"><img src="'+data.url+'" alt="" width="50"><p class="message--time">'+currentDateTime()+'</p></div></div>';  
                    }
                        
                    $(".messages-chat").append(html);
                    //$('.messages-chat').scrollTop($('.messages-chat')[0].scrollHeight);
                    //$('html, body').animate({scrollTop : $('body').height()},100);
                    scrollToBottomSmooth();
                }
                
            })


           
        });

        $('.write-message').on('keyup', function(event) {
                
            
            if (event.key === 'Enter' || event.keyCode === 13) {
                event.preventDefault(); // Prevent default behavior (like submitting a form)
                sendMessage();
            }
            if($(this).val()  == ""){
                $(".btncbox").html(recordButton);
            }else{
                $(".btncbox").html(sendButton);

            }
        });

        // $("#btnRecordSound").click(function(){
        //     let text = $(".write-message").val();
        //     if(text){
        //         let csrfToken = $('meta[name="csrf-token"]').attr('content');
        //         let html = '<div class="message--response"><div class="message--text">'+text+'<p class="message--time">30/07/24 10:23 PM</p></div><div class="photo--response" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);"><div class="online"></div></div></div> ';
        //         $(".messages-chat").append(html);
        //         //$('html, body').animate({scrollTop : $('body').height()},100);
        //         scrollToBottomSmooth();
        //         $(".write-message").val("");
        //         var msgdata = {
        //             message:text,
        //             receiver:receiver,
        //             type:"message"
        //         }
                
        //         socket.emit('send-message-to-user',msgdata);
        //         $.ajax({
        //             url: "{{ route('influencer.send.message') }}",
        //             method: "post",
                    
        //             data: {message:text,receiver:receiver},
        //             headers: {
        //                 'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
        //             },
        //             success: function(response) {
                        
        //                 // $(".create-post-image-section").hide();
        //                 // $(".create-post-form-section").show();
        //                // document.getElementById('loader').classList.remove('loader-visible');
        //                 //window.location.href = "{{ route('influencer.success.page') }}";
        //             },


        //         });
            
        //     }
        // })
        $(".changeMsgPriceBtn").click(function(){
            $("#createmodel").css('display', 'flex');
        })
        $(".closeModel").click(function(){
            $("#createmodel").css('display', 'none');
        })
        $(".make-call").click(function(){
            let id = $(this).attr('data-id');
            let url = $(this).attr('data-callurl');
            $.ajax({
                    url: "{{ route('influencer.chat.generateCall') }}",
                    data: {id:id},
                    success: function(response) {
                        let data = JSON.parse(response);
                        console.log(data)
                        if(data.is_online){
                            
                           window.location.href = data.url;
                        }else{
                            Swal.fire({text:"User is offline ",confirmButtonColor: "#333",});
                        }
                        // $(".create-post-image-section").hide();
                        // $(".create-post-form-section").show();
                       // document.getElementById('loader').classList.remove('loader-visible');
                        //window.location.href = "{{ route('influencer.success.page') }}";
                    },


                });
        })

        function sendMessage(){
            let text = $(".write-message").val();
            if(text){
                
                let html = '<div class="message--response"><div class="message--text">'+text+'<p class="message--time">30/07/24 10:23 PM</p></div><div class="photo--response" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);"><div class="online"></div></div></div> ';
                $(".messages-chat").append(html);
                //$('html, body').animate({scrollTop : $('body').height()},100);
                scrollToBottomSmooth();
                $(".write-message").val("");
                var msgdata = {
                    message:text,
                    receiver:receiver,
                    type:"message"
                }
                
                socket.emit('send-message-to-user',msgdata);
                $.ajax({
                    url: "{{ route('influencer.send.message') }}",
                    method: "post",
                    
                    data: {message:text,receiver:receiver},
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                    }
                });
            
            }
        }
        
        function currentDateTime() {
            const now = new Date();
            
            // Get date parts
            const month = String(now.getMonth() + 1).padStart(2, '0');  // Months are 0-based
            const day = String(now.getDate()).padStart(2, '0');
            const year = String(now.getFullYear()).slice(-2);  // Get last 2 digits of year
            
            // Get time parts
            let hours = now.getHours();
            const minutes = String(now.getMinutes()).padStart(2, '0');
            
            // Determine AM/PM
            const ampm = hours >= 12 ? 'PM' : 'AM';
            
            // Convert 24-hour time to 12-hour time
            hours = hours % 12 || 12;  // Convert 0 to 12 for midnight
            
            // Format final output
            return `${month}/${day}/${year} ${hours}:${minutes} ${ampm}`;
        }
        function scrollToBottomSmooth() {
            const lastMessage = document.querySelector('.messages-chat').lastElementChild;
            if (lastMessage) {
                lastMessage.scrollIntoView({ behavior: 'smooth' });
            }
        }
       
        $('#btnMediaUpload').click(function() {
         $('#attechment--input--chat').trigger("click");
        })
        $(".closeRecording").click(function(){
            $("#recording-model").css('display', 'none');
            resetAudioForm();
            
           
          
        })

         

        const startButton = document.getElementById('btnRecordSound');
        const recordingIndicator = document.getElementById('recordingIndicator'); // The recording indicator
        const startRecButton = document.getElementById("start-recording");
        const sendRecording = document.getElementById("send-recording");
        const stopRecording = document.getElementById("stop-recording");
        let audioBlob;
        let audioRecorder;
        let audioChunks = [];
        let timerInterval ;
        let isModelClose = false;
        function startRecordingTimer() {
            let recordingTime = 0;
            timerInterval = setInterval(() => {
                recordingTime++;
                const minutes = Math.floor(recordingTime / 60);
                const seconds = recordingTime % 60;

                // Format minutes and seconds to be two digits
                const formattedMinutes = String(minutes).padStart(2, '0');
                const formattedSeconds = String(seconds).padStart(2, '0');
                $(".timer-counter").html(`<h4>${formattedMinutes}:${formattedSeconds}</h4>`);
                //recordingTimer.textContent = `Recording: ${formattedMinutes}:${formattedSeconds}`;
            }, 1000); // Update timer every second
        }
        function stopRecordingTimer(){
            clearInterval(timerInterval);
        }
        function resetAudioForm(){
            $("#start-recording").show();
            $("#send-recording").hide();
            $("#stop-recording").hide();
            $("#previde-recording").attr("src", "");
            $("#previde-recording").hide();
            $(".animate-record").hide();
            $(".recordicon").show();
            stopRecordingTimer();
            $(".timer-counter").html('');
            isModelClose = true;
            if (audioRecorder.state !== 'inactive') {
                audioRecorder.stop();
                console.log('Recording stopped...');
                // socket.emit('sendAudio', audioBlob);
            }
            
        }
        

        navigator.mediaDevices.getUserMedia({ audio: true })
        .then(stream => {
            //audio initilize
                audioRecorder = new MediaRecorder(stream);
                audioRecorder.addEventListener('dataavailable', e => {
                if(isModelClose == false){
                    audioChunks.push(e.data);
                    if (audioChunks.length > 0) { // Check if audioChunks is not empty
                        audioBlob = new Blob(audioChunks, { type: 'audio/wav' });
                        const audioUrl = URL.createObjectURL(audioBlob);
                        stopRecordingTimer();
                        // Ensure the audio element is properly updated and displayed after a small delay
                        setTimeout(() => {
                            $("#previde-recording").attr("src", audioUrl);  // Update the audio source
                            $("#previde-recording").show();  // Show the audio player
                            $(".animate-record").hide();
                            $("#send-recording").show();
                            $("#stop-recording").hide();
                            $("#previde-recording")[0].play();
                        }, 500); // Small delay to let the audio blob process
                    } else {
                        console.log("No audio data recorded.");
                    }
                }
                
            
            });
            const startRecording =  () => {
                isModelClose = false;
                audioRecorder.start();
                console.log('Recording started');
                
                                                                                                                                                                                                                                                                                                                                                                                                                                
            };
            
            startButton.addEventListener('click', () =>{
                
                $("#recording-model").css('display', 'flex');
            });
            //
            startRecButton.addEventListener('click', ()=>{
                startRecording();
                startRecordingTimer();
                
                $(".recordicon").hide();
                $(".animate-record").show();
                
                $("#start-recording").hide();
                $("#stop-recording").show();
            });
            //
            stopRecording.addEventListener('click',() => {
                //previde-recording
                if (audioRecorder.state !== 'inactive') {
                    audioRecorder.stop();
                    console.log('Recording stopped...');
                    // socket.emit('sendAudio', audioBlob);
                }
            })
            sendRecording.addEventListener('click',() =>{
                $("#previde-recording")[0].pause();
                $("#previde-recording")[0].currentTime = 0;
                $("#recording-model").css('display', 'none');
                let aud = "<div class='audio-container'><audio controls><source src='"+$("#previde-recording").attr("src")+"' type='audio/wav'></audio></div>";
                let html = '<div class="message--response"><div class="message--text">'+aud+'<p class="message--time">30/07/24 10:23 PM</p></div><div class="photo--response" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);"><div class="online"></div></div></div> ';
                $(".messages-chat").append(html);
                scrollToBottomSmooth();
                //
                const reader = new FileReader();
                reader.readAsArrayBuffer(audioBlob);
                reader.onloadend = () => {
                    const audioBuffer = reader.result;
                    socket.emit('send_audio', {audiodata:audioBuffer,receiver:receiver});
                }
                //

                const formData = new FormData();
                formData.append('audioFile', audioBlob, 'audio_recording.wav'); // Append the blob with a filename
                formData.append('receiver', receiver); 

                $.ajax({
                    url: "{{ route('influencer.send.audio') }}",
                    method: "post",
                    contentType: false,
                    processData: false,
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                    }
                });
                resetAudioForm();


            })

            
        })
        .catch(err => {
            console.error('Error accessing microphone: ' + err);
        });
    </script>
<script>
    
    
    

    // Get the user's microphone input
    // navigator.mediaDevices.getUserMedia({ audio: true })
    //     .then(stream => {

    //         // Initialize the MediaRecorder object
    //         audioRecorder = new MediaRecorder(stream);

    //         // Event listener for when audio data is available
    //         audioRecorder.addEventListener('dataavailable', e => {
    //             audioChunks.push(e.data);
    //         });

    //         // Start recording when the button is pressed (either touch or click)
    //         const startRecording = () => {
    //             audioChunks = [];
    //             setTimeout(() => {
    //                 audioRecorder.start();
    //                 console.log('Recording started');
    //             }, 2000); // 2000 milliseconds = 2 seconds
               
                                                                                                                                                                                                                                                                                                                                                                                                                                
    //         };

    //         // Stop recording when the button is released
    //         const stopRecording = () => {
    //             if (audioRecorder.state !== 'inactive') {
    //                 audioRecorder.stop();
    //                 console.log('Recording stopped...');

    //                 // After stopping, create the audio blob and send or use it
    //                 const audioBlob = new Blob(audioChunks, { type: 'audio/wav' });
    //                 const audioUrl = URL.createObjectURL(audioBlob);
    //                 console.log(audioUrl);  // You can play or send this URL
                    
    //                 // For example, to send via Socket.IO:
    //                 // socket.emit('sendAudio', audioBlob);
    //             }
    //         };

    //         // Add event listeners for both touch and mouse events
    //         startButton.addEventListener('touchstart', startRecording);
    //         startButton.addEventListener('mousedown', startRecording);

    //         // Add listeners to stop recording
    //         startButton.addEventListener('touchend', stopRecording);
    //         startButton.addEventListener('mouseup', stopRecording);

    //         // Prevent event overlap on touch devices
    //         startButton.addEventListener('touchcancel', stopRecording);
    //         document.body.addEventListener('mouseleave', stopRecording);  // Stops recording if the mouse leaves the button
    //     })
    //     .catch(err => {
    //         console.error('Error accessing microphone: ' + err);
    //     });
</script>
@endpush