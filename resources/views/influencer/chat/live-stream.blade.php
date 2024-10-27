<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Video Call</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
  <style>
    ::-webkit-scrollbar {
        display: none;
    }
    /* General Styling */
    body, html {
    margin: 0;
    padding: 0;
    font-family: 'Arial', sans-serif;
    background-color: #f0f0f0;
    }

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
    


    .comments-section {
      position: absolute;
      bottom: 120px;
      left: 10px;
      right: 10px;
      max-height: 200px;
      overflow-y: auto;
      color: white;
      font-size: 14px;
      
      
    }

    /* Mobile Responsive Comments */
    .comments-section .comment {
      margin-bottom: 5px;
      margin-left: 5px;
      padding-left:5px;

      font-size: 20px;
      
    }
    .comments-section i {
      
      font-size: 25px;
      
      
    }
    .comments-section strong {
      
      font-size: 15px;
      
    }

    .comments-section p {
      
      font-size: 15px;
      margin-left:30px;
      
    }
    .live-info {
      position: absolute;
      top: 10px;
      left: 10px;
      display: flex;
      align-items: center;
    }
    .live-badge {
      background-color: red;
      color: white;
      padding: 5px 10px;
      font-size: 14px;
      border-radius: 5px;
    }
    .end-stream {
      background-color: red;
      color: white;
      padding: 5px 10px;
      font-size: 14px;
      border-radius: 5px;
      margin-left:50px;
      margin-top:5px;
    }
    .viewers-count {
      
      color:white;
      
      margin-top: 10px;
      background: rgba(0, 0, 0, 0.5);
      width:100%;
      padding:5px;
      border-radius:3px;
    }

    /* Position the options menu in the top right corner */
    .options-menu {
        position: absolute;
        top: 15px;
        right: 10px;
        z-index: 1000; /* Make sure it's on top of other elements */
    }

    .options-menu i{
        color:#fff;
        margin-right:10px;
        font-size:20px;
    }

    /* Style the dropdown menu */
    .dropdown-menu {
        background-color: rgba(0, 0, 0, 0.8);
        color: white;
        border: none;
       
    }

    .dropdown-menu a {
        color: white;
    }

    .dropdown-menu li{
      margin:10px;
      text-align:center;
    }

    .dropdown-menu li a{
      color:#fff;
    }

    .dropdown-menu a:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }

     /* Fullscreen popup styling */
     .fullscreen-popup {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100vh;
      background-color: black;
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }

    .fullscreen-popup button {
      background-color: black;
      color: white;
      padding: 15px 30px;
      font-size: 18px;
      border: 1px solid white;
      border-radius: 10px;
      cursor: pointer;
    }

    .fullscreen-popup button:hover {
      background-color: #218838;
    }

    .messagebox {
      position: absolute;
      bottom: 20px;
      width: 100%;
      
      display:flex;
      justify-content:left;
      
      
    }
    .messagebox  input{
      margin-left:10px;
      width:80%; 
      border:1px solid white;
      border-radius:60px;
      background-color:rgba(0,0,0,0.5); 
      padding:15px;
      color:#ffff;
    }
    .messagebox  button{
      
      width:20%; 
      border:1px solid white;
      border-radius:60px;
      background-color:rgba(0,0,0,0.5); 
      padding:15px;
      color:#ffff;
    }


  </style>
</head>
<body>
<input type="hidden" value="{{$agoraToken}}" id="agoraToken">
<input type="hidden" value="{{$uuid}}" id="uuid">
<input type="hidden" value="{{$usertype}}" id="usertype">

  <div class="video-call-container">
    <!-- Remote User's Video -->
    <div class="remote-video" id="remote-video">
        
    </div>
    <!-- live lable -->
    <div class="live-info">
      <div class="live-label">
        <span class="live-badge">LIVE</span>
        <span class="viewers-count" id="viewers-count">0 viewers</span>
        @if($usertype == "sender")
        <span class="end-stream">END</span>
        @endif
      </div>
    </div>
    <!-- end live lable -->
    <!-- comment section -->
    <div class="comments-section">
      
     
      <!-- More comments will go here -->
    </div>
    @if($usertype == 'sender')
    <!-- options  -->
    <div class="options-menu">
      <!-- <button class="btn btn-secondary dropdown-toggle" type="button" id="optionsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-ellipsis-v"></i> 
      </button> -->
      <i class="fas fa-ellipsis-v dropdown-toggle" id="optionsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i> <!-- The options icon (3 dots) -->
      <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="optionsDropdown">
        <li><a class="dropdown-item" href="#">Viewing Users</a></li>
        <li><a class="dropdown-item" href="#">Option 2</a></li>
        <li><a class="dropdown-item" href="#">Option 3</a></li>
      </ul>
    </div>
    @endif
    @if($usertype == 'sender')
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
      <!-- <button id="end-call" class="control-btn end">
        <i class="fas fa-phone-slash"></i>
      </button> -->
    </div>

    @else

    <div class="messagebox">
      <input type="text" placeholder="Enter Comment" id="comment-input">
      <button><img src="{{ asset("assets/images/send.png")}}" alt="" style="height: 24px;" onclick="sendComment()"></button>
      
    </div>
    
    @endif
  </div>
