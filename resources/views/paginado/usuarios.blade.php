<h3>Usuarios</h3>
        <div class="pagination-wrapper">
            <table class="pagination-table">
                <thead>
                    <tr class="thead-dark">
                        <th scope="col">Usuario</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Activo</th>
                        <th scope="col" rowspan="3"></th>
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
                            <td>Activo</td>
                        @else
                            <td>Inactivo</td>
                        @endif
                        
                        <td>
                            <a href="/admin/usuarios/edit?id={{ $user->id }}">Editar</a>
                        </td>

                        <td>
                            <a href="/delete?id={{ $user->id }}">Eliminar</a>
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>