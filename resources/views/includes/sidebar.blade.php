<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/dashboard"> <img alt="image" src="{{ asset('assets') }}/img/logo.png" class="header-logo" /> <span
                    class="logo-name">Otika</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown">
                <a href="/dashboard" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            @if (Auth::user()->role == 'admin')
                <li class="dropdown">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i
                            data-feather="briefcase"></i><span>Bank
                            Sampah</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('jenis.index') }}">Jenis Sampah</a></li>
                        <li><a class="nav-link" href="{{ route('sampah.index') }}">Daftar Sampah</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="/transaksi-sampah" class="nav-link"><i
                            data-feather="command"></i><span>Transaksi</span></a>
                </li>
            @endif
        </ul>
        @if (Auth::user()->role != 'admin')
            <ul class="sidebar-menu">
                <li class="dropdown">
                    <a href="/daftar-sampah" class="nav-link"><i data-feather="briefcase"></i><span>Daftar
                            Sampah</span></a>
                </li>
            </ul>
            <ul class="sidebar-menu">
                <li class="menu-header">Riwayat Transaksi</li>
                <li class="dropdown">
                    <a href="{{ route('transaksi.index') }}" class="nav-link"><i
                            data-feather="command"></i><span>Transaksi</span></a>
                </li>
            </ul>
        @endif
    </aside>
</div>
