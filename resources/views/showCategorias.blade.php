@extends("layouts.layout")

@section("title", "NH Diario")

@section ("content")

@php($noticias = getNoticiasCategoria($categoria))

<div id="categoria-text-wrapper">
    <h1 class="center-text" id="categoria-text">{{getCategoriaText($categoria)}}</h1>
</div>

<div class="flex-wrapper">
    {{paginateNoticiasCategoria($categoria)}}
</div>


@endsection
