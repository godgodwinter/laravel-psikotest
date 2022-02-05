<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{route('dashboard')}}">{{Fungsi::app_nama()}}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{route('dashboard')}}">{{Fungsi::app_namapendek()}}</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Layout v1.5</li>

            @if(Auth::user()!=null)
            @if((Auth::user()->tipeuser)=='admin')
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

            <li {{$pages=='masternilaipsikologi' ? 'class=active' : ''}}><a href="{{route('masternilaipsikologi')}}"
                    class="nav-link "> <i class="fas fa-archway"></i> <span>Master Nilai Psikologi</span> </a></li>
            <li {{$pages=='minatbakat' ? 'class=active' : ''}}><a href="{{route('minatbakat')}}" class="nav-link "> <i
                        class="fas fa-air-freshener"></i> <span>Minat Bakat </span> </a></li>

            <li {{$pages=='users' ? 'class=active' : ''}}><a class="nav-link" href="{{route('users')}}"><i
                        class="fas fa-user-shield"></i> <span>Administrator</span></a></li>
            {{-- <li><a class="nav-link" href="#"><i class="fas fa-chart-area"></i> <span>Analisa</span></a></li>
            <li {{$pages=='example' ? 'class=active' : ''}}><a class="nav-link" href="{{route('testing.grafik')}}"><i
                        class="fas fa-chart-area"></i> <span>Testing Grafik</span></a></li>--}}
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
            @elseif((Auth::user()->tipeuser)=='bk')
            @php
            // $users_id=Auth::user()->id;
            // dd($users_id);
            $users_id=Auth::user()->id;
            $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
            $sekolah_id=$pengguna->sekolah_id;
            $id=DB::table('sekolah')->where('id',$sekolah_id)->first();
            @endphp
            {{-- <li {{$pages=='bk-settingpengguna' ? 'class=active' : ''}}><a class="nav-link"
                href="{{$id->status=='Aktif' ? route('bk.settingpengguna.edit') : '#' }}"><i class="fas fa-school"></i>
                <span>Setting user</span></a></li> --}}
            <li class="menu-header">Menu</li>
            {{-- {{dd($id->status)}} --}}
            <li {{$pages=='bk-beranda' ? 'class=active' : ''}}><a class="nav-link"
                    href="{{route('bk.beranda') }}"><i class="fas fa-school"></i>
                    <span>Dashboard Sekolah</span></a></li>
            <li {{$pages=='bk-siswa' ? 'class=active' : ''}}><a class="nav-link"
                    href="{{route('bk.siswa')}}"><i class="fas fa-user-tie"></i>
                    <span>Siswa</span></a></li>
            <li {{$pages=='bk-walikelas' ? 'class=active' : ''}}><a class="nav-link"
                    href="{{$id->status=='Aktif' ?  route('bk.walikelas') : '#'}}"><i class="fas fa-chalkboard-teacher"></i>
                    <span>Wali Kelas</span></a></li>
            <li {{$pages=='bk-kelas' ? 'class=active' : ''}}><a class="nav-link"
                    href="{{$id->status=='Aktif' ?  route('bk.kelas') : '#'}}"><i class="fas fa-chalkboard"></i>
                    <span>Kelas</span></a></li>
            {{-- <li {{$pages=='bk-pengguna' ? 'class=active' : ''}}><a class="nav-link"
                    href="{{$id->status=='Aktif' ?  route('bk.pengguna') : '#'}}"><i class="fas fa-users-cog"></i>
                    <span>Pengguna</span></a></li> --}}


