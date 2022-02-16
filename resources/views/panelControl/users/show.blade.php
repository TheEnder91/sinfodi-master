@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/panel_control.png') }}" width="50px" height="50px"> Panel de control
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/panelControl/listUsers') }}">Listado de usuarios</a></li>
        <li class="breadcrumb-item active">Editar usuario: <b>{{ $row->nombre }}</b></li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card')
            Editar usuario: <b>{{ $row->nombre }}</b>
        @endslot
        <div class="row">
            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label class="control-label" for="txtNomUser">Nombre del usuario:</label>
                    <input id="txtNomUser" autocomplete="off" type="text" class="form-control" value="{{ $row->nombre }}" readonly>
                </div>
            </div>
            <div class="col-12 col-md-2">
                <div class="form-group">
                    <label class="control-label" for="txtUser">Usuario:</label>
                    <input id="txtUser" autocomplete="off" type="text" class="form-control" value="{{ $row->usuario }}" readonly>
                </div>
            </div>
            <div class="col-12 col-md-7">
                @component('components.card')
                    @slot('title_card', 'Asignar rol')
                    <div style="column-count:2; list-style: none;">
                        @foreach ($roles as $itemRoles)
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input roles" name="rol[]" id="rol{{ $itemRoles->id }}" value="{{ $itemRoles->id }}"
                                    @if (is_array($role_user) && in_array("$itemRoles->id", $role_user))
                                        checked
                                    @endif
                                >
                                <label class="custom-control-label" for="rol{{ $itemRoles->id }}">{{ $itemRoles->id }} - {{ $itemRoles->description }}</label>
                            </div>
                        @endforeach
                    </div>
                @endcomponent
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="float-right">
                    <a href="{{ \App\Traits\Principal::getUrlToken('/panelControl/listUsers') }}" class="btn btn-outline-danger">Cancelar</a>
                    @can('admin-user-edit')
                        <input type="button" class="btn btn-success" value="Actualizar" id="btnActualizar"/>
                    @endcan
                </div>
            </div>
        </div>
    @endcomponent
@endsection

@section('scripts')
    <script>
        $(document).ready(initRoles);

        function initRoles(){
            $('#btnActualizar').on('click', actualizarRol);
        }

        function actualizarRol(){
            var nombre = $('#txtNomUser').val();
            var usuario = $('#txtUser').val();
            var roles = [];

            $('input.roles:checked').each(function(){
                roles.push(this.value);
            });

            swal({
                type: 'warning',
                title: "Se actualizara el registro.",
                text: "¿Desea continuar?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Si, actualizar",
                denyButtonText: "Cancelar",
            }).then((result) => {
                var options = {
                    action: "{{ config('app.url') }}/panelControl/updateUser/{{ $row->id }}",
                    json: {
                        nombre: nombre,
                        usuario: usuario,
                        role: roles,
                        _token: "{{ csrf_token() }}",
                    },
                    type: 'PUT',
                    dateType: 'json',
                    mensajeConfirm: 'El registro se actualizo correctamente',
                    url: "{{ config('app.url') }}/panelControl/listUsers?token={{ Session::get('token') }}"
                };
                peticionGeneralAjax(options);
            });
        }
    </script>
@endsection
