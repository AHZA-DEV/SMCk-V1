<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
                <div class="container-fluid">
                    <button class="btn btn-link sidebar-toggle me-3" id="sidebarToggle">
                        <i class="bi bi-list"></i>
                    </button>
                    
<!-- 
                    <div class="search-box me-auto">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-0">
                                <i class="bi bi-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control border-0" placeholder="Search now">
                        </div>
                    </div> -->

                    <div class="navbar-nav flex-row align-items-center">
                        <button class="btn btn-link me-3" id="themeToggle" title="Toggle Theme">
                            <i class="bi bi-sun theme-icon"></i>
                        </button>

                        <div class="dropdown me-3">
                            <a href="{{ url('karyawan/notifikasi') }}" class="btn btn-link position-relative">
                                <i class="bi bi-bell"></i>
                                @if(isset($jumlah_notifikasi) && $jumlah_notifikasi > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ $jumlah_notifikasi }}
                                </span>
                                @endif
                            </a>
                        </div>


                        <div class="dropdown">
                            <button class="btn btn-link d-flex align-items-center text-decoration-none">
                                @if(Auth::guard('web')->check())
                                    <img src="https://via.placeholder.com/32x32/007bff/ffffff?text={{ substr(Auth::user()->name ?? 'U', 0, 1) }}" alt="Profile" class="rounded-circle me-1 me-md-2" width="32" height="32">
                                @elseif(Auth::guard('karyawan')->check())
                                    @if(Auth::guard('karyawan')->user()->foto_profil)
                                        <img src="{{ asset('storage/' . Auth::guard('karyawan')->user()->foto_profil) }}" alt="Profile" class="rounded-circle me-1 me-md-2" width="32" height="32" style="object-fit: cover;">
                                    @else
                                        <img src="https://via.placeholder.com/32x32/007bff/ffffff?text={{ substr(Auth::guard('karyawan')->user()->nama_depan ?? 'U', 0, 1) }}" alt="Profile" class="rounded-circle me-1 me-md-2" width="32" height="32">
                                    @endif
                                @endif
                                <span class="d-none d-lg-inline me-1 me-md-2">
                                    @if(Auth::guard('web')->check())
                                        {{ Auth::user()->name }}
                                    @elseif(Auth::guard('karyawan')->check())
                                        {{ Auth::guard('karyawan')->user()->nama_depan }}
                                    @endif
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </nav>