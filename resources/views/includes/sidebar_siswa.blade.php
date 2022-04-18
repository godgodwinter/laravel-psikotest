<li class="menu-header">Menu</li>
<li {{ $pages == 'dashboard' ? 'class=active' : '' }}><a class="nav-link" href="{{ route('dashboard') }}"><i
            class="fas fa-home"></i> <span>Beranda</span></a></li>
<li {{ $pages == 'sertifikat' ? 'class=active' : '' }}><a class="nav-link"
            href="{{ route('siswa.hasilpsikologi.sertifikat_lihat') }}"><i class="far fa-star"></i>
            <span>Sertifikat Psikologi</span></a></li>
<li {{ $pages == 'penjelasan_faktorkepribadian' ? 'class=active' : '' }}><a class="nav-link"
            href="{{ route('siswa.hasilpsikologi.penjelasan_faktorkepribadian') }}"><i class="fas fa-info-circle"></i>
            <span>Terapis Karakter Positif</span></a></li>
<li {{ $pages == 'deteksi' ? 'class=active' : '' }}><a class="nav-link"
        href="{{ route('siswa.hasilpsikologi.deteksi_lihat') }}"><i class="fas fa-diagnoses"></i> <span>Hasil
            Deteksi Masalah</span></a></li>
<li {{ $pages == 'siswa-pemecahanmasalahdeteksi' ? 'class=active' : '' }}><a class="nav-link"
        href="{{ route('siswa.hasilpsikologi.pemecahanmasalahdeteksi') }}"><i class="fas fa-info-circle"></i>
            <span>Penanganan Deteksi Masalah</span></a></li>

<li {{ $pages == 'siswa-klasifikasijabatan' ? 'class=active' : '' }}><a class="nav-link"
        href="{{ route('siswa.klasifikasijabatan') }}"><i class="fas fa-sort-alpha-up"></i>
        <span>Klasifikasi Akademis dan Profesi</span></a></li></span></a></li>
<li {{ $pages == 'siswa-referensi' ? 'class=active' : '' }}><a class="nav-link"
        href="{{ route('siswa.referensi') }}"><i class="far fa-file-alt"></i>
        <span>Referensi Studi & Kerja</span></a></li>
<li {{ $pages == 'siswa-informasipsikologi' ? 'class=active' : '' }}><a class="nav-link"
        href="{{ route('siswa.informasipsikologi') }}"><i class="fas fa-info-circle"></i>
        <span>Buletin Psikologi</span></a></li>

<li {{ $pages == 'catatankasus' ? 'class=active' : '' }}><a class="nav-link"
        href="{{ route('siswa.catatankasus') }}"><i class="fas fa-clipboard"></i> <span>Catatan Kasus siswa</span></a> </li>

<li {{ $pages == 'catatanpengembangandirisiswa' ? 'class=active' : '' }}><a class="nav-link"
        href="{{ route('siswa.catatanpengembangandiri') }}"><i class="far fa-clipboard"></i> <span>Catatan
            Pengembangan Diri Siswa</span></a></li>

<li {{ $pages == 'catatanprestasisiswa' ? 'class=active' : '' }}><a class="nav-link"
        href="{{ route('siswa.catatanprestasi') }}"><i class="fas fa-book-reader"></i> <span>Catatan Prestasi Siswa</span></a></li>
