<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset("adminLTE") }}/dist/img/AdminLTELogo.png"
             alt="Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Hotel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset("adminLTE") }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

            @if(auth()->user()->hasRole('admin'))
                <li class="nav-item has-treeview">
                    <a href="{{ route('admin.managers.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                        <p>Managers</p>
                        </a>
                </li>

                <!-- Clients links -->
                <li class="nav-item has-treeview">
                    <a href="{{ route('admin.users.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Clients</p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="{{ route('admin.floors.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-building"></i>
                        <p>Floors</p>
                    </a>
                </li>
                <!-- Rooms links -->
                <li class="nav-item has-treeview">
                    <a href="{{ route('admin.rooms.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-bed"></i>
                        <p>Rooms</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ route('admin.reservations.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-key"></i>
                        <p>Reservations</p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="{{ route('admin.receptionists.index') }}" class="nav-link">
                        <i class=" nav-icon fas fa-user-secret"></i>
                        <p>Receptionists</p>
                    </a>
                </li>
              @endif  

              @if(auth()->user()->hasRole('receptionist'))
                <li class="nav-item has-treeview">
                    <a href="{{ route('receptionist.clients.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                        <p>Manage Clients</p>
                        </a>
                </li>

                <!-- Clients links -->
                <li class="nav-item has-treeview">
                    <a class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>My approved Clients</p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a class="nav-link">
                        <i class="nav-icon fas fa-key"></i>
                        <p> Clients Reservations</p>
                    </a>
                </li>
              @endif  

              
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>