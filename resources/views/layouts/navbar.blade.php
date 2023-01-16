<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">{{ Session::get('nombre') }}</a>
        </li>
        @if(Auth::user()->hasPermissionTo('admin-user-index') || Auth::user()->hasPermissionTo('admin-role-index') || Auth::user()->hasPermissionTo('admin-permission-index'))
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-cogs"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">Panel de control</span>
                    <div class="dropdown-divider"></div>
                    @can('admin-user-index')
                        <div class="dropdown-divider"></div>
                        <a href="{{ \App\Traits\Principal::getUrlToken('/panelControl/listUsers') }}" class="dropdown-item">
                            <i class="fas fa-users"></i> Usuarios
                        </a>
                    @endcan
                    @can('admin-role-index')
                        <div class="dropdown-divider"></div>
                        <a href="{{ \App\Traits\Principal::getUrlToken('/panelControl/listRoles') }}" class="dropdown-item">
                            <i class="nav-icon fa fa-unlock-alt"></i> Roles
                        </a>
                    @endcan
                    @can('admin-permission-index')
                        <div class="dropdown-divider"></div>
                        <a href="{{ \App\Traits\Principal::getUrlToken('/panelControl/listPermissions') }}" class="dropdown-item">
                            <i class="nav-icon fa fa-key"></i> Permisos
                        </a>
                    @endcan
                </div>
            </li>
        @endif
    </ul>
</nav>
