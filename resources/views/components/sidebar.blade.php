<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        @php
            $role = auth()->user()->role;
            switch ($role) {
                case 'owner':
                    $brandName = 'Owner';
                    $brandHref = route('owner.dashboard.index');
                    break;
                case 'pusat':
                    $brandName = 'Admin Pusat';
                    $brandHref = route('pusat.dashboard.index');
                    break;
                case 'cabang':
                    $brandName = 'Admin Cabang';
                    $brandHref = route('cabang.dashboard.index');
                    break;
                default:
                    $brandName = '';
                    $brandHref = url('/');
                    break;
            }
        @endphp

        <div class="sidebar-brand">
            <a href="{{ $brandHref }}">
                {{ $brandName }}
            </a>
        </div>

        <ul class="sidebar-menu">

            {{-- Dashboard per role --}}
            @if($role == 'owner')
                <li class="{{ Request::is('owner/dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('owner.dashboard.index') }}">
                        <i class="fa fa-home"></i> <span>Dashboard</span>
                    </a>
                </li>
                {{-- Tambah menu owner lainnya di sini --}}
            @endif

            @if($role == 'pusat')
                <li class="{{ Request::is('pusat/dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('pusat.dashboard.index') }}">
                        <i class="fa fa-home"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{ Request::is('pusat/stock') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('pusat.stock.index') }}">
                        <i class="fa fa-home"></i> <span>Stock Pusat</span>
                    </a>
                </li>
                <li class="{{ Request::is('pusat/branch') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('pusat.branch.index') }}">
                        <i class="fa fa-home"></i> <span>Cabang</span>
                    </a>
                </li>
                <li class="{{ Request::is('pusat/user') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('pusat.user.index') }}">
                        <i class="fa fa-home"></i> <span>Akun Cabang</span>
                    </a>
                </li>
               <li class="nav-item dropdown {{ Request::is('pusat/stock*') || Request::is('pusat/stock/sales*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fa fa-layer-group"></i><span>All Stock</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('pusat/stock/cabang*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('pusat.stock.cabang') }}">Stock Cabang</a>
                    </li>
                    <li class="{{ Request::is('pusat/stock/sales*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('pusat.stock.sales') }}">Stock Sales</a>
                    </li>
                </ul>
            </li>
                {{-- Tambah menu pusat lainnya di sini --}}
            @endif

            @if($role == 'cabang')
                <li class="{{ Request::is('cabang/dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('cabang.dashboard.index') }}">
                        <i class="fa fa-home"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{ Request::is('cabang/stock') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('cabang.stock.index') }}">
                        <i class="fa fa-home"></i> <span>Stock</span>
                    </a>
                </li>
                <li class="{{ Request::is('cabang/user') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('cabang.user.index') }}">
                        <i class="fa fa-home"></i> <span>Akun Sales</span>
                    </a>
                </li>
                {{-- Tambah menu cabang lainnya di sini --}}
            @endif

        </ul>
    </aside>
</div>
