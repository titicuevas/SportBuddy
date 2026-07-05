<x-app-layout>
    <x-page-hero title="Perfil de usuario" :subtitle="$user->name" />

    <div class="max-w-lg mx-auto px-4 py-8 -mt-4">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-8 flex flex-col items-center text-center border-b border-gray-100 bg-gradient-to-br from-indigo-50 to-emerald-50">
                <x-user-avatar :user="$user" size="xl" />
                <h2 class="mt-4 text-2xl font-bold text-gray-900">{{ $user->name }} {{ $user->apellidos }}</h2>
            </div>

            <dl class="p-6 space-y-4">
                <div class="flex justify-between py-3 border-b border-gray-100">
                    <dt class="text-sm font-medium text-gray-500">Email</dt>
                    <dd class="text-sm text-gray-900">{{ $user->email }}</dd>
                </div>
                <div class="flex justify-between py-3 border-b border-gray-100">
                    <dt class="text-sm font-medium text-gray-500">Teléfono</dt>
                    <dd class="text-sm text-gray-900">{{ $user->telefono }}</dd>
                </div>
            </dl>

            <div class="p-6 pt-0 flex justify-center">
                <a href="{{ url()->previous() }}"
                    class="px-6 py-2.5 text-sm font-semibold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors">
                    Volver
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
