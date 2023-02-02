<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ \App\Traits\Principal::getUrlToken('/') }}" class="brand-link">
        <img src="{{ asset('img/cideteq.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><b>ESTIMULOS {{ date("Y") - 1 }}</b></span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                {{-- <li class="nav-header" style="font-size:13px;">MODULOS</li> --}}
                {{-- <li class="nav-item">
                    <a href="{{ \App\Traits\Principal::getUrlToken('/modulos/sostenibilidad/listSostenibilidad') }}" class="nav-link {{ isRouteActive('modulos.sostentabilidad') }}">
                        <i class="far fa-arrow-alt-circle-right"></i>
                        <p>Sostenibilidad económica</p>
                    </a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a href="{{ \App\Traits\Principal::getUrlToken('/modulos/colaboracion/listColaboracion') }}" class="nav-link {{ isRouteActive('modulos.colaboracion') }}">
                        <i class="far fa-arrow-alt-circle-right"></i>
                        <p>Colaboración institucional</p>
                    </a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a href="{{ \App\Traits\Principal::getUrlToken('/modulos/puntosTotales/listPuntosTotales') }}" class="nav-link {{ isRouteActive('modulos.puntosTotales') }}">
                        <i class="far fa-arrow-alt-circle-right"></i>
                        <p>Puntos totales</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ \App\Traits\Principal::getUrlToken('/modulos/recursosPropios/listRecursosPropios') }}" class="nav-link {{ isRouteActive('modulos.recursosPropios') }}">
                        <i class="far fa-arrow-alt-circle-right"></i>
                        <p>Recursos propios</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ \App\Traits\Principal::getUrlToken('/modulos/fondosAdministracion/listFondosAdministracion') }}" class="nav-link {{ isRouteActive('modulos.fondosAdministracion') }}">
                        <i class="far fa-arrow-alt-circle-right"></i>
                        <p>Fondos en administración</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ \App\Traits\Principal::getUrlToken('/modulos/serviciosTecnologicos/informacionFinanciera/index') }}" class="nav-link {{ isRouteActive('modulos.serviciosTecnologicos.informacionFinanciera') }}">
                        <i class="far fa-arrow-alt-circle-right"></i>
                        <p>Servicios tecnológicos</p>
                    </a>
                </li> --}}
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
                    <li class="nav-header" style="font-size:13px;">ESTIMULOS</li>
                @endif
                @can('estimulo-lineamientos-index')
                    <li class="nav-item">
                        <a href="{{ \App\Traits\Principal::getUrlToken('/estimulos/lineamientos/viewLineamientos') }}" class="nav-link {{ isRouteActive('estimulos.lineamientos') }}">
                            <i class="far fa-arrow-alt-circle-right"></i>
                            <p>Lineamientos</p>
                        </a>
                    </li>
                @endcan
                @can('estimulo-objetivo-index')
                    <li class="nav-item">
                        <a href="{{ \App\Traits\Principal::getUrlToken('/estimulos/objetivos/listObjetivos') }}" class="nav-link {{ isRouteActive('estimulos.objetivos') }}">
                            <i class="far fa-arrow-alt-circle-right"></i>
                            <p>Objetivos</p>
                        </a>
                    </li>
                @endcan
                @if (Auth::user()->hasPermissionTo('estimulo-actividadA-index') || Auth::user()->hasPermissionTo('estimulo-actividadB-index') || Auth::user()->hasPermissionTo('estimulo-responsabilidad-index'))
                    <li class="nav-item {{ isMenuOpen('estimulos.factor1') }}">
                        <a href="#" class="nav-link {{ isRouteActive('estimulos.factor1') }}">
                            <i class="far fa-arrow-alt-circle-down"></i>
                            <p><b>Factor 1</b><i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('estimulo-actividadA-index')
                                <li class="nav-item">
                                    <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/factor1/criterios/listActividadesA') }}" class="nav-link {{ isRouteActive('estimulos.factor1.actividadesA') }}">
                                        <i class="far fa-arrow-alt-circle-right"></i>
                                        <p>Actividades A</p>
                                    </a>
                                </li>
                            @endcan
                            @can('estimulo-actividadB-index')
                                <li class="nav-item">
                                    <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/factor1/criterios/listActividadesB') }}" class="nav-link {{ isRouteActive('estimulos.factor1.actividadesB') }}">
                                        <i class="far fa-arrow-alt-circle-right"></i>
                                        <p>Actividades B</p>
                                    </a>
                                </li>
                            @endcan
                            @can('estimulo-responsabilidad-index')
                                <li class="nav-item">
                                    <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/factor1/responsabilidades/listResponsabildiades') }}" class="nav-link {{ isRouteActive('estimulos.factor1.responsabilidades') }}">
                                        <i class="far fa-arrow-alt-circle-right"></i>
                                        <p>Responsabilidades</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif
                @if (Auth::user()->hasPermissionTo('estimulo-meta-index') || Auth::user()->hasPermissionTo('estimulo-impacto-index'))
                    <li class="nav-item {{ isMenuOpen('estimulos.factor2') }}">
                        <a href="#" class="nav-link {{ isRouteActive('estimulos.factor2') }}">
                            <i class="far fa-arrow-alt-circle-down"></i>
                            <p><b>Factor 2</b><i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('estimulo-meta-index')
                                <li class="nav-item">
                                    <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/factor2/metas/listMetas') }}" class="nav-link {{ isRouteActive('estimulos.factor2.metas') }}">
                                        <i class="far fa-arrow-alt-circle-right"></i>
                                        <p>Metas alcanzadas</p>
                                    </a>
                                </li>
                            @endcan
                            @can('estimulo-impacto-index')
                                <li class="nav-item">
                                    <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/factor2/inpacto/listImpacto') }}" class="nav-link {{ isRouteActive('estimulos.factor2.impacto') }}">
                                        <i class="far fa-arrow-alt-circle-right"></i>
                                        <p>Nivel de impacto</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif
                @if (Auth::user()->hasPermissionTo('estimulo-desempeño-index'))
                    <li class="nav-item {{ isMenuOpen('estimulos.factor3') }}">
                        <a href="#" class="nav-link {{ isRouteActive('estimulos.factor3') }}">
                            <i class="far fa-arrow-alt-circle-down"></i>
                            <p><b>Factor 3</b><i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/factor3/desempeño/listDesempeño') }}" class="nav-link {{ isRouteActive('estimulos.factor3.desempeño') }}">
                                    <i class="far fa-arrow-alt-circle-right"></i>
                                    <p>Desempeño</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-directores-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Director") ||
                     Auth::user()->hasPermissionTo('estimulo-evaluaciones-subdirectores-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Subdirector") ||
                     Auth::user()->hasPermissionTo('estimulo-evaluaciones-coordinadores-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Coordinador") ||
                     Auth::user()->hasPermissionTo('estimulo-evaluaciones-apoyo-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Personal_Apoyo") ||
                     existeUsuario(Auth::user()->usuario, 'general', "Direccion_General") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-difusiondivulgacion-index') ||
                     Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-investigacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-posgrado-index') ||
                     Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-sostentabilidad-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-transferencia-index') ||
                     Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-formacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-colaboracion-index') ||
                     Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-acreditaciones-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-investigacionB-index') ||
                     Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-sostentabilidadB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-transferenciaB-index') ||
                     existeUsuario(Auth::user()->usuario, 'administracion', "Direccion_Administracion") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-difusiondivulgacion-index') ||
                     Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-posgrado-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-investigacion-index') ||
                     Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-sostentabilidad-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-transferencia-index')||
                     Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-formacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-colaboracion-index') ||
                     Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-acreditaciones-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-investigacionB-index') ||
                     Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-sostentabilidadB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-transferenciaB-index') ||
                     existeUsuario(Auth::user()->usuario, 'posgrado', "Direccion_Posgrado") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-difusiondivulgacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-posgrado-index') ||
                     Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-investigacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-sostentabilidad-index') ||
                     Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-transferencia-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-formacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-colaboracion-index') ||
                     Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-acreditaciones-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-investigacionB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-sostentabilidadB-index') ||
                     Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-transferenciaB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-difusiondivulgacion-index') || existeUsuario(Auth::user()->usuario, 'ciencia', "Direccion_Ciencia") ||
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
                     Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-sostentabilidadB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-transferenciaB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-transferenciaB-index') ||
                     Auth::user()->hasPermissionTo('estimulo-evaluaciones-acuses-index') || existeUsuario(Auth::user()->usuario, 'acuses', 'acuses'))
                    <li class="nav-item has-treeview {{ isMenuOpen('estimulos.evaluaciones') }}">
                        <a href="#" class="nav-link {{ isRouteActive('estimulos.evaluaciones') }}">
                            <i class="far fa-arrow-alt-circle-down"></i>
                            <p><b>Evaluaciones</b><i class="right fas fa-angle-left"></i></p>
                        </a>
                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-acuses-index') || existeUsuario(Auth::user()->usuario, 'acuses', 'acuses'))
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/acusesPDF') }}" class="nav-link {{ isRouteActive('evaluaciones.acusesPDF') }}">
                                        <i class="fa fa-hands-helping nav-icon"></i>
                                        <p>Acuses</p>
                                    </a>
                                </li>
                            </ul>
                        @endif
                        <ul class="nav nav-treeview">
                            @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-directores-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Director") ||
                                 Auth::user()->hasPermissionTo('estimulo-evaluaciones-subdirectores-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Subdirector") ||
                                 Auth::user()->hasPermissionTo('estimulo-evaluaciones-coordinadores-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Coordinador") ||
                                 Auth::user()->hasPermissionTo('estimulo-evaluaciones-apoyo-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Personal_Apoyo"))
                                {{-- <li class="nav-header" style="font-size:13px;">Grupo 2</li> --}}
                                {{-- <li class="nav-header" style="font-size:13px;">Factor 1</li> --}}
                                <li class="nav-item has-treeview {{ isMenuOpen('estimulos.evaluaciones.responsabilidades') }}">
                                    <a style="font-size: 15px;" href="#" class="nav-link {{ isRouteActive('estimulos.evaluaciones.responsabilidades') }}">
                                        <i class="far fa-arrow-alt-circle-down"></i>
                                        <p><b>Responsabilidades</b><i class="right fas fa-angle-left"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-directores-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Director"))
                                            <li class="nav-item">
                                                <a href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/responsabilidades/directores/listDirectores') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.responsabilidades.directores') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Directores</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-subdirectores-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Subdirector"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/responsabilidades/subdirectores/listSubdirectores') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.responsabilidades.subdirectores') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Subdirectores</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-coordinadores-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Coordinador"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/responsabilidades/Coordinadores/listCoordinadores') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.responsabilidades.Coordinadores') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Coordinadores</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-apoyo-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Personal_Apoyo"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/responsabilidades/personalApoyo/listPersonalApoyo') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.responsabilidades.personalApoyo') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Personal de apoyo</p>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            @endif
                        </ul>
                        {{-- @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-directores-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Director") ||
                            Auth::user()->hasPermissionTo('estimulo-evaluaciones-subdirectores-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Subdirector"))
                            <ul class="nav nav-treeview">
                                </li>
                                <li class="nav-header" style="font-size:12px;">Factor 2</li>
                                <li class="nav-item">
                                    <a href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/grupo1/factor2') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.factores.grupo1.factor2') }}">
                                        <i class="far fa-arrow-alt-circle-right"></i>
                                        <p>Factor 2</p>
                                    </a>
                                </li>
                                <li class="nav-header" style="font-size:13px;">Factor 3</li>
                                <li class="nav-item">
                                    <a href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/grupo1/factor3') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.factores.grupo1.factor3') }}">
                                        <i class="far fa-arrow-alt-circle-right"></i>
                                        <p>Factor 3</p>
                                    </a>
                                </li>
                            </ul>
                        @else --}}
                        {{-- <ul class="nav nav-treeview">
                            </li>
                            <li class="nav-header" style="font-size:12px;">Factor 2</li>
                            <li class="nav-item">
                                <a href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/grupo1/noAplica/factor2') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.factores.grupo1.noAplica.factor2') }}">
                                    <i class="far fa-arrow-alt-circle-right"></i>
                                    <p>Factor 2</p>
                                </a>
                            </li>
                            <li class="nav-header" style="font-size:13px;">Factor 3</li>
                            <li class="nav-item">
                                <a href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/grupo1/factor3') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.factores.grupo1.factor3') }}">
                                    <i class="far fa-arrow-alt-circle-right"></i>
                                    <p>Factor 3</p>
                                </a>
                            </li>
                        </ul> --}}
                        {{-- @endif --}}
                        <ul class="nav nav-treeview">
                            {{-- @if (existeUsuario(Auth::user()->usuario, 'general', "Direccion_General") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-difusiondivulgacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-posgrado-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-investigacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-sostentabilidad-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-transferencia-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-formacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-colaboracion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-acreditaciones-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-investigacionB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-sostentabilidadB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-transferenciaB-index') ||
                             existeUsuario(Auth::user()->usuario, 'administracion', "Direccion_Administracion") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-difusiondivulgacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-posgrado-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-investigacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-sostentabilidad-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-transferencia-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-formacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-colaboracion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-acreditaciones-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-investigacionB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-sostentabilidadB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-transferenciaB-index') ||
                             existeUsuario(Auth::user()->usuario, 'posgrado', "Direccion_Posgrado") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-difusiondivulgacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-posgrado-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-investigacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-sostentabilidad-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-transferencia-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-formacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-colaboracion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-acreditaciones-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-investigacionB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-sostentabilidadB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-transferenciaB-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-difusiondivulgacion-index') || existeUsuario(Auth::user()->usuario, 'ciencia', "Direccion_Ciencia") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-posgrado-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-investigacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-sostentabilidad-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-transferencia-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-formacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-colaboracion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-acreditaciones-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-investigacionB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-sostentabilidadB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-transferenciaB-index') ||
                             existeUsuario(Auth::user()->usuario, 'servicios', "Direccion_Servicios_Tecno") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-difusiondivulgacion-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-posgrado-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-investigacion-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-sostentabilidad-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-transferencia-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-formacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-colaboracion-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-acreditaciones-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-investigacionB-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-sostentabilidadB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-transferenciaB-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-difusiondivulgacion-index') || existeUsuario(Auth::user()->usuario, 'proyectos', "Direccion_Proyectos_Tecno") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-posgrado-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-investigacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-sostentabilidad-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-transferencia-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-formacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-acreditaciones-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-investigacionB-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-sostentabilidadB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-transferenciaB-index'))
                                <li class="nav-header" style="font-size:13px;">Grupo 1</li>
                                <li class="nav-header" style="font-size:13px;">Factor 1</li>
                             @endif --}}
                            @if (existeUsuario(Auth::user()->usuario, 'general', "Direccion_General") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-difusiondivulgacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-posgrado-index') ||
                                 Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-investigacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-sostentabilidad-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-transferencia-index') ||
                                 Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-formacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-colaboracion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-acreditaciones-index') ||
                                 Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-investigacionB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-sostentabilidadB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-transferenciaB-index'))
                                <li class="nav-item has-treeview {{ isMenuOpen('estimulos.evaluaciones.direccionGeneral') }}">
                                    <a style="font-size: 15px;" href="#" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionGeneral') }}">
                                        <i class="far fa-arrow-alt-circle-down"></i>
                                        <p><b>Dirección general</b><i class="right fas fa-angle-left"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @if (existeUsuario(Auth::user()->usuario, 'general', "Direccion_General") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-difusiondivulgacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-posgrado-index') ||
                                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-investigacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-sostentabilidad-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-transferencia-index') ||
                                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-formacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-colaboracion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-acreditaciones-index'))
                                             <li class="nav-header" style="font-size:13px;">ACTIVIDADES->TABLA A</li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-difusiondivulgacion-index') || existeUsuario(Auth::user()->usuario, 'general', "Direccion_General"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionGeneral/DifDiv/listDifDIv') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionGeneral.DivDif') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Difusión y Divulgación</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-posgrado-index') || existeUsuario(Auth::user()->usuario, 'general', "Direccion_General"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionGeneral/posgrado/listPosgrado') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionGeneral.posgrado') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Posgrado->FRH</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-investigacion-index') || existeUsuario(Auth::user()->usuario, 'general', "Direccion_General"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionGeneral/investigacion/listInvestigacion') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionGeneral.investigacion') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Investigación científica</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-sostentabilidad-index') || existeUsuario(Auth::user()->usuario, 'general', "Direccion_General"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionGeneral/sostentabilidad/listSostentabilidad') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionGeneral.sostentabilidad') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Sostenibilidad</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-transferencia-index') || existeUsuario(Auth::user()->usuario, 'general', "Direccion_General"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionGeneral/transferencia/listTransferencia') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionGeneral.transferencia') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Transferencia conocimiento</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-formacion-index') || existeUsuario(Auth::user()->usuario, 'general', "Direccion_General"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionGeneral/formacionRH/listFormacionRH') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionGeneral.formacionRH') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Formación de RH</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-colaboracion-index') || existeUsuario(Auth::user()->usuario, 'general', "Direccion_General"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionGeneral/colaboracion/listColaboracion') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionGeneral.colaboracion') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Colaboración</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-acreditaciones-index') || existeUsuario(Auth::user()->usuario, 'general', "Direccion_General"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionGeneral/acreditaciones/listAcreditaciones') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionGeneral.acreditaciones') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Acreditaciones</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (existeUsuario(Auth::user()->usuario, 'general', "Direccion_General") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-investigacionB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-sostentabilidadB-index') ||
                                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-transferenciaB-index'))
                                            <li class="nav-header" style="font-size:13px;">ACTIVIDADES->TABLA B</li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-investigacionB-index') || existeUsuario(Auth::user()->usuario, 'general', "Direccion_General"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionGeneral/investigacionB/listInvestigacionB') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionGeneral.investigacionCientificaB') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Investigación Científica</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-sostentabilidadB-index') || existeUsuario(Auth::user()->usuario, 'general', "Direccion_General"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionGeneral/sostenibilidadB/listSostenibilidadB') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionGeneral.sostenibilidadB') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Sostenibilidad Económica</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-transferenciaB-index') || existeUsuario(Auth::user()->usuario, 'general', "Direccion_General"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionGeneral/tranferenciaB/listTransferencia') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionGeneral.tranferenciaB') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Transferencia Conocimiento</p>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            @endif
                        </ul>
                        <ul class="nav nav-treeview">
                            @if (existeUsuario(Auth::user()->usuario, 'administracion', "Direccion_Administracion") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-difusiondivulgacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-posgrado-index') ||
                                 Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-investigacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-sostentabilidad-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-transferencia-index') ||
                                 Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-formacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-colaboracion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-acreditaciones-index') ||
                                 Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-investigacionB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-sostentabilidadB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-transferenciaB-index'))
                                <li class="nav-item has-treeview {{ isMenuOpen('estimulos.evaluaciones.direccionAdministracion') }}">
                                    <a style="font-size: 15px;" href="#" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionAdministracion') }}">
                                        <i class="far fa-arrow-alt-circle-down"></i>
                                        <p><b>Dir. Administración</b><i class="right fas fa-angle-left"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @if (existeUsuario(Auth::user()->usuario, 'administracion', "Direccion_Administracion") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-difusiondivulgacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-posgrado-index') ||
                                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-investigacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-sostentabilidad-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-transferencia-index') ||
                                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-formacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-colaboracion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-acreditaciones-index'))
                                            <li class="nav-header" style="font-size:13px;">ACTIVIDADES->TABLA A</li>
                                        @endif
                                        @if (existeUsuario(Auth::user()->usuario, 'administracion', "Direccion_Administracion") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-difusiondivulgacion-index'))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionAdministracion/DifDiv/listDifDIv') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionAdministracion.DivDif') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Difusión y Divulgación</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (existeUsuario(Auth::user()->usuario, 'administracion', "Direccion_Administracion") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-posgrado-index'))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionAdministracion/posgrado/listPosgrado') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionAdministracion.posgrado') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Posgrado->FRH</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (existeUsuario(Auth::user()->usuario, 'administracion', "Direccion_Administracion") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-investigacion-index'))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionAdministracion/investigacion/listInvestigacion') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionAdministracion.investigacion') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Investigación científica</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-sostentabilidad-index') || existeUsuario(Auth::user()->usuario, 'administracion', "Direccion_Administracion"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionAdministracion/sostentabilidad/listSostentabilidad') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionAdministracion.sostentabilidad') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Sostenibilidad</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (existeUsuario(Auth::user()->usuario, 'administracion', "Direccion_Administracion") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-transferencia-index'))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionAdministracion/transferencia/listTransferencia') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionAdministracion.transferencia') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Transferencia conocimiento</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (existeUsuario(Auth::user()->usuario, 'administracion', "Direccion_Administracion") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-formacion-index'))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionAdministracion/formacionRH/listFormacionRH') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionAdministracion.formacion') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Formacion RH</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (existeUsuario(Auth::user()->usuario, 'administracion', "Direccion_Administracion") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-colaboracion-index'))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionAdministracion/colaboracion/listColaboracion') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionAdministracion.colaboracion') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Colaboración</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (existeUsuario(Auth::user()->usuario, 'administracion', "Direccion_Administracion") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-acreditaciones-index'))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionAdministracion/acreditaciones/listAcreditaciones') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionAdministracion.acreditaciones') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Acreditaciones</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (existeUsuario(Auth::user()->usuario, 'administracion', "Direccion_Administracion") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-investigacionB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-sostentabilidadB-index') ||
                                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-transferenciaB-index'))
                                            <li class="nav-header" style="font-size:13px;">ACTIVIDADES->TABLA B</li>
                                        @endif
                                        @if (existeUsuario(Auth::user()->usuario, 'administracion', "Direccion_Administracion") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-investigacionB-index'))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionAdministracion/investigacionB/listInvestigacionB') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionAdministracion.investigacionB') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Investigación Científica</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (existeUsuario(Auth::user()->usuario, 'administracion', "Direccion_Administracion") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-sostentabilidadB-index'))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionAdministracion/sostenibilidadB/listSostenibilidadB') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionAdministracion.sostentabilidadB') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Sostenibilidad Económica</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (existeUsuario(Auth::user()->usuario, 'administracion', "Direccion_Administracion") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-transferenciaB-index'))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionAdministracion/tranferenciaB/listTransferencia') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionAdministracion.tranferenciaB') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Transferencia Conocimiento</p>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            @endif
                        </ul>
                        @if (existeUsuario(Auth::user()->usuario, 'posgrado', "Direccion_Posgrado") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-difusiondivulgacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-posgrado-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-investigacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-sostentabilidad-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-transferencia-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-formacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-colaboracion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-acreditaciones-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-investigacionB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-sostentabilidadB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-transferenciaB-index'))
                            <ul class="nav nav-treeview">
                                <li class="nav-item has-treeview {{ isMenuOpen('estimulos.evaluaciones.direccionPosgrado') }}">
                                    <a style="font-size: 15px;" href="#" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionPosgrado') }}">
                                        <i class="far fa-arrow-alt-circle-down"></i>
                                        <p><b>Dirección Posgrado</b><i class="right fas fa-angle-left"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @if (existeUsuario(Auth::user()->usuario, 'posgrado', "Direccion_Posgrado") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-difusiondivulgacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-posgrado-index') ||
                                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-investigacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-sostentabilidad-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-transferencia-index') ||
                                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-formacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-colaboracion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-acreditaciones-index'))
                                            <li class="nav-header" style="font-size:13px;">ACTIVIDADES->TABLA A</li>
                                        @endif
                                        @if (existeUsuario(Auth::user()->usuario, 'posgrado', "Direccion_Posgrado") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-difusiondivulgacion-index'))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionPosgrado/DifDiv/listDifDIv') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionPosgrado.DivDif') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Difusión y Divulgación</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (existeUsuario(Auth::user()->usuario, 'posgrado', "Direccion_Posgrado") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-posgrado-index'))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionPosgrado/posgrado/listPosgrado') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionPosgrado.posgrado') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Posgrado->FRH</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-investigacion-index') || existeUsuario(Auth::user()->usuario, 'posgrado', "Direccion_Posgrado"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionPosgrado/investigacion/listInvestigacion') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionPosgrado.investigacion') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Investigación Cientifica</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-sostentabilidad-index') || existeUsuario(Auth::user()->usuario, 'posgrado', "Direccion_Posgrado"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionPosgrado/sostentabilidad/listSostentabilidad') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionPosgrado.sostentabilidad') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Sostenibilidad</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-transferencia-index') || existeUsuario(Auth::user()->usuario, 'posgrado', "Direccion_Posgrado"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionPosgrado/transferencia/listTransferencia') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionPosgrado.transferencia') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Transferencia conocimiento</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-formacion-index') || existeUsuario(Auth::user()->usuario, 'posgrado', "Direccion_Posgrado"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionPosgrado/formacionRH/listFormacionRH') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionPosgrado.formacion') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Formacion RH</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-colaboracion-index') || existeUsuario(Auth::user()->usuario, 'posgrado', "Direccion_Posgrado"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionPosgrado/colaboracion/listColaboracion') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionPosgrado.colaboracion') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Colaboración</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-acreditaciones-index') || existeUsuario(Auth::user()->usuario, 'posgrado', "Direccion_Posgrado"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionPosgrado/acreditaciones/listAcreditaciones') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionPosgrado.acreditaciones') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Acreditaciones</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-investigacionB-index') || existeUsuario(Auth::user()->usuario, 'posgrado', "Direccion_Posgrado") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-sostentabilidadB-index') ||
                                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-transferenciaB-index'))
                                            <li class="nav-header" style="font-size:13px;">ACTIVIDADES->TABLA B</li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-investigacionB-index') || existeUsuario(Auth::user()->usuario, 'posgrado', "Direccion_Posgrado"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionPosgrado/investigacionB/listInvestigacionB') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionPosgrado.investigacionB') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Investigación Científica</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-sostentabilidadB-index') || existeUsuario(Auth::user()->usuario, 'posgrado', "Direccion_Posgrado"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionPosgrado/sostenibilidadB/listSostenibilidadB') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionPosgrado.sostentabilidadB') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Sostenibilidad Económica</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-transferenciaB-index') || existeUsuario(Auth::user()->usuario, 'posgrado', "Direccion_Posgrado"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionPosgrado/tranferenciaB/listTransferencia') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionPosgrado.transferenciaB') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Transferencia Conocimiento</p>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            </ul>
                        @endif
                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-difusiondivulgacion-index') || existeUsuario(Auth::user()->usuario, 'ciencia', "Direccion_Ciencia") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-posgrado-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-investigacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-sostentabilidad-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-transferencia-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-formacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-colaboracion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-acreditaciones-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-investigacionB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-sostentabilidadB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-transferenciaB-index'))
                            <ul class="nav nav-treeview">
                                <li class="nav-item has-treeview {{ isMenuOpen('estimulos.evaluaciones.direccionCiencia') }}">
                                    <a style="font-size: 15px;" href="#" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionCiencia') }}">
                                        <i class="far fa-arrow-alt-circle-down"></i>
                                        <p><b>Dirección Ciencia</b><i class="right fas fa-angle-left"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-difusiondivulgacion-index') || existeUsuario(Auth::user()->usuario, 'ciencia', "Direccion_Ciencia") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-posgrado-index') ||
                                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-investigacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-sostentabilidad-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-transferencia-index') ||
                                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-formacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-colaboracion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-acreditaciones-index'))
                                            <li class="nav-header" style="font-size:13px;">ACTIVIDADES->TABLA A</li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-difusiondivulgacion-index') || existeUsuario(Auth::user()->usuario, 'ciencia', "Direccion_Ciencia"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionCiencia/DifDiv/listDifDIv') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionCiencia.DivDif') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Difusión y Divulgación</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (existeUsuario(Auth::user()->usuario, 'ciencia', "Direccion_Ciencia") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-posgrado-index'))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionCiencia/posgrado/listPosgrado') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionCiencia.posgrado') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Posgrado->FRH</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-investigacion-index') || existeUsuario(Auth::user()->usuario, 'ciencia', "Direccion_Ciencia"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionCiencia/investigacion/listInvestigacion') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionCiencia.investigacion') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Investigación Cientifica</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-sostentabilidad-index') || existeUsuario(Auth::user()->usuario, 'ciencia', "Direccion_Ciencia"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionCiencia/sostentabilidad/listSostentabilidad') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionCiencia.sostentabilidad') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Sostenibilidad</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-transferencia-index') || existeUsuario(Auth::user()->usuario, 'ciencia', "Direccion_Ciencia"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionCiencia/transferencia/listTransferencia') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionCiencia.transferencia') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Transferencia conocimiento</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-formacion-index') || existeUsuario(Auth::user()->usuario, 'ciencia', "Direccion_Ciencia"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionCiencia/formacionRH/listFormacionRH') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionCiencia.formacion') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Formacion RH</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-colaboracion-index') || existeUsuario(Auth::user()->usuario, 'ciencia', "Direccion_Ciencia"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionCiencia/colaboracion/listColaboracion') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionCiencia.colaboracion') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Colaboración</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-acreditaciones-index') || existeUsuario(Auth::user()->usuario, 'ciencia', "Direccion_Ciencia"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionCiencia/acreditaciones/listAcreditaciones') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionCiencia.acreditaciones') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Acreditaciones</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-investigacionB-index') || existeUsuario(Auth::user()->usuario, 'ciencia', "Direccion_Ciencia") ||
                                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-sostentabilidadB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-transferenciaB-index'))
                                            <li class="nav-header" style="font-size:13px;">ACTIVIDADES->TABLA B</li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-investigacionB-index') || existeUsuario(Auth::user()->usuario, 'ciencia', "Direccion_Ciencia"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionCiencia/investigacionB/listInvestigacionB') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionCiencia.investigacionB') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Investigación Científica</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-sostentabilidadB-index') || existeUsuario(Auth::user()->usuario, 'ciencia', "Direccion_Ciencia"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionCiencia/sostenibilidadB/listSostenibilidadB') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionCiencia.sostentabilidadB') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Sostenibilidad Económica</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-transferenciaB-index') || existeUsuario(Auth::user()->usuario, 'ciencia', "Direccion_Ciencia"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionCiencia/tranferenciaB/listTransferencia') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionCiencia.transferenciaB') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Transferencia Conocimiento</p>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            </ul>
                        @endif
                        @if (existeUsuario(Auth::user()->usuario, 'servicios', "Direccion_Servicios_Tecno") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-difusiondivulgacion-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-posgrado-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-investigacion-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-sostentabilidad-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-transferencia-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-formacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-colaboracion-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-acreditaciones-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-investigacionB-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-sostentabilidadB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-transferenciaB-index'))
                            <ul class="nav nav-treeview">
                                <li class="nav-item has-treeview {{ isMenuOpen('estimulos.evaluaciones.direccionServTec') }}">
                                    <a style="font-size: 15px;" href="#" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionServTec') }}">
                                        <i class="far fa-arrow-alt-circle-down"></i>
                                        <p><b>Dirección Serv. Tec.</b><i class="right fas fa-angle-left"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-difusiondivulgacion-index') || existeUsuario(Auth::user()->usuario, 'servicios', "Direccion_Servicios_Tecno") ||
                                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-posgrado-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-investigacion-index') ||
                                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-sostentabilidad-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-transferencia-index') ||
                                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-formacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-colaboracion-index') ||
                                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-acreditaciones-index'))
                                            <li class="nav-header" style="font-size:13px;">ACTIVIDADES->TABLA A</li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-difusiondivulgacion-index') || existeUsuario(Auth::user()->usuario, 'servicios', "Direccion_Servicios_Tecno"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionServTec/DifDiv/listDifDIv') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionServTec.DivDif') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Difusión y Divulgación</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (existeUsuario(Auth::user()->usuario, 'servicios', "Direccion_Servicios_Tecno") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-posgrado-index'))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionServTec/posgrado/listPosgrado') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionServTec.posgrado') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Posgrado->FRH</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-investigacion-index') || existeUsuario(Auth::user()->usuario, 'servicios', "Direccion_Servicios_Tecno"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionServTec/investigacion/listInvestigacion') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionServTec.investigacion') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Investigación Cientifica</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-sostentabilidad-index') || existeUsuario(Auth::user()->usuario, 'servicios', "Direccion_Servicios_Tecno"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionServTec/sostentabilidad/listSostentabilidad') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionServTec.sostentabilidad') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Sostenibilidad</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-transferencia-index') || existeUsuario(Auth::user()->usuario, 'servicios', "Direccion_Servicios_Tecno"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionServTec/transferencia/listTransferencia') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionServTec.transferencia') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Transferencia conocimiento</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-formacion-index') || existeUsuario(Auth::user()->usuario, 'servicios', "Direccion_Servicios_Tecno"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionServTec/formacionRH/listFormacionRH') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionServTec.formacion') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Formacion RH</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-colaboracion-index') || existeUsuario(Auth::user()->usuario, 'servicios', "Direccion_Servicios_Tecno"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionServTec/colaboracion/listColaboracion') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionServTec.colaboracion') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Colaboración</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-acreditaciones-index') || existeUsuario(Auth::user()->usuario, 'servicios', "Direccion_Servicios_Tecno"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionServTec/acreditaciones/listAcreditaciones') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionServTec.acreditaciones') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Acreditaciones</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-investigacionB-index') || existeUsuario(Auth::user()->usuario, 'servicios', "Direccion_Servicios_Tecno") ||
                                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-sostentabilidadB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-transferenciaB-index') ||
                                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-transferenciaB-index'))
                                            <li class="nav-header" style="font-size:13px;">ACTIVIDADES->TABLA B</li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-investigacionB-index') || existeUsuario(Auth::user()->usuario, 'servicios', "Direccion_Servicios_Tecno"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionServTec/investigacionB/listInvestigacionB') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionServTec.investigacionB') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Investigación B</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-sostentabilidadB-index') || existeUsuario(Auth::user()->usuario, 'servicios', "Direccion_Servicios_Tecno"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionServTec/sostenibilidadB/listSostenibilidadB') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionServTec.sostenibilidadB') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Sostenibilidad Económica</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-transferenciaB-index') || existeUsuario(Auth::user()->usuario, 'servicios', "Direccion_Servicios_Tecno"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionServTec/tranferenciaB/listTransferencia') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionServTec.transferenciaB') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Transferencia Conocimiento</p>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            </ul>
                        @endif
                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-difusiondivulgacion-index') || existeUsuario(Auth::user()->usuario, 'proyectos', "Direccion_Proyectos_Tecno") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-posgrado-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-investigacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-sostentabilidad-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-transferencia-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-formacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-acreditaciones-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-investigacionB-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-sostentabilidadB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-transferenciaB-index'))
                            <ul class="nav nav-treeview">
                                <li class="nav-item has-treeview {{ isMenuOpen('estimulos.evaluaciones.direccionProyTec') }}">
                                    <a style="font-size: 15px;" href="#" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionProyTec') }}">
                                        <i class="far fa-arrow-alt-circle-down"></i>
                                        <p><b>Dirección Proy. Tec.</b><i class="right fas fa-angle-left"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-difusiondivulgacion-index') || existeUsuario(Auth::user()->usuario, 'proyectos', "Direccion_Proyectos_Tecno") ||
                                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-posgrado-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-investigacion-index') ||
                                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-sostentabilidad-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-transferencia-index') ||
                                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-formacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-acreditaciones-index'))
                                            <li class="nav-header" style="font-size:13px;">ACTIVIDADES->TABLA A</li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-difusiondivulgacion-index') || existeUsuario(Auth::user()->usuario, 'proyectos', "Direccion_Proyectos_Tecno"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionProyTec/DifDiv/listDifDIv') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionProyTec.DivDif') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Difusión y Divulgación</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (existeUsuario(Auth::user()->usuario, 'proyectos', "Direccion_Proyectos_Tecno") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-posgrado-index'))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionProyTec/posgrado/listPosgrado') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionProyTec.posgrado') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Posgrado->FRH</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-investigacion-index') || existeUsuario(Auth::user()->usuario, 'proyectos', "Direccion_Proyectos_Tecno"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionProyTec/investigacion/listInvestigacion') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionProyTec.investigacion') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Investigación Cientifica</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-sostentabilidad-index') || existeUsuario(Auth::user()->usuario, 'proyectos', "Direccion_Proyectos_Tecno"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionProyTec/sostentabilidad/listSostentabilidad') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionProyTec.sostentabilidad') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Sostenibilidad</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-transferencia-index') || existeUsuario(Auth::user()->usuario, 'proyectos', "Direccion_Proyectos_Tecno"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionProyTec/transferencia/listTransferencia') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionProyTec.transferencia') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Transferencia conocimiento</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-formacion-index') || existeUsuario(Auth::user()->usuario, 'proyectos', "Direccion_Proyectos_Tecno"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionProyTec/formacionRH/listFormacionRH') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionProyTec.formacion') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Formacion RH</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-colaboracion-index') || existeUsuario(Auth::user()->usuario, 'proyectos', "Direccion_Proyectos_Tecno"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionProyTec/colaboracion/listColaboracion') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionProyTec.colaboracion') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Colaboración</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-acreditaciones-index') || existeUsuario(Auth::user()->usuario, 'proyectos', "Direccion_Proyectos_Tecno"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionProyTec/acreditaciones/listAcreditaciones') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionProyTec.acreditaciones') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Acreditaciones</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-investigacionB-index') || existeUsuario(Auth::user()->usuario, 'proyectos', "Direccion_Proyectos_Tecno") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-sostentabilidadB-index') ||
                                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-transferenciaB-index'))
                                            <li class="nav-header" style="font-size:13px;">ACTIVIDADES->TABLA B</li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-investigacionB-index') || existeUsuario(Auth::user()->usuario, 'proyectos', "Direccion_Proyectos_Tecno"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionProyTec/investigacionB/listInvestigacionB') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionProyTec.investigacionB') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Investigación B</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-sostentabilidadB-index') || existeUsuario(Auth::user()->usuario, 'proyectos', "Direccion_Proyectos_Tecno"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionProyTec/sostenibilidadB/listSostenibilidadB') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionProyTec.sostenibilidadB') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Sostenibilidad Económica</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-transferenciaB-index') || existeUsuario(Auth::user()->usuario, 'proyectos', "Direccion_Proyectos_Tecno"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionProyTec/tranferenciaB/listTransferencia') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionProyTec.transferenciaB') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Transferencia Conocimiento</p>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            </ul>
                        @endif
                        {{-- @if (existeUsuario(Auth::user()->usuario, 'general', "Direccion_General") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-difusiondivulgacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-posgrado-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-investigacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-sostentabilidad-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-transferencia-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-formacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-colaboracion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-acreditaciones-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-investigacionB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-sostentabilidadB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-transferenciaB-index') ||
                             existeUsuario(Auth::user()->usuario, 'administracion', "Direccion_Administracion") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-difusiondivulgacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-posgrado-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-investigacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-sostentabilidad-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-transferencia-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-formacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-colaboracion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-acreditaciones-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-investigacionB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-sostentabilidadB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-administracion-transferenciaB-index') ||
                             existeUsuario(Auth::user()->usuario, 'posgrado', "Direccion_Posgrado") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-difusiondivulgacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-posgrado-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-investigacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-sostentabilidad-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-transferencia-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-formacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-colaboracion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-acreditaciones-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-investigacionB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-sostentabilidadB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-posgrado-transferenciaB-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-difusiondivulgacion-index') || existeUsuario(Auth::user()->usuario, 'ciencia', "Direccion_Ciencia") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-posgrado-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-investigacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-sostentabilidad-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-transferencia-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-formacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-colaboracion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-acreditaciones-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-investigacionB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-sostentabilidadB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-ciencia-transferenciaB-index') ||
                             existeUsuario(Auth::user()->usuario, 'servicios', "Direccion_Servicios_Tecno") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-difusiondivulgacion-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-posgrado-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-investigacion-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-sostentabilidad-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-transferencia-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-formacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-colaboracion-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-acreditaciones-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-investigacionB-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-sostentabilidadB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-servicios-transferenciaB-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-difusiondivulgacion-index') || existeUsuario(Auth::user()->usuario, 'proyectos', "Direccion_Proyectos_Tecno") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-posgrado-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-investigacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-sostentabilidad-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-transferencia-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-formacion-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-acreditaciones-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-investigacionB-index') ||
                             Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-sostentabilidadB-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-proyectos-transferenciaB-index'))
                            <ul class="nav nav-treeview">
                                </li>
                                <li class="nav-header" style="font-size:13px;">Factor 2</li>
                                <li class="nav-item">
                                    <a href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/grupo2/factor2') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.factores.grupo2.factor2') }}">
                                        <i class="far fa-arrow-alt-circle-right"></i>
                                        <p>Factor 2</p>
                                    </a>
                                </li>
                                <li class="nav-header" style="font-size:13px;">Factor 3</li>
                                <li class="nav-item">
                                    <a href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/grupo2/factor3') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.factores.grupo2.factor3') }}">
                                        <i class="far fa-arrow-alt-circle-right"></i>
                                        <p>Factor 3</p>
                                    </a>
                                </li>
                            </ul>
                        @endif --}}
                @endif
            </ul>
        </nav>
    </div>
</aside>
