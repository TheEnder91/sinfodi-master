@csrf
<input type="text" name="id" id="id" hidden>

<label for="" class="col-form-control">
    <span style="color: red">*</span>Criterio:
</label>
<textarea class="form-control" name="nombre" id="nombreE"></textarea>

<label for="" name='id_objetivo'>
    <span style="color: red">*</span>Objetivo al que pertenece:
</label>

<select name="id_objetivo" id="id_objetivoE" class="form-control">
    <option value="" selected disabled>Seleccione un objetivo...</option>
    @foreach ($objetivos as $item)
        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
    @endforeach
</select>

<label for="" name='puntos' class="col-form-control">
    <span style="color: red">*</span>Punto asginado:
</label>

<input type="number" name="puntos" class="form-control" onKeyPress="return soloNumeros(event)" id="puntosE">

<input type="text" name="observaciones" id="observaciones" value="Tabla 1. Actividad B." hidden>
