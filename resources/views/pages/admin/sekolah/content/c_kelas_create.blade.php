



           <form id="setting-form" method="POST" action="{{route('sekolah.kelas.store',$id->id)}}">
                @csrf
                <div class="card" id="settings-card">
                  <div class="card-header">
                    <h4>Kelas </h4>
                  </div>
                  <div class="card-body">

                    <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Nama Kelas</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('nama') is-invalid @enderror" name="nama" required>

                          @error('nama')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Tipe Kelas</label>
                        <div class="col-sm-6 col-md-9">




                            <select class="form-control" name="tipe"  srequired>
                                <option disabled selected> Pilih Tipe</option>
                                <option>Umum</option>
                                <option>Khusus</option>

                              </select>

                          @error('walikelas_id')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Wali Kelas</label>
                        <div class="col-sm-6 col-md-9">




                            <select class="js-example-basic-single form-control-sm" name="walikelas_id"  style="width: 75%" required>
                                <option disabled selected> Pilih Walikelas</option>
                                @foreach ($walikelas as $t)
                                    <option value="{{ $t->nomerinduk }}" > {{ $t->nama }}</option>
                                @endforeach
                              </select>

                          @error('walikelas_id')<div class="invalid-feedback"> {{$message}}</div>
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
