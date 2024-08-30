@extends("layouts.layout")

@section("title", "NHdiario")

@section ("content")
@vite(['resources/js/app.js'])



<div id="news-content">

</div>

<script type="module">
    const edjsParser = window.edjsHTML()
    let html = edjsParser.parse({"time":1724972309253,"blocks":[{"id":"E8HI3Iyara","type":"image","data":{"caption":"","withBorder":false,"withBackground":false,"stretched":false,"file":{"url":"/storage/images/cbADTEDFN4VKbvasz4yYHZUeyd4WxC7kdHHZ0fm0.jpg"}}}],"version":"2.30.5"});

    let contenido = document.querySelector('#news-content')
    contenido.innerHTML = html
</script>

@endsection