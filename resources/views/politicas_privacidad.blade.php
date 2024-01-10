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
        <div class="container bg-gray-200 mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl text-center font-bold mb-4">Política de Privacidad</h1>



            <p class="mb-4">Esta Política de Privacidad describe cómo SportBuddy recopila, utiliza y protege la
                información personal que usted proporciona en nuestro sitio web. La seguridad de su información es
                nuestra prioridad; por lo tanto, le pedimos que lea detenidamente esta política antes de compartir
                cualquier dato personal con nosotros.</p>

            <h2 class="text-2xl font-bold mt-4 mb-2">Información que recopilamos:</h2>
            <ul class="list-disc ml-6 mb-4">
                <li>Nombre y apellidos</li>
                <li>Dirección de correo electrónico</li>
                <li>Información de contacto</li>
                <li>Otros datos personales que pueda proporcionar voluntariamente</li>
            </ul>

            <h2 class="text-2xl font-bold mt-4 mb-2">Uso de la información:</h2>
            <ul class="list-disc ml-6 mb-4">
                <li>Personalizar su experiencia en nuestro sitio.</li>
                <li>Mejorar nuestro sitio web y servicios.</li>
                <li>Enviarle información y actualizaciones relacionadas con su solicitud.</li>
                <li>Administrar concursos, promociones u otras funciones del sitio.</li>
            </ul>

            <h2 class="text-2xl font-bold mt-4 mb-2">Protección de la información:</h2>
            <p class="mb-4">Implementamos medidas de seguridad para proteger la confidencialidad de su información
                personal. Sin embargo, no podemos garantizar la seguridad completa de la información transmitida por
                Internet.</p>

            <h2 class="text-2xl font-bold mt-4 mb-2">Divulgación a terceros:</h2>
            <p class="mb-4">No vendemos, intercambiamos ni transferimos su información personal a terceros sin su
                consentimiento, excepto cuando sea necesario para cumplir con requisitos legales.</p>

            <h2 class="text-2xl font-bold mt-4 mb-2">Enlaces a terceros:</h2>
            <p class="mb-4">Nuestro sitio web puede contener enlaces a sitios de terceros. No somos responsables de
                las prácticas de privacidad de estos sitios y le recomendamos que lea sus políticas de privacidad.</p>

            <p class="mb-4">Al utilizar nuestro sitio, usted acepta los términos de esta política de privacidad.</p>

            <h2 class="text-2xl font-bold mt-4 mb-2">Cambios en la política:</h2>
            <p class="mb-4">Nos reservamos el derecho de actualizar esta política en cualquier momento. Se le
                notificarán los cambios a través de la dirección de correo electrónico proporcionada, o mediante un
                aviso destacado en nuestro sitio web.</p>

            <p>Si tiene alguna pregunta sobre esta política de privacidad, no dude en ponerse en contacto con nosotros
                en <a href="mailto:sportbuddy@gmail.com" class="text-blue-500 hover:underline">sportbuddy@gmail.com</a>.
            </p>
        </div>

        {{--  <!-- Botón Mejorado -->
         <div class="flex justify-center mt-8">
            <button onclick="window.location.href='{{ route('welcome') }}'"
                class="bg-gray-500 text-white px-6 py-3 rounded hover:bg-gray-600">Volver</button>
        </div> --}}

    </x-slot>

</x-guest-layout>
