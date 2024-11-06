@extends('user.layout.app')
@push('css')
<style>
    .unorderForList{
       
        list-style-type: none;

    }
    .unorderForList li{
        margin:5px 10px 8px 0px;
        display:inline-block;

    }
    .unorderForList img{
        width:40px;
        height:40px;
        display:block;

    }
    .unorderForList span{
        font-size:10px;
        color:#fff;
    }
    .giflist{
        margin-top:20px;
        height:150px;
        overflow-y:scroll;
        
    }
    .modelbox{
        background-color:#1b1919 !important;
        min-height:325px !important;
    }
    .audio-container{
        width: 50%;
    }
    .audio-container audio{
        width:220px; 
        padding:5px 2px 5px 2px;
    }
</style>
@endpush
@section('content')
<header>
    <nav class="Chat--nav">
        <div class="back--nav">
            <a href="javascript:void(0)" onclick="history.back()" class="back--btn">
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
                    <p class="header--chat--heading text-truncate">{{request()->segment(2)}}</p>
                    <p class="header--chat--text text-truncate">Spent : <span> ₹{{ $spent }}</span></p>
                    <p class="header--chat--text text-truncate">Wallet Balance : <span> ₹{{Auth::guard('customer')->user()->balance}}</span></p>
                    <!-- <p class="header--chat--text text-truncate">Last seen : <span> 10 Minutes ago</span></p> -->
                </div>
                <div class="col-6 chat--header--links">
                    <div class="header--chat--link--section" style="justify-content:end !important;">
                        <div class="header--link--box girfList" style="background-color: #e9f122; " onclick="">
                            <img src="{{ asset('assets/images/gift-chat.png') }}" alt="" class="header--link--box--image">
                        </div>
                       
                    </div>
                    
                </div>
            </div>

        </div>

        <div class="message--chat--box">

            <div class="messages-chat">

          @foreach($list as $key =>$value)
                @if($value->sender == auth()->guard('customer')->user()->id)
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

                        @elseif($value->message_type == 'audio')
                        <div class='audio-container'>
                            <audio controls><source src='{{ URL::TO('chat-audio') }}/{{$value->message_file_path}}' type='audio/wav'></audio>
                        </div>

                        @else

                        @endif


                        <p class="message--time">
                            {{ date('d/m/y h:i A',strtotime($value->created_at)) }}
                        </p>
                    </div>
                </div>
                @endif
            @endforeach  
           
                 <!-- <div class="message--receive--voice">
                    <div class="photo--receive" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);">
                        <div class="online"></div>
                    </div>
                    <div class="message--text--receive">
                        <div class="message--call">
                            <div class="call--show">
                                <img src="{{ asset('assets/images/call-chat.png') }}" alt="" class="message--voice--icon">
                                Voice Call
                            </div>
                            <div class="call--timing">
                                5:20 sec.
                            </div>
                        </div>
                        <p class="message--time">
                            30/07/24 10:23 PM
                        </p>
                    </div>
                </div>

                <div class="message--receive--video">
                    <div class="photo--receive" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);">
                        <div class="online"></div>
                    </div>
                    <div class="message--text--receive">
                        <div class="message--call">
                            <div class="call--show">
                                <img src="{{ asset('assets/images/video-chat.png') }}" alt="" class="message--video--icon">
                                Video Call
                            </div>
                            <div class="call--timing">
                                9:20 sec.
                            </div>
                        </div>
                        <p class="message--time">
                            30/07/24 10:23 PM
                        </p>
                    </div>
                </div>

                <div class="message--response">
                    <div class="message--text">
                        <div class="message--call">
                            <div class="call--show">
                                <img src="{{ asset('assets/images/video-chat.png') }}" alt="" class="message--video--icon">
                                Video Call
                            </div>
                            <div class="call--timing">
                                9:20 sec.
                            </div>
                        </div>
                        <p class="message--time">
                            30/07/24 10:23 PM
                        </p>
                    </div>
                    <div class="photo--response" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);">
                        <div class="online"></div>
                    </div>
                </div>

                <div class="message--response">
                    <div class="message--text">
                        <div class="message--call">
                            <div class="call--show">
                                <img src="{{ asset('assets/images/call-chat.png') }}" alt="" class="message--voice--icon">
                                Voice Call
                            </div>
                            <div class="call--timing">
                                5:20 sec.
                            </div>
                        </div>
                        <p class="message--time">
                            30/07/24 10:23 PM
                        </p>
                    </div>
                    <div class="photo--response" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);">
                        <div class="online"></div>
                    </div>
                </div>

                <div class="message--receive">
                    <div class="photo--receive" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);">
                        <div class="online"></div>
                    </div>
                    <div class="message--text--receive">
                        Hello there...!!!
                        <p class="message--time">
                            30/07/24 10:23 PM
                        </p>
                    </div>
                </div>

                <div class="message--receive">
                    <div class="photo--receive" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);">
                        <div class="online"></div>
                    </div>
                    <div class="message--text--receive">
                       hi
                        <p class="message--time">
                            30/07/24 10:23 PM
                        </p>
                    </div>
                </div>

                <div class="message--response">
                    <div class="message--text">
                        Hello there...!!! Hello there...!!! Hello there...!!! Hello there...!!! Hello there...!!!
                        Hello there...!!!
                        <p class="message--time">
                            30/07/24 10:23 PM
                        </p>
                    </div>
                    <div class="photo--response" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);">
                        <div class="online"></div>
                    </div>
                </div>  -->
            </div>
        </div>

        <div class="footer-chat">
            <input type="text" class="write-message" placeholder="Type your message here" />
            <button id="btnMediaUpload" class="btn chat--input--btn">
                <img src="{{ asset('assets/images/chat-attachment.png')}}" alt="" style="height: 24px;width: 24px;">
            </button>
            <input type="file" id="attechment--input--chat" name="">
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
    <div class="modelbox stream-model" >
        <div class="modelnav">
            <div class="model--nav--head">Girf</div>
            <div>
                <img src="{{ asset('assets/images/cross-icon.png') }}" class="model--close live--model--close closeModel"  alt="">
            </div>
        </div>

        
        <div class="giflist" >
            <ul class="unorderForList">
            @foreach($girf as $keu =>$value)
            
                <li data-id="{{ $value->id }}" data-src="{{ URL::TO('/') }}/gift/{{ $value->image }}">
                    <img src="{{ URL::TO('/') }}/gift/{{$value->image}}" alt="">
                    <span>₹.{{number_format($value->price,2)}}</span>
                </li>
                

            
            @endforeach
            </ul>
            
        </div>

    </div>
