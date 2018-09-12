@if($auth->posisi == 'pusat')
<ul class="sidebar-section-nav">
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link" href="{{url('kordinator')}}">
            <span class="sidebar-section-nav__item-icon mdi mdi-home"></span>
            <span class="sidebar-section-nav__item-text">Halaman Utama</span>
        </a>
    </li>
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link" href="{{url('kordinator/dl/'.$auth->anggota_id)}}">
            <span class="sidebar-section-nav__item-icon mdi mdi-account-multiple-plus"></span>
            <span class="sidebar-section-nav__item-text">Anggota</span>
        </a>
    </li>
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link" href="{{url('kandidat')}}">
            <span class="sidebar-section-nav__item-icon mdi mdi-account-check"></span>
            <span class="sidebar-section-nav__item-text">Data Kandidat</span>
        </a>
    </li>
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link sidebar-section-nav__link-dropdown" href="#">
            <span class="sidebar-section-nav__item-icon mdi mdi-ray-start"></span>
            <span class="sidebar-section-nav__item-text">Pra Event</span>
        </a>
        <ul class="sidebar-section-subnav">
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('event/hasil-pendataan/pra')}}">Hasil Pendataan</a></li>
        </ul>
    </li>

    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link sidebar-section-nav__link-dropdown" href="#">
            <span class="sidebar-section-nav__item-icon mdi mdi-ray-end"></span>
            <span class="sidebar-section-nav__item-text">Event</span>
        </a>
        <ul class="sidebar-section-subnav">
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('event/hasil-pendataan')}}">Hasil Pendataan</a></li>
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('event/hasil-pendataan/detail')}}">Detail Pendataan</a></li>
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('event/hasil-pendataan/detail/chart')}}">Detail Statistik</a></li>
        </ul>
    </li>
</ul>
@endif

@if($auth->posisi == 'kabkota')
<ul class="sidebar-section-nav">
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link" href="{{url('kordinator')}}">
            <span class="sidebar-section-nav__item-icon mdi mdi-home"></span>
            <span class="sidebar-section-nav__item-text">Halaman Utama</span>
        </a>
    </li>
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link" href="{{url('kordinator/dl/'.$auth->anggota_id)}}">
            <span class="sidebar-section-nav__item-icon mdi mdi-account-multiple-plus"></span>
            <span class="sidebar-section-nav__item-text">Anggota</span>
        </a>
    </li>
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link sidebar-section-nav__link-dropdown" href="#">
            <span class="sidebar-section-nav__item-icon mdi mdi-ray-start"></span>
            <span class="sidebar-section-nav__item-text">Pra Event</span>
        </a>
        <ul class="sidebar-section-subnav">
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('event/hasil-pendataan/pra')}}">Hasil Pendataan</a></li>
        </ul>
    </li>

    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link sidebar-section-nav__link-dropdown" href="#">
            <span class="sidebar-section-nav__item-icon mdi mdi-ray-end"></span>
            <span class="sidebar-section-nav__item-text">Event</span>
        </a>
        <ul class="sidebar-section-subnav">
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('event/hasil-pendataan')}}">Hasil Pendataan</a></li>
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('event/hasil-pendataan/detail')}}">Detail Pendataan</a></li>
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('event/hasil-pendataan/detail/chart')}}">Detail Statistik</a></li>
        </ul>
    </li>
</ul>
@endif

@if($auth->posisi == 'kecamatan')
<ul class="sidebar-section-nav">
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link" href="{{url('kordinator')}}">
            <span class="sidebar-section-nav__item-icon mdi mdi-home"></span>
            <span class="sidebar-section-nav__item-text">Halaman Utama</span>
        </a>
    </li>
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link" href="{{url('kordinator/dl/'.$auth->anggota_id)}}">
            <span class="sidebar-section-nav__item-icon mdi mdi-account-multiple-plus"></span>
            <span class="sidebar-section-nav__item-text">Anggota</span>
        </a>
    </li>
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link sidebar-section-nav__link-dropdown" href="#">
            <span class="sidebar-section-nav__item-icon mdi mdi-ray-start"></span>
            <span class="sidebar-section-nav__item-text">Pra Event</span>
        </a>
        <ul class="sidebar-section-subnav">
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('event/hasil-pendataan/pra')}}">Hasil Pendataan</a></li>
        </ul>
    </li>

    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link sidebar-section-nav__link-dropdown" href="#">
            <span class="sidebar-section-nav__item-icon mdi mdi-ray-end"></span>
            <span class="sidebar-section-nav__item-text">Event</span>
        </a>
        <ul class="sidebar-section-subnav">
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('event/hasil-pendataan')}}">Hasil Pendataan</a></li>
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('event/hasil-pendataan/detail')}}">Detail Pendataan</a></li>
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('event/hasil-pendataan/detail/chart')}}">Detail Statistik</a></li>
        </ul>
    </li>
</ul>
@endif

@if($auth->posisi == 'kelurahan')
<ul class="sidebar-section-nav">
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link" href="{{url('kordinator')}}">
            <span class="sidebar-section-nav__item-icon mdi mdi-home"></span>
            <span class="sidebar-section-nav__item-text">Halaman Utama</span>
        </a>
    </li>
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link" href="{{url('relawan/data')}}">
            <span class="sidebar-section-nav__item-icon mdi mdi-account-multiple"></span>
            <span class="sidebar-section-nav__item-text">Relawan</span>
        </a>
    </li>
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link sidebar-section-nav__link-dropdown" href="#">
            <span class="sidebar-section-nav__item-icon mdi mdi-ray-start"></span>
            <span class="sidebar-section-nav__item-text">Pra Event</span>
        </a>
        <ul class="sidebar-section-subnav">
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('event/hasil-pendataan/pra')}}">Hasil Pendataan</a></li>
        </ul>
    </li>

    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link sidebar-section-nav__link-dropdown" href="#">
            <span class="sidebar-section-nav__item-icon mdi mdi-ray-end"></span>
            <span class="sidebar-section-nav__item-text">Event</span>
        </a>
        <ul class="sidebar-section-subnav">
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('event/hasil-pendataan')}}">Hasil Pendataan</a></li>
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('event/hasil-pendataan/detail')}}">Detail Pendataan</a></li>
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('event/hasil-pendataan/detail/chart')}}">Detail Statistik</a></li>
        </ul>
    </li>
</ul>
@endif