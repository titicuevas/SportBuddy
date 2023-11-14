<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Página</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-black">
    <!-- Cabecera -->
    <header class="bg-blue-500 text-white p-4">
        <div class="container mx-auto text-center">
            <h1 class="text-3xl font-bold">SportBuddy</h1>
        </div>
    </header>



    <div class="flex">
        <!-- Sección 1 -->
        <div class="w-1/3 border-solid border-5 border-yellow-500 p-4 bg-red-300">
            <img src="https://i.ibb.co/4MF7M4q/Sport-Buddy-removebg-preview.png" alt="Sport-Buddy-removebg-preview"
                class="w-full h-full object-cover">
            <h2 class="text-2xl font-bold mb-4">Sección 1</h2>
            <p>Contenido de la sección 1...</p>
        </div>

        <!-- Sección 2 -->
        <div class="w-1/3 border-solid border-5 border-blue-500 p-4 bg-green-300 class="w-full h-full object-cover">
            <h1 class="text-center">Entra para encontrar partidos o registrate</h1>
            <div class="flex flex-col items-center">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />

                <a href="{{ route('login') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Login</a>
                <a href="{{ route('register') }}"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Register</a>
            </div>
        </div>


        <!-- Sección 3 -->
        <div class="w-1/3 border-5 border-red p-4 bg-blue-950">
            <img src="https://i.ibb.co/KVYwDKN/Furbo.jpg" alt="Furbo" class="w-full h-full object-cover">

        </div>
    </div>


    </div>



</body>
<!-- Footer -->
<footer class="mt-auto bg-white text-black p-4">
    <div class="container mx-auto text-center">
        <p>&copy; {{ date('Y') }} Tu Proyecto Laravel</p>
        <p>Creado por: Nombre del Creador</p>
    </div>
    <html lang="en">
</footer>

</html>
