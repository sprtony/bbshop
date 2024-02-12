//VITE PUEDE CARGAR IMAGENES
import.meta.glob(["../images/**"]);

// import Echo from 'laravel-echo';
// import Pusher from 'pusher-js';

// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
//
import * as Taos from "taos";
window.Taos = Taos;
