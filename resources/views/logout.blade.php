@extends("layouts.layout")

@section("title", "NH Diario")

@section ("content")
<p>Hola {{ auth()->user()->usuario }}</p>
@endsection
