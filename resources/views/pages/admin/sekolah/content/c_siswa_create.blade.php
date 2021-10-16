


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
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Orang Tua</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Testing branch</a>
                      </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                    <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Nama2</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('nama') is-invalid @enderror" name="nama" required>

                          @error('nama')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">NISN</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('nomerinduk') is-invalid @enderror" name="nomerinduk" required>

                          @error('nomerinduk')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                        </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Jenis Kelamin</label>
                        <div class="col-sm-6 col-md-9">
  
                      <select name="jeniskelamin" class="form-control">
                        <option>Laki-laki</option>
                        <option>Perempuan</option>
                      </select>
                  
                      </div>
                      </div>
                      <div class="form-group row align-items-center">
                      <label for="site-title" class="form-control-label col-sm-3 text-md-right">Tempat Lahir</label>
                      <div class="col-sm-6 col-md-9">

                        <input type="text" class="form-control  @error('tempatlahir') is-invalid @enderror" name="tempatlahir" required>

                          @error('tempatlahir')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                      </div>
                      </div>
                      <div class="form-group row align-items-center">
                      <label for="site-title" class="form-control-label col-sm-3 text-md-right">Tanggal Lahir</label>
                      <div class="col-sm-6 col-md-9">
                      <div class="form-group">
                        <input type="date" class="form-control datepicker" name="tanggallahir">
                      </div>
                      </div>
                      </div>
                      <div class="form-group row align-items-center">
                      <label for="site-title" class="form-control-label col-sm-3 text-md-right">Usia</label>
                      <div class="col-sm-6 col-md-9">

                        <input type="text" class="form-control  @error('usia') is-invalid @enderror" name="usia" required>

                          @error('usia')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                      </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Kewarganegaraan</label>
                        <div class="col-sm-6 col-md-9">
  
                      <select name="warnanegara" class="form-control">
                        <option>WNI</option>
                        <option>WNA</option>
                      </select>
                  
                      </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Agama</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('agama') is-invalid @enderror" name="agama" required>

                          @error('agama')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                        </div>
                        <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Anak Ke</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('anak') is-invalid @enderror" name="anak" required>

                          @error('anak')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                        </div>
                        <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Jumlah Saudara Kandung</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('kandung') is-invalid @enderror" name="kandung" required>

                          @error('kandung')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                        </div>
                        <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Jumlah Saudara Angkat</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('angkat') is-invalid @enderror" name="angkat" required>

                          @error('angkat')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                        </div>
                        <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Jumlah Saudara Tiri</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('tiri') is-invalid @enderror" name="tiri" required>

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

                          <input type="text" class="form-control  @error('bahasa') is-invalid @enderror" name="bahasa" required>

                          @error('bahasa')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                        </div>
                      <div class="form-group row align-items-center">
                      <label for="site-title" class="form-control-label col-sm-3 text-md-right">No. Handphone</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('nohp') is-invalid @enderror" name="nohp" required>

                          @error('nohp')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror
                      </div>
                      </div>
                      <div class="form-group row align-items-center">
                      <label for="site-title" class="form-control-label col-sm-3 text-md-right">Tinggal Dengan</label>
                      <div class="col-sm-6 col-md-9">
                      <div class="selectgroup w-100">
                        <label class="selectgroup-item">
                          <input type="radio" name="tinggal" value="Orang Tua" class="selectgroup-input" checked="">
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

                          <input type="text" class="form-control  @error('jarak') is-invalid @enderror" name="jarak" required>

                          @error('jarak')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>
                      </div>
                      
                      <!-- --------- -->
                      
                      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        Sed sed metus vel lacus hendrerit tempus. Sed efficitur velit tortor, ac efficitur est lobortis quis. Nullam lacinia metus erat, sed fermentum justo rutrum ultrices. Proin quis iaculis tellus. Etiam ac vehicula eros, pharetra consectetur dui. Aliquam convallis neque eget tellus efficitur, eget maximus massa imperdiet. Morbi a mattis velit. Donec hendrerit venenatis justo, eget scelerisque tellus pharetra a.
                      </div>
                      <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        Vestibulum imperdiet odio sed neque ultricies, ut dapibus mi maximus. Proin ligula massa, gravida in lacinia efficitur, hendrerit eget mauris. Pellentesque fermentum, sem interdum molestie finibus, nulla diam varius leo, nec varius lectus elit id dolor. Nam malesuada orci non ornare vulputate. Ut ut sollicitudin magna. Vestibulum eget ligula ut ipsum venenatis ultrices. Proin bibendum bibendum augue ut luctus.
                      </div>
                    </div>

                  <div class="card-footer bg-whitesmoke text-md-right">
                    <button class="btn btn-primary" id="save-btn">Simpan</button>
                  </div>
                </div>
              </form>
