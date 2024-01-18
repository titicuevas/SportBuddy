<x-administrador>
    @section('contenido')
        <div class="flex items-center justify-center">
            <h1 class="text-4xl text-blue-500 mb-6">Editar Pista</h1>
        </div>

        <form action="{{ route('admin.pista.update', $pista->id) }}" method="post" class="max-w-md mx-auto">
            @csrf
            @method('PUT')

            <div class="mx-auto max-w-2xl">
                <table class="w-full bg-white border border-gray-500">
                    <tbody>
                        <!-- Ubicación -->
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-500 text-gray-600 text-xl font-semibold">Ubicación</td>
                            <td class="py-2 px-4 border-b border-gray-500">
                                <select name="ubicacion_id" id="ubicacion_id"
                                    class="w-full border-gray-300 text-xl rounded-md p-2 border-opacity-50" required>
                                    @foreach ($ubicaciones as $ubicacion)
                                        <option value="{{ $ubicacion->id }}"
                                            {{ $pista->ubicacion_id == $ubicacion->id ? 'selected' : '' }}>
                                            {{ $ubicacion->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>

                        <!-- Superficie -->
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-500 text-gray-600 text-xl font-semibold">Superficie
                            </td>
                            <td class="py-2 px-4 border-b border-gray-500">
                                <select name="superficie_id" id="superficie_id"
                                    class="w-full border-gray-300 text-xl rounded-md p-2 border-opacity-50" required>
                                    @foreach ($superficies as $superficie)
                                        <option value="{{ $superficie->id }}"
                                            {{ $pista->superficie_id == $superficie->id ? 'selected' : '' }}>
                                            {{ $superficie->tipo }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>

                        <!-- Deporte -->
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-500 text-gray-600 text-xl font-semibold">Deporte</td>
                            <td class="py-2 px-4 border-b border-gray-500">
                                <select name="deporte_id" id="deporte_id"
                                    class="w-full border-gray-300 text-xl rounded-md p-2 border-opacity-50" required>
                                    @foreach ($deportes as $deporte)
                                        <option value="{{ $deporte->id }}"
                                            {{ $pista->deporte_id == $deporte->id ? 'selected' : '' }}>
                                            {{ $deporte->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>

                        <!-- Número de Pista -->
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-500 text-gray-600 text-xl font-semibold">Número de
                                Pista</td>
                            <td class="py-2 px-4 border-b border-gray-500">
                                <input type="text" name="numero" id="numero"
                                    class="w-full border-gray-300 text-xl rounded-md p-2" value="{{ $pista->numero }}" required>
                            </td>
                        </tr>

                        <!-- Precio con Luz -->
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-500 text-gray-600 text-xl font-semibold">Precio con
                                Luz</td>
                            <td class="py-2 px-4 border-b border-gray-500">
                                <input type="text" name="precio_con_luz" id="precio_con_luz"
                                    class="w-full border-gray-300 text-xl rounded-md p-2" value="{{ $pista->precio_con_luz }}">
                            </td>
                        </tr>

                        <!-- Precio sin Luz -->
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-500 text-gray-600 text-xl font-semibold">Precio sin
                                Luz</td>
                            <td class="py-2 px-4 border-b border-gray-500">
                                <input type="text" name="precio_sin_luz" id="precio_sin_luz"
                                    class="w-full border-gray-300 text-xl rounded-md p-2" value="{{ $pista->precio_sin_luz }}"
                                    required>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Botón Guardar Cambios -->
            <div class="mt-8 flex justify-center">
                <button type="submit"
                    class="bg-blue-500 text-white py-2 text-xl px-4 rounded-md hover:bg-blue-700 focus:outline-none">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </x-administrador>
