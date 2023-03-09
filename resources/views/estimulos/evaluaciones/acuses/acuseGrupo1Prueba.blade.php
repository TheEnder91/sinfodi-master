@php
    $totalPuntosA = $sumaTotalPuntosA * 0.3;
    $totalPuntosB = $sumaTotalPuntosB * 0.7;
    $sumarTotalPuntosAyB = $totalPuntosA + $totalPuntosB;
    $montoAnual = $sumarTotalPuntosAyB * $valorPuntoProductividad
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
                <td>Factor 1. (Total puntos actividades A + B) * {{ number_format($valorPuntoProductividad, 2) }}</td>
                <td style="text-align: center">{{ number_format($sumarTotalPuntosAyB, 2) }}</td>
                <td style="text-align: center">${{ number_format($montoAnual, 2) }}</td>
                {{-- <td style="text-align: center">$0.00</td> --}}
            </tr>
            <tr>
                <td><b>Criterios adoptados por DG</b></td>
                <td style="text-align: center"></td>
                <td style="text-align: center"></td>
                {{-- <td style="text-align: center"></td> --}}
            </tr>
            @if($año == 2020)
                <tr>
                    <td>Ingresos propios</td>
                    <td style="text-align: center">N/A</td>
                    <td style="text-align: center">$0.00</td>
                    {{-- <td style="text-align: center">$0.00</td> --}}
                </tr>
                <tr>
                    <td>Fondos en administración</td>
                    <td style="text-align: center">N/A</td>
                    <td style="text-align: center">$0.00</td>
                    {{-- <td style="text-align: center">$0.00</td> --}}
                </tr>
            @endif
            {{-- <tr>
                <td>Ingresos propios</td>
                <td style="text-align: center">N/A</td>
                <td style="text-align: center">$0.00</td>
                <td style="text-align: center">$0.00</td>
            </tr>
            <tr>
                <td>Fondos en administración</td>
                <td style="text-align: center">N/A</td>
                <td style="text-align: center">$0.00</td>
                <td style="text-align: center">$0.00</td>
            </tr> --}}
        </tbody>
        <tfoot width = "100%" style="font-size: 10px;">
            <tr>
                <td style="text-align: left">Total General:</td>
                <td style="text-align: center">{{ number_format($sumarTotalPuntosAyB, 2) }}</td>
                <td style="text-align: center">${{ number_format($montoAnual, 2) }}</td>
                {{-- <td style="text-align: center">$0.00</td> --}}
            </tr>
        </tfoot>
        <div style="font-size: 8px;">
            <b>1 Cifras antes de impuestos.</b>
        </div>
    </table>
