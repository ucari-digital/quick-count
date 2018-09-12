<ul class="sidebar-section-nav">
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link" href="{{url('superadmin')}}">
            <span class="sidebar-section-nav__item-icon mdi mdi-home menu-icon"></span>
            <span class="sidebar-section-nav__item-text">Halaman Utama</span>
        </a>
    </li>
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link" href="{{url('dpt')}}">
            <span class="sidebar-section-nav__item-icon mdi mdi-book-open"></span>
            <span class="sidebar-section-nav__item-text">Data DPT</span>
        </a>
    </li>
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link sidebar-section-nav__link-dropdown" href="#">
            <span class="sidebar-section-nav__item-icon mdi mdi-account-star"></span>
            <span class="sidebar-section-nav__item-text">Kordinator</span>
        </a>
        <ul class="sidebar-section-subnav">
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('kordinator/pusat')}}">Pusat</a></li>
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('kordinator/kabkota')}}">Kabupaten / Kota</a></li>
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('kordinator/kecamatan')}}">Kecamatan</a></li>
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('kordinator/kelurahan')}}">Kelurahan</a></li>
        </ul>
    </li>
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link" href="{{url('relawan/data')}}">
            <span class="sidebar-section-nav__item-icon mdi mdi-account-multiple"></span>
            <span class="sidebar-section-nav__item-text">Relawan</span>
        </a>
    </li>
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link" href="{{url('pemilih/data')}}">
            <span class="sidebar-section-nav__item-icon mdi mdi-account-plus"></span>
            <span class="sidebar-section-nav__item-text">Pemilih</span>
        </a>
    </li>
</ul>