@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/panel_control.png') }}" width="50px" height="50px"> Panel de control
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/panelControl/listRoles') }}">Listado de roles</a></li>
        <li class="breadcrumb-item active">Editar rol: <b>{{ $role->description }}</b></li>
    </ol>
@endsection


@section('content')
    @component('components.card')
        @slot('title_card')
            Editar rol: <b>{{ $role->description }}</b>
        @endslot
        <div class="row">
            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label class="control-label" for="txtNomRol">*Nombre del rol:</label>
                    <input id="txtNomRol" autocomplete="off" type="text" class="form-control" value="{{ $role->name }}">
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label class="control-label" for="txtSlug">*Slug:</label>
                    <input id="txtSlug" autocomplete="off" type="text" class="form-control" value="{{ $role->slug }}">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label class="control-label" for="txtDesRol">*Descripción del rol:</label>
                    <input id="txtDesRol" autocomplete="off" type="text" class="form-control" value="{{ $role->description }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-12">
                @component('components.card')
                    @slot('title_card', 'Listado de permisos')
                    <div style="column-count:4; list-style: none;">
                        @foreach ($permissions as $permission)
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input permissions" name="permission[]" id="permission_{{ $permission->id }}" value="{{ $permission->id }}"
                                @if (is_array($permission_role) && in_array("$permission->id", $permission_role))
                                    checked
                                @endif
                            >
                            <label class="custom-control-label" for="permission_{{ $permission->id }}">{{ $permission->id }} - {{ $permission->name }}</label>
                        </div>
                    @endforeach
                    </div>
                @endcomponent
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="float-right">
                    <a href="{{ \App\Traits\Principal::getUrlToken('/panelControl/listRoles') }}" class="btn btn-outline-danger">Cancelar</a>
                    <input type="button" class="btn btn-success" value="Actualizar" id="btnActualizar"/>
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
            var name = $('#txtNomRol').val();
            var slug = $('#txtSlug').val();
            var description = $('#txtDesRol').val();

            if((name == "") || (slug == "") || (description == "")){
                swal({
                    type: 'warning',
                    title: '',
                    text: 'Por favor de ingresar los campos requeridos.',
                });
                return;
            }

            var full_access = "";
            var permissions = [];

            if($('#fullaccessyes').is(':checked')){
                full_access = 'yes';
            }

            if($('#fullaccessno').is(':checked')){
                full_access = 'no';
            }

            $('input.permissions:checked').each(function(){
                permissions.push(this.value);
            });

            console.log(full_access);
            console.log(permissions);

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
                    action: "{{ config('app.url') }}/panelControl/updateRol/{{ $role->id }}",
                    json: {
                        name: name,
                        slug: slug,
                        description: description,
                        permission: permissions,
                        _token: "{{ csrf_token() }}",
                    },
                    type: 'PUT',
                    dateType: 'json',
                    mensajeConfirm: 'El registro se actualizo correctamente',
                    url: "{{ config('app.url') }}/panelControl/listRoles?token={{ Session::get('token') }}"
                };
                peticionGeneralAjax(options);
            });
        }
    </script>
@endsection