`       <li class="menu-header">Menu Utama</li>
            <li {{$pages=='bk-klasifikasijabatan' ? 'class=active' : ''}}><a class="nav-link"
                    href="{{$id->status=='Aktif' ?  route('bk.klasifikasijabatan') : '#'}}"><i class="fas fa-sort-alpha-up"></i>
                    <span>Klasifikasi Akademis dan Profesi</span></a></li></span></a></li>
            <li {{$pages=='bk-referensi' ? 'class=active' : ''}}><a class="nav-link"
                    href="{{$id->status=='Aktif' ?  route('bk.referensi') : '#'}}"><i class="far fa-file-alt"></i>
                    <span>Referensi Studi & Kerja</span></a></li>
            <li {{$pages=='bk-informasipsikologi' ? 'class=active' : ''}}><a class="nav-link"
                    href="{{$id->status=='Aktif' ?  route('bk.informasipsikologi') : '#'}}"><i class="fas fa-info-circle"></i>
                     <span>Buletin Psikologi</span></a></li>
            <li {{$pages=='bk-inputnilaipsikologi' ? 'class=active' : ''}}><a class="nav-link"
                    href="{{$id->status=='Aktif' ?  route('bk.inputnilaipsikologi') : '#'}}"><i class="fas fa-graduation-cap"></i>
                     <span>Nilai Siswa</span></a></li>

            <li {{$pages=='bk-inputminatbakat' ? 'class=active' : ''}}><a class="nav-link"
                    href="{{$id->status=='Aktif' ?  route('bk.inputminatbakat') : '#'}}"><i class="fas fa-quidditch"></i>
                    <span>Analisa Minat dan Bakat
            <li {{$pages=='bk-penjurusan' ? 'class=active' : ''}}><a class="nav-link"
                    href="{{$id->status=='Aktif' ?  route('bk.penjurusan') : '#'}}"><i class="fas fa-sitemap"></i>
                    <span>Analisa Penjurusan</span></a></li></span></a></li>



            <li class="menu-header">Catatan Siswa</li>
            <li {{$pages=='bk-catatankasussiswa' ? 'class=active' : ''}}><a class="nav-link"
                    href="{{$id->status=='Aktif' ?  route('bk.catatankasussiswa') : '#'}}"><i class="fas fa-clipboard"></i>
                    <span>Catatan Kasus Siswa</span></a></li>
            <li {{$pages=='bk-catatanpengembangandirisiswa' ? 'class=active' : ''}}><a class="nav-link"
                    href="{{$id->status=='Aktif' ?  route('bk.catatanpengembangandirisiswa') : '#'}}"><i class="fas fa-clipboard"></i>
                </i> <span>Catatan Pengembangan Diri Siswa</span></a></li>
            <li {{$pages=='bk-catatanprestasisiswa' ? 'class=active' : ''}}><a class="nav-link"
                    href="{{$id->status=='Aktif' ? route('bk.catatanprestasisiswa') : '#'}}"><i class="fas fa-clipboard"></i>
                     <span>Catatan Prestasi Siswa</span></a></li>


                @elseif((Auth::user()->tipeuser)=='yayasan')
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


                        @elseif((Auth::user()->tipeuser)=='siswa')
                        <li class="menu-header">Menu</li>
                        <li {{$pages=='dashboard' ? 'class=active' : ''}}><a class="nav-link" href="{{route('dashboard')}}"><i class="fas fa-diagnoses"></i> <span>Beranda</span></a></li>
                        <li {{$pages=='deteksi' ? 'class=active' : ''}}><a class="nav-link" href="{{route('siswa.hasilpsikologi.deteksi_lihat')}}"><i class="fas fa-diagnoses"></i> <span>Hasil Deteksi</span></a></li>
                        <li {{$pages=='sertifikat' ? 'class=active' : ''}}><a class="nav-link" href="{{route('siswa.hasilpsikologi.sertifikat_lihat')}}"><i class="fas fa-stamp"></i> <span>Sertifikat</span></a></li>

                        <li {{$pages=='sertifikat' ? 'class=active' : ''}}><a class="nav-link" href="{{route('siswa.catatankasus')}}"><i class="fas fa-stamp"></i> <span>Catatan Kasus siswa</span></a></li>

                        <li {{$pages=='sertifikat' ? 'class=active' : ''}}><a class="nav-link" href="{{route('siswa.catatanpengembangandiri')}}"><i class="fas fa-stamp"></i> <span>Catatan Pengembangan Diri Siswa</span></a></li>

                        <li {{$pages=='sertifikat' ? 'class=active' : ''}}><a class="nav-link" href="{{route('siswa.catatanprestasi')}}"><i class="fas fa-stamp"></i> <span>Catatan Prestasi Siswa</span></a></li>

                        <li {{$pages=='siswa-klasifikasijabatan' ? 'class=active' : ''}}><a class="nav-link"
                            href="{{route('siswa.klasifikasijabatan')}}"><i class="fas fa-sort-alpha-up"></i>
                            <span>Klasifikasi Akademis dan Profesi</span></a></li></span></a></li>
                         <li {{$pages=='siswa-referensi' ? 'class=active' : ''}}><a class="nav-link"
                            href="{{route('siswa.referensi')}}"><i class="far fa-file-alt"></i>
                            <span>Referensi Studi & Kerja</span></a></li>
                        <li {{$pages=='siswa-informasipsikologi' ? 'class=active' : ''}}><a class="nav-link"
                            href="{{route('siswa.informasipsikologi')}}"><i class="fas fa-info-circle"></i>
                            <span>Buletin Psikologi</span></a></li>
                    @else

            @endif
            @endif
        </ul>


    </aside>
</div>
