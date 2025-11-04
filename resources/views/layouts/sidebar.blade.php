{{-- Sidebar untuk Admin --}}
@if(Auth::guard('web')->check())
<nav class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="d-flex align-items-center">
            <i class="bi bi-shield-check text-primary me-2"></i>
            <span class="fw-bold">Admin Panel</span>
        </div>
    </div>

    <div class="sidebar-menu">
        <ul class="list-unstyled">
            <li class="menu-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="menu-link">
                    <i class="bi bi-house-door"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="menu-item {{ Request::is('admin/karyawan*') ? 'active' : '' }}">
                <a href="{{ route('admin.karyawan.index') }}" class="menu-link">
                    <i class="bi bi-people"></i>
                    <span>Kelola Karyawan</span>
                </a>
            </li>

            <li class="menu-item {{ Request::is('admin/departemen*') ? 'active' : '' }}">
                <a href="{{ route('admin.departemen.index') }}" class="menu-link">
                    <i class="bi bi-building"></i>
                    <span>Kelola Departemen</span>
                </a>
            </li>

            <li class="menu-item {{ Request::is('admin/hrd*') ? 'active' : '' }}">
                <a href="{{ route('admin.hrd.index') }}" class="menu-link">
                    <i class="bi bi-person-badge"></i>
                    <span>Kelola HRD</span>
                </a>
            </li>

            <li class="menu-item {{ Request::is('admin/cuti*') ? 'active' : '' }}">
                <a href="{{ route('admin.cuti.index') }}" class="menu-link">
                    <i class="bi bi-calendar-check"></i>
                    <span>Kelola Cuti</span>
                </a>
            </li>

            <li class="menu-item {{ Request::is('admin/laporan*') ? 'active' : '' }}">
                <a href="{{ route('admin.laporan.index') }}" class="menu-link">
                    <i class="bi bi-file-earmark-bar-graph"></i>
                    <span>Laporan</span>
                </a>
            </li>

            <li class="menu-item {{ Request::is('admin/pengaturan*') ? 'active' : '' }}">
                <a href="{{ route('admin.pengaturan.index') }}" class="menu-link">
                    <i class="bi bi-gear"></i>
                    <span>Pengaturan Sistem</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

{{-- Sidebar untuk HRD --}}
@elseif(Auth::guard('karyawan')->check() && Auth::guard('karyawan')->user()->peran === 'hrd')
<nav class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="d-flex align-items-center">
            <i class="bi bi-person-badge text-primary me-2"></i>
            <span class="fw-bold">HRD Panel</span>
        </div>
    </div>

    <div class="sidebar-menu">
        <ul class="list-unstyled">
            <li class="menu-item {{ Request::is('hrd/dashboard') ? 'active' : '' }}">
                <a href="{{ route('hrd.dashboard') }}" class="menu-link">
                    <i class="bi bi-house-door"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="menu-item {{ Request::is('hrd/pengajuan-cuti*') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <i class="bi bi-inbox"></i>
                    <span>Pengajuan Cuti</span>
                </a>
            </li>

            <li class="menu-item {{ Request::is('hrd/approval*') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <i class="bi bi-check-circle"></i>
                    <span>Approval Cuti</span>
                </a>
            </li>

            <li class="menu-item {{ Request::is('hrd/riwayat-cuti*') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <i class="bi bi-clock-history"></i>
                    <span>Riwayat Cuti</span>
                </a>
            </li>

            <li class="menu-item {{ Request::is('hrd/karyawan*') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <i class="bi bi-people"></i>
                    <span>Data Karyawan</span>
                </a>
            </li>

            <li class="menu-item {{ Request::is('hrd/laporan*') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <i class="bi bi-file-earmark-text"></i>
                    <span>Laporan</span>
                </a>
            </li>

            <li class="menu-item {{ Request::is('hrd/profil*') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <i class="bi bi-person-circle"></i>
                    <span>Profil Saya</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

{{-- Sidebar untuk Karyawan --}}
@elseif(Auth::guard('karyawan')->check() && Auth::guard('karyawan')->user()->peran === 'karyawan')
<nav class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="d-flex align-items-center">
            <i class="bi bi-person-circle text-primary me-2"></i>
            <span class="fw-bold">Karyawan Panel</span>
        </div>
    </div>

    <div class="sidebar-menu">
        <ul class="list-unstyled">
            <li class="menu-item {{ Request::is('karyawan/dashboard') ? 'active' : '' }}">
                <a href="{{ route('karyawan.dashboard') }}" class="menu-link">
                    <i class="bi bi-house-door"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="menu-item {{ Request::is('karyawan/ajukan-cuti*') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <i class="bi bi-calendar-plus"></i>
                    <span>Ajukan Cuti</span>
                </a>
            </li>

            <li class="menu-item {{ Request::is('karyawan/riwayat-cuti*') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <i class="bi bi-clock-history"></i>
                    <span>Riwayat Cuti</span>
                </a>
            </li>

            <li class="menu-item {{ Request::is('karyawan/sisa-cuti*') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <i class="bi bi-calendar-event"></i>
                    <span>Sisa Cuti</span>
                </a>
            </li>

            <li class="menu-item {{ Request::is('karyawan/notifikasi*') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <i class="bi bi-bell"></i>
                    <span>Notifikasi</span>
                </a>
            </li>

            <li class="menu-item {{ Request::is('karyawan/profil*') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <i class="bi bi-person-circle"></i>
                    <span>Profil Saya</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
@endif
