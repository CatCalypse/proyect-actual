<div class="flex-wrapper">
    <div id="pagination-wrapper">
        <div id="table-wrapper">
            <div id="table-extras">
                <h3 class="extra-text">Usuarios</h3>
            
                <a href="/admin/usuarios/create" id="add-user"><md-elevated-button type="button"><span id="link-text-create">Añadir usuario</span></md-elevated-button></a>
            </div>

            <div class="pagination-wrapper">
                <table id="user-pagination-table">
                    <thead>
                        <tr class="thead-dark">
                            <th scope="col">Usuario</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Rol</th>
                            <th scope="col">Activo</th>
                            <th scope="col" colspan="2"></th>
                        </tr>
                    </thead>
    
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->usuario }}</td>
                            <td>{{ $user->correo }}</td>
                            <td>{{ $user->nombre }}</td>
                            <td>{{ $user->apellidos }}</td>
                            <td>{{ rolText($user->rol) }}</td>

                            @if($user->activo == 1)
                                <td class="center-td">
                                    <md-checkbox touch-target="wrapper" name="activo" id="activo" checked disabled></md-checkbox>
                                </td>
                            @else
                                <td class="center-td">
                                    <md-checkbox touch-target="wrapper" name="activo" id="activo" disabled ></md-checkbox>
                                </td>
                            @endif
                        
                            <td class="center-td">
                                <a href="/admin/usuarios/edit?id={{ $user->id }}">Editar</a>
                            </td>

                            <td class="center-td">
                                <a href="/delete?id={{ $user->id }}">Eliminar</a>
                            </td>
                        
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div id="pagination-links">
            {{ $users->links('paginado.paginationLinks') }}
        </div>
    </div>
</div>

