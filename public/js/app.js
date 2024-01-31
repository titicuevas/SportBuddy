import Alpine from "alpinejs";
import Echo from "laravel-echo";
import "flowbite";

window.Alpine = Alpine;
Alpine.start();

window.Echo = new Echo({
    broadcaster: "pusher",
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: true,
    forceTLS: true,
});
