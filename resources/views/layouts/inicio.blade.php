@extends('layouts.app')

@if (Auth::user()->hasPermissionTo('estimulo-lineamientos-index') || Auth::user()->hasPermissionTo('estimulo-objetivo-index') || Auth::user()->hasPermissionTo('estimulo-actividadA-index') || Auth::user()->hasPermissionTo('estimulo-actividadB-index') ||
     Auth::user()->hasPermissionTo('estimulo-responsabilidad-index') || Auth::user()->hasPermissionTo('estimulo-meta-index') || Auth::user()->hasPermissionTo('estimulo-impacto-index') ||
     Auth::user()->hasPermissionTo('estimulo-desempeño-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-directores-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Director") ||
     Auth::user()->hasPermissionTo('estimulo-evaluaciones-subdirectores-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Subdirector") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-coordinadores-index') ||
     existeUsuario(Auth::user()->usuario, 'responsabilidades', "Coordinador") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-apoyo-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Personal_Apoyo") ||
     existeUsuario(Auth::user()->usuario, 'general', "Direccion_General") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-difusiondivulgacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-posgrado-index') ||
     Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-investigacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-sostentabilidad-index') ||
     Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-transferencia-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-formacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-colaboracion-index') ||
     Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-acreditaciones-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-investigacionB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-sostentabilidadB-index') ||
     Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-transferenciaB-index') || existeUsuario(Auth::user()->usuario, 'administracion', "Direccion_Administracion") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-difusiondivulgacion-index') ||
     Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-posgrado-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-investigacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-sostentabilidad-index')||
     Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-transferencia-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-formacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-colaboracion-index') ||
     Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-acreditaciones-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-investigacionB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-sostentabilidadB-index') ||
     Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-transferenciaB-index') || existeUsuario(Auth::user()->usuario, 'posgrado', "Direccion_Posgrado") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-difusiondivulgacion-index') ||
     Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-posgrado-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-investigacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-sostentabilidad-index') ||
     Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-transferencia-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-formacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-colaboracion-index') ||
     Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-acreditaciones-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-investigacionB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-sostentabilidadB-index') ||
     Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-transferenciaB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-difusiondivulgacion-index') || existeUsuario(Auth::user()->usuario, 'ciencia', 'Direccion_Ciencia') ||
     Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-posgrado-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-investigacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-sostentabilidad-index') ||
     Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-transferencia-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-formacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-colaboracion-index') ||
     Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-acreditaciones-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-investigacionB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-sostentabilidadB-index') ||
     Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-transferenciaB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-difusiondivulgacion-index') || existeUsuario(Auth::user()->usuario, 'servicios', "Direccion_Servicios_Tecno") ||
     Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-difusiondivulgacion-index') || existeUsuario(Auth::user()->usuario, 'proyectos', "Direccion_Proyectos_Tecno") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-posgrado-index') ||
     Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-posgrado-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-investigacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-investigacion-index') ||
     Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-sostentabilidad-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-sostentabilidad-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-transferencia-index') ||
     Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-transferencia-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-formacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-formacion-index') ||
     Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-colaboracion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-acreditaciones-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-acreditaciones-index') ||
     Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-investigacionB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-investigacionB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-sostentabilidadB-index') ||
     Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-sostentabilidadB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-transferenciaB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-transferenciaB-index'))
        @section('texto_informativo')
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Bienivenido al módulo de <label>Estimulos</label>.</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h5><label>La información que se muestra en este módulo de estímulos {{ date("Y") - 1 }} es preliminar.</label></h5>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h6>En caso de tener alguna inquietud en lo que respecta a la siguiente Información dirigirse a los responsables de los módulos:</h6>
                    <ul>
                        <li><label>Claudia Nava:</label> Difusión y divulgación</li>
                        <li><label>Oscar García:</label> Formación de recursos humanos</li>
                        <li><label>Isabel Mendoza:</label> Investigación Científica</li>
                        <li><label>Beatriz Lizardi:</label> Transferencia de conocimiento</li>
                    </ul>
                    <h6>Acceso o duda pueden referirse a su servidor por medio de correo o a la ext 7821</h6>
                </div>
            </div>
        @endsection
@else
        @section('texto_informativo')
            <div class="row">
                <div class="col-12">
                    <h5><label>Lo sentimos, usted no es candidato para participar en estimulos.</label></h5>
                </div>
            </div>
        @endsection
@endif
