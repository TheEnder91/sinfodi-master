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
                    <label class="control-label" for="txtNomRol" style="font-size:13px;"><span style="color: red">*</span>Nombre del rol:</label>
                    <input id="txtNomRol" autocomplete="off" type="text" class="form-control form-control-sm" value="{{ $role->name }}">
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label class="control-label" for="txtSlug" style="font-size:13px;"><span style="color: red">*</span>Slug:</label>
                    <input id="txtSlug" autocomplete="off" type="text" class="form-control form-control-sm" value="{{ $role->slug }}">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label class="control-label" for="txtDesRol" style="font-size:13px;"><span style="color: red">*</span>Descripción del rol:</label>
                    <input id="txtDesRol" autocomplete="off" type="text" class="form-control form-control-sm" value="{{ $role->description }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-12">
                @component('components.card')
                    @slot('title_card', 'Listado de permisos')
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            @foreach ($permissionsCat as $item)
                                <a class="nav-item nav-link {{ $item->id_categoria == 1 ? 'active' : '' }}" id="nav-{{ $item->id_categoria }}-tab" data-toggle="tab" href="#nav-{{ $item->id_categoria }}" role="tab" aria-controls="nav-{{ $item->id_categoria }}" aria-selected="true">{{ $item->categoria }}</a>
                            @endforeach
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-1" role="tabpanel" aria-labelledby="nav-1-tab">
                            <div style="column-count:4; list-style: none; padding-left: 1em; padding-top: 1em;">
                                @foreach ($permissions as $permission)
                                    @if ($permission->id_categoria == 1)
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input permissions" name="permission[]" id="permission_{{ $permission->id }}" value="{{ $permission->id }}"
                                                @if (is_array($permission_role) && in_array("$permission->id", $permission_role))
                                                    checked
                                                @endif
                                            >
                                            <label class="custom-control-label" for="permission_{{ $permission->id }}" style="font-size:13px;">{{ $permission->id }} - {{ $permission->slug }}</label>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-2" role="tabpanel" aria-labelledby="nav-2-tab">
                            <div style="column-count:4; list-style: none; padding-left: 1em; padding-top: 1em;">
                                @foreach ($permissions as $permission)
                                    @if ($permission->id_categoria == 2)
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input permissions" name="permission[]" id="permission_{{ $permission->id }}" value="{{ $permission->id }}"
                                                @if (is_array($permission_role) && in_array("$permission->id", $permission_role))
                                                    checked
                                                @endif
                                            >
                                            <label class="custom-control-label" for="permission_{{ $permission->id }}" style="font-size:13px;">{{ $permission->id }} - {{ $permission->slug }}</label>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endcomponent
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="float-right">
                    <a href="{{ \App\Traits\Principal::getUrlToken('/panelControl/listRoles') }}" class="btn btn-outline-danger" style="font-size:13px;">Cancelar</a>
                    @can('admin-role-edit')
                        <input type="button" class="btn btn-success" value="Actualizar" id="btnActualizar" style="font-size:13px;"/>
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

            // console.log(full_access);
            // console.log(permissions);

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
