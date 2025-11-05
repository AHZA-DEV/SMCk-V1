<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
                <div class="container-fluid">
                    <button class="btn btn-link sidebar-toggle me-3" id="sidebarToggle">
                        <i class="bi bi-list"></i>
                    </button>
                    
                    <div class="search-box me-auto">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-0">
                                <i class="bi bi-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control border-0" placeholder="Search now">
                        </div>
                    </div>
                    
                    <div class="navbar-nav flex-row align-items-center">
                        <button class="btn btn-link me-3" id="themeToggle" title="Toggle Theme">
                            <i class="bi bi-sun theme-icon"></i>
                        </button>
                        
                        <div class="dropdown me-3">
                            <button class="btn btn-link position-relative" data-bs-toggle="dropdown">
                                <i class="bi bi-bell"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    3
                                </span>
                            </button>
                        </div>
                        
                        <div class="dropdown">
                            <button class="btn btn-link d-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://via.placeholder.com/32x32/007bff/ffffff?text={{ substr(Auth::user()->name ?? Auth::guard('karyawan')->user()->nama_depan ?? 'U', 0, 1) }}" alt="Profile" class="rounded-circle me-2" width="32" height="32">
                                <span class="d-none d-md-inline me-2">
                                    @if(Auth::guard('web')->check())
                                        {{ Auth::user()->name }}
                                    @elseif(Auth::guard('karyawan')->check())
                                        {{ Auth::guard('karyawan')->user()->nama_depan }}
                                    @endif
                                </span>
                                <i class="bi bi-chevron-down"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <div class="dropdown-header">
                                        <div class="fw-bold">
                                            @if(Auth::guard('web')->check())
                                                {{ Auth::user()->name }}
                                            @elseif(Auth::guard('karyawan')->check())
                                                {{ Auth::guard('karyawan')->user()->nama_depan }} {{ Auth::guard('karyawan')->user()->nama_belakang }}
                                            @endif
                                        </div>
                                        <small class="text-muted">
                                            @if(Auth::guard('web')->check())
                                                {{ Auth::user()->email }}
                                            @elseif(Auth::guard('karyawan')->check())
                                                {{ Auth::guard('karyawan')->user()->email }}
                                            @endif
                                        </small>
                                    </div>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="@if(Auth::guard('web')->check()){{ route('admin.dashboard') }}@elseif(Auth::guard('karyawan')->check() && Auth::guard('karyawan')->user()->peran === 'hrd'){{ route('hrd.dashboard') }}@else{{ route('karyawan.dashboard') }}@endif">
                                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#profil">
                                        <i class="bi bi-person-circle me-2"></i>Profil Saya
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>