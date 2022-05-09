<li {{$pages=='dashboard' ? 'class=active' : ''}}><a class="nav-link" href="{{route('dashboard')}}"><i
            class="fas fa-home"></i> <span>Dashboard</span></a></li>
<li {{$pages=='settings' ? 'class=active' : ''}}><a class="nav-link" href="{{route('settings')}}"><i
            class="fas fa-cog"></i> <span>Pengaturan</span></a>
<li class="menu-header">Menu</li>

<li {{$pages=='sekolah' ? 'class=active' : ''}}><a class="nav-link" href="{{route('sekolah')}}"><i
            class="fas fa-school"></i> <span>Sekolah</span></a></li>
<li {{$pages=='yayasan' ? 'class=active' : ''}}><a href="{{route('yayasan')}}"
        class="nav-link "> <i class="far fa-address-card"></i> <span>Yayasan/Dinas</span> </a></li>

<li {{$pages=='klasifikasijabatan' ? 'class=active' : ''}}><a href="{{route('klasifikasijabatan')}}"
        class="nav-link "> <i class="far fa-address-card"></i> <span>Klasifikasi Akademis & Profesi</span> </a></li>

<li {{$pages=='referensi' ? 'class=active' : ''}}><a href="{{route('referensi')}}" class="nav-link "> <i
            class="fas fa-greater-than-equal"></i> <span>Referensi Studi & Kerja</span> </a></li>

<li {{$pages=='informasipsikologi' ? 'class=active' : ''}}><a href="{{route('informasipsikologi')}}"
        class="nav-link "> <i class="fas fa-info-circle"></i> <span>Buletin Psikologi</span> </a></li>
<li {{ $pages == 'penjelasan_faktorkepribadianpages' ? 'class=active' : '' }}><a class="nav-link"
        href="{{ route('penjelasanfaktorkepribadian') }}"><i class="fas fa-user-shield"></i> <span>Terapis Karakter Positif</span></a></li>
<li {{ $pages == 'pemecahanmasalahdeteksi' ? 'class=active' : '' }}><a class="nav-link"
        href="{{ route('pemecahanmasalahdeteksi') }}"><i class="fas fa-user-shield"></i> <span>Penanganan Deteksi Masalah</span></a></li>
<li {{ $pages == 'katabijak' ? 'class=active' : '' }}><a class="nav-link" href="{{ route('katabijak') }}"><i
        class="fas fa-user-shield"></i> <span>Kata-kata Bijak</span></a></li>
<li {{$pages=='masternilaipsikologi' ? 'class=active' : ''}}><a href="{{route('masternilaipsikologi')}}"
        class="nav-link "> <i class="fas fa-archway"></i> <span>Master Nilai Psikologi</span> </a></li>
<li {{$pages=='minatbakat' ? 'class=active' : ''}}><a href="{{route('minatbakat')}}" class="nav-link "> <i
            class="fas fa-air-freshener"></i> <span>Minat Bakat </span> </a></li>
