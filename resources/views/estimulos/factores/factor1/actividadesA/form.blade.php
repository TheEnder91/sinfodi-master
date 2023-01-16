<input type="text" name="id" id="id" hidden>

<label for="txtNombre" class="col-form-control" style="font-size:13px;">
    <span style="color: red">*</span>Criterio:
</label>
<textarea class="form-control form-control-sm" id="txtNombreE"></textarea>

<label for="" name='id_objetivo' style="font-size:13px;">
    <span style="color: red">*</span>Objetivo al que pertenece:
</label>

<select name="id_objetivo" id="id_objetivoE" class="form-control form-control-sm id_objetivo">
    <option value="0" selected disabled style="font-size:13px;">Seleccione un objetivo...</option>
    @foreach ($objetivos as $item)
        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
    @endforeach
</select>

<label for="" name='puntos' class="col-form-control" style="font-size:13px;">
    <span style="color: red">*</span>Punto asginado:
</label>

<input type="number" class="form-control form-control-sm" onKeyPress="return soloNumeros(event)" id="txtPuntosE">

<input type="text" name="observaciones" class="observaciones" id="observaciones" value="Tabla 1. Actividad A." hidden>
