@extends("layouts.layout")

@section("title", "NHdiario")

@section ("content")
<a href="/admin/usuarios/create">Añadir Usuario</a>

@if($errors->status->any())
<div id="status">
    @foreach ($errors->status->all() as $error) 
        <p>{{ $error }}</p>
    @endforeach
</div>
@endif

@if($errors->any())
<div id="error">
    @foreach ($errors->all() as $error) 
        <p>{{ $error }}</p>
    @endforeach
</div>
@endif


<div>
    {{ paginateUsuarios() }}
</div>

@endsection
