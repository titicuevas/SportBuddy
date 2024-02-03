<x-app-layout>
    <x-slot name="header">

        <h1 class=" text-3xl text-gray-800 leading-tight text-center">
            {{ ('SportBuddy') }}
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6 text-center text-3xl">{{ __('¿Qué se te apetece hacer hoy?') }}</div>

                    <div class="flex justify-center">
                        <a href="{{ route('partidos.create') }}"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xl px-5 py-3 mr-2 mb-2">Crear</a>
                        <a href="{{ route('partidos.index') }}"
                            class="py-3 px-5 mr-2 mb-2 text-xl font-medium text-white focus:outline-none bg-green-500 rounded-lg border border-green-500 hover:bg-green-600 focus:z-10 focus:ring-4 focus:ring-green-300">Jugar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
