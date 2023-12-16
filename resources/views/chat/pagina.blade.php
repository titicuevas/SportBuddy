<x-app-layout>

    <h1>Chat en Vivo</h1>

    <div id="chat">
        <!-- Aquí se mostrarán los mensajes del chat -->
    </div>

    <input type="text" id="message" placeholder="Escribe tu mensaje">
    <button onclick="sendMessage()">Enviar</button>

    <script>
        window.Echo.channel('chat').listen('NewChatMessage', (event) => {
            // Maneja el nuevo mensaje recibido
            appendMessage(event.user.name, event.message);
        });

        function appendMessage(user, message) {
            const chat = document.getElementById('chat');
            const messageElement = document.createElement('div');
            messageElement.textContent = user + ': ' + message;
            chat.appendChild(messageElement);
        }

        function sendMessage() {
            const messageInput = document.getElementById('message');
            const message = messageInput.value;

            // Envía el mensaje al controlador para su procesamiento
            fetch('/send-message', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({
                    message: message,
                }),
            })
            .then(response => response.json())
            .then(data => {
                // Actualiza la vista del chat con el nuevo mensaje
                appendMessage(data.user.name, data.message);
            });

            // Limpiar el campo de entrada después de enviar el mensaje
            messageInput.value = '';
        }

        // Agregar lógica para enviar mensaje al presionar Enter
        document.getElementById('message').addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                // Evitar que se agregue un salto de línea en el campo de entrada
                event.preventDefault();
                sendMessage();
            }
        });
    </script>
</x-app-layout>
