import Echo from "laravel-echo";

import Pusher from "pusher-js";
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "reverb",
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST || "srv656676.hstgr.cloud",
    wsPort: null,
    wssPort: 443,
    forceTLS: true,
    enabledTransports: ["ws", "wss"],
    encrypted: true,
});
