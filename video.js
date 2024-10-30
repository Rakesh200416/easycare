// Signaling server (replace with your WebSocket server URL)
const signalingServerURL = "wss://your-websocket-server.com";
const startButton = document.getElementById("startButton");
const hangupButton = document.getElementById("hangupButton");
const muteButton = document.getElementById("muteButton");
const videoButton = document.getElementById("videoButton");
const localVideo = document.getElementById("localVideo");
const remoteVideo = document.getElementById("remoteVideo");
const statusDiv = document.getElementById("status");

let localStream;
let peerConnection;
const signalingServer = new WebSocket(signalingServerURL);

// Media constraints
const mediaConstraints = { video: true, audio: true };

// Update status function
function updateStatus(status) {
    statusDiv.textContent = status;
}

// WebSocket event handling
signalingServer.onopen = () => updateStatus("Connected to signaling server");
signalingServer.onclose = () => updateStatus("Disconnected from signaling server");

signalingServer.onmessage = async (message) => {
    const data = JSON.parse(message.data);

    if (data.offer) {
        await peerConnection.setRemoteDescription(new RTCSessionDescription(data.offer));
        const answer = await peerConnection.createAnswer();
        await peerConnection.setLocalDescription(answer);
        signalingServer.send(JSON.stringify({ answer }));
    } else if (data.answer) {
        await peerConnection.setRemoteDescription(new RTCSessionDescription(data.answer));
    } else if (data.candidate) {
        await peerConnection.addIceCandidate(new RTCIceCandidate(data.candidate));
    }
};

// Start call function
startButton.onclick = async () => {
    startButton.disabled = true;
    hangupButton.disabled = false;
    muteButton.disabled = false;
    videoButton.disabled = false;
    localStream = await navigator.mediaDevices.getUserMedia(mediaConstraints);
    localVideo.srcObject = localStream;

    peerConnection = createPeerConnection();
    localStream.getTracks().forEach((track) => peerConnection.addTrack(track, localStream));

    const offer = await peerConnection.createOffer();
    await peerConnection.setLocalDescription(offer);
    signalingServer.send(JSON.stringify({ offer }));
    updateStatus("Calling...");
};

// Hang up call
hangupButton.onclick = () => {
    peerConnection.close();
    signalingServer.close();
    localVideo.srcObject = null;
    remoteVideo.srcObject = null;
    startButton.disabled = false;
    hangupButton.disabled = true;
    muteButton.disabled = true;
    videoButton.disabled = true;
    updateStatus("Call Ended");
};

// Mute/Unmute functionality
muteButton.onclick = () => {
    const audioTrack = localStream.getAudioTracks()[0];
    audioTrack.enabled = !audioTrack.enabled;
    muteButton.textContent = audioTrack.enabled ? "Mute" : "Unmute";
};

// Toggle Video functionality
videoButton.onclick = () => {
    const videoTrack = localStream.getVideoTracks()[0];
    videoTrack.enabled = !videoTrack.enabled;
    videoButton.textContent = videoTrack.enabled ? "Turn Video Off" : "Turn Video On";
};

// Create PeerConnection and add event listeners
function createPeerConnection() {
    const pc = new RTCPeerConnection();

    pc.onicecandidate = (event) => {
        if (event.candidate) {
            signalingServer.send(JSON.stringify({ candidate: event.candidate }));
        }
    };

    pc.ontrack = (event) => {
        remoteVideo.srcObject = event.streams[0];
        updateStatus("Connected");
    };

    return pc;
}