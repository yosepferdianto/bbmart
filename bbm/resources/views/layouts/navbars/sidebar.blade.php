<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header d-flex align-items-center">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
            <h1 class="text-primary"><b>BBM-Mart</b></h1>
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
                    <a href="{{ route('admin.profile.edit', auth()->user()->id) }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('Activity') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('Support') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <div class="ml-auto">
          <!-- Sidenav toggler -->
          <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
            <div class="sidenav-toggler-inner">
                <i class="fas fa-align-left text-primary"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('account/dashboard*') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-desktop text-primary"></i>
                    <span class="nav-link-text">Dashboards</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('account/vendor*') ? 'active' : '' }}" href="#operasional" data-toggle="collapse" role="button"
                    aria-expanded="true" aria-controls="operasional">
                    <i class="fas fa-people-carry text-primary"></i>
                    <span class="nav-link-text">Operasional</span>
                </a>

                <div class="collapse {{ request()->is('account/vendor*') ? 'show' : '' }}" id="operasional">
                    <ul class="nav nav-sm flex-column">
                        @can('vendor')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('account/vendor*') ? 'active' : '' }}" href="{{ route('admin.vendor.index')}}">
                                Vendor
                            </a>
                        </li>
                        @endcan
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.users.index') }}">
                                Customer
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.users.index') }}">
                                Transport
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.users.index') }}">
                                Delivery
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('account/pembelian*') ? 'active' : '' }}" href="#pembelian" data-toggle="collapse" role="button"
                    aria-expanded="true" aria-controls="pembelian">
                    <i class="fas fa-clipboard text-primary"></i>
                    <span class="nav-link-text">Pembelian</span>
                </a>

                <div class="collapse {{ request()->is('account/pembelian*') ? 'show' : '' }}" id="pembelian">
                    <ul class="nav nav-sm flex-column">
                        @can('pemesanan')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('account/pembelian*') ? 'active' : '' }}" href="{{ route('admin.pembelian.index') }}">
                                Pemesanan
                            </a>
                        </li>
                        @endcan
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.users.index') }}">
                                Delivery Order
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.users.index') }}">
                                Pembayaran
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#persediaan" data-toggle="collapse" role="button" aria-expanded="true"
                    aria-controls="persediaan">
                    <i class="fas fa-boxes text-primary"></i>
                    <span class="nav-link-text">{{ __('Persediaan') }}</span>
                </a>
                <div class="collapse {{ request()->is('account/warehouses*') ? 'show' : '' }} || {{ request()->is('account/gudang*') ? 'show' : '' }} || {{ request()->is('account/barang*') ? 'show' : '' }} || {{ request()->is('account/categories*') ? 'show' : '' }} || {{ request()->is('account/satuan*') ? 'show' : '' }}" id="persediaan">
                    <ul class="nav nav-sm flex-column">
                        @if (auth()->user()->can('warehouse'))
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('account/warehouse*') ? 'active' : '' }}" href="{{ route('admin.warehouses.index')}}">
                                {{ __('Warehouse') }}
                            </a>
                        </li>
                        @endif
                        @if (auth()->user()->can('gudang'))
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('account/gudang*') ? 'active' : '' }}" href="{{ route('admin.gudang.index') }}">
                                {{ __('Gudang') }}
                            </a>
                        </li>
                        @endif
                        <a class="nav-link" href="#barang" data-toggle="collapse" role="button" aria-expanded="true"
                            aria-controls="barang">
                            <i class="fab fa-laravel" style="color: #f4645f;"></i>
                            <span class="nav-link-text text-primary">Data Barang</span>
                        </a>
                        <div class="collapse {{ request()->is('account/barang*') ? 'show' : '' }} || {{ request()->is('account/categories*') ? 'show' : '' }} || {{ request()->is('account/satuan*') ? 'show' : '' }}" id="barang">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    @if (auth()->user()->can('barang'))
                                    <a class="nav-link {{ request()->is('account/barang*') ? 'active' : '' }}" href="{{ route('admin.barang.index')}}">
                                        Data barang
                                    </a>
                                    @endif
                                    @if (auth()->user()->can('kategori'))
                                    <a class="nav-link {{ request()->is('account/categories*') ? 'active' : '' }}" href="{{ route('admin.categories.index')}}">
                                        {{ __('Kategori Barang') }}
                                    </a>
                                    @endif
                                    @if (auth()->user()->can('satuan'))
                                    <a class="nav-link {{ request()->is('account/satuan*') ? 'active' : '' }}" href="{{ route('admin.satuan.index')}}">
                                        {{ __('Satuan Barang') }}
                                    </a>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </ul>
                </div>
            </li>

        </ul>
          <!-- Divider -->
          <hr class="my-3">
          <!-- Heading -->
          <h6 class="navbar-heading p-0 text-muted">Documentation</h6>
          <!-- Navigation -->
          <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.settings.index') }}">
                    <i class="fas fa-cogs text-primary"></i> {{ __('Pengaturan') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.roles.index') }}">
                    <i class="fas fa-users text-primary"></i> Roles
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.users.roles_permission') }}">
                    <i class="fas fa-users text-primary"></i> Permission
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.users.index') }}">
                    <i class="fas fa-users text-primary"></i> Pengguna
                </a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.logout') }}">
                    <i class="fas fa-cogs text-primary"></i> Logout
                </a>
            </li>
        </ul>
        </div>
      </div>
    </div>
  </nav>