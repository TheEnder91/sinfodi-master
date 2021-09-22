<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ \App\Traits\Principal::getUrlToken('/') }}" class="brand-link">
        <img src="{{ asset('img/cideteq.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><b>S I N F O D I</b></span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">{{ Session::get('nombre') }}</a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if(Auth::user()->hasPermissionTo('admin-user-index') || Auth::user()->hasPermissionTo('admin-role-index') || Auth::user()->hasPermissionTo('admin-permission-index'))
                    <li class="nav-header">PANEL DE CONTROL</li>
                @endif
                @can('admin-user-index')
                    <li class="nav-item">
                        <a href="{{ \App\Traits\Principal::getUrlToken('/panelControl/listUsers') }}" class="nav-link {{ isRouteActive('panelControl.users') }}">
                            <i class="nav-icon fa fa-users"></i>
                            <p>Usuarios</p>
                        </a>
                    </li>
                @endcan
                @can('admin-role-index')
                    <li class="nav-item">
                        <a href="{{ \App\Traits\Principal::getUrlToken('/panelControl/listRoles') }}" class="nav-link {{ isRouteActive('panelControl.roles') }}">
                            <i class="nav-icon fa fa-unlock-alt"></i>
                            <p>Roles</p>
                        </a>
                    </li>
                @endcan
                @can('admin-permission-index')
                    <li class="nav-item">
                        <a href="{{ \App\Traits\Principal::getUrlToken('/panelControl/listPermissions') }}" class="nav-link {{ isRouteActive('panelControl.permissions') }}">
                            <i class="nav-icon fa fa-key"></i>
                            <p>Permisos</p>
                        </a>
                    </li>
                @endcan
                @if (Auth::user()->hasPermissionTo('estimulo-objetivo-index') || Auth::user()->hasPermissionTo('estimulo-actividadA-index') || Auth::user()->hasPermissionTo('estimulo-actividadB-index') ||
                     Auth::user()->hasPermissionTo('estimulo-responsabilidad-index') || Auth::user()->hasPermissionTo('estimulo-meta-index') || Auth::user()->hasPermissionTo('estimulo-impacto-index') ||
                     Auth::user()->hasPermissionTo('estimulo-desempeño-index') || Auth::user()->hasPermissionTo('estimulo-evaluaciones-directores-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Directores") ||
                     Auth::user()->hasPermissionTo('estimulo-evaluaciones-subdirectores-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Subdirectores") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-coordinadores-index') ||
                     existeUsuario(Auth::user()->usuario, 'responsabilidades', "Coordinadores") || Auth::user()->hasPermissionTo('estimulo-evaluaciones-apoyo-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Personal_Apoyo") ||
                     Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-difusiondivulgacion-index') || existeUsuario(Auth::user()->usuario, 'general', "Direccion_General"))
                    <li class="nav-header">ESTIMULOS</li>
                @endif
                @can('estimulo-objetivo-index')
                    <li class="nav-item">
                        <a href="{{ \App\Traits\Principal::getUrlToken('/estimulos/objetivos/listObjetivos') }}" class="nav-link {{ isRouteActive('estimulos.objetivos') }}">
                            <i class="nav-icon fa fa-bullseye"></i>
                            <p>Objetivos</p>
                        </a>
                    </li>
                @endcan
                @can('estimulo-lineamientos-index')
                    <li class="nav-item">
                        <a href="{{ \App\Traits\Principal::getUrlToken('/estimulos/lineamientos/viewLineamientos') }}" class="nav-link {{ isRouteActive('estimulos.lineamientos') }}">
                            <i class="nav-icon fa fa-file-invoice"></i>
                            <p>Lineamientos</p>
                        </a>
                    </li>
                @endcan
                @if (Auth::user()->hasPermissionTo('estimulo-actividadA-index') || Auth::user()->hasPermissionTo('estimulo-actividadB-index') || Auth::user()->hasPermissionTo('estimulo-responsabilidad-index'))
                    <li class="nav-item {{ isMenuOpen('estimulos.factor1') }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-table"></i>
                            <p><b>Factor 1</b><i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('estimulo-actividadA-index')
                                <li class="nav-item">
                                    <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/factor1/criterios/listActividadesA') }}" class="nav-link {{ isRouteActive('estimulos.factor1.actividadesA') }}">
                                        <i class="fab fa-amilia nav-icon"></i>
                                        <p>Actividades A</p>
                                    </a>
                                </li>
                            @endcan
                            @can('estimulo-actividadB-index')
                                <li class="nav-item">
                                    <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/factor1/criterios/listActividadesB') }}" class="nav-link {{ isRouteActive('estimulos.factor1.actividadesB') }}">
                                        <i class="fas fa-bold nav-icon"></i>
                                        <p>Actividades B</p>
                                    </a>
                                </li>
                            @endcan
                            @can('estimulo-responsabilidad-index')
                                <li class="nav-item">
                                    <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/factor1/responsabilidades/listResponsabildiades') }}" class="nav-link {{ isRouteActive('estimulos.factor1.responsabilidades') }}">
                                        <i class="fas fa-hands nav-icon"></i>
                                        <p>Responsabilidades</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif
                @if (Auth::user()->hasPermissionTo('estimulo-meta-index') || Auth::user()->hasPermissionTo('estimulo-impacto-index'))
                    <li class="nav-item {{ isMenuOpen('estimulos.factor2') }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-table"></i>
                            <p><b>Factor 2</b><i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('estimulo-meta-index')
                                <li class="nav-item">
                                    <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/factor2/metas/listMetas') }}" class="nav-link {{ isRouteActive('estimulos.factor2.metas') }}">
                                        <i class="fas fa-bullseye nav-icon"></i>
                                        <p>Metas alcanzadas</p>
                                    </a>
                                </li>
                            @endcan
                            @can('estimulo-impacto-index')
                                <li class="nav-item">
                                    <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/factor2/inpacto/listImpacto') }}" class="nav-link {{ isRouteActive('estimulos.factor2.impacto') }}">
                                        <i class="fas fa-sign-language nav-icon"></i>
                                        <p>Nivel de impacto</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif
                @if (Auth::user()->hasPermissionTo('estimulo-desempeño-index'))
                    <li class="nav-item {{ isMenuOpen('estimulos.factor3') }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-table"></i>
                            <p><b>Factor 3</b><i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/factor3/desempeño/listDesempeño') }}" class="nav-link {{ isRouteActive('estimulos.factor3.desempeño') }}">
                                    <i class="fas fa-chart-bar nav-icon"></i>
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
                     Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-difusiondivulgacion-index') || existeUsuario(Auth::user()->usuario, 'general', "Direccion_General"))
                    <li class="nav-item has-treeview {{ isMenuOpen('estimulos.evaluaciones') }}">
                        <a href="#" class="nav-link {{ isRouteActive('estimulos.evaluaciones') }}">
                            <i class="fas fa-clipboard-check nav-icon"></i>
                            <p><b>Evaluaciones</b><i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-directores-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Directores") ||
                                 Auth::user()->hasPermissionTo('estimulo-evaluaciones-subdirectores-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Subdirectores") ||
                                 Auth::user()->hasPermissionTo('estimulo-evaluaciones-coordinadores-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Coordinadores") ||
                                 Auth::user()->hasPermissionTo('estimulo-evaluaciones-apoyo-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Personal_Apoyo"))
                                <li class="nav-item has-treeview {{ isMenuOpen('estimulos.evaluaciones.responsabilidades') }}">
                                    <a style="font-size: 15px;" href="#" class="nav-link {{ isRouteActive('estimulos.evaluaciones.responsabilidades') }}">
                                        <i class="fas fa-hands nav-icon"></i>
                                        <p><b>Responsabilidades</b><i class="right fas fa-angle-left"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-directores-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Directores"))
                                            <li class="nav-item">
                                                <a href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/responsabilidades/directores/listDirectores') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.responsabilidades.directores') }}">
                                                    <i class="fa fa-fist-raised nav-icon"></i>
                                                    <p>Directores</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-subdirectores-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Subdirectores"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/responsabilidades/subdirectores/listSubdirectores') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.responsabilidades.subdirectores') }}">
                                                    <i class="fa fa-user-tie nav-icon"></i>
                                                    <p>Subdirectores</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-coordinadores-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Coordinadores"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/responsabilidades/coordinadores/listCoordinadores') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.responsabilidades.coordinadores') }}">
                                                    <i class="fa fa-people-arrows nav-icon"></i>
                                                    <p>Coordinadores</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-apoyo-index') || existeUsuario(Auth::user()->usuario, 'responsabilidades', "Personal_Apoyo"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/responsabilidades/personalApoyo/listPersonalApoyo') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.responsabilidades.personalApoyo') }}">
                                                    <i class="fa fa-hands-helping nav-icon"></i>
                                                    <p>Personal de apoyo</p>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            @endif
                        </ul>
                        <ul class="nav nav-treeview">
                            @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-difusiondivulgacion-index') || existeUsuario(Auth::user()->usuario, 'general', "Direccion_General"))
                                <li class="nav-item has-treeview {{ isMenuOpen('estimulos.evaluaciones.direccionGeneral') }}">
                                    <a style="font-size: 15px;" href="#" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionGeneral') }}">
                                        <i class="fa fa-cogs nav-icon"></i>
                                        <p><b>Dirección general</b><i class="right fas fa-angle-left"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-general-difusiondivulgacion-index') || existeUsuario(Auth::user()->usuario, 'general', "Direccion_General"))
                                            <li class="nav-item">
                                                <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/DireccionGeneral/DifDiv/listDifDIv') }}" class="nav-link {{ isRouteActive('estimulos.evaluaciones.direccionGeneral.DivDif') }}">
                                                    <i class="fa fa-bullhorn nav-icon"></i>
                                                    <p>Difusión y Divulgación</p>
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
