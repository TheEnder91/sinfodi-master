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
                     Auth::user()->hasPermissionTo('estimulo-responsabilidad-index') || Auth::user()->hasPermissionTo('estimulo-meta-index') || Auth::user()->hasPermissionTo('estimulo-impacto-index'))
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
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Actividades A</p>
                                    </a>
                                </li>
                            @endcan
                            @can('estimulo-actividadB-index')
                                <li class="nav-item">
                                    <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/factor1/criterios/listActividadesB') }}" class="nav-link {{ isRouteActive('estimulos.factor1.actividadesB') }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Actividades B</p>
                                    </a>
                                </li>
                            @endcan
                            @can('estimulo-responsabilidad-index')
                                <li class="nav-item">
                                    <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/factor1/responsabilidades/listResponsabildiades') }}" class="nav-link {{ isRouteActive('estimulos.factor1.responsabilidades') }}">
                                        <i class="far fa-circle nav-icon"></i>
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
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Metas alcanzadas</p>
                                    </a>
                                </li>
                            @endcan
                            @can('estimulo-impacto-index')
                                <li class="nav-item">
                                    <a style="font-size: 15px;" href="{{ \App\Traits\Principal::getUrlToken('/estimulos/factor2/inpacto/listImpacto') }}" class="nav-link {{ isRouteActive('estimulos.factor2.impacto') }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Nivel de impacto</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>
