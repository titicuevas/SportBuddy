<x-administrador>
    <x-slot name="title">Panel</x-slot>

    <div class="mb-8">
        <h2 class="text-2xl font-bold text-slate-900">Panel de administración</h2>
        <p class="mt-1 text-slate-600">Gestiona usuarios, instalaciones y catálogo deportivo.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">
        <a href="{{ route('admin.users.index') }}" class="block p-5 rounded-xl bg-white border border-slate-200 hover:border-indigo-300 hover:shadow-md transition-all">
            <p class="text-3xl font-bold text-indigo-600">{{ $stats['users'] }}</p>
            <p class="mt-1 text-sm font-medium text-slate-700">Usuarios</p>
        </a>
        <a href="{{ route('admin.deportes.index') }}" class="block p-5 rounded-xl bg-white border border-slate-200 hover:border-emerald-300 hover:shadow-md transition-all">
            <p class="text-3xl font-bold text-emerald-600">{{ $stats['deportes'] }}</p>
            <p class="mt-1 text-sm font-medium text-slate-700">Deportes</p>
        </a>
        <a href="{{ route('admin.ubicacion.index') }}" class="block p-5 rounded-xl bg-white border border-slate-200 hover:border-blue-300 hover:shadow-md transition-all">
            <p class="text-3xl font-bold text-blue-600">{{ $stats['ubicaciones'] }}</p>
            <p class="mt-1 text-sm font-medium text-slate-700">Ubicaciones</p>
        </a>
        <a href="{{ route('admin.superficie.index') }}" class="block p-5 rounded-xl bg-white border border-slate-200 hover:border-amber-300 hover:shadow-md transition-all">
            <p class="text-3xl font-bold text-amber-600">{{ $stats['superficies'] }}</p>
            <p class="mt-1 text-sm font-medium text-slate-700">Superficies</p>
        </a>
        <a href="{{ route('admin.pista.index') }}" class="block p-5 rounded-xl bg-white border border-slate-200 hover:border-purple-300 hover:shadow-md transition-all">
            <p class="text-3xl font-bold text-purple-600">{{ $stats['pistas'] }}</p>
            <p class="mt-1 text-sm font-medium text-slate-700">Pistas</p>
        </a>
        <a href="{{ route('partidos.index') }}" class="block p-5 rounded-xl bg-white border border-slate-200 hover:border-rose-300 hover:shadow-md transition-all">
            <p class="text-3xl font-bold text-rose-600">{{ $stats['partidos'] }}</p>
            <p class="mt-1 text-sm font-medium text-slate-700">Partidos</p>
        </a>
    </div>
</x-administrador>
