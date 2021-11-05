



           <form id="setting-form" method="POST" action="{{route('sekolah.catatankasus.update',[$id->id,$data->id])}}">
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

                      @error('siswa_id')<div class="invalid-feedback"> {{$message}}</div>
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
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Tanggal Kasus</label>
                    <div class="col-sm-6 col-md-9">
                        <div class="form-group">
                            <input type="date" class="form-control datepicker @error('tanggal')
                            is_invalid
                        @enderror" value="{{old('tanggal') ? old('tanggal') : $datas->tanggal}}" name="tanggal">
                            @error('tanggal')<div class="invalid-feedback"> {{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>


                  <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Kasus </label>
                    <div class="col-sm-6 col-md-9">

                      <input type="text" class="form-control  @error('kasus') is-invalid @enderror" name="kasus" required  value="{{old('kasus') ? old('kasus') : $datas->kasus}}">

                      @error('kasus')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror

                    </div>
                  </div>


                  <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Pengambilan Data </label>
                    <div class="col-sm-6 col-md-9">

                      <input type="text" class="form-control  @error('pengambilandata') is-invalid @enderror" name="pengambilandata" required  value="{{old('pengambilandata') ? old('pengambilandata') : $datas->pengambilandata}}">

                      @error('pengambilandata')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror

                    </div>
                  </div>


                  <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right"> Sumber Kasus </label>
                    <div class="col-sm-6 col-md-9">

                      <input type="text" class="form-control  @error('sumberkasus') is-invalid @enderror" name="sumberkasus" required  value="{{old('sumberkasus') ? old('sumberkasus') : $datas->sumberkasus}}">

                      @error('sumberkasus')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror

                    </div>
                  </div>


                  <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Golongan Kasus </label>
                    <div class="col-sm-6 col-md-9">

                      <input type="text" class="form-control  @error('golkasus') is-invalid @enderror" name="golkasus" required  value="{{old('golkasus') ? old('golkasus') : $datas->golkasus}}">

                      @error('golkasus')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror

                    </div>
                  </div>


                  <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Penyebab Timbul Kasus </label>
                    <div class="col-sm-6 col-md-9">

                      <input type="text" class="form-control  @error('penyebabtimbulkasus') is-invalid @enderror" name="penyebabtimbulkasus" required  value="{{old('penyebabtimbulkasus') ? old('penyebabtimbulkasus') : $datas->penyebabtimbulkasus}}">

                      @error('penyebabtimbulkasus')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror

                    </div>
                  </div>


                  <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Teknik Konseling </label>
                    <div class="col-sm-6 col-md-9">

                      <input type="text" class="form-control  @error('teknikkonseling') is-invalid @enderror" name="teknikkonseling" required  value="{{old('teknikkonseling') ? old('teknikkonseling') : $datas->teknikkonseling}}">

                      @error('teknikkonseling')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror

                    </div>
                  </div>


                  <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Keberhasilan Penangan Kasus </label>
                    <div class="col-sm-6 col-md-9">

                      <input type="text" class="form-control  @error('keberhasilanpenanganankasus') is-invalid @enderror" name="keberhasilanpenanganankasus" required  value="{{old('keberhasilanpenanganankasus') ? old('keberhasilanpenanganankasus') : $datas->keberhasilanpenanganankasus}}">

                      @error('keberhasilanpenanganankasus')<div class="invalid-feedback"> {{$message}}</div>
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
