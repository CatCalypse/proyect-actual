@extends("layouts.layout")

@section("title", "NH Diario")

@section ("content")

<h2>Actualidad</h2>

<div class="noticias-four-block" id="actualidad">

</div>
@php ($categorias = getCategorias())


@foreach($categorias as $cat)
    <h2 class="categoria"><a href="/{{getSlug($cat->categoria)}}">{{$cat->categoria}}</a></h2>
@endforeach


    


@endsection






