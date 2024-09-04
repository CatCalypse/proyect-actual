<div class="flex-wrapper">
    <div id="paginado-categorias-wrapper">
        @php($count = 0)

        @foreach($news as $noticia)
            @if($count % 3 == 0 && $count != 0)
                </div>
            @endif
            
            @if($count % 3 == 0 && $count != 12)
                <div class="fila">
            @endif

            <div class="noticia">
                <div class="destacado-wrapper">
                    @php($rutaImagen = getImageFromStorage($noticia->destacado))

                    <a href="/noticias/{{getSlug(getCategoriaText($noticia->categoria))}}/{{$noticia->ano}}/{{$noticia->mes}}/{{$noticia->slug}}">
                        <img src="{{$rutaImagen}}" alt="" class="destacado-noticias-categorias">
                    </a>
                </div>

                <div>
                    <a href="/noticias/{{getSlug(getCategoriaText($noticia->categoria))}}/{{$noticia->ano}}/{{$noticia->mes}}/{{$noticia->slug}}">
                        <h2>{{$noticia->titular}}</h2>
                    </a>
                </div>
            </div>



            @php($count++)
        @endforeach
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        let noticias = document.querySelectorAll('.noticia')
        let texto = document.querySelector('#sin-noticias')

        if(noticias.length == 0){
            texto.style.display = 'initial'
        }
    })
</script>