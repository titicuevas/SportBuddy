<x-guest-layout>
    <!DOCTYPE html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Políticas de Cookies y Privacidad</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>

    <body class="bg-gray-800 text-white">


        <!-- Contenido -->
        <div class="container mx-auto py-8">
            <h1 class="text-4xl font-bold mb-4">Política de Cookies</h1>

            <p><strong>¿Qué son las cookies?</strong></p>
            <p>Las cookies son pequeños archivos de texto que se descargan en tu ordenador o dispositivo móvil cuando
                visitas una página web. Las cookies permiten a la página web recordar tus acciones y preferencias (como
                tu idioma, tamaño de letra y otras opciones de visualización) durante un período de tiempo, para que no
                tengas que volver a introducirlas cada vez que vuelves a la página o navegas de una página a otra.</p>

            <p><strong>¿Qué tipos de cookies utilizamos?</strong></p>
            <ul>
                <li><strong>Cookies necesarias:</strong> Estas cookies son esenciales para que la página web funcione
                    correctamente. Permiten a la página web recordar tus acciones y preferencias (como tu idioma, tamaño
                    de letra y otras opciones de visualización) durante un período de tiempo, para que no tengas que
                    volver a introducirlas cada vez que vuelves a la página o navegas de una página a otra.</li>
                <li><strong>Cookies de rendimiento:</strong> Estas cookies recopilan información sobre cómo utilizas la
                    página web, como las páginas que visitas más a menudo y los errores que se producen. Esta
                    información se utiliza para mejorar el rendimiento de la página web y proporcionar una mejor
                    experiencia de usuario.</li>
                <li><strong>Cookies de marketing:</strong> Estas cookies se utilizan para mostrarte anuncios relevantes
                    y de interés para ti. Se basan en tus intereses y en la información de navegación que recopilamos
                    sobre ti.</li>
            </ul>

            <p><strong>¿Cómo puedo controlar las cookies?</strong></p>
            <ul>
                <li><strong>A través de tu navegador:</strong> Puedes configurar tu navegador para aceptar o rechazar
                    todas las cookies, o para recibir un aviso antes de que se instale una cookie. La configuración de
                    cada navegador es diferente, por lo que te recomendamos que consultes la guía del navegador que
                    utilices para obtener más información.</li>
                <li><strong>A través de nuestra página web:</strong> Puedes aceptar o rechazar todas las cookies, o
                    elegir qué tipos de cookies quieres permitir, en el banner de cookies que aparece al acceder a
                    nuestra página web.</li>
            </ul>

            <p><strong>¿Cómo puedo eliminar las cookies?</strong></p>
            <p>Puedes eliminar las cookies de tu ordenador o dispositivo móvil en cualquier momento. La forma de hacerlo
                depende del navegador que utilices. Consulta la guía del navegador que utilices para obtener más
                información.</p>

            <p><strong>¿Cómo protegemos tu privacidad?</strong></p>
            <p>Tu privacidad es importante para nosotros. Utilizamos las cookies de acuerdo con la normativa de
                protección de datos aplicable, como el Reglamento general de protección de datos (RGPD).</p>

            <p>Para más información sobre cómo protegemos tu privacidad, consulta nuestra <a
                    href="{{ route('politicas.privacidad') }}" class="text-blue-500 hover:underline">política de
                    privacidad</a>.</p>
        </div>

        <!-- Footer -->
        <footer class="mt-auto bg-white text-black p-4">
            <div class="container mx-auto text-center">
                <p>&copy; {{ date('Y') }} Tu Proyecto Laravel</p>
                <p>Creado por: Nombre del Creador</p>
            </div>
        </footer>
    </body>

    </html>
</x-guest-layout>
