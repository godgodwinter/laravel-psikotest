



           <form id="setting-form" method="POST" action="{{route('sekolah.catatanpengembangandiri.update',[$id->id,$data->id])}}">
            @method('put')
            @csrf
            <div class="card" id="settings-card">
              <div class="card-header">
                <h4>Edit </h4>
              </div>
              <div class="card-body">




                <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Siswa</label>
                    <div class="col-sm-6 col-md-9">

                        <select class="js-example-basic-single form-control-sm @error('siswa_id')
                            is-invalid
                        @enderror" name="siswa_id"  style="width: 75%" required>
                            <option value="{{$datas->siswa_id}}">{{$datas->siswa->nama}}</option>
                            <option disabled value=""> Pilih Siswa</option>
                            @foreach ($siswa as $t)
                                <option value="{{ $t->id }}"> {{ $t->nama }}</option>
                            @endforeach
                          </select>

                      @error('siswa_id')<div class="invalid-feedbac "> {{$message}}</div>
                      @enderror

                    </div>
                  </div>

                  <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Kelas</label>
                    <div class="col-sm-6 col-md-9">

                        <select class="js-example-basic-single form-control-sm @error('kelas_id')
                            is-invalid
                        @enderror" name="kelas_id"  style="width: 75%" required>
                            <option value="{{$datas->kelas_id}}">{{$datas->kelas->nama}}</option>
                            <option disabled  value=""> Pilih Kelas</option>
                            @foreach ($kelas as $k)
                                <option value="{{ $k->id }}"> {{ $k->nama }}</option>
                            @endforeach
                          </select>

                      @error('kelas_id')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror

                    </div>
                  </div>


                <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Tanggal
                        </label>
                    <div class="col-sm-6 col-md-9">
                        <div class="form-group">
                            <input type="date" class="form-control datepicker" value="{{old('tanggal') ? old('tanggal') : $datas->tanggal}}"
                            name="tanggal">
                        </div>
                    </div>
                </div>


                  <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Ide dan Imajinasi </label>
                    <div class="col-sm-6 col-md-9">

                      <input type="text" class="form-control  @error('idedanimajinasi') is-invalid @enderror" name="idedanimajinasi" required  value="{{old('idedanimajinasi') ? old('idedanimajinasi') : $datas->idedanimajinasi}}">

                      @error('idedanimajinasi')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror

                    </div>
                  </div>


                  <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Ketrampilan </label>
                    <div class="col-sm-6 col-md-9">

                      <input type="text" class="form-control  @error('ketrampilan') is-invalid @enderror" name="ketrampilan" required  value="{{old('ketrampilan')? old('ketrampilan') : $datas->ketrampilan}}">

                      @error('ketrampilan')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror

                    </div>
                  </div>


                  <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right"> Kreatif </label>
                    <div class="col-sm-6 col-md-9">

                      <input type="text" class="form-control  @error('kreatif') is-invalid @enderror" name="kreatif" required  value="{{old('kreatif')? old('kreatif') : $datas->kreatif}}">

                      @error('kreatif')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror

                    </div>
                  </div>


                  <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Organisasi </label>
                    <div class="col-sm-6 col-md-9">

                      <input type="text" class="form-control  @error('organisasi') is-invalid @enderror" name="organisasi" required  value="{{old('organisasi') ? old('organisasi') : $datas->organisasi}}">

                      @error('organisasi')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror

                    </div>
                  </div>


                  <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Kelanjutan Studi </label>
                    <div class="col-sm-6 col-md-9">

                      <input type="text" class="form-control  @error('kelanjutanstudi') is-invalid @enderror" name="kelanjutanstudi" required  value="{{old('kelanjutanstudi') ? old('kelanjutanstudi') : $datas->kelanjutanstudi}}">

                      @error('kelanjutanstudi')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror

                    </div>
                  </div>


                  <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Hobi </label>
                    <div class="col-sm-6 col-md-9">

                      <input type="text" class="form-control  @error('hobi') is-invalid @enderror" name="hobi" required  value="{{old('hobi') ? old('hobi') : $datas->hobi}}">

                      @error('hobi')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror

                    </div>
                  </div>


                  <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Cita - cita </label>
                    <div class="col-sm-6 col-md-9">

                      <input type="text" class="form-control  @error('citacita') is-invalid @enderror" name="citacita" required  value="{{old('citacita') ? old('citacita') : $datas->citacita}}">

                      @error('citacita')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror

                    </div>
                  </div>

                  <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Kemampuan Khusus </label>
                    <div class="col-sm-6 col-md-9">

                      <input type="text" class="form-control  @error('kemampuankhusus') is-invalid @enderror" name="kemampuankhusus" required  value="{{old('kemampuankhusus') ? old('kemampuankhusus') : $datas->kemampuankhusus}}">

                      @error('kemampuankhusus')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror

                    </div>
                  </div>

                  <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Keterangan </label>
                    <div class="col-sm-6 col-md-9">

                      <input type="text" class="form-control  @error('keterangan') is-invalid @enderror" name="keterangan" required  value="{{old('keterangan') ? old('keterangan') : $datas->keterangan}}">

                      @error('keterangan')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror

                    </div>
                  </div>




              <div class="card-footer bg-whitesmoke text-md-right">
                <button class="btn btn-primary" id="save-btn">Simpan</button>
              </div>
            </div>
          </form>

          <script type="text/javascript">
            $(document).ready(function() {

                // In your Javascript (external .js resource or <script> tag)
                    $(document).ready(function() {
                        $('.js-example-basic-single').select2({
                            // theme: "classic",
                            // allowClear: true,
                            width: "resolve"
                        });
                    });
            });
           </script>
