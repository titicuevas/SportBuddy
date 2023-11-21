<x-app-layout>

    <h1 class="text-3xl font-bold text-gray-900 mb-4">Datos del partido</h1>

    <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="mb-6">
            <label for="fecha" class="block mb-2 text-sm font-medium text-gray-900">Fecha:</label>
            <p class="text-gray-700">{{ $partido->fecha }}</p>
        </div>

        <div class="mb-6">
            <label for="hora" class="block mb-2 text-sm font-medium text-gray-900">Hora:</label>
            <p class="text-gray-700">{{ $partido->hora }}</p>
        </div>

        <div class="mb-6">
            <label for="creador" class="block mb-2 text-sm font-medium text-gray-900">Creador:</label>
            <p class="text-gray-700">{{ $partido->user->name }}</p>
        </div>

        <div class="mb-6">
            <label for="ubicacion" class="block mb-2 text-sm font-medium text-gray-900">Ubicación:</label>
            <p class="text-gray-700">{{ $partido->ubicacion->nombre }}</p>
        </div>

        <div class="mb-6">
            <label for="deporte" class="block mb-2 text-sm font-medium text-gray-900">Deporte:</label>
            <p class="text-gray-700">{{ $partido->deporte->nombre }}</p>
        </div>
    </div>

</x-app-layout>
