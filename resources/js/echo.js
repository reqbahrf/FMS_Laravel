import Echo from "laravel-echo";

import Pusher from "pusher-js";
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "reverb",
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST || "srv656676.hstgr.cloud",
    wsPort: import.meta.env.VITE_REVERB_PORT || 8090,
    wssPort: import.meta.env.VITE_REVERB_PORT || 8090,
    forceTLS: true,
    enabledTransports: ["ws", "wss"],
    disableStats: true,
    encrypted: true,
    cluster: "mt1",
    authEndpoint: "/broadcasting/auth",
});
