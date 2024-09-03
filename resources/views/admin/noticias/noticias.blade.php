@extends("layouts.layout")

@section("title", "NH Diario")

@section ("content")

<div>
    {{ paginateNoticiasAdmin() }}
</div>

@endsection

