<x-app-layout>
    <x-page-hero title="Mi perfil" subtitle="Gestiona tu información personal" />

    <div class="max-w-xl mx-auto px-4 py-8 -mt-4 space-y-6">
        <div class="p-6 bg-white shadow-sm border border-gray-100 rounded-2xl">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="p-6 bg-white shadow-sm border border-gray-100 rounded-2xl">
            @include('profile.partials.update-password-form')
        </div>

        <div class="p-6 bg-white shadow-sm border border-gray-100 rounded-2xl">
            <h2 class="text-lg font-semibold text-gray-900 mb-4 text-center">Foto de perfil</h2>

            <div class="flex justify-center mb-6">
                @if ($user->foto)
                    <img class="rounded-full ring-4 ring-indigo-100 w-32 h-32 object-cover" id="imgPerfil"
                        src="{{ Storage::url($user->foto) }}" alt="Foto de perfil" />
                @else
                    <div id="imgPerfil" class="w-32 h-32 rounded-full bg-gradient-to-br from-indigo-500 to-emerald-500 flex items-center justify-center text-white text-3xl font-bold ring-4 ring-indigo-100" aria-hidden="true">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif
            </div>

            <div class="flex flex-wrap justify-center gap-3">
                <button type="button" class="px-4 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors" id="btn-examinar-foto">
                    Examinar
                </button>

                <button type="button" class="px-4 py-2 text-sm font-semibold text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors {{ $user->foto ? '' : 'hidden' }}" id="btn-eliminar-foto">
                    Eliminar foto
                </button>

                <button type="button" class="px-4 py-2 text-sm font-semibold text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 transition-colors disabled:opacity-50" id="btn-guardar-foto" disabled>
                    Guardar foto
                </button>

                <form action="{{ route('profile.update-foto') }}" method="post" enctype="multipart/form-data" id="form-actualizar-foto">
                    @csrf
                    @method('post')
                    <input type="file" name="foto" id="foto" accept="image/*" class="hidden">
                    <input type="hidden" name="foto_eliminada" id="foto_eliminada" value="0">
                    <button type="submit" class="hidden"></button>
                </form>
            </div>

            <p id="foto-status" class="mt-4 text-center text-sm hidden" role="status" aria-live="polite"></p>
        </div>

        <div class="p-6 bg-white shadow-sm border border-gray-100 rounded-2xl">
            @include('profile.partials.delete-user-form')
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var btnExaminar = document.getElementById('btn-examinar-foto');
            var btnEliminar = document.getElementById('btn-eliminar-foto');
            var btnGuardar = document.getElementById('btn-guardar-foto');
            var imgPerfil = document.getElementById('imgPerfil');
            var inputFoto = document.getElementById('foto');
            var formActualizarFoto = document.getElementById('form-actualizar-foto');

            var fotoStatus = document.getElementById('foto-status');

            function setFotoStatus(message, isError) {
                fotoStatus.textContent = message;
                fotoStatus.classList.remove('hidden', 'text-emerald-600', 'text-red-600');
                fotoStatus.classList.add(isError ? 'text-red-600' : 'text-emerald-600');
            }

            btnExaminar.addEventListener('click', function() { inputFoto.click(); });

            btnEliminar.addEventListener('click', function() {
                if (!confirm('¿Eliminar la foto de perfil?')) return;

                if (imgPerfil.tagName === 'IMG') {
                    var placeholder = document.createElement('div');
                    placeholder.id = 'imgPerfil';
                    placeholder.className = 'w-32 h-32 rounded-full bg-gradient-to-br from-indigo-500 to-emerald-500 flex items-center justify-center text-white text-3xl font-bold ring-4 ring-indigo-100';
                    placeholder.textContent = @json(strtoupper(substr($user->name, 0, 1)));
                    imgPerfil.replaceWith(placeholder);
                    imgPerfil = placeholder;
                }

                btnEliminar.classList.add('hidden');
                btnExaminar.classList.remove('hidden');
                inputFoto.value = null;
                btnGuardar.disabled = true;
                document.getElementById('foto_eliminada').value = 1;
                formActualizarFoto.submit();
            });

            btnGuardar.addEventListener('click', function() {
                fetch(@json(route('profile.update-foto')), {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: new FormData(formActualizarFoto),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'error') {
                        setFotoStatus(data.message || 'No se pudo actualizar la foto.', true);
                    } else {
                        if (imgPerfil.tagName !== 'IMG') {
                            var img = document.createElement('img');
                            img.id = 'imgPerfil';
                            img.className = 'rounded-full ring-4 ring-indigo-100 w-32 h-32 object-cover';
                            img.alt = 'Foto de perfil';
                            imgPerfil.replaceWith(img);
                            imgPerfil = img;
                        }
                        imgPerfil.src = data.fotoPerfilURL;
                        btnGuardar.disabled = true;
                        btnExaminar.classList.remove('hidden');
                        btnEliminar.classList.remove('hidden');
                        inputFoto.value = '';
                        document.getElementById('foto_eliminada').value = 0;
                        setFotoStatus('Foto actualizada.', false);
                    }
                })
                .catch(function() {
                    setFotoStatus('No se pudo actualizar la foto. Inténtalo de nuevo.', true);
                });
            });

            inputFoto.addEventListener('change', function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    if (imgPerfil.tagName !== 'IMG') {
                        var img = document.createElement('img');
                        img.id = 'imgPerfil';
                        img.className = 'rounded-full ring-4 ring-indigo-100 w-32 h-32 object-cover';
                        img.alt = 'Foto de perfil';
                        imgPerfil.replaceWith(img);
                        imgPerfil = img;
                    }
                    imgPerfil.src = e.target.result;
                };
                reader.readAsDataURL(this.files[0]);
                btnEliminar.classList.remove('hidden');
                btnExaminar.classList.add('hidden');
                btnGuardar.disabled = false;
                document.getElementById('foto_eliminada').value = 0;
            });
        });
    </script>
</x-app-layout>
