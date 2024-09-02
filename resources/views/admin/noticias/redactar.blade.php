@extends("layouts.layout")

@section("title", "NH Diario")

@section ("content")

@vite(['resources/js/codex-editor.js'])


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

        <md-outlined-text-field value="{{ old('titular') }}" name="titular" id="titular" type="text"></md-outlined-text-field>
    </div>

    

    <div class="input-wrapper">
        <label for="categoria">Categoria <span class="requerido">*</span></label>

        <md-outlined-select name="categoria" id="categoria">
            @if(!old('categoria'))
                <md-select-option aria-label="blank" value="" selected>--- Seleccionar Categoría ---</md-select-option>
            @endif

            @foreach(getCategorias() as $categoria)
                @if($categoria->id == old('categoria'))
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
        <label for="destacado">Imagen Destacada <span class="requerido">*</span></label>

        <div id="file-upload">
            <md-elevated-button type="button" id="boton-archivo">Seleccionar Imagen</md-elevated-button>
            <p id="nombre-archivo"></p>
        </div>
            
        <input type="file" name="destacado" id="destacado" value="{{old('destacado')}}">
    </div>



    <input type="hidden" name="editorData" id="editorData" value="{{old('editorData')}}">

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

