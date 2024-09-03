@extends("layouts.layout")

@section("title", "NH Diario")

@section ("content")
@vite(['resources/js/app.js'])

<input type="hidden" id="newsData" name="newsData" value="{{$noticia}}">

<div class="flex-wrapper" id="noticia-wrapper">
    @php($noticiaImagen = getNoticiaWithSlug($slug))

    <div id="titular-wrapper">
        <h2 class="center-text" id="titular-text">{{$noticiaImagen->titular}}</h2>
    </div>    
    
    <div id="content-wrapper">
        <div id="news-content">    
            @php($rutaImagen = getImageFromStorage($noticiaImagen->destacado))

            <img src="{{$rutaImagen}}" alt="" id="imagen-noticia">
            <div id="contenido">

            </div>
        </div>
    </div>
</div>

<script type="module">
    const edjsParser = window.edjsHTML()

    let newsData = document.querySelector('#newsData');

    let html = edjsParser.parse(JSON.parse(newsData.value))

    let contenido = document.querySelector('#contenido')
    contenido.innerHTML = html
</script>

@endsection