<table class="table table-bordered">
    <thead class="thead-dark">
        <tr class="text-center">
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Módulo</th>
            <th scope="col">Puntos</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datos as $item)
            <tr>
                <th scope="row" class="text-center">{{ $item->id }}</th>
                <td>{{ $item->nombre }}</td>
                <td>{{ $item->modulo->nombre }}</td>
                <td>{{ $item->puntos }}</td>
                <td class="text-center">
                    <button class="btn btn-warning" data-toggle="modal" data-target="#modalEditar" onclick="ver_datos({{ $item->id }});">
                        <i class="fa fa-pencil-alt"></i>
                    </button>
                    <button class="btn btn-danger" onclick="eliminar({{ $item->id }});">
                        <i class="fa fa-trash-alt"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