</div>
<br>
<fieldset class="Fieldset">
    <legend class="Legend">Grupo 1</legend>
    <fieldset>
        <legend class="LegendFactor">Factor 1</legend>
        <table class="factores" style="width: 100%;" border="1">
            <thead>
                <tr style="text-align: center; font-size: 12px; font-weight: bold;">
                    <td colspan="4">Factor 1. Tabla 1. Actividades A</td>
                </tr>
                <tr style="text-align: center; font-size: 11px; font-weight: bold;">
                    <td>Criterio evaluado</td>
                    <td>Valor</td>
                    <td>Cantidad</td>
                    <td>Total</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($criteriosA as $itemCriteriosA)
                    <tr>
                        <td class="tbody">{{ $itemCriteriosA->criterio }}</td>
                        <td class="tbody" style="text-align: center">{{ $itemCriteriosA->puntosCriterio }}</td>
                        <td class="tbody" style="text-align: center">
                            @if ($itemCriteriosA->cantidad === null)
                                0
                            @else
                                {{ round($itemCriteriosA->cantidad) }}
                            @endif
                        </td>
                        <td class="tbody" style="text-align: center">
                            @if ($itemCriteriosA->totalPuntos === null)
                                0.00
                            @else
                                {{ number_format($itemCriteriosA->totalPuntos, 2) }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr style="font-size: 10px;">
                    <td style="text-align: right; font-weight: bold;" colspan="3">Total de puntos</td>
                    <td style="text-align: center">{{ number_format($sumaTotalPuntosA, 2) }}</td>
                </tr>
                <tr style="font-size: 10px;">
                    <td style="text-align: right; font-weight: bold;" colspan="3">Total de puntos * 0.3</td>
                    <td style="text-align: center">{{ number_format($totalPuntosA, 2) }}</td>
                </tr>
                <tr>
                    <td style="text-align: left; font-size: 8px; font-weight: bold;" colspan="4">Resultado de la suma de la tabla 1 actividades A multiplicados por un factor de 0.3, al Anexo 1 Mecanismo de Evaluación, página 13.</td>
                </tr>
                <tr>
                    <td style="text-align: left; font-size: 8px; font-weight: bold;" colspan="4">*Ingreso obtenido por proyecto / 10000</td>
                </tr>
            </tfoot>
        </table>
        <br>
        <table class="factores" style="width: 100%;" border="1">
            <thead>
                <tr style="text-align: center; font-size: 12px; font-weight: bold;">
                    <td colspan="4">Factor 1. Tabla 2. Actividades B</td>
                </tr>
                <tr style="text-align: center; font-size: 11px; font-weight: bold;">
                    <td>Criterio evaluado</td>
                    <td>Valor</td>
                    <td>Cantidad</td>
                    <td>Total</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($criteriosB as $itemCriteriosB)
                    <tr>
                        <td class="tbody">{{ $itemCriteriosB->criterio }}</td>
                        <td class="tbody" style="text-align: center">{{ $itemCriteriosB->puntosCriterio }}</td>
                        <td class="tbody" style="text-align: center">
                            @if ($itemCriteriosB->cantidad === null)
                                0
                            @else
                                {{ round($itemCriteriosB->cantidad) }}
                            @endif
                        </td>
                        <td class="tbody" style="text-align: center">
                            @if ($itemCriteriosB->totalPuntos === null)
                                0.00
                            @else
                                {{ $itemCriteriosB->totalPuntos }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr style="font-size: 10px;">
                    <td style="text-align: right; font-weight: bold;" colspan="3">Total de puntos</td>
                    <td style="text-align: center">{{ number_format($sumaTotalPuntosB, 2) }}</td>
                </tr>
                <tr style="font-size: 10px;">
                    <td style="text-align: right; font-weight: bold;" colspan="3">Total de puntos * 0.7</td>
                    <td style="text-align: center">{{ number_format($totalPuntosB, 2) }}</td>
                </tr>
                <tr>
                    <td style="text-align: left; font-size: 8px; font-weight: bold;" colspan="4">Resultado de la suma de la tabla 2 actividades B multiplicados por un factor de 0.7, al Anexo 1 Mecanismo de Evaluación, página 13.</td>
                </tr>
            </tfoot>
        </table>
    </fieldset>
    <br>
    <fieldset>
        <legend class="LegendFactor">Factor 2*</legend>
        <div style="width: 100%; text-align: justify; font-size: 11px; font-weight: bold">
            {{-- Conforme a los lineamientos para el otorgamiento de estimulos por proyecto del personal cientifico y tecnologico del CIDETEQ en su anexo 1 página 13 que a la letra dice, estos y a las atribuciones de la DG y conforme al criterio del comite de estimulos SDCH-056-2022 de fecha del 13 de Junio del 2022 este factor podra o no ser evaluado. --}}
            Acuerdo 03/ext05/2022. La titular de la Dirección General de conformidad con sus facultades determina lo siguiente: Del grupo 1 solo se aplicará el factor 1, los factores 2 y 3 no se evalúan tomando en consideración el Anexo 1 pagina 13 de los Lineamientos aplicables.
        </div>
        <br>
    </fieldset>
    <br>
    <fieldset>
        <legend class="LegendFactor">Factor 3*</legend>
        <div style="width: 100%; text-align: justify; font-size: 11px; font-weight: bold">
            Acuerdo 03/ext05/2022. La titular de la Dirección General de conformidad con sus facultades determina lo siguiente: Del grupo 1 solo se aplicará el factor 1, los factores 2 y 3 no se evalúan tomando en consideración el Anexo 1 pagina 13 de los Lineamientos aplicables.
        </div>
        <br>
    </fieldset>
</fieldset>
<fieldset class="Fieldset">
    <div style="width: 100%; text-align: justify; font-size: 11px;">
        Fecha y número de acta de presentación de los resultados de determinación de cálculo de estímulos presentados a la Dirección General conforme al Capítulo  VIII , Numeral 2 "De la facultades de los integrantes del Comité de Evaluación" punto 3 para aprobación del pago.<br><br>
        Quinta sesión Extraordinaria, La Titular de la Dirección General aprueba la presente cédula de evaluación para el otorgamiento de estímulos al personal científico y tecnológico del Centro, correspondiente al ejercicio 2021 mediante Acuerdo número: 05/EXT/2022.<br><br>
        Quinta sesión Extraordinaria, La Titular de la Dirección General conforme a sus facultades establecidas en los Lineamientos para el otorgamiento de estímulos al personal científico y tecnológico del CIDETEQ, aprueba que la dispersión del monto a pagar señalado en la presente cédula de evaluación correspondiente al ejercicio 2021 se realice en una sola exhibición mediante Acuerdo número: 06/EXT/2022.
    </div>
</fieldset>
