@php
    $calculo1 = (intval($puntajeResponsabilidad)) * floatval($valorPuntoResponsabilidad);
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
                @if ($clave == 167)
                    <td style="text-align: center">1200</td>
                @elseif ($clave == 254)
                    <td style="text-align: center">800</td>
                @elseif ($clave == 271)
                    <td style="text-align: center">400</td>
                @else
                    <td style="text-align: center">{{ $puntajeResponsabilidad }}</td>
                @endif
                @if ($tipoResonsabilidad == 'Directores' || $tipoResonsabilidad == 'Subdirectores')
                    <td style="text-align: center">N/A</td>
                @elseif ($tipoResonsabilidad == 'Coordinadores' || $tipoResonsabilidad == 'Personal_Apoyo')
                    <td style="text-align: center">N/A</td>
                @endif
                {{-- <td style="text-align: center">N/A</td> --}}
            </tr>
            <tr>
                <td>Factor 2. Evaluación anual de nivel de impacto para el desarrollo institucional</td>
                @if ($tipoResonsabilidad == 'Directores' || $tipoResonsabilidad == 'Subdirectores')
                    <td style="text-align: center">{{ $factorImpacto }}</td>
                @elseif ($tipoResonsabilidad == 'Coordinadores' || $tipoResonsabilidad == 'Personal_Apoyo')
                    <td style="text-align: center">N/A</td>
                @endif
                <td style="text-align: center">N/A</td>
                {{-- <td style="text-align: center">N/A</td> --}}
            </tr>
            <tr>
                <td>Factor 3. Evaluación anual de factor por desempeño</td>
                @if ($tipoResonsabilidad == 'Directores' || $tipoResonsabilidad == 'Subdirectores')
                    <td style="text-align: center">N/A</td>
                @elseif ($tipoResonsabilidad == 'Coordinadores' || $tipoResonsabilidad == 'Personal_Apoyo')
                    <td style="text-align: center">{{ $f3Desempeño }}</td>
                @endif
                <td style="text-align: center">N/A</td>
            </tr>
        </tbody>
        <tfoot width = "100%" style="font-size: 10px;">
            <tr>
                @if ($tipoResonsabilidad == 'Directores' || $tipoResonsabilidad == 'Subdirectores')
                    <td style="text-align: left"><b>Calculo para determinar el monto del éstimulo = (Factor1 * Factor2) * valor del punto:</b></td>
                @elseif ($tipoResonsabilidad == 'Coordinadores' || $tipoResonsabilidad == 'Personal_Apoyo')
                    <td style="text-align: left"><b>Calculo para determinar el monto del éstimulo = (Factor1 * Factor3) * valor del punto:</b></td>
                @endif
                <td style="text-align: center"></td>
                <td style="text-align: center"></td>
                <td style="text-align: center"></td>
            </tr>
            <tr>
                @if ($tipoResonsabilidad == 'Directores' || $tipoResonsabilidad == 'Subdirectores')
                    @if ($clave == 167)
                        <td style="text-align: left">Calculo para determinar el monto del éstimulo = (1200 * {{ $factorImpacto }}) * {{ number_format($valorPuntoResponsabilidad, 2) }}:</td>
                    @else
                        <td style="text-align: left">Calculo para determinar el monto del éstimulo = ({{ $puntajeResponsabilidad }} * {{ $factorImpacto }}) * {{ number_format($valorPuntoResponsabilidad, 2) }}:</td>
                    @endif
                    <td style="text-align: center">{{ $puntajeResponsabilidad }}</td>
                    <td style="text-align: center">${{ number_format($calculo1, 2) }}</td>
                    {{-- <td style="text-align: center">${{ number_format($calculoBimestral1, 2) }}</td> --}}
                @elseif ($tipoResonsabilidad == 'Coordinadores' || $tipoResonsabilidad == 'Personal_Apoyo')
                    @if ($clave == 254)
                        <td style="text-align: left">Calculo para determinar el monto del éstimulo = (800 * {{ $f3Desempeño }}) * {{ number_format($valorPuntoResponsabilidad, 2) }}:</td>
                    @elseif ($clave == 271)
                        <td style="text-align: left">Calculo para determinar el monto del éstimulo = (400 * {{ $f3Desempeño }}) * {{ number_format($valorPuntoResponsabilidad, 2) }}:</td>
                    @else
                        <td style="text-align: left">Calculo para determinar el monto del éstimulo = {{ $puntajeResponsabilidad }} * {{ number_format($valorPuntoResponsabilidad, 2) }}:</td>
                    @endif
                    <td style="text-align: center">{{ $puntajeResponsabilidad }}</td>
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
                    @if($tipoResonsabilidad == 'Directores')
                        <td class="tbody">Director de área o equivalente</td>
                    @elseif ($tipoResonsabilidad == 'Subdirectores')
                        <td class="tbody">Subdirector de área o equivalente</td>
                    @elseif ($tipoResonsabilidad == 'Coordinadores')
                        <td class="tbody">Coordinador de área o equivalente</td>
                    @elseif ($tipoResonsabilidad == 'Personal_Apoyo')
                        <td class="tbody">Personal de apoyo de área o equivalente</td>
                    @endif
                    @if($clave == 167)
                        <td class="tbody" style="text-align: center">1200</td>
                    @elseif ($clave == 254)
                        <td class="tbody" style="text-align: center">800</td>
                    @elseif ($clave == 271)
                        <td class="tbody" style="text-align: center">400</td>
                    @else
                        <td class="tbody" style="text-align: center">{{ $puntajeResponsabilidad }}</td>
                    @endif
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
                            <td class="tbody" style="text-align: center;">{{ $factorImpacto }}</td>
                            <td class="tbody" style="text-align: center">{{ $nivelImpacto }}</td>
                        </tr>
                    </tbody>
                </table>
            @elseif ($tipoResonsabilidad == 'Coordinadores' || $tipoResonsabilidad == 'Personal_Apoyo')
                <div style="width: 100%; text-align: justify; font-size: 11px; font-weight: bold">
                    *ESTE FACTOR APLICA PARA DIRECTORES Y SUBDIRECTORES.
                </div>
            @endif
        </div>
        <br>
    </fieldset>
    <br>
    <fieldset>
        <legend class="LegendFactor">Factor 3*</legend>
        @if ($tipoResonsabilidad == 'Directores' || $tipoResonsabilidad == 'Subdirectores')
            <div style="width: 100%; text-align: justify; font-size: 11px; font-weight: bold">
                *ESTE FACTOR APLICA PARA COORDINADORES Y PERSONAL DE APOYO.
            </div>
        @elseif ($tipoResonsabilidad == 'Coordinadores' || $tipoResonsabilidad == 'Personal_Apoyo')
            <div style="width: 100%; text-align: center;">
                <table class="factores">
                    <thead>
                        <tr style="text-align: center; font-size: 12px; font-weight: bold;">
                            <td class="thead" colspan="2">FACTOR POR DESEMPEÑO</td>
                        </tr>
                        <tr style="text-align: center;">
                            <td class="thead">RESULTADO DE LA EVALUACION</td>
                            <td class="thead">F3 = FACTOR x Cumplimiento de Metas de Desempeño Cualitativo</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="tbody" style="text-align: center;">{{ $resultadosDesempeño }}</td>
                            <td class="tbody" style="text-align: center">{{ $f3Desempeño }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endif
        <br>
    </fieldset>
</fieldset>
<fieldset class="Fieldset">
    <div style="width: 100%; text-align: justify; font-size: 11px;">
        Fecha y número de acta de presentación de los resultados de determinación de cálculo de estímulos presentados a la Dirección General conforme al Capítulo  VIII , Numeral 2 "De la facultades de los integrantes del Comité de Evaluación" punto 3 para aprobación del pago.<br><br>
        Quinta sesión Extraordinaria, La Titular de la Dirección General aprueba la presente cédula de evaluación para el otorgamiento de estímulos al personal científico y tecnológico del Centro, correspondiente al ejercicio {{ date('Y') - 1 }}.<br><br>
        Quinta sesión Extraordinaria, La Titular de la Dirección General conforme a sus facultades establecidas en los Lineamientos para el otorgamiento de estímulos al personal científico y tecnológico del CIDETEQ, aprueba que la dispersión del monto a pagar señalado en la presente cédula de evaluación correspondiente al ejercicio {{ date('Y') - 1 }} se realice de forma bimestral.
    </div>
</fieldset>
