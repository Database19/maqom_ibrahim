<ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-speedometer') }}"></use>
            </svg>
            {{ __('Dashboard') }}
        </a>
    </li>

    <li class="nav-group" aria-expanded="false">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-people') }}"></use>
            </svg>
            Jamaah
        </a>
        <ul class="nav-group-items" style="height: 0px;">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('daftar-jamaah.index') }}" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-pen') }}"></use>
                    </svg>
                    Daftar Jamaah
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('daftar-umrah.index') }}" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-pen-alt') }}"></use>
                    </svg>
                    Daftar Umrah
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-file') }}"></use>
                    </svg>
                    Persyaratan Dokumen
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-money') }}"></use>
                    </svg>
                    Pembayaran Umrah
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-rowing') }}"></use>
                    </svg>
                    Perlengkapan Jamaah
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-group" aria-expanded="false">
        <a  class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-book') }}"></use>
            </svg>
            Manifestasi
        </a>
        <ul class="nav-group-items" style="height: 0px;">
            <li class="nav-item">
                <a class="nav-link" href="#" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-pasport') }}"></use>
                    </svg>
                    Pasport
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-ticket') }}"></use>
                    </svg>
                    Tiket
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-isurance') }}"></use>
                    </svg>
                    Asuransi
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-roomlist') }}"></use>
                    </svg>
                    Rooming List
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-bus-alt') }}"></use>
                    </svg>
                    Bis
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-cc') }}"></use>
                    </svg>
                    Siskopatuh
                </a>
            </li>
        </ul>
    </li>


    <li class="nav-group" aria-expanded="false">
        <a  class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-paper-plane') }}"></use>
            </svg>
            Keberangkatan
        </a>
        <ul class="nav-group-items" style="height: 0px;">
            <li class="nav-item">
                <a class="nav-link" href="#" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-cancel') }}"></use>
                    </svg>
                    Pembatalan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-suitecase') }}"></use>
                    </svg>
                    Pengelolaan Pemberangkatan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-book') }}"></use>
                    </svg>
                    Pengelolaan Kepulangan
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-group" aria-expanded="false">
        <a  class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-star') }}"></use>
            </svg>
            Layanan Jasa
        </a>
        <ul class="nav-group-items" style="height: 0px;">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('paket-umrah.index') }}" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-book') }}"></use>
                    </svg>
                    Umrah
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-book') }}"></use>
                    </svg>
                    Haji
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-book') }}"></use>
                    </svg>
                    Tur Wisata
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-group" aria-expanded="false">
        <a  class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-star') }}"></use>
            </svg>
            Inventory
        </a>
        <ul class="nav-group-items" style="height: 0px;">
            <li class="nav-item">
                <a class="nav-link" href="#" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-book') }}"></use>
                    </svg>
                    Pengeluaran Barang
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-book') }}"></use>
                    </svg>
                    Pengadaan Barang
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-book') }}"></use>
                    </svg>
                    Keluar-Masuk Barang
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-book') }}"></use>
                    </svg>
                    Stock Opname Barang
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-book') }}"></use>
                    </svg>
                    Perlengkapan Ibadah
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-group" aria-expanded="false">
        <a  class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-star') }}"></use>
            </svg>
            Keuangan
        </a>
        <ul class="nav-group-items" style="height: 0px;">
            <li class="nav-item">
                <a class="nav-link" href="#" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-book') }}"></use>
                    </svg>
                    Jurnal
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-book') }}"></use>
                    </svg>
                    Buku Besar
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-book') }}"></use>
                    </svg>
                    Finansial Statement
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-group" aria-expanded="false">
        <a  class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-star') }}"></use>
            </svg>
            SDM
        </a>
        <ul class="nav-group-items" style="height: 0px;">
            <li class="nav-item">
                <a class="nav-link" href="#" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-book') }}"></use>
                    </svg>
                    Karyawan
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-group" aria-expanded="false">
        <a  class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-star') }}"></use>
            </svg>
            Master Data
        </a>
        <ul class="nav-group-items" style="height: 0px;">
            <li class="nav-item">
                <a class="nav-link" href="#" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-book') }}"></use>
                    </svg>
                    Golongan Darah
                </a>
            </li>
        </ul>
    </li>


    <li class="nav-group" aria-expanded="false">
        <a  class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-star') }}"></use>
            </svg>
            Manifestasi
        </a>
        <ul class="nav-group-items" style="height: 0px;">
            <li class="nav-item">
                <a class="nav-link" href="#" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-book') }}"></use>
                    </svg>
                    Daftar Jamaah
                </a>
            </li>
        </ul>
    </li>

    <li>
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-account-logout') }}"></use>
            </svg>
            {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
    </li>
</ul>
