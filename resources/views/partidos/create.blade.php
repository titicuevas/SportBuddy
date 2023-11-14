@extends('layouts.app-layout')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Añadir partido</h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('partidos.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control @error('fecha') is-invalid @enderror" id="fecha" name="fecha"
                                value="{{ old('fecha') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="hora" class="form-label">Hora</label>
                            <input type="time" class="form-control @error('hora') is-invalid @enderror" id="hora" name="hora"
                                value="{{ old('hora') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="ubicacion_id" class="form-label">Ubicación</label>
                            <select class="form-select @error('ubicacion_id') is-invalid @enderror" id="ubicacion_id" name="ubicacion_id" required>
                                <option value="">Selecciona una ubicación</option>
                                @foreach ($ubicaciones as $ubicacion)
                                    <option value="{{ $ubicacion->id }}">{{ $ubicacion->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="pista_id" class="form-label">Numero Pista</label>
                            <select class="form-select @error('pista_id') is-invalid @enderror" id="pista_id" name="pista_id" required>
                                <option value="">Selecciona una pista</option>
                                @foreach ($ubicaciones as $ubicacion)
                                    @foreach ($ubicacion->pistas as $pista)
                                        <option value="{{ $pista->id }}">{{ $pista->numero }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="superficie_id" class="form-label">Tipo de campo</label>
                            <select class="form-select @error('superficie_id') is-invalid @enderror" id="superficie_id" name="superficie_id" required>
                                <option value="">Selecciona una superficie</option>
                                @foreach ($ubicaciones as $ubicacion)
                                    @foreach ($ubicacion->pistas as $pista)
                                        <option value="{{ $pista->superficie->id }}">{{ $pista->superficie->tipo }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="deporte_id" class="form-label">Deporte</label>
                            <select class="form-select @error('deporte_id') is-invalid @enderror" id="deporte_id" name="deporte_id" required>
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
@endsection
