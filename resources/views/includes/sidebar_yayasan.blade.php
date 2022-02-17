<li class="menu-header">Menu</li>
<li {{$pages=='dashboard' ? 'class=active' : ''}}><a class="nav-link" href="{{route('dashboard')}}"><i class="fas fa-diagnoses"></i> <span>Beranda</span></a></li>
<li {{$pages=='sekolah' ? 'class=active' : ''}}><a class="nav-link" href="{{route('yayasan.sekolah')}}"><i
            class="fas fa-home"></i> <span>Sekolah</span></a></li>
<li {{$pages=='yayasan-klasifikasijabatan' ? 'class=active' : ''}}><a class="nav-link"
            href="{{route('yayasan.klasifikasijabatan')}}"><i class="fas fa-sort-alpha-up"></i>
            <span>Klasifikasi Akademis dan Profesi</span></a></li></span></a></li>
<li {{$pages=='yayasan-referensi' ? 'class=active' : ''}}><a class="nav-link"
            href="{{route('yayasan.referensi')}}"><i class="far fa-file-alt"></i>
            <span>Referensi Studi & Kerja</span></a></li>
<li {{$pages=='yayasan-informasipsikologi' ? 'class=active' : ''}}><a class="nav-link"
            href="{{route('yayasan.informasipsikologi')}}"><i class="fas fa-info-circle"></i>
            <span>Buletin Psikologi</span></a></li>
