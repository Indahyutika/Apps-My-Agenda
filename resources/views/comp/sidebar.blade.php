@php
use Illuminate\Support\Facades\Auth;
use App\MyAgenda_sekolah;

$user = Auth::user();
$punyaSekolah = $user ? MyAgenda_sekolah::where('myagenda_sekolah_user_id', $user->myagenda_user_id)->exists() : false;
@endphp


<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo text-center">
        <a href="index.html" class="app-brand-link d-flex justify-content-center">
            <span class="app-brand-logo demo">
                <img src="{{ asset('assets/img/favicon.png') }}" alt="Logo" width="100">
            </span>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
       <li class="menu-item {{ request()->is('home') || request()->is('dashboard/admin') ? 'active' : '' }}">
    <a href="{{ auth()->user()->myagenda_user_role == 'admin' ? url('dashboard/admin') : url('home') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Dashboard</div>
    </a>
</li>


        @if ($punyaSekolah)
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">MY Agenda</span>
        </li>
        <li class="menu-item">
            <a href="/myagenda_agenda" class="menu-link">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="Authentications">Agenda</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="/myagenda_gambar" class="menu-link">
                <i class="menu-icon bx bx-images"></i>
                <div data-i18n="Authentications">Media</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="/myagenda_runningtext" class="menu-link">
                <i class="menu-icon bx bx-news"></i>
                <div data-i18n="Authentications">Lintas Info</div>
            </a>
        </li>
        @endif
    </ul>
</aside>

<style>
    .app-brand {
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>