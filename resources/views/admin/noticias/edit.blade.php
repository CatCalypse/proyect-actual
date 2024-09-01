@extends("layouts.layout")

@section("title", "NHdiario")

@section ("content")

@vite(['resources/js/codex-editor.js'])

@php($datosNoticia = getNewsData($idNoticia)) 

<form id="redact-form" method="post" action="/edit-noticias">
    @csrf

    <div>
        <label for="titular">Titular</label>
        <input type="text" name="titular" id="titular" value="{{ $datosNoticia->titular }}">
    </div>


    <div>
        <label for="categoria">Categoria</label>

        <select name="categoria" id="categoria">
            <option value="">--- Seleccionar Categoría ---</option>

            @foreach(getCategorias() as $categoria)
                @if($datosNoticia->categoria == $categoria->id)
                    <option value="{{$categoria->id}}" selected>{{ $categoria->categoria }}</option>
                @else
                    <option value="{{$categoria->id}}">{{ $categoria->categoria}}</option>
                @endif
                
            @endforeach
        </select>
    </div>

    <input type="hidden" name="idNoticia" id="idNoticia" value="{{$idNoticia}}">

    <input type="hidden" name="editorData" id="editorData" value="{{$editorData}}">

    <div id="editorjs"></div>
        
    <div>
        <input type="submit" value="save">
    </div>


</form>

@endsection

