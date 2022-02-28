<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ \App\Traits\Principal::getUrlToken('/') }}" class="brand-link">
        <img src="{{ asset('img/cideteq.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><b>S I N F O D I</b></span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if (Auth::user()->hasPermissionTo('estimulo-objetivo-index') || Auth::user()->hasPermissionTo('estimulo-actividadA-index') || Auth::user()->hasPermissionTo('estimulo-actividadB-index') ||
                     Auth::user()->hasPermissionTo('estimulo-responsabilidad-index') || Auth::user()->hasPermissionTo('estimulo-meta-index') || Auth::user()->hasPermissionTo('estimulo-impacto-index') ||
                     Auth::user()->hasPermissionTo('estimulo-desempeño-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-directores-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Directores") ||
                     Auth::user()->hasPermissionTo('estimulo-evaluaciones-subdirectores-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Subdirectores") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-coordinadores-index') ||
                     existeUsuario(Auth::user()->usuario, 'responsabilidades', "Coordinadores") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-apoyo-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Personal_Apoyo") ||
                     Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-difusiondivulgacion-index') || existeUsuario(Auth::user()->usuario, 'general', "Direccion_General") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-direccionGral-posgrado-index') || existeUsuario(Auth::user()->usuario, 'general', "Direccion_General") ||
                     Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-investigacion-index') || existeUsuario(Auth::user()->usuario, 'general', "Direccion_General"))
                    <li class="nav-header">ESTIMULOS</li>
                @endif
                @can('estimulo-lineamientos-index')
                    <li class="nav-item">
                        <a href="{{ \App\Traits\Principal::getUrlToken('/estimulos/lineamientos/viewLineamientos') }}" class="nav-link {{ isRouteActive('estimulos.lineamientos') }}">
                            <i class="nav-icon fa fa-file-invoice"></i>
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
                @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-directores-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Directores") ||
                     Auth::user()->hasPermissionTo('estimulo-evaluaciones-subdirectores-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Subdirectores") ||
                     Auth::user()->hasPermissionTo('estimulo-evaluaciones-coordinadores-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Coordinadores") ||
                     Auth::user()->hasPermissionTo('estimulo-evaluaciones-apoyo-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Personal_Apoyo") ||
                     Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-difusiondivulgacion-index') || existeUsuario(Auth::user()->usuario, 'general', "Direccion_General") ||
                     Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-investigacion-index') || existeUsuario(Auth::user()->usuario, 'general', "Direccion_General"))
                    <li class="nav-item has-treeview {{ isMenuOpen('estimulos.evaluaciones') }}">
                        <a href="#" class="nav-link {{ isRouteActive('estimulos.evaluaciones') }}">
                            <i class="far fa-arrow-alt-circle-down"></i>
                            <p><b>Evaluaciones</b><i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-directores-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Directores") ||
                                 Auth::user()->hasPermissionTo('estimulo-evaluaciones-subdirectores-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Subdirectores") ||
                                 Auth::user()->hasPermissionTo('estimulo-evaluaciones-coordinadores-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Coordinadores") ||
                                 Auth::user()->hasPermissionTo('estimulo-evaluaciones-apoyo-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Personal_Apoyo"))
                                <li class="nav-item has-treeview {{ isMenuOpen('estimulos.evaluaciones.responsabilidades') }}">
                                    <a style="font-size: 15px;" href="#" class="nav-link {{ isRouteActive('estimulos.evaluaciones.responsabilidades') }}">
                                        <i class="far fa-arrow-alt-circle-down"></i>
                                        <p><b>Responsabilidades</b><i class="right fas fa-angle-left"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-directores-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Directores"))
                                            <li class="nav-item">
                                                <a href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/responsabilidades/directores/listDirectores') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.responsabilidades.directores') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Directores</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-subdirectores-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Subdirectores"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/responsabilidades/subdirectores/listSubdirectores') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.responsabilidades.subdirectores') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Subdirectores</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-coordinadores-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Coordinadores"))
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
                        <ul class="nav nav-treeview">
                            @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-difusiondivulgacion-index') || existeUsuario(Auth::user()->usuario, 'general', "Direccion_General") ||
                                 Auth::user()->hasPermissionTo('estimulo-evaluaciones-direccionGral-posgrado-index') || existeUsuario(Auth::user()->usuario, 'general', "Direccion_General") ||
                                 Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-investigacion-index') || existeUsuario(Auth::user()->usuario, 'general', "Direccion_General"))
                                <li class="nav-item has-treeview {{ isMenuOpen('estimulos.evaluaciones.direccionGeneral') }}">
                                    <a style="font-size: 15px;" href="#" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionGeneral') }}">
                                        <i class="far fa-arrow-alt-circle-down"></i>
                                        <p><b>Dirección general</b><i class="right fas fa-angle-left"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-difusiondivulgacion-index') || existeUsuario(Auth::user()->usuario, 'general', "Direccion_General"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionGeneral/DifDiv/listDifDIv') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionGeneral.DivDif') }}">
                                                    <i class="far fa-arrow-alt-circle-right"></i>
                                                    <p>Difusión y Divulgación</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-direccionGral-posgrado-index') || existeUsuario(Auth::user()->usuario, 'general', "Direccion_General"))
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
                                                    <p>Investigación Cientifica</p>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>
