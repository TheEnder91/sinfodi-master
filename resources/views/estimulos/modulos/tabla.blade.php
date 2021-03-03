<table class="table table-bordered">
    <thead class="thead-dark">
        <tr class="text-center">
            <th scope="col">#</th>
            <th scope="col">Nombre del módulo</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datos as $item)
            <tr>
                <th scope="row" class="text-center">{{ $item->id }}</th>
                <td>{{ $item->nombre }}</td>
                <td class="text-center"></td>
            </tr>
        @endforeach
    </tbody>
</table>
