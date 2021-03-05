<table id="example1" class="table table-bordered">
    <thead class="thead-dark">
        <tr class="text-center">
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Objetivo</th>
            <th scope="col">Puntos</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datos as $item)
            <tr>
                <th scope="row" class="text-center" width="2%">{{ $item->id }}</th>
                <td width="50%">{{ $item->nombre }}</td>
                <td>{{ $item->modulo->nombre }}</td>
                <td class="text-center">{{ $item->puntos }}</td>
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
<script>
    $('#example1').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "language":{
            "lengthMenu": "Mostrar _MENU_ registros por página.",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "No se encontraron registros.",
            "infoFiltered": "(filtrada de _MAX_ registros)",
            "loadingRecords": "Cargando...",
            "processing":     "Procesando...",
            "search": "Buscar:",
            "zeroRecords":    "No se encontraron registros.",
            "paginate": {
                "next":       ">",
                "previous":   "<"
            },
        },
        lengthMenu: [[5, 10, 15], [5, 10, 15]]
    });
</script>
