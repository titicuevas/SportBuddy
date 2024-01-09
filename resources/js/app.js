import Alpine from "alpinejs";
/* import Echo from "laravel-echo";
import Pusher from "pusher-js"; */
import "flowbite";

window.Alpine = Alpine;
Alpine.start();

/* window.Pusher = Pusher;

window.Pusher = require("pusher-js");

window.Echo = new Echo({
    broadcaster: "pusher",
    key: process.env.MIX_PUSHER_APP_KEY,
    wsHost: window.location.hostname,
    wsPort: 6001,
    forceTLS: false,
    disableStats: true,
}); */

/* if (typeof process !== "undefined") {
    window.Echo = new Echo({
        broadcaster: "pusher",
        key: process.env.MIX_PUSHER_APP_KEY,
        cluster: process.env.MIX_PUSHER_APP_CLUSTER,
        forceTLS: true,
    });
}
 */
