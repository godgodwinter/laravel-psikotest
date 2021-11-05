
            <div class="card">
                <div class="card-header">
                    <a href="{{route('sekolah.show',$id->id)}}"> <h4>Dashboard Sekolah</h4></a>
                </div>
                <div class="card-body">
                    <h5>Mastering</h5>
                  <ul class="nav nav-pills flex-column">
                      {{-- <li class="nav-item"><a href="{{route('sekolah.tahun',$id->id)}}" class="nav-link {{$pages=='tahun' ? 'active' : ''}} disabled">Tahun Ajaran</a></li>
                      <li class="nav-item"><a href="{{route('sekolah.semester',$id->id)}}" class="nav-link  {{$pages=='semester' ? 'active' : ''}}">Semester</a></li> --}}
                    <li class="nav-item"><a href="{{route('sekolah.siswa',$id->id)}}" class="nav-link  {{$pages=='siswa' ? 'active' : ''}}">Siswa</a></li>
                    <li class="nav-item"><a href="{{route('sekolah.walikelas',$id->id)}}" class="nav-link {{$pages=='walikelas' ? 'active' : ''}}">Wali kelas</a></li>
                    <li class="nav-item"><a href="{{route('sekolah.kelas',$id->id)}}" class="nav-link {{$pages=='kelas' ? 'active' : ''}}">Kelas</a></li>
                    <li class="nav-item"><a href="{{route('sekolah.pengguna',$id->id)}}" class="nav-link {{$pages=='pengguna' ? 'active' : ''}}">User / Pengguna</a></li>
                    {{-- <li class="nav-item"><a href="{{route('sekolah.referensi',$id->id)}}" class="nav-link {{$pages=='referensi' ? 'active' : ''}}">Referensi Psikologis</a></li> --}}
                    {{-- <li class="nav-item"><a href="{{route('sekolah.deteksi',$id->id)}}" class="nav-link">Deteksi Psikologis</a></li> --}}
                    {{-- <li class="nav-item"><a href="{{route('sekolah.masternilaipsikologi',$id->id)}}" class="nav-link {{$pages=='masternilaipsikologi' ? 'active' : ''}}">Master Nilai Psikologi</a></li> --}}
                    {{-- <li class="nav-item"><a href="#" class="nav-link {{$pages=='masternilaipsikologi' ? 'active' : ''}}">Informasi Psikologi</a></li> --}}
                    {{-- <li class="nav-item"><a href="{{route('sekolah.masternilaibidangstudi',$id->id)}}" class="nav-link {{$pages=='masternilaibidangstudi' ? 'active' : ''}}">Master Nilai Bidang Studi</a></li> --}}
                  </ul>
                  <br>
                  <h5>Proses</h5>
                  <ul class="nav nav-pills flex-column">
                    <li class="nav-item"><a href="{{route('sekolah.inputnilaipsikologi',$id->id)}}" class="nav-link  {{$pages=='inputnilaipsikologi' ? 'active' : ''}}">Input Nilai Siswa</a></li>
                    <li class="nav-item"><a href="{{route('sekolah.inputminatbakat',$id->id)}}" class="nav-link {{$pages=='inputminatbakat' ? 'active' : ''}}">Analisa Minat Dan Bakat</a></li>
                    <li class="nav-item"><a href="{{route('sekolah.penjurusan',$id->id)}}" class="nav-link {{$pages=='penjurusan' ? 'active' : ''}}">Analisa Penjurusan</a></li>
                    <li class="nav-item"><a href="{{route('sekolah.hasilpsikologi',$id->id)}}" class="nav-link {{$pages=='hasilpsikologi' ? 'active' : ''}}">Hasil Psikologi</a></li>
                    <li class="nav-item"><a href="{{route('sekolah.catatankasus',$id->id)}}" class="nav-link {{$pages=='catatankasus' ? 'active' : ''}}">Catatan Kasus Siswa</a></li>
                    <li class="nav-item"><a href="{{route('sekolah.catatanpengembangandiri',$id->id)}}" class="nav-link {{$pages=='catatanpengembangandiri' ? 'active' : ''}}">Catatan Pengembangan diri Siswa</a></li>
                    <li class="nav-item"><a href="{{route('sekolah.catatanprestasi',$id->id)}}" class="nav-link {{$pages=='catatanprestasi' ? 'active' : ''}}">Catatan Prestasi Siswa</a></li>
                    {{-- <li class="nav-item"><a href="#" class="nav-link">Grafik</a></li> --}}
                  </ul>
                </div>
              </div>
