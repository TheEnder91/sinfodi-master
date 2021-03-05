<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('img/cideteq.png') }}" alt="CIDETEQ Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><b>S I N F O D I</b></span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">edgac427</a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header"><b>ESTIMULOS</b></li>
                <li class="nav-item">
                    <a href="{{ route('modulos.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-cubes"></i>
                        <p>
                            Modulos
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('criterios.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-clipboard-list"></i>
                        <p>
                            Criterios y puntos
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
