


           <form id="setting-form" method="POST" action="{{route('sekolah.siswa.store',$id->id)}}">
                @csrf
                <div class="card" id="settings-card">
                  <div class="card-header">
                    <h4>Siswa </h4>
                  </div>
                  <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Identitas Pribadi2</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="kesehatan-tab" data-toggle="tab" href="#kesehatan" role="tab" aria-controls="kesehatan" aria-selected="false">Kesehatan</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="pendidikan-tab" data-toggle="tab" href="#pendidikan" role="tab" aria-controls="pendidikan" aria-selected="false">Pendidikan</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="orangtua-tab" data-toggle="tab" href="#orangtua" role="tab" aria-controls="orangtua" aria-selected="false">Orang Tua / Wali</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="lainlain-tab" data-toggle="tab" href="#lainlain" role="tab" aria-controls="lainlain" aria-selected="false">Lain-lain</a>
                      </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                    <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Nama Lengkap</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('nama') is-invalid @enderror" value="{{old('nama')}}" required>

                          @error('nama')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">NISN</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('nomerinduk') is-invalid @enderror" value="{{old('nomerinduk')}}" required>

                          @error('nomerinduk')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                        </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Jenis Kelamin</label>
                        <div class="col-sm-6 col-md-9">

                      <select name="jeniskelamin" class="form-control @error('jeniskelamin')
                          is_invalid
                      @enderror">
                        <option>Laki-laki</option>
                        <option>Perempuan</option>
                      </select>
                      @error('nomerinduk')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror

                      </div>
                      </div>
                      <div class="form-group row align-items-center">
                      <label for="site-title" class="form-control-label col-sm-3 text-md-right">Tempat Lahir</label>
                      <div class="col-sm-6 col-md-9">

                        <input type="text" class="form-control  @error('tempatlahir') is-invalid @enderror" value="{{old('tempatlahir')}}" >

                          @error('tempatlahir')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                      </div>
                      </div>
                      <div class="form-group row align-items-center">
                      <label for="site-title" class="form-control-label col-sm-3 text-md-right">Tanggal Lahir</label>
                      <div class="col-sm-6 col-md-9">
                      <div class="form-group">
                        <input type="date" class="form-control datepicker @error('tanggallahir')
                            is_invalid
                        @enderror" value="{{old('tanggallahir')}}">
                        @error('tanggallahir')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                      </div>
                      </div>
                      </div>
                      <div class="form-group row align-items-center">
                      <label for="site-title" class="form-control-label col-sm-3 text-md-right">Usia</label>
                      <div class="col-sm-6 col-md-9">

                        <input type="text" class="form-control  @error('usia') is-invalid @enderror" value="{{old('usia')}}" >

                          @error('usia')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                      </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Kewarganegaraan</label>
                        <div class="col-sm-6 col-md-9">

  
                      <select name="warganegara" class="form-control @error('warganegara')
                          is_invalid
                      @enderror">
                        <option>WNI</option>
                        <option>WNA</option>
                      </select>
                      @error('warnanegara')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror

                      </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Agama</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('agama') is-invalid @enderror" value="{{old('agama')}}" >

                          @error('agama')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                        </div>
                        <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Anak Ke</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('anak') is-invalid @enderror" value="{{old('anak')}}" >

                          @error('anak')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                        </div>
                        <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Jumlah Saudara Kandung</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('kandung') is-invalid @enderror" value="{{old('kandung')}}" >

                          @error('kandung')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                        </div>
                        <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Jumlah Saudara Angkat</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('angkat') is-invalid @enderror" value="{{old('angkat')}}" >

                          @error('angkat')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                        </div>
                        <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Jumlah Saudara Tiri</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('tiri') is-invalid @enderror" value="{{old('tiri')}}" >

                          @error('tiri')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                        </div>
                      <div class="form-group row align-items-center">
                      <label for="site-title" class="form-control-label col-sm-3 text-md-right">Status Anak</label>
                      <div class="col-sm-6 col-md-9">
                      <div class="selectgroup w-100">
                        <label class="selectgroup-item">
                          <input type="radio" name="statusanak" value="Yatim" class="selectgroup-input" checked="">
                          <span class="selectgroup-button">Yatim</span>
                        </label>
                        <label class="selectgroup-item">
                          <input type="radio" name="statusanak" value="Piatu" class="selectgroup-input">
                          <span class="selectgroup-button">Piatu</span>
                        </label>
                        <label class="selectgroup-item">
                          <input type="radio" name="statusanak" value="Yatim Piatu" class="selectgroup-input">
                          <span class="selectgroup-button">Yatim Piatu</span>
                        </label>
                        <label class="selectgroup-item">
                          <input type="radio" name="statusanak" value="Lengkap" class="selectgroup-input">
                          <span class="selectgroup-button">Lengkap</span>
                        </label>
                      </div>
                      </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Bahasa Sehari-Hari Dirumah</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('bahasa') is-invalid @enderror" value="{{old('bahasa')}}" >

                          @error('bahasa')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                        </div>
                      <div class="form-group row align-items-center">
                      <label for="site-title" class="form-control-label col-sm-3 text-md-right">No. Handphone</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('nohp') is-invalid @enderror" value="{{old('nohp')}}" >

                          @error('nohp')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror
                      </div>
                      </div>
                      <div class="form-group row align-items-center">
                      <label for="site-title" class="form-control-label col-sm-3 text-md-right">Tinggal Dengan</label>
                      <div class="col-sm-6 col-md-9">
                      <div class="selectgroup w-100">
                        <label class="selectgroup-item">
                          <input type="radio" name="tinggal" value="ortu" class="selectgroup-input" checked="">
                          <span class="selectgroup-button">Orang Tua</span>
                        </label>
                        <label class="selectgroup-item">
                          <input type="radio" name="tinggal" value="Saudara" class="selectgroup-input">
                          <span class="selectgroup-button">Saudara</span>
                        </label>
                        <label class="selectgroup-item">
                          <input type="radio" name="tinggal" value="asrama" class="selectgroup-input">
                          <span class="selectgroup-button">Asrama/Kost</span>
                        </label>
                      </div>
                      </div>
                      </div>
                      <div class="form-group row align-items-center">
                      <label for="site-title" class="form-control-label col-sm-3 text-md-right">Jarak Ke Sekolah</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('jarak') is-invalid @enderror" value="{{old('jarak')}}" >

                          @error('jarak')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>
                      </div>

                      <!-- --------- -->

                      <div class="tab-pane fade" id="kesehatan" role="tabpanel" aria-labelledby="kesehatan-tab">
                      <div class="form-group row align-items-center">
                      <label for="site-title" class="form-control-label col-sm-3 text-md-right">Golongan Darah</label>
                      <div class="col-sm-6 col-md-9">
                      <div class="selectgroup w-100">
                        <label class="selectgroup-item">
                          <input type="radio" name="goldar" value="A" class="selectgroup-input" checked="">
                          <span class="selectgroup-button">A</span>
                        </label>
                        <label class="selectgroup-item">
                          <input type="radio" name="goldar" value="B" class="selectgroup-input">
                          <span class="selectgroup-button">B</span>
                        </label>
                        <label class="selectgroup-item">
                          <input type="radio" name="goldar" value="AB" class="selectgroup-input">
                          <span class="selectgroup-button">AB</span>
                        </label>
                        <label class="selectgroup-item">
                          <input type="radio" name="goldar" value="O" class="selectgroup-input">
                          <span class="selectgroup-button">O</span>
                        </label>
                      </div>
                      </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Kelainan Jasmani</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('kelainan') is-invalid @enderror" value="{{old('kelainan')}}" >

                          @error('kelainan')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Tinggi Badan</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('tinggibadan') is-invalid @enderror" value="{{old('tinggibadan')}}" >

                          @error('tinggibadan')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Berat Badan</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('beratbadan') is-invalid @enderror" value="{{old('beratbadan')}}" >

                          @error('beratbadan')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>
                      </div>

                    <!-- ---------- -->
                    <div class="tab-pane fade" id="pendidikan" role="tabpanel" aria-labelledby="pendidikan-tab">
                    <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Tamatan Dari</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('tamatan') is-invalid @enderror" value="{{old('tamatan')}}" >

                          @error('tamatan')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Nomor Ijazah</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('ijazah') is-invalid @enderror" value="{{old('ijazah')}}" >

                          @error('ijazah')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Lama Belajar</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('lamabelajar') is-invalid @enderror" value="{{old('lamabelajar')}}" >

                          @error('lamabelajar')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Pindahan dari Sekolah</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('pindahan') is-invalid @enderror" value="{{old('pindahan')}}" >

                          @error('pindahan')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Alasan</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('alasan') is-invalid @enderror" value="{{old('alasan')}}" >

                          @error('alasan')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>
                    </div>
                      <!-- --------------- -->

                      <div class="tab-pane fade" id="orangtua" role="tabpanel" aria-labelledby="orangtua-tab">
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Nama Ayah Kandung</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('namaayah') is-invalid @enderror" value="{{old('namaayah')}}" >

                          @error('namaayah')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Tempat Lahir Ayah</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('tempatayah') is-invalid @enderror" value="{{old('tempatayah')}}" >

                          @error('tempatayah')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                      <label for="site-title" class="form-control-label col-sm-3 text-md-right">Tanggal Lahir Ayah</label>
                      <div class="col-sm-6 col-md-9">
                      <div class="form-group">
                        <input type="date" class="form-control datepicker" value="{{old('tanggallahirayah')}}">
                      </div>
                      </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Agama Ayah</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('agamaayah') is-invalid @enderror" value="{{old('agamaayah')}}" >

                          @error('agamaayah')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Kewarganegaraan Ayah</label>
                        <div class="col-sm-6 col-md-9">

                        <select name="wargaanegaraayah" class="form-control @error('warganegaraayah')
                          is_invalid
                      @enderror">
                        <option>WNI</option>
                        <option>WNA</option>
                      </select>

                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Pendidikan Ayah</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('pendidikanayah') is-invalid @enderror" value="{{old('pendidikanayah')}}" >

                          @error('pendidikanayah')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Pekerjaan Ayah</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('pekerjaanayah') is-invalid @enderror" value="{{old('pekerjaanayah')}}" >

                          @error('pekerjaanayah')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Penghasilan Ayah</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('penghasilanayah') is-invalid @enderror" value="{{old('penghasilanayah')}}" >

                          @error('penghasilanayah')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Alamat Ayah</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('alamatayah') is-invalid @enderror" value="{{old('alamatayah')}}" >

                          @error('alamatayah')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">No. HP Ayah</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('nomorayah') is-invalid @enderror" value="{{old('nomorayah')}}" >

                          @error('nomorayah')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Status Ayah</label>
                        <div class="col-sm-6 col-md-9">

                        <select name="statusayah" class="form-control">
                        <option>Masih Hidup</option>
                        <option>Meninggal Dunia</option>
                        </select>

                        </div>
                      </div>

                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Nama Ibu Kandung</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('namaibu') is-invalid @enderror" value="{{old('namaibu')}}" >

                          @error('namaibu')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Tempat Lahir Ibu</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('tempatibu') is-invalid @enderror" value="{{old('tempatibu')}}" >

                          @error('tempatibu')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                      <label for="site-title" class="form-control-label col-sm-3 text-md-right">Tanggal Lahir Ibu</label>
                      <div class="col-sm-6 col-md-9">
                      <div class="form-group">
                        <input type="date" class="form-control datepicker" value="{{old('tanggallahiribu')}}">
                      </div>
                      </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Agama Ibu</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('agamaibu') is-invalid @enderror" value="{{old('agamaibu')}}" >

                          @error('agamaibu')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Kewarganegaraan Ibu</label>
                        <div class="col-sm-6 col-md-9">

                        <select name="warganegaraibu" class="form-control @error('warganegaraibu')
                          is_invalid
                      @enderror">
                        <option>WNI</option>
                        <option>WNA</option>
                      </select>

                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Pendidikan Ibu</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('pendidikanibu') is-invalid @enderror" value="{{old('pendidikanibu')}}" >

                          @error('pendidikanibu')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Pekerjaan Ibu</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('pekerjaanibu') is-invalid @enderror" value="{{old('pekerjaanibu')}}" >

                          @error('pekerjaanibu')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Penghasilan Ibu</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('penghasilanibu') is-invalid @enderror" value="{{old('penghasilanibu')}}" >

                          @error('penghasilanibu')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Alamat Ibu</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('alamatibu') is-invalid @enderror" value="{{old('alamatibu')}}" >

                          @error('alamatibu')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">No. HP Ibu</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('nomoribu') is-invalid @enderror" value="{{old('nomoribu')}}" >

                          @error('nomoribu')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Status Ibu</label>
                        <div class="col-sm-6 col-md-9">

                        <select name="statusibu" class="form-control">
                        <option>Masih Hidup</option>
                        <option>Meninggal Dunia</option>
                        </select>

                        </div>
                        </div>

                        <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Nama Wali</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('namawali') is-invalid @enderror" value="{{old('namawali')}}" >

                          @error('namawali')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                        </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Tempat Lahir Wali</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('tempatwali') is-invalid @enderror" value="{{old('tempatwali')}}" >

                          @error('tempatwali')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                      <label for="site-title" class="form-control-label col-sm-3 text-md-right">Tanggal Lahir Wali</label>
                      <div class="col-sm-6 col-md-9">
                      <div class="form-group">
                        <input type="date" class="form-control datepicker" value="{{old('tanggallahirwali')}}">
                      </div>
                      </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Agama Wali</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('agamawali') is-invalid @enderror" value="{{old('agamawali')}}" >

                          @error('agamawali')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Kewarganegaraan Wali</label>
                        <div class="col-sm-6 col-md-9">

                        <select name="warganegarawali" class="form-control @error('warganegarawali')
                          is_invalid
                      @enderror">
                        <option>WNI</option>
                        <option>WNA</option>
                      </select>

                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Pendidikan Wali</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('pendidikanwali') is-invalid @enderror" value="{{old('pendidikanwali')}}" >

                          @error('pendidikanwali')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Pekerjaan Wali</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('pekerjaanwali') is-invalid @enderror" value="{{old('pekerjaanwali')}}" >

                          @error('pekerjaanwali')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Penghasilan Wali</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('penghasilanwali') is-invalid @enderror" value="{{old('penghasilanwali')}}" >

                          @error('penghasilanwali')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Alamat Wali</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('alamatwali') is-invalid @enderror" value="{{old('alamatwali')}}" >

                          @error('alamatwali')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">No. HP Wali</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('nomorwali') is-invalid @enderror" value="{{old('nomorwali')}}" >

                          @error('nomorwali')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Status Wali</label>
                        <div class="col-sm-6 col-md-9">

                        <select name="statuswali" class="form-control">
                        <option>Masih Hidup</option>
                        <option>Meninggal Dunia</option>
                        </select>

                        </div>
                        </div>


                      </div>

                        <!-- ---------- -->
                      <div class="tab-pane fade" id="lainlain" role="tabpanel" aria-labelledby="lainlain-tab">
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Hobi</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('hobi') is-invalid @enderror" value="{{old('hobi')}}" >

                          @error('hobi')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                        </div>
                        <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Kemasyarakatan / Organisasi</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('organisasi') is-invalid @enderror" value="{{old('organisasi')}}" >

                          @error('organisasi')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                        </div>
                        <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Setelah Lulus Akan Ke</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('setelahlulus') is-invalid @enderror" value="{{old('setelahlulus')}}" >

                          @error('setelahlulus')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                        </div>

                      </div>
                    </div>

                    <!-- ----------- -->
                  <div class="card-footer bg-whitesmoke text-md-right">
                    <button class="btn btn-primary" id="save-btn">Simpan</button>
                  </div>
                </div>
              </form>
