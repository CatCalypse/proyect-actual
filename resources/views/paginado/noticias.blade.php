<h3>Noticias</h3>

@foreach($news as $noticia)
    <div class="noticia">
        <p>{{$noticia->titular}}</p>
        <a href="/admin/noticias/editar?id={{ $noticia->id }}">Editar</a>
    </div>

@endforeach

{{ $news->links() }}