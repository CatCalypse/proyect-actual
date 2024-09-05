@extends("layouts.layout")

@section("title", "NH Diario")

@section ("content")




<div class="flex-wrapper">
    <div id="portada-wrapper">
        
        <div id="actualidad">
            @php($noticiasActualidad = getNoticiasActualidad())


            @php($cantidadActualidad = count($noticiasActualidad))

            @if($cantidadActualidad == 0)
                <h3 class="center-text">No hay noticias disponibles</h3>
            @endif


            @php($count = 0)

            @foreach($noticiasActualidad as $new)
                @if($count < 2)
                    @if($count == 0)
                        <div id="grande-wrapper">
                    @endif

                    
                    <div class="actualidad-grande">
                        @php($rutaImagen = getImageFromStorage($new->destacado))

                        <a href="/noticias/{{getSlug(getCategoriaText($new->categoria))}}/{{$new->ano}}/{{$new->mes}}/{{$new->slug}}" class="link-portada">
                            <img src="{{$rutaImagen}}" alt="" class="grande-imagen">
                        </a>


                        <div class="bottom-left">

                            <a href="/noticias/{{getSlug(getCategoriaText($new->categoria))}}/{{$new->ano}}/{{$new->mes}}/{{$new->slug}}">
                                <p class="titular-actualidad">{{$new->titular}}</p>
                            </a>
                        </div>
                    </div>

                    @if($count == 1 || $count == $cantidadActualidad)
                        </div>
                    @endif
                @else
                    @if($count == 2)
                        <div id="pequeno-wrapper">
                    @endif
                    
                    <div class="actualidad-pequeno">
                        @php($rutaImagen = getImageFromStorage($new->destacado))

                        <a href="/noticias/{{getSlug(getCategoriaText($new->categoria))}}/{{$new->ano}}/{{$new->mes}}/{{$new->slug}}"  class="link-portada">
                            <img src="{{$rutaImagen}}" alt="" class="pequeno-imagen">
                        </a>

                        <div class="bottom-left">
                            <div class="fondo-transparente"></div>
                            <a href="/noticias/{{getSlug(getCategoriaText($new->categoria))}}/{{$new->ano}}/{{$new->mes}}/{{$new->slug}}">
                                <p class="titular-actualidad">{{$new->titular}}</p>
                            </a>
                        </div>
                    </div>

                    @if($count == 5 || $count == $cantidadActualidad)
                        </div>
                    @endif
                @endif

                @php($count++)
            @endforeach


        </div>




        
        <div id="contenido-portada">
            <div id="categorias-wrapper">
                @php ($categorias = getCategorias())

                @foreach($categorias as $cat)
                    <div class="noticia-portada">
                        <h2 class="categoria" id="{{getSlug($cat->categoria)}}"><a href="/noticias/{{getSlug($cat->categoria)}}">{{$cat->categoria}}</a></h2>

                        @php($noticiasCategoria = getNoticiasCategoriaPortada($noticiasActualidad, $cat->id))

                        @php($count = 0)

                        @php($cantidadCategorias = count($noticiasCategoria))
        
        
                        @if($cantidadCategorias == 0)
                            <h3>No hay noticias disponibles</h3>
                        @else

                            @foreach($noticiasCategoria as $new)
                        

                                @if($count == 0)
                                    <div class="categoria-portada">
                                @endif

                                <div class="noticia-categoria">
                                @php($rutaImagen = getImageFromStorage($new->destacado))

                                    <div class="wrap-imagen">
                                        <a href="/noticias/{{getSlug(getCategoriaText($new->categoria))}}/{{$new->ano}}/{{$new->mes}}/{{$new->slug}}">
                                            <img src="{{$rutaImagen}}" alt="" class="pequeno-imagen">
                                        </a>
                                    </div>

                                    <div>
                                        <a href="/noticias/{{getSlug(getCategoriaText($new->categoria))}}/{{$new->ano}}/{{$new->mes}}/{{$new->slug}}">
                                            <p class="titular-noticia-categoria">{{$new->titular}}</p>
                                        </a>
                                    </div>
                       

                                @if($count == 2 || $count == $cantidadCategorias)
                                    </div>
                                @endif

                                @php($count++)

                                </div>
                            @endforeach

                        @endif  
                    </div>
                @endforeach

            </div>

            <div id="euronoticias">
                <h2 class="categoria" id="noticias-europa">NH TV</h2>
                <div class="video-responsive"><iframe src="https://www.youtube-nocookie.com/embed/live_stream?channel=UCyoGb3SMlTlB8CLGVH4c8Rw&amp;autoplay=1&mute=1&amp;modestbranding=1&amp;showinfo=0&amp;rel=0&amp;iv_load_policy=3&amp;theme=light" width="100%" height="197" frameborder="0"><br /></iframe></div>
            </div>
        </div>
    </div>
</div>

    


@endsection






