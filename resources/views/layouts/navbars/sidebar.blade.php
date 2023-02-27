<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
            aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{ asset('argon') }}/img/devifologoicon.jpg" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item"
                        onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                            data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                            aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fas fa-home {{$activePage == 'home' ? 'text-primary' : '' }}"></i> {{ __('Dashboard') }}
                    </a>
                </li>
                @if (Auth::user()->department == 'owner')
                <li class="nav-item {{$activePage == 'transaksi' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('pos.transaksi_index') }}">
                        <i class="ni ni-money-coins {{$activePage == 'transaksi' ? 'text-primary' : '' }}"></i> {{ __('Transaksi') }}
                    </a>
                </li>

                <li class="nav-vc {{ $activePage == 'barangs' || $activePage == 'pos' || $activePage == 'laporan offline' ? ' active' : '' }}">
                <a class="nav-link collapsed" href="#navbar-crud-vendor" data-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="navbar-crud-vendor">
                    <i class="fas fa-database {{ $activePage == 'barangs' || $activePage == 'pos' || $activePage == 'laporan offline' ? 'text-primary' : '' }}"></i>
                    <span class="nav-link-text">{{ __('Basis Data') }}</span>
                </a>
                <div class="collapse" id="navbar-crud-vendor">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item {{$activePage == 'pos' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('pos.index') }}">
                                {{ __('Transaksi Order') }}
                            </a>
                        </li>
                        <li class="nav-item {{ $activePage == 'barangs' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('barangs.index') }}">
                                {{ __('Barang') }}
                            </a>
                        </li>
                        <li class="nav-item {{ $activePage == 'laporan offline' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('lap_off.index') }}">
                                {{ __('Laporan Offline') }}
                            </a>
                        </li>
                    </ul>
                </div>
                </li>

                {{-- @can('admin.hakakses', Auth::user()) --}}
                    <li class="nav-pa {{ $activePage == 'permission' || $activePage == 'role' ? ' active' : '' }}">
                        <a class="nav-link collapsed" href="#navbar-examples" data-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="navbar-examples">
                            <i class="ni ni-lock-circle-open"></i>
                            <span class="nav-link-text">{{ __('Hak Akses') }}</span>
                        </a>
                        <div class="collapse" id="navbar-examples">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('permission.index') }}">
                                        {{ __('Permission') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('role.index') }}">
                                        {{ __('Role') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('roleuser.index') }}">
                                        {{ __('User Role') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    {{-- @endcan --}}
                    <li class="nav-reports {{ $activePage == 'reports laporan offline' || $activePage == 'reports transaksi order' ? ' active' : '' }}">
                    <a class="nav-link collapsed" href="#navbar-crud-reports" data-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="navbar-crud-reports">
                        <i class="ni ni-single-copy-04"></i>
                        <span class="nav-link-text">{{ __('Reports') }}</span>
                    </a>

                    <div class="collapse" id="navbar-crud-reports">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item {{ $activePage == 'reports laporan offline' ? ' active' : '' }}">
                                <a class="nav-link" href="{{ route('ReportsLo') }}">
                                    {{ __('Reports Lap.Offline') }}
                                </a>

                            </li>
                            <li class="nav-item {{ $activePage == 'reports transaksi order' ? ' active' : '' }}">
                                <a class="nav-link" href="{{ route('report.order') }}">
                                    {{ __('Reports Transaksi Order') }}
                                </a>

                            </li>
                        </ul>


                    </div>
                </li>



                @endif

                @can('admin.transaksi', Auth::user())
                <li class="nav-item {{$activePage == 'transaksi' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('pos.transaksi_index') }}">
                        <i class="ni ni-money-coins {{$activePage == 'transaksi' ? 'text-primary' : '' }}"></i> {{ __('Transaksi') }}
                    </a>
                </li>
                @endcan
                @can('admin.transaksi-order', Auth::user())
                <li class="nav-item {{$activePage == 'pos' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('pos.index') }}">
                        <i class="fas fa-database {{$activePage == 'pos' ? 'text-primary' : '' }}"></i> {{ __('Transaksi Order') }}
                    </a>
                </li>
                @endcan
                @can('admin.barang', Auth::user())
                <li class="nav-item {{$activePage == 'barangs' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('barangs.index') }}">
                        <i class="fas fa-database {{$activePage == 'barangs' ? 'text-primary' : '' }}"></i> {{ __('Barang') }}
                    </a>
                </li>
                @endcan
                @can('admin.laporan-offline', Auth::user())
                <li class="nav-item {{$activePage == 'laporan offline' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('lap_off.index') }}">
                        <i class="fas fa-database {{$activePage == 'laporan offline' ? 'text-primary' : '' }}"></i> {{ __('Laporan Offline') }}
                    </a>
                </li>
                @endcan
                @can('admin.report-lapoff', Auth::user())
                <li class="nav-item {{$activePage == 'reports laporan offline' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('ReportsLo') }}">
                        <i class="ni ni-single-copy-04 {{$activePage == 'reports laporan offline' ? 'text-primary' : '' }}"></i> {{ __('Reports Lap.Offline') }}
                    </a>
                </li>
                @endcan
                @can('admin.report-transaksiorder', Auth::user())
                <li class="nav-item {{$activePage == 'reports transaksi order' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('report.order') }}">
                        <i class="ni ni-single-copy-04 {{$activePage == 'reports transaksi order' ? 'text-primary' : '' }}"></i> {{ __('Reports Transaksi Order') }}
                    </a>
                </li>
                @endcan



            </ul>




            <!-- Divider -->
            <hr class="my-3">
            <!-- Navigation -->
            <ul class="navbar-nav mb-md-3">
                {{-- isi nav bawah --}}
            </ul>
        </div>
    </div>
</nav>
