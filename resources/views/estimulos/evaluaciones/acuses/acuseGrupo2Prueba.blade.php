@php
    $calculo1 = (intval($puntajeResponsabilidad) * intval($nivelImpacto)) * floatval($valorPuntoResponsabilidad);
    $calculoBimestral1 = $calculo1 / 6;
    $calculo2 =  intval($puntajeResponsabilidad) * floatval($valorPuntoResponsabilidad);
    $calculoBimestral2 = $calculo2 / 6;
@endphp
<div id="page">
    <table id="resumen">
        <thead>
            <tr>
                <th>Resumen</th>
                <th>No. Puntos Anual</th>
                <th>Monto Anual<sup>1</sup></th>
                {{-- <th>Monto Bimestral<sup>1</sup></th> --}}
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Factor 1. Puntaje de acuerdo a su función</td>
                <td style="text-align: center">{{ $puntajeResponsabilidad }}</td>
                @if ($tipoResonsabilidad == 'Directores' || $tipoResonsabilidad == 'Subdirectores')
                    <td style="text-align: center">${{ number_format($calculo1, 2) }}</td>
                @elseif ($tipoResonsabilidad == 'Coordinadores' || $tipoResonsabilidad == 'Personal_Apoyo')
                    <td style="text-align: center">${{ number_format($calculo2, 2) }}</td>
                @endif
                {{-- <td style="text-align: center">N/A</td> --}}
            </tr>
            <tr>
                <td>Factor 2. Evaluación anual de nivel de impacto para el desarrollo institucional</td>
                @if ($tipoResonsabilidad == 'Directores' || $tipoResonsabilidad == 'Subdirectores')
                    <td style="text-align: center">{{ $nivelImpacto }}</td>
                @elseif ($tipoResonsabilidad == 'Coordinadores' || $tipoResonsabilidad == 'Personal_Apoyo')
                    <td style="text-align: center">N/A</td>
                @endif
                <td style="text-align: center">N/A</td>
                {{-- <td style="text-align: center">N/A</td> --}}
            </tr>
        </tbody>
        <tfoot width = "100%" style="font-size: 10px;">
            <tr>
                @if ($tipoResonsabilidad == 'Directores' || $tipoResonsabilidad == 'Subdirectores')
                    <td style="text-align: left"><b>Calculo para determinar el monto del éstimulo = (Factor1 * Factor2) * valor del punto:</b></td>
                @elseif ($tipoResonsabilidad == 'Coordinadores' || $tipoResonsabilidad == 'Personal_Apoyo')
                    <td style="text-align: left"><b>Calculo para determinar el monto del éstimulo = Factor1 * valor del punto:</b></td>
                @endif
                <td style="text-align: center"></td>
                <td style="text-align: center"></td>
                <td style="text-align: center"></td>
            </tr>
            <tr>
                @if ($tipoResonsabilidad == 'Directores' || $tipoResonsabilidad == 'Subdirectores')
                    <td style="text-align: left">Calculo para determinar el monto del éstimulo = ({{ $puntajeResponsabilidad }} * {{ $nivelImpacto }}) * {{ number_format($valorPuntoResponsabilidad, 2) }}:</td>
                    <td style="text-align: center">N/A</td>
                    <td style="text-align: center">${{ number_format($calculo1, 2) }}</td>
                    {{-- <td style="text-align: center">${{ number_format($calculoBimestral1, 2) }}</td> --}}
                @elseif ($tipoResonsabilidad == 'Coordinadores' || $tipoResonsabilidad == 'Personal_Apoyo')
                    <td style="text-align: left">Calculo para determinar el monto del éstimulo = {{ $puntajeResponsabilidad }} * {{ number_format($valorPuntoResponsabilidad, 2) }}:</td>
                    <td style="text-align: center">N/A</td>
                    <td style="text-align: center">${{ number_format($calculo2, 2) }}</td>
                    {{-- <td style="text-align: center">${{ number_format($calculoBimestral2, 2) }}</td> --}}
                @endif
            </tr>
        </tfoot>
        <div style="font-size: 8px;">
            <b>1 Cifras antes de impuestos.</b>
        </div>
    </table>
</div>
<br>
<fieldset class="Fieldset">
    <legend class="Legend">Grupo 2</legend>
    <fieldset>
        <legend class="LegendFactor">Factor 1</legend>
        <table class="factores">
            <thead>
                <tr>
                    <th class="thead">Nivel de responsabilidad</th>
                    <th class="thead">Puntos</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="tbody">{{ $nivelResponsabilidad }}</td>
                    <td class="tbody" style="text-align: center">{{ $puntajeResponsabilidad }}</td>
                </tr>
            </tbody>
        </table>
        <br>
    </fieldset>
    <br>
    <fieldset>
        <legend class="LegendFactor">Factor 2</legend>
        <div style="width: 100%; text-align: center;">
            @if ($tipoResonsabilidad == 'Directores' || $tipoResonsabilidad == 'Subdirectores')
                <table class="factores">
                    <thead>
                        <tr style="text-align: center; font-size: 12px; font-weight: bold;">
                            <td class="thead" colspan="2">FACTOR DEL NIVEL DE IMPACTO AL DESARROLLO INSTITUCIONAL</td>
                        </tr>
                        <tr style="text-align: center;">
                            <td class="thead">F2 = FACTOR</td>
                            <td class="thead">Nivel</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="tbody" style="text-align: center;">1</td>
                            <td class="tbody" style="text-align: center">Medio</td>
                        </tr>
                    </tbody>
                </table>
            @elseif ($tipoResonsabilidad == 'Coordinadores' || $tipoResonsabilidad == 'Personal_Apoyo')
                <div style="width: 100%; text-align: justify; font-size: 11px; font-weight: bold">
                    *NO APLICA
                </div>
            @endif
        </div>
        <br>
    </fieldset>
    <br>
    <fieldset>
        <legend class="LegendFactor">Factor 3*</legend>
        <div style="width: 100%; text-align: justify; font-size: 11px; font-weight: bold">
            Acuerdo 04/ext05/{{ date("Y") }}. La titular de la Dirección General de conformidad con sus facultades determina lo siguiente: Del grupo 2 no se evalúa el factor 3 tomando en consideración lo descrito en la página 18 de los lineamientos aplicables.
        </div>
        <br>
    </fieldset>
</fieldset>
<fieldset class="Fieldset">
    <div style="width: 100%; text-align: justify; font-size: 11px;">
        Fecha y número de acta de presentación de los resultados de determinación de cálculo de estímulos presentados a la Dirección General conforme al Capítulo  VIII , Numeral 2 "De la facultades de los integrantes del Comité de Evaluación" punto 3 para aprobación del pago.<br><br>
        Quinta sesión Extraordinaria, La Titular de la Dirección General aprueba la presente cédula de evaluación para el otorgamiento de estímulos al personal científico y tecnológico del Centro, correspondiente al ejercicio 2021 mediante Acuerdo número: 05/EXT/{{ date("Y") }}.<br><br>
        Quinta sesión Extraordinaria, La Titular de la Dirección General conforme a sus facultades establecidas en los Lineamientos para el otorgamiento de estímulos al personal científico y tecnológico del CIDETEQ, aprueba que la dispersión del monto a pagar señalado en la presente cédula de evaluación correspondiente al ejercicio 2021 se realice en una sola exhibición mediante Acuerdo número: 06/EXT/{{ date("Y") }}.
    </div>
</fieldset>
