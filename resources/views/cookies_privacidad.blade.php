<x-guest-layout>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-10 prose prose-indigo max-w-none">
            <h1 class="text-3xl font-bold text-center text-gray-900 mb-8">Política de cookies</h1>

            <h2 class="text-xl font-bold mt-6 mb-2">¿Qué son las cookies?</h2>
            <p class="text-gray-700">Las cookies son pequeños archivos de texto que se descargan en tu ordenador o dispositivo móvil cuando visitas una página web. Permiten recordar tus acciones y preferencias durante un período de tiempo.</p>

            <h2 class="text-xl font-bold mt-6 mb-2">¿Qué tipos de cookies utilizamos?</h2>
            <ul class="list-disc ml-6 text-gray-700 space-y-2">
                <li><strong>Necesarias:</strong> Esenciales para que la página funcione correctamente.</li>
                <li><strong>De rendimiento:</strong> Recopilan información sobre cómo utilizas el sitio para mejorar la experiencia.</li>
                <li><strong>De marketing:</strong> Se utilizan para mostrarte contenido relevante según tus intereses.</li>
            </ul>

            <h2 class="text-xl font-bold mt-6 mb-2">¿Cómo puedo controlar las cookies?</h2>
            <ul class="list-disc ml-6 text-gray-700 space-y-2">
                <li><strong>Desde tu navegador:</strong> Puedes aceptar, rechazar o recibir avisos antes de instalar cookies.</li>
                <li><strong>Desde nuestra web:</strong> Puedes aceptarlas en el banner que aparece al acceder.</li>
            </ul>

            <h2 class="text-xl font-bold mt-6 mb-2">¿Cómo protegemos tu privacidad?</h2>
            <p class="text-gray-700">Utilizamos las cookies de acuerdo con el RGPD. Consulta nuestra <a href="{{ route('politicas.privacidad') }}" class="text-indigo-600 hover:underline">política de privacidad</a>.</p>
        </div>

        <div class="flex justify-center mt-8">
            <a href="{{ route('welcome') }}"
                class="px-6 py-3 text-sm font-semibold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors">
                Volver al inicio
            </a>
        </div>
    </div>
</x-guest-layout>
