const client = AgoraRTC.createClient({ mode: "rtc", codec: "vp8" });

let localTrack, remoteTrack;
let isAudioMuted = false;
let isVideoMuted = false;
let videoDevices = [];
let currentCamera = 0; // Keeps track of which camera is currently active

const appId = '196d749c65c242a880352e012bdc2724';
const token = document.getElementById("agoraToken").value;

const channelName = 'video-test';
const uid = document.getElementById("uuid").value;

document.getElementById("make-call").addEventListener('click', async () => {
    try {
        $(".join-container").remove();
        await client.join(appId, channelName, token,0);
        console.log('User ' + uid + ' joined channel successfully');
        
        // Get all video devices (cameras)
        videoDevices = await AgoraRTC.getCameras();

        // Create local audio and video tracks
        const [localAudioTrack, localVideoTrack] = await AgoraRTC.createMicrophoneAndCameraTracks(); 

        // Play local video
        localVideoTrack.play('local-video');

        // Publish local tracks to the channel
        await client.publish([localAudioTrack, localVideoTrack]);

        localTrack = { audioTrack: localAudioTrack, videoTrack: localVideoTrack };

        client.on('user-published', async (user, mediaType) => {
            await client.subscribe(user, mediaType);
            console.log('Subscribed to remote user:', user);

            if (mediaType === 'video') {
                const remoteVideoTrack = user.videoTrack;
                remoteVideoTrack.play('remote-video');
                
            }
            if (mediaType === 'audio') {
                const remoteAudioTrack = user.audioTrack;
                remoteAudioTrack.play();
            }
        });

    } catch (error) {
        console.error('Error joining the channel:', error);
    }
    
    
})


// Leave Channel
document.getElementById('end-call').onclick = async function () {
    try {
        // Stop local tracks
        if (localTrack) {
            localTrack.audioTrack.stop();
            localTrack.videoTrack.stop();
        }

        // Leave the channel
        await client.leave();
        console.log('Left the channel successfully');
        //window.location.reload();
        window.history.back();
    } catch (error) {
        console.error('Error leaving the channel:', error);
    }
};

// Mute/Unmute Audio
document.getElementById('mute-audio').onclick = function () {
    if (!isAudioMuted) {
        localTrack.audioTrack.setMuted(true);
        isAudioMuted = true;
        document.querySelector('#mute-audio i').classList.replace('fa-microphone', 'fa-microphone-slash');
    } else {
        localTrack.audioTrack.setMuted(false);
        isAudioMuted = false;
        document.querySelector('#mute-audio i').classList.replace('fa-microphone-slash', 'fa-microphone');
    }
};

// Mute/Unmute Video
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

// Switch Camera
document.getElementById('switch-camera').onclick = async function () {
    if (videoDevices.length > 1) {
        currentCamera = (currentCamera + 1) % videoDevices.length; // Toggle between cameras

        try {
            // Switch to the next camera
            await localTrack.videoTrack.setDevice(videoDevices[currentCamera].deviceId);
            console.log('Switched to camera:', videoDevices[currentCamera].label);
        } catch (error) {
            console.error('Error switching camera:', error);
        }
    } else {
        console.log('No alternative camera to switch to.');
    }
};



