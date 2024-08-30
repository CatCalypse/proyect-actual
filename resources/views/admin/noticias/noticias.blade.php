@extends("layouts.layout")

@section("title", "NHdiario")

@section ("content")

<div>
    {{ paginateNoticias() }}
</div>

@endsection

