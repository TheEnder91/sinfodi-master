@extends('layouts.app')

@section('title_content')
    <i class="fa fa-cubes"></i> Módulos
@endsection

@section('title_card', 'Listado de módulos')

@section('content_card')

    @if (session('exito'))
        <span class="alert-success">
            {{ session('exito') }}
        </span>
    @else
        <span class="alert-error">
            {{ session('error') }}
        </span>
    @endif

    <section class="text-right">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalNuevo">
            <i class="fa fa-plus-circle"></i> Nuevo registro
        </button>
    </section><br>
    @include('estimulos.modulos.tabla')

    @include('estimulos.modulos.modalEditar')

    {{-- Modal nuevo --}}
    @section('titulo_modal', 'Nuevo registro')

    @section('cuerpo_modal')
        <form action="{{ route('modulos.store') }}" method="POST">
            @csrf
            @include('estimulos.modulos.form')
            @section('pie_modal')
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> Guardar registro
                </button>
        </form>
        @endsection
    @endsection
@endsection

@section('scripts')
    <script>
        function ver_datos(id){
            $.get('modulos/' + id + '/edit', function(data){
                // console.log(data);
                $('#id').val(data.id);
                $('input[name="nombre"]').val(data.nombre);
            });

            $('#btn_actualizar').on('click', function(){
                var id = $('#id').val();
                var nombre = $('input[name="nombre"]').val();
                var token = $('input[name="_token"]').val();
                $.ajax({
                    url: 'modulos/' + id,
                    type: 'PUT',
                    data: {
                        nombre: nombre,
                        _token: token
                    },
                    success: function(data){
                        if(data == "ok"){
                            $('#modalEditar').modal('hide');
                            swal('Exito!!', 'Se guardo correctamente el registro.', 'success');
                            //ver_tabla();
                        }
                    }
                });
            });
        }
    </script>
@endsection
