<nav class="nxl-navigation">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="{{ route('admin.dashboard') }}" class="b-brand">
                    <!-- ========   change your logo hear   ============ -->
                    <img src="assets/images/logo-full.png" alt="" class="logo logo-lg" />
                    <img src="assets/images/logo-abbr.png" alt="" class="logo logo-sm" />
                </a>
            </div>
            <div class="navbar-content">
                <ul class="nxl-navbar">
                    <li class="nxl-item nxl-caption">
                        <label>Navigation</label>
                    </li>
                    
                    <!-- Dashboard -->
                    <li class="nxl-item">
                        <a href="{{ route('admin.dashboard') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-home"></i></span>
                            <span class="nxl-mtext">Dashboard</span>
                        </a>
                    </li>
           
                    <!-- Leads Management -->
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-users"></i></span>
                            <span class="nxl-mtext">Leads</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.leads.index') }}">All Leads</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.leads.create') }}">Add New Lead</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.leads.index', ['status' => 'New']) }}">New Leads</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.leads.index', ['status' => 'Customer']) }}">Customers</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.leads.index', ['status' => 'Qualified']) }}">Qualified Leads</a></li>
                        </ul>
                    </li>

                    <li class="nxl-item nxl-caption">
                        <label>Account</label>
                    </li>

                    <!-- Logout -->
                    <li class="nxl-item">
                        <a href="javascript:void(0);" class="nxl-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="nxl-micon"><i class="feather-log-out"></i></span>
                            <span class="nxl-mtext">Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                
                </ul>
               
            </div>
        </div>
    </nav>