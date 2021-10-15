
            <form id="setting-form" method="POST" action="{{route('sekolah.semester.update',[$id->id,$data->id])}}">
                @method('put')
                @csrf
                <div class="card" id="settings-card">
                  <div class="card-header">
                    <h4>Semester </h4>
                  </div>
                  <div class="card-body">
                    <div class="form-group row align-items-center">
                      <label for="site-title" class="form-control-label col-sm-3 text-md-right">Pilih semester</label>
                      <div class="col-sm-6 col-md-9">
                        <select class="form-control  @error('nama') is-invalid @enderror" name="nama" required>
                          <option >  {{old('nama') ? old('nama') : $data->nama}}</option>
                            <option>1</option>
                            <option>2</option>
                        </select> 
                        @error('nama')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                      </div>
                    </div>

                  </div>
                  <div class="card-footer bg-whitesmoke text-md-right">
                    <button class="btn btn-primary" id="save-btn">Simpan</button>
                  </div>
                </div>
              </form>
