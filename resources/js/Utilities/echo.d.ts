declare module 'global' {
    interface Window {
        Pusher: typeof Pusher;
        Echo: Echo;
    }
    global {
        var Pusher: typeof Pusher;
        var Echo: Echo;
    }
}