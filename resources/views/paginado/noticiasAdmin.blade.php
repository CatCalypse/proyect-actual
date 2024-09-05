<div class="flex-wrapper">
    <div id="pagination-wrapper">
        <div id="table-wrapper">
            <div id="extra-noticias">
                <h3 class="extra-text">Noticias</h3>
            </div>

            <div class="pagination-wrapper">
                <table id="user-pagination-table">
                    <thead>
                        <tr class="thead-dark">
                            <th scope="col" id="destacado-text">Imagen Destacada</th>
                            <th scope="col">Titular</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Publicación</th>
                            <th scope="col">Escritor</th>
                            <th scope="col">Activo</th>
                            <th scope="col" colspan="2"></th>
                        </tr>
                    </thead>
    
                    <tbody>
                        @foreach($news as $noticia)
                            <tr>
                                <td class="destacado-wrapper">
                                    @php($rutaImagen = getImageFromStorage($noticia->destacado))
                                    <img src="{{$rutaImagen}}" alt="" class="destacado-show-noticias">
                                </td>
                                <td>{{ $noticia->titular }}</td>
                                <td>{{ getCategoriaText($noticia->categoria) }}</td>
                                <td>{{ $noticia->ano . "/" . $noticia->mes }}</td>
                                <td>{{ getWriter($noticia->escritor) }}</td>

                                @if($noticia->activo == 1)
                                    <td class="center-td">
                                        <md-checkbox touch-target="wrapper" name="activo" id="activo" checked disabled></md-checkbox>
                                    </td>
                                @else
                                    <td class="center-td">
                                        <md-checkbox touch-target="wrapper" name="activo" id="activo" disabled ></md-checkbox>
                                    </td>
                                @endif
                        
                                <td class="center-td">
                                    <a href="/admin/noticias/editar?id={{ $noticia->id }}">Editar</a>
                                </td>

                                <td class="center-td">
                                    <a href="/delete-noticias?id={{ $noticia->id }}" class="delete" data-confirm="Estas seguro de que quieres eliminar esta noticia?">Eliminar</a>
                                </td>
                        
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <script src="{{ url('/js/confirmDelete.js')}}"></script>

        <div id="pagination-links">
            {{ $news->links() }}
        </div>
    </div>
</div>