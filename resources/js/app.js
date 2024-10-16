import './bootstrap';
import Echo from "laravel-echo";
import Pusher from "pusher-js";

// Set Pusher as the broadcaster
window.Pusher = Pusher;

// Initialize Echo
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,   // Ensure you are using VITE variables here
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER, // Pusher cluster
    forceTLS: true
});