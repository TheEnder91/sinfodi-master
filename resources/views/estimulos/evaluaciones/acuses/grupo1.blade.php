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
                        <td class="tbody">{{ $itemCriteriosA->nombre }}</td>
                        <td class="tbody" style="text-align: center">{{ $itemCriteriosA->puntos }}</td>
                        <td class="tbody" style="text-align: center">0</td>
                        <td class="tbody" style="text-align: center">0</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr style="font-size: 10px;">
                    <td style="text-align: right; font-weight: bold;" colspan="3">Total de puntos</td>
                    <td style="text-align: center">0.00</td>
                </tr>
                <tr style="font-size: 10px;">
                    <td style="text-align: right; font-weight: bold;" colspan="3">Total de puntos por 0.3</td>
                    <td style="text-align: center">0.00</td>
                </tr>
                <tr>
                    <td style="text-align: left; font-size: 8px; font-weight: bold;" colspan="4">Resultado de la suma de la tabla 1 actividades A multiplicados por un factor de 0.3, al Anexo 1 Mecanismo de Evaluación, página 13.</td>
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
                        <td class="tbody">{{ $itemCriteriosB->nombre }}</td>
                        <td class="tbody" style="text-align: center">{{ $itemCriteriosB->puntos }}</td>
                        <td class="tbody" style="text-align: center">0</td>
                        <td class="tbody" style="text-align: center">0</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr style="font-size: 10px;">
                    <td style="text-align: right; font-weight: bold;" colspan="3">Total de puntos</td>
                    <td style="text-align: center">0.00</td>
                </tr>
                <tr style="font-size: 10px;">
                    <td style="text-align: right; font-weight: bold;" colspan="3">Total de puntos por 0.7</td>
                    <td style="text-align: center">0.00</td>
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
            Conforme a los Lineamientos para el Otorgamiento de Estímulos por Proyecto del Personal Científico y Tecnológico del CIDETEQ en el ANEXO 1 página 13; criterio de la Dirección General de no evaluarse y acordado por el Comité de Estímulos conforme al oficio SDCH-056-2022 de fecha 13 de junio 2022.
        </div>
        <br>
    </fieldset>
    <br>
    <fieldset>
        <legend class="LegendFactor">Factor 3*</legend>
        <div style="width: 100%; text-align: justify; font-size: 11px; font-weight: bold">
            Conforme a los Lineamientos para el Otorgamiento de Estímulos por Proyecto del Personal Científico y Tecnológico del CIDETEQ en el ANEXO 1 página 13; criterio de la Dirección General de no evaluarse y acordado por el Comité de Estímulos conforme al oficio SDCH-056-2022 de fecha 13 de junio 2022.
        </div>
        <br>
    </fieldset>
</fieldset>
<fieldset class="Fieldset">
    <div style="width: 100%; text-align: justify; font-size: 11px;">
        Fecha y número de acta de presentación de los resultados de determinación de cálculo de estímulos presentados a la Dirección General conforme al Capítulo  VIII , Numeral 2 "De la facultades de los integrantes del Comité de Evaluación" punto 3 para aprobación del pago.
    </div>
</fieldset>
