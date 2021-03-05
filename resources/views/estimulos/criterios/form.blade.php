@csrf
<input type="text" name="id" id="id" hidden>

{{-- <label for="" class="col-form-control">
    Criterio:
</label>
<input type="text" name="nombre" class="form-control"> --}}

<label for="" class="col-form-control">
    Criterio:
</label>
<textarea class="form-control" name="nombre" id="nombre"></textarea>

<label for="" name='id_modulo'>
    Objetivo al que pertenece:
</label>

<select name="id_modulo" id="id_modulo" class="form-control">
    <option value="" selected disabled>Seleccione un modulo...</option>
    @foreach ($modulos as $item)
        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
    @endforeach
</select>

<label for="" name='puntos' class="col-form-control">
    Punto asginado:
</label>
<input type="number" name="puntos" class="form-control" onKeyPress="return soloNumeros(event)">
