<x-guest-layout>
    {{-- Hero --}}
    <section class="relative min-h-[75vh] flex items-center overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center"
            style="background-image: url('https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&w=1920&q=80');">
        </div>
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-900/85 via-indigo-800/75 to-emerald-800/70"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
            <p class="inline-block mb-4 px-4 py-1.5 text-sm font-medium text-emerald-200 bg-white/10 backdrop-blur-sm rounded-full border border-white/20">
                Tu comunidad deportiva
            </p>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white leading-tight max-w-4xl mx-auto">
                Encuentra dónde y con quién jugar
            </h1>
            <p class="mt-6 text-lg sm:text-xl text-indigo-100 max-w-2xl mx-auto">
                Publica partidos, reserva pistas y conoce nuevos compañeros de deporte en minutos.
            </p>
            <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('register') }}"
                    class="w-full sm:w-auto px-8 py-3.5 text-base font-semibold text-indigo-700 bg-white rounded-xl hover:bg-indigo-50 shadow-lg hover:shadow-xl transition-all">
                    Empezar gratis
                </a>
                <a href="{{ route('login') }}"
                    class="w-full sm:w-auto px-8 py-3.5 text-base font-semibold text-white border-2 border-white/40 rounded-xl hover:bg-white/10 transition-colors">
                    Ya tengo cuenta
                </a>
            </div>
        </div>
    </section>

    {{-- Features --}}
    <section class="py-16 sm:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900">¿Por qué SportBuddy?</h2>
                <p class="mt-3 text-lg text-gray-600 max-w-2xl mx-auto">
                    Todo lo que necesitas para organizar y unirte a partidos cerca de ti.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-6 rounded-2xl bg-gradient-to-br from-indigo-50 to-white border border-indigo-100 shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-indigo-600 text-white mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Encuentra partidos</h3>
                    <p class="mt-2 text-gray-600">Descubre encuentros cerca de ti: fútbol, pádel, baloncesto y más.</p>
                </div>

                <div class="p-6 rounded-2xl bg-gradient-to-br from-emerald-50 to-white border border-emerald-100 shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-emerald-600 text-white mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Conoce gente nueva</h3>
                    <p class="mt-2 text-gray-600">Únete a equipos, chatea con jugadores y amplía tu círculo deportivo.</p>
                </div>

                <div class="p-6 rounded-2xl bg-gradient-to-br from-blue-50 to-white border border-blue-100 shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-blue-600 text-white mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Reserva en minutos</h3>
                    <p class="mt-2 text-gray-600">Elige pista, hora y deporte. Publica tu partido de forma sencilla.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA split --}}
    <section class="py-16 sm:py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900">
                        Organizar un partido nunca fue tan fácil
                    </h2>
                    <p class="mt-4 text-lg text-gray-600">
                        Crea tu partido, invita jugadores y gestiona pagos desde una sola plataforma.
                        Nuestra comunidad está lista para jugar contigo.
                    </p>
                    <a href="{{ route('register') }}"
                        class="inline-block mt-8 px-8 py-3 font-semibold text-white bg-gradient-to-r from-indigo-600 to-emerald-500 rounded-xl hover:opacity-90 shadow-md transition-opacity">
                        Crear mi cuenta
                    </a>
                </div>
                <div class="relative rounded-2xl overflow-hidden shadow-2xl aspect-video">
                    <img src="https://images.unsplash.com/photo-1529900748604-07564a03e7a6?auto=format&fit=crop&w=800&q=80"
                        alt="Jugadores en un partido de fútbol"
                        class="w-full h-full object-cover"
                        loading="lazy">
                </div>
            </div>
        </div>
    </section>

    {{-- Final CTA --}}
    <section class="py-16 bg-gradient-to-r from-indigo-600 via-indigo-500 to-emerald-500">
        <div class="max-w-3xl mx-auto px-4 text-center">
            <h2 class="text-3xl sm:text-4xl font-bold text-white">¿Listo para jugar?</h2>
            <p class="mt-4 text-lg text-indigo-100">
                Únete a SportBuddy y encuentra tu próximo partido hoy mismo.
            </p>
            <a href="{{ route('register') }}"
                class="inline-block mt-8 px-10 py-3.5 font-semibold text-indigo-700 bg-white rounded-xl hover:bg-indigo-50 shadow-lg transition-colors">
                Registrarse ahora
            </a>
        </div>
    </section>
</x-guest-layout>
