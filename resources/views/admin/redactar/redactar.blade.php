@extends("layouts.layout")

@section("title", "NHdiario")

@section ("content")


<form id="editor-form" method="post" action="/redactar">
    @csrf

    <div>
        <label for="categoria">Categoria</label>

        <select name="categoria" id="categoria">
            <option value="">--- Seleccionar Categoría ---</option>

            @foreach(getCategorias() as $categoria)
                <option value="{{$categoria->id}}">{{ $categoria->categoria}}</option>
            @endforeach
        </select>
    </div>


    <textarea id="text-editor" name="text-editor" hidden></textarea>

    <div>
        <input type="submit" value="Publicar">
    </div>
</form>


<script src="https://unpkg.com/react@17.0.2/umd/react.production.min.js"></script>

<script src="https://unpkg.com/react-dom@17.0.2/umd/react-dom.production.min.js"></script>

<script src="{{ asset('vendor/laraberg/js/laraberg.js') }}"></script>

<script type="module">
    Laraberg.init('text-editor', { height: '500px', laravelFilemanager: true });
</script>

@endsection

