import Alpine from "alpinejs";
import Echo from "laravel-echo/dist/echo.common";
import Pusher from "pusher-js";
import 'flowbite';

window.Alpine = Alpine;
Alpine.start();

window.Pusher = Pusher;

if (typeof process !== "undefined") {
    window.Echo = new Echo({
        broadcaster: "pusher",
        key: process.env.MIX_PUSHER_APP_KEY,
        cluster: process.env.MIX_PUSHER_APP_CLUSTER,
        forceTLS: true,
    });
}
