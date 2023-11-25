<x-app-layout>
    <x-slot name="header">
        <h2 class="font-knucklehead-slab text-xl text-gray-800 leading-tight text-center">
            <link rel="stylesheet" href="{{ asset('/public/fonts/knucklehead-slab.otf') }}">  {{-- Preguntar a Ignacio --}}

            {{ __('SportBuddy') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4 text-center">{{ __('¿Qué se te apetece hacer hoy?') }}</div>

                    <div class="flex justify-center">
                        <a href="{{ route('partidos.create') }}"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-md px-5 py-2.5 mr-2 mb-2">Crear</a>
                        <a href="{{ route('partidos.index') }}"
                            class="py-2.5 px-5 mr-2 mb-2 text-md font-medium text-white focus:outline-none bg-green-500 rounded-lg border border-green-500 hover:bg-green-600 focus:z-10 focus:ring-4 focus:ring-green-300">Jugar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