</div>

@endsection

@push('js')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.socket.io/4.0.0/socket.io.min.js"></script>
<script>
     const socket = io('{{env('SOCKET_IO_SERVER_URL')}}'); // Replace with your server address
    // const socket = io('{{ env('SOCKET_IO_SERVER_URL') }}', {
    //     withCredentials: true, // This ensures that credentials like cookies are sent if needed
    //     transports: ['polling', 'websocket']
    // });
    const userid = "{{ auth()->guard('customer')->user()->id }}";
     socket.on('connect',()=>{
        socket.emit('client-connect',{userid:userid});
        socket.emit('user_disconnected_testing', { test:"test" });
        
     });

  
    $(window).unload(function() {
        if (validNavigation == 0) {
            socket.emit('user_disconnected_testing', { test:"test" });
        }
    });
</script>
    <script>
        $(document).ready(function(){
            let userId = "{{ auth()->guard('customer')->user()->id}}";
            let sendButton = '<button id="btnRecordSound"  class="btnSendMessage btn chat--input--btn" modifier="large" disable-auto-styling><img src="{{ asset("assets/images/send.png")}}" alt="" style="height: 24px;width: 24px;"></button>';
            let recordButton = '<button id="btnRecordSound" class="btn chat--input--btn" modifier="large" disable-auto-styling><img src="{{ asset("assets/images/chat-record.png")}}" alt="" style="height: 24px;width: 14px;"></button>';
            let influencer_id = "{{  $influencer_id }}";
            $('html, body').animate({
                        scrollTop: $(document).height() - $(window).height()
                    }, 100); 
            socket.on("send-message-to-user",function(data){
                    
                if(data.receiver == userId){
                    let html = '<div class="message--receive"><div class="photo--receive" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);"><div class="online"></div></div><div class="message--text--receive">'+data.message+'<p class="message--time">30/07/24 10:23 PM</p></div></div>';  
                    $(".messages-chat").append(html);
                    scrollToBottomSmooth()
                }
                    
            });

            socket.on('request-to-connect',(data) =>{
                if(data.requestUserId == userId && influencer_id == data.sender){
                    window.location.href = data.url;
                }
                
            })
            socket.on('receive-user-audio',(data) =>{
                console.log("audi test " +data);
                if(data.receiver == userId){
                    const audioBlob = new Blob([data.audiodata], { type: 'audio/wav' });
                    const audioUrl = URL.createObjectURL(audioBlob);
                    console.log(audioUrl);
                    let aud = "<div class='audio-container'><audio controls><source src='"+audioUrl+"' type='audio/wav'></audio></div>";
                    let html = '<div class="message--receive"><div class="photo--receive" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);"><div class="online"></div></div><div class="message--text--receive">'+aud+'<p class="message--time">30/07/24 10:23 PM</p></div></div>';  
                    $(".messages-chat").append(html);
                    scrollToBottomSmooth()

                   
                }
            })
            $('.write-message').on('keydown', function(event) {
                
                if($(this).val()  == ""){
                    $(".btncbox").html(recordButton);
                }else{
                    $(".btncbox").html(sendButton);

                }
                if (event.key === 'Enter' || event.keyCode === 13) {
                    event.preventDefault(); // Prevent default behavior (like submitting a form)
                    sendMessage();
                }
            });
        
            $(document).on('click','.btnSendMessage',function(){
                sendMessage();
            })

            function sendMessage(){
                let text = $(".write-message").val();
                if(text){
                    let csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: "{{ route('user.send.message.check',[request()->segment(2)]) }}",
                        method: "get",
                        success: function(response) {
                            
                            if(response == "yes"){
                               
                                let html = '<div class="message--response"><div class="message--text">'+text+'<p class="message--time">'+currentDateTime()+'</p></div><div class="photo--response" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);"><div class="online"></div></div></div> ';
                                $(".messages-chat").append(html);
                                scrollToBottomSmooth()
                                $(".write-message").val("");
                                //
                                var msgdata = {
                                    message:text,
                                    receiver:influencer_id,
                                    type:"message"
                                }
                                socket.emit('send-message-to-influencer',msgdata);


                                $.ajax({
                                    url: "{{ route('user.send.message',[request()->segment(2)]) }}",
                                    method: "post",
                                    
                                    data: {message:text},
                                    headers: {
                                        'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                                    },
                                    success: function(response) {},
                                });
                            }else{
                                Swal.fire({text:"Insufficient Balance",confirmButtonColor: "#333",});
                            }
                        },


                    });


                    
                
                }
            }

            $(".girfList").click(function(){
                $("#createmodel").css('display', 'flex');
            })
                
            $(".closeModel").click(function(){
                $("#createmodel").css('display', 'none');
            })

            $(".giflist li").click(function(){
                let id = $(this).attr('data-id');
                let src = $(this).attr('data-src');
                let csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "{{ route('user.send.message.check',[request()->segment(2)]) }}",
                    method: "get",
                    data:{type:"sendGift",giftid:id},
                    success: function(response) {
                        
                        if(response == "yes"){
                        
                            let html = '<div class="message--response"><div class="message--text text-center"><img src="'+src+'" alt="" width="50"><p class="message--time">'+currentDateTime()+'</p></div><div class="photo--response" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);"><div class="online"></div></div></div> ';
                            $(".messages-chat").append(html);
                            $("#createmodel").css('display', 'none');
                            $('html, body').animate({
                                scrollTop: $(document).height() - $(window).height()
                            }, 100); 
                            $(".write-message").val("");
                            $.ajax({
                                url: "{{ route('user.send.gift.message',[request()->segment(2)]) }}",
                                method: "post",
                                
                                data: {giftId:id},
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                                },
                                success: function(response) {
                                    response = JSON.parse(response);
                                    var msgdata = {
                                        message:'-',
                                        receiver:influencer_id,
                                        type:"gift",
                                        url:response.image
                                    }
                                    
                                    socket.emit('send-message-to-influencer',msgdata);
                                    
                                },
                            });
                        }else{
                            $("#createmodel").css('display', 'none');
                            Swal.fire({text:"Insufficient Balance",confirmButtonColor: "#333",});
                        }
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
            function scrollToBottomSmooth() {
                const lastMessage = document.querySelector('.messages-chat').lastElementChild;
                if (lastMessage) {
                    lastMessage.scrollIntoView({ behavior: 'smooth' });
                }
            }
            
        })
        
    </script>
<script>
    $('#btnMediaUpload').click(function() {
        //$('#attechment--input--chat').trigger("click");
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