@csrf
<input type="text" name="id" id="id" hidden>

<label for="" class="col-form-control">
    Criterio:
</label>
<input type="text" name="nombre" class="form-control">

<label for="" name='id_modulo'>
    Modulo al que pertenece:
</label>

<select name="id_modulo" id="id_modulo" class="form-control">
    <option value="" selected disabled>Seleccione un modulo...</option>
    @foreach ($modulos as $item)
        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
    @endforeach
</select>
