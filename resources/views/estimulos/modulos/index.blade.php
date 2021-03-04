@extends('layouts.app')

@section('title_content')
    <i class="fa fa-cubes"></i> Módulos
@endsection

@section('title_card', 'Listado de módulos')

@section('content_card')

    <section class="text-right">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalNuevo">
            <i class="fa fa-plus-circle"></i> Nuevo registro
        </button>
    </section><br>
    {{-- @include('estimulos.modulos.tabla') --}}

    <div id="tabla"></div>

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
        $(document).ready(function(){
            ver_tabla();
        });

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
                            ver_tabla();
                        }
                    }
                });
            });
        }

        function ver_tabla(){
            $.get('tblModulos', function(data){
                $('#tabla').empty().html(data);
            });
        }
    </script>
@endsection
