<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex flex-wrap align-items-center w-100" id="navbar-collapse">
        <div class="navbar-nav align-items-center flex-grow-1">
            <div class="nav-item d-flex flex-wrap align-items-center gap-1 text-break">
                <span>Halo,</span>
                <b>{{ Auth::user()->myagenda_user_nama }}!</b>
                <span>Siap untuk menjelajahi agenda hari ini?</span>
            </div>
        </div>

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        @if(Auth::user()->myagenda_user_role == 'admin' && isset($myagendaProfile) && !empty($myagendaProfile->myagenda_profile_foto))
                        <img src="{{ asset('storage/' . $myagendaProfile->myagenda_profile_foto) }}"
                            alt="Foto Profile" class="w-px-40 h-auto rounded-circle" />
                        @elseif(Auth::user()->myagenda_user_role == 'pengguna' && isset($myagendaSekolah) && !empty($myagendaSekolah->myagenda_sekolah_logo))
                        <img src="{{ asset('storage/' . $myagendaSekolah->myagenda_sekolah_logo) }}"
                            alt="Logo Sekolah" class="w-px-40 h-auto rounded-circle" />
                        @else
                        <img src="https://via.placeholder.com/100" class="w-px-40 h-auto rounded-circle" />
                        @endif


                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item"
                            href="{{ Auth::user()->myagenda_user_role == 'admin' ? route('myagenda_profile.create') : '#' }}">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        @if(Auth::user()->myagenda_user_role == 'admin' && isset($myagendaProfile) && !empty($myagendaProfile->myagenda_profile_foto))
                                        <img src="{{ asset('storage/' . $myagendaProfile->myagenda_profile_foto) }}"
                                            alt="Foto Profile" class="w-px-40 h-auto rounded-circle" />
                                        @elseif(Auth::user()->myagenda_user_role == 'pengguna' && isset($myagendaSekolah) && !empty($myagendaSekolah->myagenda_sekolah_logo))
                                        <img src="{{ asset('storage/' . $myagendaSekolah->myagenda_sekolah_logo) }}"
                                            alt="Logo Sekolah" class="w-px-40 h-auto rounded-circle" />
                                        @else
                                        <img src="https://via.placeholder.com/100" class="w-px-40 h-auto rounded-circle" />
                                        @endif


                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">{{ Auth::user()->myagenda_user_nama }}</span>
                                    <small class="text-muted">{{ Auth::user()->myagenda_user_role }}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    @if(auth()->user()->myagenda_user_role == 'pengguna')
                    <li>
                        <a class="dropdown-item" href="myagenda_sekolah">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">My Profile</span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    @endif

                    <li>
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="bx bx-power-off me-2"></i>
                                <span class="align-middle">Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>