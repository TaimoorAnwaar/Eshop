// resources/js/app.js

import './bootstrap';
import Echo from 'laravel-echo';

var pusher = new Pusher(window.PUSHER_KEY, {  // Use dynamic key from the Blade template
  cluster: 'ap2'
});
// Initialize Echo with Pusher
window.Echo = new Echo({
  broadcaster: 'pusher',
  key: window.PUSHER_KEY,  // Use the dynamic key
  cluster: 'ap2',
  forceTLS: true
});

window.Echo.channel('chat.' + userId) 
    .listen('MessageSent', (data) => {
        alert('New message from ' + data.message.sender_name + ': ' + data.message.text);
    });
