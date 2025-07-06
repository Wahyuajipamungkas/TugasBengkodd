<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    <!-- @if(config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif -->
    <div >
        <h2 class="text-white text-center p-1 font-serif">M e d P l u s</h2>
    </div>
    <hr class="bg-white">

    {{-- Sidebar menu --}}
    <div class="sidebar">
        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview" role="menu"
                @if(config('adminlte.sidebar_nav_animation_speed') != 300)
                    data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}"
                @endif
                @if(!config('adminlte.sidebar_nav_accordion'))
                    data-accordion="false"
                @endif>

                @if(request()->is('dokter*'))
                    <li class="nav-item">
                        <a href="/dokter" class="nav-link active">
                        <i class="fas fa-chart-line mr-2"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/dokter/jadwalperiksa" class="nav-link active">
                        <i class="fas fa-stopwatch"></i>
                            <p>Jadwal Periksa</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/dokter/periksa" class="nav-link active">
                        <i class="fas fa-stethoscope mr-2"></i>
                            <p>Memeriksa</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/dokter/obat" class="nav-link active">
                        <i class="fas fa-pills mr-2"></i>
                            <p>obat</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/dokter/riwayat" class="nav-link active">
                        <i class="fas fa-history mr-2"></i>
                            <p>Riwayat</p>
                        </a>
                    </li>
                     <li class="nav-item">
                        <a href="/dokter/profil" class="nav-link active">
                           <i class="fas fa-user-md"></i> 
                            <p>Profil</p>
                        </a>
                    </li>

                @elseif (request()->is('pasien*'))
                    <li class="nav-item">
                        <a href="/pasien" class="nav-link active">
                            <i class="fas fa-chart-line mr-2"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('pasien.daftarpoli.index') }}" class="nav-link active">
                        <i class="fas fa-user-check mr-2"></i>
                            <p>Daftar Poli</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('pasien.riwayat.index') }}" class="nav-link active">
                        <i class="fas fa-history mr-2"></i>
                            <p>Riwayat</p>
                        </a>
                    </li>
                @elseif (request()->is('admin*'))
                     <li class="nav-item">
                        <a href="/admin" class="nav-link active">
                        <i class="fas fa-chart-line mr-2"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/dokter" class="nav-link active">
                       <i class="fas fa-user-md"></i>
                            <p>Dokter</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/pasien" class="nav-link active">
                        <i class="fas fa-user-injured"></i>
                            <p>Pasien</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/obat" class="nav-link active">
                        <i class="fas fa-pills mr-2"></i>
                            <p>Obat</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/poli" class="nav-link active">
                        <i class="fas fa-landmark"></i>
                            <p>Poli</p>
                        </a>
                    </li>
                @endif


                {{-- Configured sidebar links --}}
                <!-- @each('adminlte::partials.sidebar.menu-item', $adminlte->menu('sidebar'), 'item') -->
            </ul>
        </nav>
    </div>
    @php( $logout_url = View::getSection('logout_url') ?? config('adminlte.logout_url', 'logout') )

    @if (config('adminlte.use_route_url', false))
        @php( $logout_url = $logout_url ? route($logout_url) : '' )
    @else
        @php( $logout_url = $logout_url ? url($logout_url) : '' )
    @endif
    <li class="nav-item mt-3">
        <a class="nav-link border border-danger text-danger rounded mx-2"
        href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt mr-2"></i>
            <span>{{ __('Logout') }}</span>
        </a>
        <form id="logout-form" action="{{ $logout_url }}" method="POST" style="display: none;">
            @if(config('adminlte.logout_method'))
                {{ method_field(config('adminlte.logout_method')) }}
            @endif
            {{ csrf_field() }}
        </form>
    </li>



</aside>
