@extends("layouts.layout")

@section("title", "NHdiario")

@section ("content")

@vite(['resources/js/codex-editor.js'])

<form id="redact-form" method="post" action="/redactar">
    @csrf

    <div>
        <label for="titular">Titular</label>
        <input type="text" name="titular" id="titular">
    </div>


    <div>
        <label for="categoria">Categoria</label>

        <select name="categoria" id="categoria">
            <option value="">--- Seleccionar Categoría ---</option>

            @foreach(getCategorias() as $categoria)
                <option value="{{$categoria->id}}">{{ $categoria->categoria}}</option>
            @endforeach
        </select>
    </div>
    

    <input type="hidden" name="editorData" id="editorData">

    <div id="editorjs"></div>
    
    <div>
        <input type="submit" value="Publicar">
    </div>
</form>




@endsection

