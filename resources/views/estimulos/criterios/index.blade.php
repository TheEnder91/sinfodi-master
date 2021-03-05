@extends('layouts.app')

@section('title_content')
    <i class="fa fa-clipboard-list"></i> Criterios
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
       <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
       <li class="breadcrumb-item active">Listado de criterios</li>
    </ol>
@endsection

@section('title_card', 'Listado de criterios')

@section('content_card')

    <section class="text-right">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalNuevo">
            <i class="fa fa-plus-circle"></i> Nuevo registro
        </button>
    </section><br>

    <div id="tabla"></div>

    {{-- Incluimos el modal para editar... --}}
    @include('estimulos.criterios.modalEditar')

    {{-- Modal nuevo --}}
    @section('titulo_modal', 'Nuevo registro')

    @section('cuerpo_modal')
        <form action="{{ route('criterios.store') }}" method="POST">
            @csrf
            @include('estimulos.criterios.form')
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
            $.get('criterios/' + id + '/edit', function(data){
                $('#id').val(data.id);
                $('input[name="nombre"]').val(data.nombre);
                $('#id_modulo').val(data.id_modulo);
            });

            $('#btn_actualizar').on('click', function(){
                var id = $('#id').val();
                var nombre = $('input[name="nombre"]').val();
                var id_modulo = $('#id_modulo').val();
                var token = $('input[name="_token"]').val();
                $.ajax({
                    url: 'criterios/' + id,
                    type: 'PUT',
                    data: {
                        nombre: nombre,
                        id_modulo: id_modulo,
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
            $.get('tblCriterios', function(data){
                $('#tabla').empty().html(data);
            });
        }

        function eliminar(id){
            var ruta = 'criterios/' + id;
            var token = $('input[name="_token"]').val();
            swal({
                type: 'warning',
                title: "¿Estas seguro?",
                text: "Se eliminara de forma permanente.",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Si, eliminar",
                denyButtonText: "Cancelar",
            }).then((result) => {
                if (result) {
                    $.ajax({
                        url: ruta,
                        data: {
                            _token: token,
                        },
                        type: 'DELETE',
                        success: function(data){
                            if(data == "ok"){
                                swal('Exito!!', 'Eliminado con exito.', 'success');
                                ver_tabla();
                            }
                        }
                    });
                }
            });
        }
    </script>
@endsection
