<table>
    <thead>
        <tr>
            <th colspan="3">Cuadro de actividades susceptibles de evaluación.</th>
            @foreach ($participantes as $itemParticipantes)
                <th colspan="2" background-color="green">{{ $itemParticipantes->clave }} {{ $itemParticipantes->nombre }}</th>
            @endforeach
        </tr>
        <tr>
            <th>Objetivo</th>
            <th>Criterio Evaluado</th>
            <th>Puntos</th>
            @foreach ($participantes as $itemParticipantes)
                <th>Cantidad</th>
                <th>Puntos obtenidos</th>
            @endforeach
        </tr>
        <tr>
            <th colspan="3">Tabla 1. Actividades A.</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>asasas</td>
            <td>qweqweqwe</td>
        </tr>
        {{-- @foreach ($objetivos as $itemObjetivos)
            <tr>
                <td>{{ $itemObjetivos->nombre }}</td>
                <td>asdadad</td>
            </tr>
        @endforeach
        @foreach ($criterios as $itemCriterios)
            <tr>
                <td>{{ $itemCriterios->nombre }}</td>
            </tr>
        @endforeach
        <tr>
            <td>asdasdasdasd</td>
        </tr> --}}
    </tbody>
</table>
