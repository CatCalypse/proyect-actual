@extends("layouts.layout")

@section("title", "NHdiario")

@section ("content")
@vite(['resources/js/app.js'])

<input type="hidden" id="newsData" name="newsData" value="{{$noticia}}">

<div id="news-content">

</div>

<script type="module">
    const edjsParser = window.edjsHTML()

    let newsData = document.querySelector('#newsData');

    let html = edjsParser.parse(JSON.parse(newsData.value))

    let contenido = document.querySelector('#news-content')
    contenido.innerHTML = html
</script>

@endsection