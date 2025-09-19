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
                <li class="{{ Request::is('owner/product') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('owner.product.index') }}">
                        <i class="fa fa-box"></i> <span>Product</span>
                    </a>
                </li>
                <li class="nav-item dropdown {{ Request::is('owner/stock*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fa fa-boxes"></i><span>Stock</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ Request::is('owner/stock/pusat*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('owner.stock.pusat.index') }}">Pusat</a>
                        </li>
                        <li class="{{ Request::is('owner/stock/cabang*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('owner.stock.cabang.index') }}">Cabang</a>
                        </li>
                        <li class="{{ Request::is('owner/stock/sales*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('owner.stock.sales.index') }}">Sales</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ Request::is('owner/branch') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('owner.branch.index') }}">
                        <i class="fa fa-building"></i> <span>Cabang</span>
                    </a>
                </li>
                <li class="nav-item dropdown {{ Request::is('owner/user*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fa fa-boxes"></i><span>Akun</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ Request::is('owner/user/pusat*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('owner.user.pusat.index') }}">Akun Pusat</a>
                        </li>
                        <li class="{{ Request::is('owner/user/cabang*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('owner.user.cabang.index') }}">Akun Cabang</a>
                        </li>
                        <li class="{{ Request::is('owner/user/sales*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('owner.user.sales.index') }}">Akun Sales</a>
                        </li>
                    </ul>
                </li>
                {{-- Tambah menu owner lainnya di sini --}}
            @endif

            @if($role == 'pusat')
                <li class="{{ Request::is('pusat/dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('pusat.dashboard.index') }}">
                        <i class="fa fa-home"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{ Request::is('pusat/product') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('pusat.product.index') }}">
                        <i class="fa fa-box"></i> <span>Product</span>
                    </a>
                </li>

                <li class="nav-item dropdown {{ Request::is('pusat/stock*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fa fa-boxes"></i><span>Stock</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ Request::is('pusat/stock/pusat*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('pusat.stock.pusat') }}">Pusat</a>
                        </li>
                        <li class="{{ Request::is('pusat/stock/cabang*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('pusat.stock.cabang') }}">Cabang</a>
                        </li>
                        <li class="{{ Request::is('pusat/stock/sales*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('pusat.stock.sales') }}">Sales</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ Request::is('pusat/branch') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('pusat.branch.index') }}">
                        <i class="fa fa-building"></i> <span>Cabang</span>
                    </a>
                </li>
                <li class="{{ Request::is('pusat/user') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('pusat.user.index') }}">
                        <i class="fa fa-users"></i> <span>Akun Cabang</span>
                    </a>
                </li>
                {{-- Tambah menu pusat lainnya di sini --}}
            @endif

            @if($role == 'cabang')
                <li class="{{ Request::is('cabang/dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('cabang.dashboard.index') }}">
                        <i class="fa fa-home"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item dropdown {{ Request::is('cabang/stock*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fa fa-boxes"></i><span>Stock</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ Request::is('cabang/stock/cabang*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('cabang.stock.cabang') }}">Cabang</a>
                        </li>
                        <li class="{{ Request::is('cabang/stock/sales*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('cabang.stock.sales') }}">Sales</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ Request::is('cabang/user') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('cabang.user.index') }}">
                        <i class="fa fa-users"></i> <span>Akun Sales</span>
                    </a>
                </li>
                <li class="{{ Request::is('cabang/transaction') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('cabang.transaction.index') }}">
                        <i class="fa fa-receipt"></i> <span>Transaksi Sales</span>
                    </a>
                </li>
                {{-- Tambah menu cabang lainnya di sini --}}
            @endif

        </ul>
    </aside>
</div>
