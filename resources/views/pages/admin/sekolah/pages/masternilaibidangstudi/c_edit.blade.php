



           <form id="setting-form" method="POST" action="{{route('sekolah.masternilaibidangstudi.update',[$id->id,$data->id])}}">
            @method('put')
            @csrf
            <div class="card" id="settings-card">
              <div class="card-header">
                <h4>Master Nilai Bidang Studi </h4>
              </div>
              <div class="card-body">

                <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Nama</label>
                    <div class="col-sm-6 col-md-9">

                      <input type="text" class="form-control  @error('nama') is-invalid @enderror" name="nama" required  value="{{old('nama') ? old('nama') : $data->nama}}">

                      @error('nama')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror

                    </div>
                  </div>
                <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Singkatan</label>
                    <div class="col-sm-6 col-md-9">

                      <input type="text" class="form-control  @error('singkatan') is-invalid @enderror" name="singkatan" required  value="{{old('singkatan') ? old('singkatan') : $data->singkatan}}">

                      @error('singkatan')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror

                    </div>
                  </div>

                  </div>




              <div class="card-footer bg-whitesmoke text-md-right">
                <button class="btn btn-primary" id="save-btn">Simpan</button>
              </div>
            </div>
          </form>

