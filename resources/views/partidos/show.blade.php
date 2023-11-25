<x-app-layout>


    <div class="flex flex-col space-y-4">

        <!-- Parte 1 con fondo azul -->
        <div class="bg-blue-200 p-6 rounded-lg flex space-x-4">

            <!-- Sección 1: Datos del partido -->
            <div class="flex-1">
                <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">Datos del partido</h1>
                    <div class="mb-6">
                        <label for="fecha" class="block mb-2 text-lg font-bold text-black">Fecha:</label>
                        <p class="text-gray-700">{{ \Carbon\Carbon::parse($partido->fecha)->format('d-m-Y') }}</p>
                    </div>

                    <div class="mb-6">
                        <label for="hora" class="block mb-2 text-lg font-bold text-black">Hora:</label>
                        <p class="text-gray-700">{{ \Carbon\Carbon::parse($partido->hora)->format('H:i') }}</p>
                    </div>

                    <div class="mb-6">
                        <label for="creador" class="block mb-2 text-lg font-bold text-black">Creador:</label>
                        <a href="{{ route('user.show', $partido->user) }}"
                            class="text-blue-500 hover:text-blue-700 underline">
                            <p class="text-gray-700">{{ $partido->user->name }}</p>
                        </a>
                    </div>

                    <div class="mb-6">
                        <label for="ubicacion" class="block mb-2 text-lg font-bold text-black">Ubicación:</label>
                        <a href="{{ $partido->ubicacion->enlace_maps }}" target="_blank"
                            class="text-blue-500 hover:text-blue-700 underline">
                            {{ $partido->ubicacion->nombre }}
                        </a>
                    </div>

                    <div class="mb-6">
                        <label for="deporte" class="block mb-2 text-lg font-bold text-black">Deporte:</label>
                        <p class="text-gray-700">{{ $partido->deporte->nombre }}</p>
                    </div>
                </div>
            </div>

            <!-- Sección 2: Mapa con fondo amarillo -->
            <div class="flex-1">
                <div class="p-6 bg-yellow-200 rounded-lg">
                    <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <p class="text-lg font-bold text-black">Aquí va el mapa</p>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2133.067183138113!2d-6.372765335893901!3d36.770816663270196!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd0ddfcdb6c94397%3A0x3a4243307e5894d8!2sPadel%20La%20Jara!5e0!3m2!1ses!2ses!4v1700935465670!5m2!1ses!2ses" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>

        </div>

        <!-- Parte 2 dividida en dos con fondo verde -->
        <div class="bg-green-200 p-6 rounded-lg flex space-x-4">

            <!-- Parte 2.1 - EQUIPO 1 -->
            <div class="flex-1">
                <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <h2 class="text-2xl font-bold text-black mb-4">EQUIPO 1</h2>
                    <!-- Contenido específico para EQUIPO 1 -->
                </div>
            </div>

            <!-- Parte 2.2 - EQUIPO 2 -->
            <div class="flex-1">
                <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <h2 class="text-2xl font-bold text-black mb-4">EQUIPO 2</h2>
                    <!-- Contenido específico para EQUIPO 2 -->
                </div>
            </div>

        </div>

    </div>

    </div>


</x-app-layout>
