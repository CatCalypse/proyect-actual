@extends("layouts.layout")

@section("title", "NH Diario")

@section ("content")


<div id="categoria-text-wrapper">
    <h1 class="center-text" id="categoria-text"><span id="{{getSlug(getCategoriaText($categoria))}}">{{getCategoriaText($categoria)}}</span></h1>
</div>


<div id="categoria-text-wrapper">
    <h2 class="center-text" id="sin-noticias">No hay noticias disponibles</h2>
</div>

<div class="flex-wrapper">
    {{paginateNoticiasCategoria($categoria)}}
</div>


@endsection
