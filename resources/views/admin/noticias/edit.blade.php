@extends("layouts.layout")

@section("title", "NH Diario")

@section ("content")

@vite(['resources/js/codex-editor.js'])

@php($datosNoticia = getNewsData($idNoticia)) 

<!-- <form id="redact-form" method="post" action="/edit-noticias">
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


</form> -->





<!-- O form de redactar -->

@if($errors->any())
<div id="status">
    @foreach ($errors->all() as $error) 
        <p>{{ $error }}</p>
    @endforeach
</div>
@endif

<div id="form-wrapper">
<form id="redact-form" method="post" action="/redactar" enctype="multipart/form-data">
    @csrf

    <div class="input-wrapper">
        <label for="titular">Titular <span class="requerido">*</span></label>

        <md-outlined-text-field name="titular" id="titular" type="text" value="{{ $datosNoticia->titular }}"></md-outlined-text-field>
    </div>

    

    <div class="input-wrapper">
        <label for="categoria">Categoria <span class="requerido">*</span></label>

        <md-outlined-select name="categoria" id="categoria">
            @foreach(getCategorias() as $categoria)
                @if($datosNoticia->categoria == $categoria->id)
                    <md-select-option value="{{$categoria->id}}" selected>
                        <div slot="headline">{{ $categoria->categoria}}</div>
                    </md-select-option>
                @else
                    <md-select-option value="{{$categoria->id}}">
                        <div slot="headline">{{ $categoria->categoria}}</div>
                    </md-select-option>
                @endif
            @endforeach
        </md-outlined-select>
    </div>



    <div class="input-wrapper">
        <label for="fondo">Imagen de Fondo <span class="requerido">*</span></label>

        <div id="file-upload">
            <md-elevated-button type="button" id="boton-archivo">Subir Imagen</md-elevated-button>
            <p id="nombre-archivo"></p>
        </div>
            
        <input type="file" name="fondo" id="fondo">
    </div>



    <input type="hidden" name="idNoticia" id="idNoticia" value="{{$idNoticia}}">

    <input type="hidden" name="editorData" id="editorData" value="{{$editorData}}">

    <div>
        <p id="content-marker">Contenido  <span class="requerido">*</span></p>
        <div id="editorjs"></div>
    </div>

    
    <div>
        <md-elevated-button type="submit">Publicar</md-elevated-button>
    </div>
</form>
</div>

<script src="{{ url('/js/fileInput.js')}}"></script>



@endsection

