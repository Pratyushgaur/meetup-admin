@extends('influencer.login_pages.app')

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
                        <div class="header--link--box" style="background-color: #fff;">
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

@endsection

@push('js')
@vite('resources/js/app.js')
    <script type="module">
        $('html, body').animate({scrollTop : $('body').height()},100);
        let userId = "{{ auth()->id()}}";
        let receiver = "{{ $userdata->id}}";
        document.addEventListener("DOMContentLoaded", function() {
            Echo.channel('chat-room')
                .listen('MessageSent', (e) => {
                    console.log(e);
                    if(e.message.receiver == userId){
                        
                        let html = '';
                        if(e.message.type == 'message'){
                            html = '<div class="message--receive"><div class="photo--receive" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);"><div class="online"></div></div><div class="message--text--receive">'+e.message.message+'<p class="message--time">30/07/24 10:23 PM</p></div></div>';  
                        }
                        if(e.message.type == 'gift'){
                             html = '<div class="message--receive"><div class="photo--receive" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);"><div class="online"></div></div><div class="message--text--receive"><img src="'+e.message.image+'" alt="" width="50"><p class="message--time">30/07/24 10:23 PM</p></div></div>';  
                        }
                            
                          $(".messages-chat").append(html);
                          //$('.messages-chat').scrollTop($('.messages-chat')[0].scrollHeight);
                          $('html, body').animate({scrollTop : $('body').height()},100);
                    }
                
                    
                });
        });

        $("#btnRecordSound").click(function(){
            let text = $(".write-message").val();
            if(text){
                let csrfToken = $('meta[name="csrf-token"]').attr('content');
                let html = '<div class="message--response"><div class="message--text">'+text+'<p class="message--time">30/07/24 10:23 PM</p></div><div class="photo--response" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);"><div class="online"></div></div></div> ';
                $(".messages-chat").append(html);
                $('html, body').animate({scrollTop : $('body').height()},100);
                $(".write-message").val("");
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