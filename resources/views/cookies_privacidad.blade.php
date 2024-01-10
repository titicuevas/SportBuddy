<x-guest-layout>

    <x-slot name="header">
        <!DOCTYPE html>

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Políticas de Cookies y Privacidad</title>
            <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        </head>
    </x-slot>

    <x-slot name="slot">
        <!-- Contenido -->
        <div class="bg-gray-100 py-8">

            <div class="container bg-gray-200 mx-auto px-4 sm:px-6 lg:px-8">
                <h1 class="text-4xl text-center font-bold mb-4">Política de Cookies</h1>

                <div class="text-gray-800">
                    <h2 class="text-2xl font-bold mt-4 mb-2">¿Qué son las cookies?</h2>
                    <p>Las cookies son pequeños archivos de texto que se descargan en tu ordenador o dispositivo móvil
                        cuando visitas una página web. Las cookies permiten a la página web recordar tus acciones y
                        preferencias (como tu idioma, tamaño de letra y otras opciones de visualización) durante un
                        período de tiempo, para que no tengas que volver a introducirlas cada vez que vuelves a la
                        página o navegas de una página a otra.</p>

                    <h2 class="text-2xl font-bold mt-4 mb-2">¿Qué tipos de cookies utilizamos?</h2>
                    <ul class="list-disc ml-6 mt-2">
                        <li><strong>Cookies necesarias:</strong> Estas cookies son esenciales para que la página web
                            funcione correctamente. Permiten a la página web recordar tus acciones y preferencias (como
                            tu idioma, tamaño de letra y otras opciones de visualización) durante un período de tiempo,
                            para que no tengas que volver a introducirlas cada vez que vuelves a la página o navegas de
                            una página a otra.</li>
                        <li><strong>Cookies de rendimiento:</strong> Estas cookies recopilan información sobre cómo
                            utilizas la página web, como las páginas que visitas más a menudo y los errores que se
                            producen. Esta información se utiliza para mejorar el rendimiento de la página web y
                            proporcionar una mejor experiencia de usuario.</li>
                        <li><strong>Cookies de marketing:</strong> Estas cookies se utilizan para mostrarte anuncios
                            relevantes y de interés para ti. Se basan en tus intereses y en la información de navegación
                            que recopilamos sobre ti.</li>
                    </ul>

                    <h2 class="text-2xl font-bold mt-4 mb-2">¿Cómo puedo controlar las cookies?</h2>
                    <ul class="list-disc ml-6 mt-2">
                        <li><strong>A través de tu navegador:</strong> Puedes configurar tu navegador para aceptar o
                            rechazar todas las cookies, o para recibir un aviso antes de que se instale una cookie. La
                            configuración de cada navegador es diferente, por lo que te recomendamos que consultes la
                            guía del navegador que utilices para obtener más información.</li>
                        <li><strong>A través de nuestra página web:</strong> Puedes aceptar o rechazar todas las
                            cookies, o elegir qué tipos de cookies quieres permitir, en el banner de cookies que aparece
                            al acceder a nuestra página web.</li>
                    </ul>

                    <h2 class="text-2xl font-bold mt-4 mb-2">¿Cómo puedo eliminar las cookies?</h2>
                    <p>Puedes eliminar las cookies de tu ordenador o dispositivo móvil en cualquier momento. La forma de
                        hacerlo depende del navegador que utilices. Consulta la guía del navegador que utilices para
                        obtener más información.</p>

                    <h2 class="text-2xl font-bold mt-4 mb-2">¿Cómo protegemos tu privacidad?</h2>
                    <p>Tu privacidad es importante para nosotros. Utilizamos las cookies de acuerdo con la normativa de
                        protección de datos aplicable, como el Reglamento general de protección de datos (RGPD).</p>

                    <div x-data="{ openWindow: () => window.open('{{ route('politicas.privacidad') }}', '_blank', 'width=600,height=600,top=screen.height/2-200,left=screen.width/2-300') }" class="mt-4">
                        <p>Para más información sobre cómo protegemos tu privacidad, consulta nuestra <a
                                href="javascript:void(0)" class="text-blue-500 hover:underline"
                                x-on:click.prevent="openWindow()">política de privacidad</a>.</p>
                    </div>

                </div>
            </div>

            {{-- <!-- Botón Volver -->
            <div class="flex justify-center mt-8">
                <a href="{{ route('welcome') }}"
                    class="bg-gray-500 text-white px-6 py-3 rounded hover:bg-gray-600">Volver</a>
            </div> --}}

            <!-- Botón Mejorado -->
            <div class="flex justify-center mt-8">
                <button onclick="window.location.href='{{ route('welcome') }}'"
                    class="bg-gray-500 text-white px-6 py-3 rounded hover:bg-gray-600">Volver</button>
            </div>
        </div>
    </x-slot>

</x-guest-layout>
