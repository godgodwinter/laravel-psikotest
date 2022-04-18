
            <div class="card">
                <div class="card-header">
                    <a href="{{route('sekolah.show',$id->id)}}"> <h4>Dashboard Sekolah</h4></a>
                </div>
                <div class="card-body">
                    <h5>Menu</h5>
                  <ul class="nav nav-pills flex-column">
                    <li class="nav-item"><a href="{{route('yayasan.sekolah.siswa',$id->id)}}" class="nav-link  {{$pages=='siswa' ? 'active' : ''}}">Siswa</a></li>
                  </ul>
                  <br>
                  <h5>Hasil Penilaian</h5>
                  <ul class="nav nav-pills flex-column">
                    <li class="nav-item"><a href="{{route('yayasan.sekolah.hasilpsikologi',$id->id)}}" class="nav-link {{$pages=='hasilpsikologi' ? 'active' : ''}}">Hasil Psikologi</a></li>
                    <li class="nav-item"><a href="{{route('yayasan.sekolah.inputnilaipsikologi',$id->id)}}" class="nav-link  {{$pages=='inputnilaipsikologi' ? 'active' : ''}}"> Nilai Psikologi Siswa</a></li>
                    <li class="nav-item"><a href="{{route('yayasan.sekolah.inputminatbakat',$id->id)}}" class="nav-link {{$pages=='inputminatbakat' ? 'active' : ''}}">Analisa Minat Dan Bakat</a></li>
                    <li class="nav-item"><a href="{{route('yayasan.sekolah.penjurusan',$id->id)}}" class="nav-link {{$pages=='penjurusan' ? 'active' : ''}}">Analisa Penjurusan</a></li>
                    <li class="nav-item"><a href="{{route('yayasan.sekolah.catatankasus',$id->id)}}" class="nav-link {{$pages=='catatankasus' ? 'active' : ''}}">Catatan Kasus Siswa</a></li>
                    <li class="nav-item"><a href="{{route('yayasan.sekolah.catatanpengembangandiri',$id->id)}}" class="nav-link {{$pages=='catatanpengembangandiri' ? 'active' : ''}}">Catatan Pengembangan diri Siswa</a></li>
                    <li class="nav-item"><a href="{{route('yayasan.sekolah.catatanprestasi',$id->id)}}" class="nav-link {{$pages=='catatanprestasi' ? 'active' : ''}}">Catatan Prestasi Siswa</a></li>
                    {{-- <li class="nav-item"><a href="#" class="nav-link">Grafik</a></li> --}}
                  </ul>
                </div>
              </div>
