<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{route('dashboard')}}">{{Fungsi::app_nama()}}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{route('dashboard')}}">{{Fungsi::app_namapendek()}}</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Layout v1.2</li>
            <li {{$pages=='dashboard' ? 'class=active' : ''}}><a class="nav-link" href="{{route('dashboard')}}"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
            <li {{$pages=='settings' ? 'class=active' : ''}}><a class="nav-link" href="{{route('settings')}}"><i class="fas fa-cog"></i> <span>Pengaturan</span></a>
            <li class="menu-header">Menu</li>

            <li {{$pages=='sekolah' ? 'class=active' : ''}}><a class="nav-link" href="{{route('sekolah')}}"><i class="fas fa-school"></i> <span>Sekolah</span></a></li>

            <li {{$pages=='referensi' ? 'class=active' : ''}}><a href="{{route('referensi')}}" class="nav-link "> <i class="fas fa-greater-than-equal"></i>  <span>Referensi Psikologis</span> </a></li>

            <li {{$pages=='informasipsikologi' ? 'class=active' : ''}}><a href="{{route('informasipsikologi')}}" class="nav-link "> <i class="fas fa-info-circle"></i>  <span>Informasi Psikologis</span> </a></li>

            <li {{$pages=='masternilaipsikologi' ? 'class=active' : ''}}><a href="{{route('masternilaipsikologi')}}" class="nav-link "> <i class="fas fa-info-circle"></i>  <span>Master Nilai Psikologi</span> </a></li>

            <li {{$pages=='users' ? 'class=active' : ''}}><a class="nav-link" href="{{route('users')}}"><i class="fas fa-user-shield"></i> <span>Administrator</span></a></li>
            {{-- <li><a class="nav-link" href="#"><i class="fas fa-chart-area"></i> <span>Analisa</span></a></li> --}}
            <li {{$pages=='example' ? 'class=active' : ''}}><a class="nav-link" href="{{route('testing.grafik')}}"><i class="fas fa-chart-area"></i> <span>Testing Grafik</span></a></li>
            {{-- <li class="nav-item dropdown ">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-school"></i>
                    <span>Sekolah</span></a>
                <ul class="dropdown-menu">
                    <li ><a class="nav-link" href="#">Tahun Ajaran</a></li>
                    <li><a class="nav-link" href="#">Semester</a></li>
                    <li><a class="nav-link" href="#">Wali kelas</a></li>
                    <li><a class="nav-link" href="#">Kelas</a></li>
                </ul>
            </li> --}}
            {{-- <li><a class="nav-link" href="#"><i class="fas fa-chalkboard"></i> <span>Referensi Psikologis</span></a>
            </li>
            <li><a class="nav-link" href="#"><i class="fas fa-chalkboard-teacher"></i> <span>Deteksi Psikologis</span></a></li>

            <li><a class="nav-link" href="#"><i class="fas fa-graduation-cap"></i> <span>User</span></a></li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-keyboard"></i>
                    <span>Master Nilai</span></a>
                <ul class="dropdown-menu">
                    <li class="active"><a class="nav-link" href="#">Psikologi</a></li>
                    <li><a class="nav-link" href="#">Bidang Studi</a></li>
                </ul>
            </li>
            <li class="menu-header">Proses</li>
            <li><a class="nav-link" href="#"><i class="fas fa-id-badge"></i> <span>Input Nilai Siswa</span></a></li>


            <li class="menu-header">Analisa</li>
            <li><a class="nav-link" href="#"><i class="fab fa-itunes-note"></i> <span>Minat dan Bakat</span></a></li>
            <li><a class="nav-link" href="#"><i class="fas fa-chart-line"></i> <span>Grafik</span></a></li> --}}

        </ul>


    </aside>
</div>
