<div id="page">
    <table id="resumen">
        <thead>
            <tr>
                <th>Resumen</th>
                <th>No. Puntos Anual</th>
                <th>Monto Anual<sup>1</sup></th>
                <th>Monto Bimestral<sup>1</sup></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Factor 1. Puntaje de acuerdo a su función</td>
                <td style="text-align: center">{{ $puntajeResponsabilidad }}</td>
                <td style="text-align: center">N/A</td>
                <td style="text-align: center">N/A</td>
            </tr>
            <tr>
                <td>Factor 2. Evaluación anual de nivel de impacto para el desarrollo institucional</td>
                @if ($tipoResonsabilidad == 'Directores' || $tipoResonsabilidad == 'Subdirectores')
                    <td style="text-align: center">{{ $nivelImpacto }}</td>
                @elseif ($tipoResonsabilidad == 'Coordinadores' || $tipoResonsabilidad == 'Personal_Apoyo')
                    <td style="text-align: center">N/A</td>
                @endif
                <td style="text-align: center">N/A</td>
                <td style="text-align: center">N/A</td>
            </tr>
        </tbody>
        @php
            $calculo1 = (intval($puntajeResponsabilidad) * intval($nivelImpacto)) * floatval($valorPuntoResponsabilidad);
            $calculoBimestral1 = $calculo1 / 6;
            $calculo2 =  intval($puntajeResponsabilidad) * floatval($valorPuntoResponsabilidad);
            $calculoBimestral2 = $calculo2 / 6;
        @endphp
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
                    <td style="text-align: left">Calculo para determinar el monto del éstimulo = ({{ $puntajeResponsabilidad }} * {{ $nivelImpacto }}) * {{ $valorPuntoResponsabilidad }}:</td>
                    <td style="text-align: center">N/A</td>
                    <td style="text-align: center">${{ number_format($calculo1, 2) }}</td>
                    <td style="text-align: center">${{ number_format($calculoBimestral1, 2) }}</td>
                @elseif ($tipoResonsabilidad == 'Coordinadores' || $tipoResonsabilidad == 'Personal_Apoyo')
                    <td style="text-align: left">Calculo para determinar el monto del éstimulo = {{ $puntajeResponsabilidad }} * {{ $valorPuntoResponsabilidad }}:</td>
                    <td style="text-align: center">N/A</td>
                    <td style="text-align: center">${{ number_format($calculo2, 2) }}</td>
                    <td style="text-align: center">${{ number_format($calculoBimestral2, 2) }}</td>
                @endif
            </tr>
        </tfoot>
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
            *Conforme a los Lineamientos para el Otorgamiento de Estímulos por Proyecto del Personal Científico y Tecnológico del CIDETEQ en el ANEXO 1, numeral 2, página 16;  criterio de la Dirección General de no evaluarse y acordado por el Comité de Estímulos conforme al oficio SDCH-056-2022 de fecha 13 de junio 2022.
        </div>
        <br>
    </fieldset>
</fieldset>
<fieldset class="Fieldset">
    <div style="width: 100%; text-align: justify; font-size: 11px;">
        Fecha y número de acta de presentación de los resultados de determinación de cálculo de estímulos presentados a la Dirección General conforme al Capítulo  VIII , Numeral 2 "De la facultades de los integrantes del Comité de Evaluación" punto 3 para aprobación del pago.
    </div>
</fieldset>
