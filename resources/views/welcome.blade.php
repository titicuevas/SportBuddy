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


                <!-- Dark Overlay -->
                <div id="dark-overlay"
                    style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.8); z-index: 998;">
                </div>

                <!-- Cookie Overlay -->
                <div id="cookie-overlay"
                    style="display: none; position: fixed; bottom: 0; left: 0; width: 100%; background: rgba(255, 255, 255, 0.9); z-index: 999; color: black; text-align: center; padding: 20px;">
                    <p>Este sitio utiliza cookies para mejorar la experiencia del usuario. Al continuar, aceptas el uso
                        de 🍪.
                    </p>
                    <button onclick="acceptCookies()"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Aceptar</button>

                    <a href="{{ route('politicas.cookies.privacidad') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Políticas Cookies y
                        Privacidad</a>
                </div>

                <script>
                    // Función para establecer la cookie y ocultar el mensaje
                    function acceptCookies() {
                        // Configura la cookie sin un tiempo de vida específico (cookie de sesión)
                        document.cookie = "acceptCookies=true; path=/";

                        // Oculta el mensaje de cookies
                        document.getElementById('cookie-overlay').style.display = 'none';

                        // También oculta el overlay oscuro
                        document.getElementById('dark-overlay').style.display = 'none';
                    }

                    // Comprueba si la cookie ya ha sido aceptada al cargar la página
                    window.onload = function() {
                        if (document.cookie.indexOf("acceptCookies=true") === -1) {
                            // La cookie no se ha aceptado, muestra el mensaje de cookies y el overlay oscuro
                            document.getElementById('cookie-overlay').style.display = 'block';
                            document.getElementById('dark-overlay').style.display = 'block';
                        }
                    };
                </script>









                <!-- Agrega esto a tu código donde quieras mostrar el icono de usuario y el menú desplegable -->
                <div class="relative inline-block text-left">
                    <div>
                        <button type="button" class="text-white hover:underline focus:outline-none"
                            onclick="toggleDropdown()">
                            <!-- Puedes personalizar este icono según tus preferencias -->
                            <img src="https://i.ibb.co/W5rQcpn/usuario.png" alt="usuario" border="0">
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
    <div x-data="{ slide: 0 }" x-init="startInterval()"
    class="bg-gray-800 text-black py-16 transition-all duration-500"
    :style="'background-image: url(' + getImageUrl(slide) +
        '); background-size: cover; background-position: center; background-repeat: no-repeat; height: 100vh;'">
    <div class="container mx-auto flex flex-col items-center">
        <h2 class="text-3xl font-bold mb-6">Busca dónde y con quién jugar a tus deportes favoritos</h2>

        <!-- Carrusel de imágenes -->
        <div class="relative w-full h-96 overflow-hidden">
            <div class="flex transition-transform ease-in-out duration-500 transform -translate-x-full"
                :style="'translateX(' + (slide * -100) + '%)'">
                        <!-- Imágenes del carrusel -->
                        <img src="https://live.staticflickr.com/6078/6110035405_894bf88cbc_b.jpg" alt="Albero"
                            class="w-full h-full object-cover bg-center bg-cover">
                        <img src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/319678569.jpg?k=90a4681b5870c3873a41afe366ccedddd860dd686aa56d5a325e81ee74cb24bf&o=&hp=1"
                            alt="Futbol7" class="w-full h-full object-cover bg-center bg-cover">
                        <img src="https://santamariaarquitectes.cat/wp-content/uploads/2019/06/camp_futbol_01.jpg"
                            alt="Campo de Fútbol" class="w-full h-full object-cover bg-center bg-cover">
                        <img src="https://news.mondoiberica.com.es/wp-content/uploads/elementor/thumbs/IMG-20171211-WA0002-p473c99lxzb0882lvv33erk8m7fwn88zr2t8litpbk.jpg"
                            alt="Futsal" class="w-full h-full object-cover bg-center bg-cover">
                        <img src="https://s3.ppllstatics.com/ideal/www/multimedia/202104/21/media/cortadas/olvio%202-kUPB-U140127566558BBD-1248x770@Ideal.jpg"
                            alt="Pista de Fútbol Sala" class="w-full h-full object-cover bg-center bg-cover">
                        <img src="https://www.pistas-padel.es/wp-content/uploads/2021/10/Construccion-pistas-padel-Espana-1024x566.jpg"
                            alt="Pádel Indoor" class="w-full h-full object-cover bg-center bg-cover">
                        <img src="https://www.padeladdict.com/wp-content/uploads/2022/11/ventajas-de-las-pistas-de-padel-interiores-frente-a-las-exteriores-portada-1068x580.jpg"
                            alt="Pista de Pádel" class="w-full h-full object-cover bg-center bg-cover">



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

                    // Cambia el fondo de la sección al mismo tiempo que cambia la imagen del carrusel
                    var section = document.querySelector('.bg-gray-800');
                    if (section) {
                        section.style.backgroundImage = 'url(' + getImageUrl(slide) + ')';
                    }
                }, 5000);
            }

            function getImageUrl(slide) {
                // Retorna la URL de la imagen correspondiente al índice del carrusel
                var images = [
                    'https://live.staticflickr.com/6078/6110035405_894bf88cbc_b.jpg',
                    'https://cf.bstatic.com/xdata/images/hotel/max1024x768/319678569.jpg?k=90a4681b5870c3873a41afe366ccedddd860dd686aa56d5a325e81ee74cb24bf&o=&hp=1',
                    'https://santamariaarquitectes.cat/wp-content/uploads/2019/06/camp_futbol_01.jpg',
                    'https://news.mondoiberica.com.es/wp-content/uploads/elementor/thumbs/IMG-20171211-WA0002-p473c99lxzb0882lvv33erk8m7fwn88zr2t8litpbk.jpg',
                    'https://s3.ppllstatics.com/ideal/www/multimedia/202104/21/media/cortadas/olvio%202-kUPB-U140127566558BBD-1248x770@Ideal.jpg',
                    'https://www.pistas-padel.es/wp-content/uploads/2021/10/Construccion-pistas-padel-Espana-1024x566.jpg',
                    'https://www.padeladdict.com/wp-content/uploads/2022/11/ventajas-de-las-pistas-de-padel-interiores-frente-a-las-exteriores-portada-1068x580.jpg'
                ];
                return images[slide];
            }

            document.addEventListener('DOMContentLoaded', startInterval);
        </script>





    </body>

    </html>

</x-guest-layout>


{{-- Sección de mensaje y video -->
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
