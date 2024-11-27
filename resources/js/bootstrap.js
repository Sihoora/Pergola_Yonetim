import _ from 'lodash';
window._ = _;

import axios from 'axios';
window.axios = axios;

// Laravel Echo ve Pusher importları
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
    encrypted: true, // Ekstra güvenlik için
});

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';