

           <form id="setting-form" method="POST" action="{{route('sekolah.catatanprestasi.store',$id->id)}}">
                @csrf
                <div class="card" id="settings-card">
                  <div class="card-header">
                    <h4>Tambah data </h4>
                  </div>
                  <div class="card-body">

                    <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Siswa</label>
                        <div class="col-sm-6 col-md-9">

                            <select class="js-example-basic-single form-control-sm @error('siswa_id')
                                is-invalid
                            @enderror" name="siswa_id"  style="width: 75%" required>
                            @if($request->siswa_id)
                                <option  selected value="{{$ambildata->id}}">{{$ambildata->nama}}</option>
                            @else
                            <option disabled selected value=""> Pilih Siswa</option>
                            @endif
                                @foreach ($siswa as $t)
                                    <option value="{{ $t->id }}"> {{ $t->nama }}</option>
                                @endforeach
                              </select>

                          @error('siswa_id')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>

                      {{-- <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Kelas</label>
                        <div class="col-sm-6 col-md-9">

                            <select class="js-example-basic-single form-control-sm @error('kelas_id')
                                is-invalid
                            @enderror" name="kelas_id"  style="width: 75%" required>
                                <option disabled selected value=""> Pilih Kelas</option>
                                @foreach ($kelas as $k)
                                    <option value="{{ $k->id }}"> {{ $k->nama }}</option>
                                @endforeach
                              </select>

                          @error('kelas_id')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div> --}}


                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Tanggal
                            </label>
                        <div class="col-sm-6 col-md-9">
                            <div class="form-group">
                                <input type="date" class="form-control datepicker" value="{{old('tanggal') ? old('tanggal') : date('Y-m-d')}}"
                                name="tanggal">
                            </div>
                        </div>
                    </div>


                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Prestasi </label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('prestasi') is-invalid @enderror" name="prestasi" required  value="{{old('prestasi')}}">

                          @error('prestasi')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>


                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Teknik Belajar </label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('teknikbelajar') is-invalid @enderror" name="teknikbelajar" required  value="{{old('teknikbelajar')}}">

                          @error('teknikbelajar')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>


                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right"> Sarana Belajar </label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('saranabelajar') is-invalid @enderror" name="saranabelajar" required  value="{{old('saranabelajar')}}">

                          @error('saranabelajar')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>


                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Penunjang Belajar </label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('penunjangbelajar') is-invalid @enderror" name="penunjangbelajar" required  value="{{old('penunjangbelajar')}}">

                          @error('penunjangbelajar')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>


                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Kesimpulan dan Saran </label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('kesimpulandansaran') is-invalid @enderror" name="kesimpulandansaran" required  value="{{old('kesimpulandansaran')}}">

                          @error('kesimpulandansaran')<div class="invalid-feedback"> {{$message}}</div>
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
