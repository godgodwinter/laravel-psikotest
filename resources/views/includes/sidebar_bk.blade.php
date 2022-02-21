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
<li {{$pages=='bk-gurubk' ? 'class=active' : ''}}><a class="nav-link"
         href="{{$id->status=='Aktif' ?  route('bk.gurubk') : '#'}}"><i class="fas fa-chalkboard-teacher"></i>
        <span>Guru BK</span></a></li>
<li {{$pages=='bk-kelas' ? 'class=active' : ''}}><a class="nav-link"
        href="{{$id->status=='Aktif' ?  route('bk.kelas') : '#'}}"><i class="fas fa-chalkboard"></i>
        <span>Kelas</span></a></li>
{{-- <li {{$pages=='bk-pengguna' ? 'class=active' : ''}}><a class="nav-link"
        href="{{$id->status=='Aktif' ?  route('bk.pengguna') : '#'}}"><i class="fas fa-users-cog"></i>
        <span>Pengguna</span></a></li> --}}
       <li class="menu-header">Menu Utama</li>
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
<li {{$pages=='bk-hasilpsikologi' ? 'class=active' : ''}}><a class="nav-link"
        href="{{$id->status=='Aktif' ?  route('bk.hasilpsikologi') : '#'}}"><i class="fas fa-sitemap"></i>
        <span>Hasil Psikologi</span></a></li></span></a></li>
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
