@section('content')
    <h2>Crear Nuevo Deporte</h2>

    <form action="{{ route('deportes.store') }}" method="post">
        @csrf
        <label for="nombre">Nombre del Deporte:</label>
        <input type="text" name="nombre" required>
        <button type="submit">Crear Deporte</button>
    </form>
@endsection
