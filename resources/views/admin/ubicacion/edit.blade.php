<x-administrador>

    @section('contenido')
        @if (session('success'))
            <div x-data="{ show: false }" x-show="show" x-init="() => {
                show = true;
                setTimeout(() => show = false, 5000);
            }"
                class="fixed inset-x-0 mx-auto top-4 px-4 py-2 bg-green-500 text-white rounded-md shadow-md transition-all duration-300">
                <p class="text-center text-base">{{ session('success') }}</p>
            </div>
        @endif

        <div class="flex items-center justify-center mb-6">
            <h1 class="text-4xl text-blue-500">Editar Ubicación</h1>
        </div>

        <form action="{{ route('admin.ubicacion.update', $ubicacion->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mx-auto max-w-2xl">
                <table class="w-full bg-white border border-gray-500">
                    <tbody>
                        <!-- Campos del formulario -->
                        <tr>
                            <td class="py-2 px-4 border-b text-center font-semibold text-gray-600">Nombre</td>
                            <td class="py-2 px-4 border-b">
                                <input type="text" name="nombre" id="nombre"
                                    class="w-48 border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
                                    value="{{ old('nombre', $ubicacion->nombre) }}" required>
                            </td>
                        </tr>

                        <tr>
                            <td class="py-2 px-4 border-b text-center font-semibold text-gray-600">Dirección</td>
                            <td class="py-2 px-4 border-b">
                                <input type="text" name="direccion" id="direccion"
                                    class="w-48 border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
                                    value="{{ old('direccion', $ubicacion->direccion) }}" required>
                            </td>
                        </tr>


                        <tr>
                            <td class="py-2 px-4 border-b-2 text-center font-semibold text-gray-600">Enlace Maps</td>
                            <td class="py-2 px-4 border-b">
                                <textarea name="enlace_maps" id="enlace_maps"
                                    class="w-48 border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" rows="4">{{ old('enlace_maps', $ubicacion->enlace_maps) }}</textarea>
                            </td>
                        </tr>

                        <tr>
                            <td class="py-2 px-4 border-b-2 text-center font-semibold text-gray-600">Iframe</td>
                            <td class="py-2 px-4 border-b-2">
                                <textarea name="iframe" id="iframe"
                                    class="w-48 border-2 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" rows="4">{{ old('iframe', $ubicacion->iframe) }}</textarea>
                            </td>
                        </tr>

                        <tr>
                            <td class="py-2 px-4 border-b text-center font-semibold text-gray-600">Imagen</td>
                            <td class="py-2 px-4 border-b-2">
                                <input type="file" name="imagen" id="imagen" accept="image/*"
                                    class="py-2 px-3 focus:outline-none focus:border-blue-500">

                                @if ($ubicacion->imagen)
                                    <div class="flex justify-center items-center mt-2">
                                        <img src="{{ asset('storage/imagen/' . $ubicacion->imagen) }}"
                                            alt="Imagen Actual" class="max-w-full h-auto">
                                    </div>
                                    <p class="text-gray-500 text-xl mt-1">Imagen actual: {{ $ubicacion->imagen }}</p>
                                @else
                                    <p class="text-gray-500 text-xl mt-1">Sin imagen actual</p>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Botón para actualizar la ubicación -->
            <div class="mt-4 text-center">
                <button type="submit"
                    class="bg-blue-500 text-white py-2 px-4 text-xls rounded-md hover:bg-blue-700 focus:outline-none">
                    Actualizar Ubicación
                </button>
            </div>
        </form>
    </x-administrador>
