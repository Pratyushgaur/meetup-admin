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
        </div>

        <div class="footer-chat">
            <input type="text" class="write-message" placeholder="Type your message here" />
            <button id="btnMediaUpload" class="btn chat--input--btn">
                <img src="{{ asset('assets/images/chat-attachment.png')}}" alt="" style="height: 24px;width: 24px;">
            </button>
            <input type="file" id="attechment--input--chat" name="">
            <button id="btnRecordSound" class="btn chat--input--btn" modifier="large" disable-auto-styling>
                <img src="{{ asset('assets/images/chat-record.png')}}" alt="" style="height: 24px;width: 14px;">
            </button>
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

<div id="videocall-model">
<div class="video-call-container">
    <!-- Remote User's Video -->
    <div class="remote-video" id="remote-video"></div>

    <!-- Local User's Video -->
    <div class="local-video" id="local-video"></div>

    <!-- Call Control Buttons -->
    <div class="controls">
      <button id="mute-audio" class="control-btn">
        <i class="fas fa-microphone"></i>
      </button>
      <button id="camera-toggle" class="control-btn">
        <i class="fas fa-video"></i>
      </button>
      <button id="switch-camera" class="control-btn">
        <i class="fas fa-sync-alt"></i>
      </button>
      <button id="end-call" class="control-btn end">
        <i class="fas fa-phone-slash"></i>
      </button>
    </div>
  </div>
</div>


@endsection

@push('js')

<script src="https://cdn.agora.io/sdk/release/AgoraRTC_N.js"></script>
<script src="{{URL::to('video-call/videocall.js')}}"></script>
<script src="https://cdn.socket.io/4.0.0/socket.io.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
     const socket = io('http://localhost:3000'); // Replace with your server address
     let userId = "{{ auth()->id()}}";
     socket.on('connect',()=>{
        
        socket.emit('client-connect',{userid:userId});
     });
</script>
    <script type="module">
        //$("#videocall-model").css('display', 'flex');
        
        $('html, body').animate({scrollTop : $('body').height()},100);
        
        let receiver = "{{ $userdata->id}}";
        
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
                    $('html, body').animate({scrollTop : $('body').height()},100);
                }
                
            })


           
        });

        $("#btnRecordSound").click(function(){
            let text = $(".write-message").val();
            if(text){
                let csrfToken = $('meta[name="csrf-token"]').attr('content');
                let html = '<div class="message--response"><div class="message--text">'+text+'<p class="message--time">30/07/24 10:23 PM</p></div><div class="photo--response" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);"><div class="online"></div></div></div> ';
                $(".messages-chat").append(html);
                $('html, body').animate({scrollTop : $('body').height()},100);
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
                    },
                    success: function(response) {
                        
                        // $(".create-post-image-section").hide();
                        // $(".create-post-form-section").show();
                       // document.getElementById('loader').classList.remove('loader-visible');
                        //window.location.href = "{{ route('influencer.success.page') }}";
                    },


                });
            
            }
        })
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
    </script>
<script>
    $('#btnMediaUpload').click(function() {
       // $('#attechment--input--chat').trigger("click");
    })

    const startButton = document.getElementById('btnRecordSound');

    let audioRecorder;
    let audioChunks = [];
    navigator.mediaDevices.getUserMedia({
        audio: true
    })
    .then(stream => {

        // Initialize the media recorder object
        audioRecorder = new MediaRecorder(stream);

        // dataavailable event is fired when the recording is stopped
        audioRecorder.addEventListener('dataavailable', e => {
            audioChunks.push(e.data);
        });

        // start recording when the start button is clicked
        startButton.addEventListener('touchstart', () => {
            console.log('check');
            audioChunks = [];
            audioRecorder.start();

            
        });

        // stop recording when the stop button is clicked
        startButton.addEventListener('touchend mouseup', () => {
            audioRecorder.stop();
            console.log('check');

        });
    }).catch(err => {

        // If the user denies permission to record audio, then display an error.
        console.log('Error: ' + err);
    });
</script>
@endpush