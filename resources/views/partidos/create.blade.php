<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Añadir partido
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('partidos.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="fecha">Fecha</label>
                            <input type="date" class="form-control" id="fecha" name="fecha"
                                value="{{ old('fecha') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="hora">Hora</label>
                            <input type="time" class="form-control" id="hora" name="hora"
                                value="{{ old('hora') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="ubicacion_id">Ubicación</label>
                            <select class="form-control" id="ubicacion_id" name="ubicacion_id" required>
                                <option value="">Selecciona una ubicación</option>
                                @foreach ($ubicaciones as $ubicacion)
                                    <option value="{{ $ubicacion->id }}">{{ $ubicacion->nombre }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="ubicacion_id">Numero Pista</label>
                            <select class="form-control" id="ubicacion_id" name="ubicacion_id" required>
                                <option value="">Selecciona una ubicación</option>
                                @foreach ($ubicaciones as $ubicacion)
                                    @foreach ($ubicacion->pistas as $pista)
                                        <option value="{{ $pista->id }}">{{ $pista->numero }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>



                        <div class="form-group">
                            <label for="ubicacion_id">Tipo de campo</label>
                            <select class="form-control" id="ubicacion_id" name="ubicacion_id" required>
                                <option value="">Selecciona una superficie</option>
                                @foreach ($ubicaciones as $ubicacion)
                                    @foreach ($ubicacion->pistas as $pista)
                                        <option value="{{ $pista->superficie->id }}">{{ $pista->superficie->tipo }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="deporte_id">Deporte</label>
                            <select class="form-control" id="deporte_id" name="deporte_id" required>
                                <option value="">Selecciona un deporte</option>
                                @foreach ($deportes as $deporte)
                                    <option value="{{ $deporte->id }}">{{ $deporte->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Crear</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
