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
                        <i class="fa fa-home"></i> <span>Stock</span>
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
                <li class="{{ Request::is('cabang/stock') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('cabang.stock.index') }}">
                        <i class="fa fa-home"></i> <span>Stock</span>
                    </a>
                </li>
                {{-- Tambah menu cabang lainnya di sini --}}
            @endif

        </ul>
    </aside>
</div>
