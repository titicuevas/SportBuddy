<div>


    <div class="form-group">

        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" id="nombre" wire:model="nombre">
        <small>{{ $nombre }}</small>
    </div>
    <br>

    <div class="form-group">

        <label for="mensaje">Mensaje</label>
        <input type="text" class="form-control" id="mensaje" wire:model="mensaje">
        <small>{{ $mensaje }}</small>
    </div>
    <br>

    <button class="btn btn-primary" wire:click="enviarMensaje">Enviar Mensaje</button>


    {{-- Mensaje alerta --}}

    <div style="position: :absolute;" class="alert alert-success collapse" role="alert" id="avisoSuccess">

        Se envio
    </div>

    <script>
        /* JS de componetes */

        window.livewire.on('mensajeEnviado', function() {


            /* Mostrar aviso */
            $("#avisoSuccess").fadeIn("slow");

            /* Ocultar aviso 3 segundos */

            setTimeout(function() {
                $("#avisoSuccess").fadeOut("slow");

            }, 3000);

        });
    </script>



</div>
