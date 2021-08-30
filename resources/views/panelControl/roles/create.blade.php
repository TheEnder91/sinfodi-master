@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/panel_control.png') }}" width="50px" height="50px"> Panel de control
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/panelControl/listRoles') }}">Listado de roles</a></li>
        <li class="breadcrumb-item active">Crear un nuevo rol</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Crear un nuevo rol')
        <div class="row">
            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label class="control-label" for="txtNomRol">*Nombre del rol:</label>
                    <input id="txtNomRol" autocomplete="off" type="text" class="form-control">
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label class="control-label" for="txtSlug">*Slug:</label>
                    <input id="txtSlug" autocomplete="off" type="text" class="form-control">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label class="control-label" for="txtDesRol">*Descripción del rol:</label>
                    <input id="txtDesRol" autocomplete="off" type="text" class="form-control">
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
                            <input type="checkbox" class="custom-control-input permissions" name="permission[]" id="permission_{{ $permission->id }}" value="{{ $permission->id }}">
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
                    <input type="button" class="btn btn-success" value="Guardar" id="btnGuardar"/>
                </div>
            </div>
        </div>
    @endcomponent
@endsection

@section('scripts')
    <script>
        $(document).ready(initRoles);

        function initRoles(){
            $('#btnGuardar').on('click', guardarRol);
        }

        function guardarRol(){
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

            var options = {
                action: "{{ config('app.url') }}/panelControl/storeRol",
                json: {
                    name: name,
                    slug: slug,
                    description: description,
                    fullaccess: full_access,
                    permission: permissions,
                    _token: "{{ csrf_token() }}",
                },
                type: 'POST',
                dateType: 'json',
                mensajeConfirm: 'El registro se agrego correctamente',
                url: "{{ config('app.url') }}/panelControl/listRoles?token={{ Session::get('token') }}"
            };
            peticionGeneralAjax(options);
        }
    </script>
@endsection
