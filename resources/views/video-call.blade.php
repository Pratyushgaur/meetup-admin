<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <video id="local-video" autoplay playsinline></video>
        <video id="remote-video" autoplay playsinline></video>
    </div>
    <script src="https://cdn.zegocloud.com/rtc/sdk/ZegoExpress-WebRTC-Latest.js"></script>
    <script>
        const appID = {{ env('ZEGO_APP_ID') }};  // ZEGOCLOUD App ID from .env
        let token;

        const userID = Math.floor(Math.random() * 100000);  // Unique user ID (can be dynamic)
        const roomID = 'testingvideocall';  // Room ID for video call
        
        // Fetch the token from Laravel API
        fetch(`/generate_token?user_id=${userID}`)
            .then(response => response.json())
            .then(data => {
                token = data.token;

                // Initialize ZEGOCLOUD
                const zg = new ZegoExpressEngine(appID, { server: 'wss://webliveroom-api.zego.im/ws' });

                // Login to the room
                zg.loginRoom(roomID, token, { userID, userName: 'Your Username' }, { userUpdate: true }).then(() => {
                    // Publish local stream
                    zg.startPublishingStream('your_stream_id');
                    zg.startPlayingStream('your_stream_id', document.getElementById('local-video'));
                });

                // Listen for remote stream updates
                zg.on('roomStreamUpdate', (type, streamList) => {
                    if (type === 'ADD') {
                        zg.startPlayingStream(streamList[0].streamID, document.getElementById('remote-video'));
                    }
                });
            })
            .catch(error => console.error('Error generating token:', error));
    </script>

</body>
</html>