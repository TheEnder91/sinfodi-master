<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
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
                        <a href="{{ \App\Traits\Principal::getUrlToken('/panelControl/listUsers')  }}" class="nav-link {{ isRouteActive('panelControl.users') }}">
                            <i class="nav-icon fa fa-users"></i>
                            <p>Usuarios</p>
                        </a>
                    </li>
                @endcan
                @can('admin-role-index')
                    <li class="nav-item">
                        <a href="{{ \App\Traits\Principal::getUrlToken('/panelControl/listRoles')  }}" class="nav-link {{ isRouteActive('panelControl.roles') }}">
                            <i class="nav-icon fa fa-unlock-alt"></i>
                            <p>Roles</p>
                        </a>
                    </li>
                @endcan
                @can('admin-permission-index')
                    <li class="nav-item">
                        <a href="{{ \App\Traits\Principal::getUrlToken('/panelControl/listPermissions')  }}" class="nav-link {{ isRouteActive('panelControl.permissions') }}">
                            <i class="nav-icon fa fa-key"></i>
                            <p>Permisos</p>
                        </a>
                    </li>
                @endcan
                @if (Auth::user()->hasPermissionTo('estimulo-objetivo-index'))
                    <li class="nav-header">ESTIMULOS</li>
                @endif
                @can('estimulo-objetivo-index')
                    <li class="nav-item">
                        <a href="{{ \App\Traits\Principal::getUrlToken('/estimulos/objetivos/listObjetivos')  }}" class="nav-link {{ isRouteActive('estimulos.objetivos') }}">
                            <i class="nav-icon fa fa-bullseye"></i>
                            <p>Objetivos</p>
                        </a>
                    </li>
                @endcan
            </ul>
        </nav>
    </div>
</aside>
