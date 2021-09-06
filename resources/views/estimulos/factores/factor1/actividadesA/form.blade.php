<input type="text" name="id" id="id" hidden>

<label for="txtNombre" class="col-form-control">
    <span style="color: red">*</span>Criterio:
</label>
<textarea class="form-control" id="txtNombreE"></textarea>

<label for="" name='id_objetivo'>
    <span style="color: red">*</span>Objetivo al que pertenece:
</label>

<select name="id_objetivo" id="id_objetivoE" class="form-control id_objetivo">
    <option value="0" selected disabled>Seleccione un objetivo...</option>
    @foreach ($objetivos as $item)
        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
    @endforeach
</select>

<label for="" name='puntos' class="col-form-control">
    <span style="color: red">*</span>Punto asginado:
</label>

<input type="number" class="form-control" onKeyPress="return soloNumeros(event)" id="txtPuntosE">

<input type="text" name="observaciones" class="observaciones" id="observaciones" value="Tabla 1. Actividad A." hidden>
