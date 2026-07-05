<div id="dark-overlay" class="hidden fixed inset-0 bg-black/60 z-[998]" aria-hidden="true"></div>

<div id="cookie-overlay"
    class="hidden fixed bottom-0 inset-x-0 z-[999] p-4 sm:p-6"
    role="dialog"
    aria-labelledby="cookie-title"
    aria-describedby="cookie-desc">
    <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-2xl p-5 sm:p-6 text-center sm:text-left sm:flex sm:items-center sm:gap-6">
        <div class="flex-1">
            <p id="cookie-title" class="font-semibold text-gray-900">Usamos cookies</p>
            <p id="cookie-desc" class="text-sm text-gray-600 mt-1">
                Este sitio utiliza cookies para mejorar tu experiencia. Al continuar, aceptas su uso.
            </p>
        </div>
        <div class="mt-4 sm:mt-0 flex flex-col sm:flex-row gap-2 shrink-0">
            <button type="button" onclick="acceptCookies()"
                class="px-5 py-2 text-sm font-semibold text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 transition-colors">
                Aceptar
            </button>
            <a href="{{ route('politicas.cookies.privacidad') }}"
                class="px-5 py-2 text-sm font-medium text-indigo-600 border border-indigo-200 rounded-lg hover:bg-indigo-50 transition-colors">
                Más información
            </a>
        </div>
    </div>
</div>

<script>
    function acceptCookies() {
        document.cookie = "cookie_accepted=true; expires=" + new Date(Date.now() + 30 * 24 * 60 * 60 * 1000).toUTCString() + "; path=/";
        document.getElementById('cookie-overlay').classList.add('hidden');
        document.getElementById('dark-overlay').classList.add('hidden');
    }

    document.addEventListener('DOMContentLoaded', function () {
        if (!document.cookie.includes('cookie_accepted=true')) {
            document.getElementById('cookie-overlay').classList.remove('hidden');
            document.getElementById('dark-overlay').classList.remove('hidden');
        }
    });
</script>
