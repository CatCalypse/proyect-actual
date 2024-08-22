@extends("layouts.layout")

@section("title", "NHdiario")

@section ("content")
<p>Hola {{ auth()->user()->usuario }}</p>
@endsection
