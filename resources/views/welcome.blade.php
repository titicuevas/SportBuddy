<x-guest-layout>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tu Página</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>

    <body class="bg-black">

        <!-- Cabecera -->
        <header class="bg-blue-500 text-white p-4">
            <div class="container mx-auto flex items-center justify-between">
                <!-- Aquí coloca el icono y el texto "SportBuddy" juntos -->
                <div class="flex items-center">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                    <h1 class="text-3xl font-bold ml-2">SportBuddy</h1>
                </div>

                <!-- Agrega esto a tu código donde quieras mostrar el icono de usuario y el menú desplegable -->
                <div class="relative inline-block text-left">
                    <div>
                        <button type="button" class="text-white hover:underline focus:outline-none"
                            onclick="toggleDropdown()">
                            <!-- Puedes personalizar este icono según tus preferencias -->
                            <img src="https://i.ibb.co/q5K9P4G/usuario.png" alt="usuario" border="0">
                        </button>
                    </div>
                    <div id="dropdown"
                        class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 transition">
                        <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                            <a href="{{ route('login') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                                role="menuitem">Iniciar sesión</a>
                            <a href="{{ route('register') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                                role="menuitem">Registrarse</a>
                        </div>
                    </div>
                </div>

                <script>
                    function toggleDropdown() {
                        var dropdown = document.getElementById("dropdown");
                        dropdown.classList.toggle("hidden");
                    }
                </script>
            </div>
        </header>

        <!-- Sección de mensaje y carrusel -->
        <div class="bg-gray-800 text-white py-16">
            <div class="container mx-auto flex flex-col items-center">
                <h2 class="text-3xl font-bold mb-6">Busca donde y con quien jugar a tus deportes favoritos</h2>

                <!-- Carrusel de imágenes -->
                <div x-data="{ slide: 0 }" x-init="startInterval()">
                    <div class="relative w-full h-96 overflow-hidden">
                        <div class="flex transition-transform ease-in-out duration-500 transform -translate-x-full"
                            :style="'translateX(' + (slide * -100) + '%)'">
                            <!-- Imágenes del carrusel -->
                            <img src="https://i.ibb.co/qLHXnNh/albero.jpg" alt="Albero"
                                class="w-full h-full object-cover">
                            <img src="https://i.ibb.co/Qjt1vbM/futbol7-2.png" alt="Futbol7"
                                class="w-full h-full object-cover">
                            <img src="https://i.ibb.co/BPGxCmC/camp-futbol-01.jpg" alt="Campo de Fútbol"
                                class="w-full h-full object-cover">
                            <img src="https://i.ibb.co/BZnmFWc/futsal-2.jpg" alt="Futsal"
                                class="w-full h-full object-cover">
                            <img src="https://i.ibb.co/GnK9SvY/pista-futbol-sala.jpg" alt="Pista de Fútbol Sala"
                                class="w-full h-full object-cover">
                            <img src="https://i.ibb.co/RcmjMK8/padel-indoor-oarso-club-pistas.jpg" alt="Pádel Indoor"
                                class="w-full h-full object-cover">
                            <img src="https://i.ibb.co/TwgYWyz/pista-de-padel.jpg" alt="Pista de Pádel"
                                class="w-full h-full object-cover">
                            <!-- Puedes agregar más imágenes según sea necesario -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Script para el carrusel automático -->
        <script>
            function startInterval() {
                var slide = 0;
                setInterval(function() {
                    slide = (slide + 1) % 7;
                    var xDataElement = document.querySelector('[x-data="{ slide: 0 }"]');
                    if (xDataElement && xDataElement.__x) {
                        xDataElement.__x.$data.slide = slide;
                    }
                }, 5000);
            }

            document.addEventListener('DOMContentLoaded', startInterval);
        </script>



    </body>

    </html>

</x-guest-layout>


{{-- <!-- Sección de mensaje y video -->
        <div class="bg-gray-800 text-white py-16">
            <div class="container mx-auto flex flex-col items-center">
                <h2 class="text-3xl font-bold mb-6">Busca donde y con quien jugar a tus deportes favoritos</h2>

                <!-- Video de YouTube con Tailwind -->
                <div class="relative w-full h-96 overflow-hidden">
                    <iframe class="w-full h-full" src="https://www.youtube.com/embed/uJg1u_VUUi4?autoplay=1&mute=1"
                        frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div> --}}
