/**
 * Created by crest on 14-05-2018.
 */

Pusher.logToConsole = true;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'db062e2192f2ee7a3573',
    cluster: 'ap2',
    encrypted: true,
    logToConsole: true
});

window.Echo.private('user-*')
    .listen('NewMessageNotification', (e) => {
    console.log(e.message.message);
});