<!-- Fullscreen Popup -->
<div class="fullscreen-popup" id="startPopup">
    @if($usertype == "sender")
      @if($streamStatus == "1")
      <button>You Have Ended Stream</button>
      @else
      <button id="confirmStart">Start a Live Stream</button>
      @endif
    
    @else
    <button id="confirmJoin">Join  Live Stream</button>
    @endif
   
  </div>

  <script src="https://cdn.agora.io/sdk/release/AgoraRTC_N.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.socket.io/4.0.0/socket.io.min.js"></script>

<script>

//const socket = io('{{env('SOCKET_IO_SERVER_URL')}}'); 

const socket = io('{{env('SOCKET_IO_SERVER_URL')}}', {
  transports: ['polling', 'websocket'] // or ['polling'] or ['websocket', 'polling']
});
let localTrack, remoteTrack, localVideoTrack;
let isAudioMuted = false;
let isVideoMuted = false;
let videoDevices = [];
let currentCamera = 0; // Keeps track of which camera is currently active

const appId = '196d749c65c242a880352e012bdc2724';
const token = document.getElementById("agoraToken").value;
const usertype = document.getElementById("usertype").value;
const channelName = 'video-stream';
const uid = document.getElementById("uuid").value;
const roomid = "live-stream-"+"{{ $id }}";

const client = AgoraRTC.createClient({ mode: "rtc", codec: "vp8" });
var beforeUnloadTimeout = 0;
var isCancel = false; // Flag to check if the user canceled the action
async function startStream() {

    try {
        socket.emit('joinRoom', {usertype:usertype,roomid:roomid});
        await client.join(appId, channelName, token, 0);
        console.log('User ' + uid + ' joined channel successfully');
        
        if (usertype === "sender") {
            // Get all video devices (cameras)
            videoDevices = await AgoraRTC.getCameras();

            // Create local audio and video tracks
            const [localAudioTrack, localVideoTrack] = await AgoraRTC.createMicrophoneAndCameraTracks(); 

            // Play local video in 'remote-video' container (for sender to see their own video)
            localVideoTrack.play('remote-video');

            // Publish local tracks to the channel
            await client.publish([localAudioTrack, localVideoTrack]);

            localTrack = { audioTrack: localAudioTrack, videoTrack: localVideoTrack };

        } else if (usertype === "receiver") {
            // The receiver will just subscribe to the sender's stream
            client.on('user-published', async (user, mediaType) => {
                await client.subscribe(user, mediaType);
                console.log('Subscribed to remote user:', user);

                if (mediaType === 'video') {
                    const remoteVideoTrack = user.videoTrack;
                    // Play the remote video stream in 'remote-video' container
                    remoteVideoTrack.play('remote-video');
                }

                if (mediaType === 'audio') {
                    const remoteAudioTrack = user.audioTrack;
                    // Play remote audio (audio is usually played without a container)
                    remoteAudioTrack.play();
                }
            });
        }

    } catch (error) {
        console.error('Error joining the channel:', error);
    }
}




socket.on('viewerUpdate', (data) => {
      document.getElementById('viewers-count').textContent = `${data.viewers} Viewers`;
});
socket.on('newComment', (data) => {
    const { username, message, timestamp } = data;
    var html = '<div class="comment"><i class="fa-solid fa-user"></i><strong>'+username+'</strong><p>'+message+'</p></div>';
    $(".comments-section").append(html);
});


function sendComment(){
  if($("#comment-input").val()!=''){
    socket.emit('comment', {
        room: roomid,  // Specify the room
        message: $("#comment-input").val(),
        username: "testingUsername"
    });
    $("#comment-input").val("");
  }
}
function autoScrollComments() {
      var $commentBox = $('.comments-section');
      var scrollHeight = $commentBox[0].scrollHeight; // Get the total scrollable height
      var currentScrollTop = $commentBox.scrollTop(); // Get the current scroll position

      // If the scroll has not reached the bottom, scroll down
      if (currentScrollTop + $commentBox.innerHeight() < scrollHeight) {
          $commentBox.animate({
              scrollTop: currentScrollTop + 50  // Scroll by 50px each time
          }, 1000); // Scroll duration 1 second
      }
  }
setInterval(autoScrollComments, 2000);



$("#confirmJoin").click(function() {
    $(".fullscreen-popup").css("display", "none");
    startStream();
});

$("#comment-input").keyup(function(){
  if (event.key === 'Enter' || event.keyCode === 13) {
      event.preventDefault(); // Prevent default behavior (like submitting a form)
      sendComment();
  }
})




</script>
@if($usertype == 'sender')
<script>
    setInterval(() => {
      updateUserStatusOnline();
    }, 5000);

    $("#confirmStart").click(function() {
        $(".fullscreen-popup").css("display", "none");
        startStream();
    });
    function updateUserStatusOnline() {
      socket.emit('user_is_live',{userId:uid});
    }
    document.getElementById('camera-toggle').onclick = function () {
      if (!isVideoMuted) {
          localTrack.videoTrack.setMuted(true);
          isVideoMuted = true;
          document.querySelector('#camera-toggle i').classList.replace('fa-video', 'fa-video-slash');
      } else {
          localTrack.videoTrack.setMuted(false);
          isVideoMuted = false;
          document.querySelector('#camera-toggle i').classList.replace('fa-video-slash', 'fa-video');
      }
    };

    const beforeUnloadListener = (event) => {
        //Send something to back end
        console.log("event call");
        fetch("http://127.0.0.1:8000/update-user/"+uid);
    };
    window.addEventListener("beforeunload", beforeUnloadListener);
</script>
@endif
</body>
</html>
