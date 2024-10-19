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
    .loader-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: rgba(0, 0, 0, 0.4); /* Slightly transparent background */
        z-index: 9999; /* To ensure it's on top */
        display:none;
    }
    .loader-container h4{
        color:#fff;
        margin-left:5px;
    }

        /* Loader styles */
    .loader {
        border: 5px solid #f3f3f3;
        border-top: 5px solid #333;
        border-radius: 50%;
        width: 15px;
        height: 15px;
        animation: spin 2s linear infinite;
    }

        /* Animation for loader */
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

  </style>
</head>
<body>
    <div class="loader-container">
        <div class="loader"></div>
        <br>
        <h4>Connecting..</h4>
    </div>
  <div class="video-call-container">
    <!-- Remote User's Video -->
    <div class="remote-video" id="remote-video">
            <div class="join-container">    
                <button class="btn btn-primary " id="make-call">Join</button>
            </div>
    </div>

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
  

  <script src="https://cdn.agora.io/sdk/release/AgoraRTC_N.js"></script>
<script src="{{URL::to('video-call/videocall.js')}}"></script>
  <script src="https://cdn.socket.io/4.0.0/socket.io.min.js"></script>
  <script>
    $("#join-modal").modal('show');
     const socket = io('http://localhost:3000'); // Replace with your server address
     let userId = "{{ $senderData->id}}";
     let requestId = "{{ $receiverData->id}}";
     let usertype = "{{ $usertype }}";
     let url = "{{ $url }}";
     socket.on('connect',()=>{
        
        
        if(usertype == 'sender'){
            
            socket.emit('client-connect',{userid:userId});
            socket.emit('request-to-connect',{requestUserId:requestId,url:url});
            
        }
        
        
     });

</script>
  <script src="app.js"></script>
</body>
</html>
