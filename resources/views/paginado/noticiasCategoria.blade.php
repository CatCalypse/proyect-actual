<div class="flex-wrapper">
    <div id="paginado-categorias-wrapper">
        @foreach($news as $noticia)
            <div class="noticia">
                <div class="destacado-wrapper">
                    @php($rutaImagen = getImageFromStorage($noticia->destacado))

                    <a href="/noticias/{{getSlug(getCategoriaText($noticia->categoria))}}/{{$noticia->ano}}/{{$noticia->mes}}/{{$noticia->slug}}">
                        <img src="{{$rutaImagen}}" alt="" class="destacado-show-noticias">
                    </a>
                </div>

                <div>
                    <a href="/noticias/{{getSlug(getCategoriaText($noticia->categoria))}}/{{$noticia->ano}}/{{$noticia->mes}}/{{$noticia->slug}}">
                        <h2>{{$noticia->titular}}</h2>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>