@extends("layouts.layout")

@section("title", "NH Diario")

@section ("content")

<div>
    {{ paginateNoticias() }}
</div>

@endsection

