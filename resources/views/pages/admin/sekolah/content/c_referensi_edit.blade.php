



           <form id="setting-form" method="POST" action="{{route('sekolah.referensi.update',[$id->id,$data->id])}}" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="card" id="settings-card">
              <div class="card-header">
                <h4>referensi </h4>
              </div>
              <div class="card-body">

                <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Judul </label>
                    <div class="col-sm-6 col-md-9">

                      <input type="text" class="form-control  @error('nama') is-invalid @enderror" name="nama" required  value="{{old('nama') ? old('nama') : $data->nama}}">
                     

                      @error('nama')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror

                    </div>
                  </div>
                  <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Tipe </label>
                    <div class="col-sm-6 col-md-9">




                        <select class="form-control @error('file') is-invalid @enderror @error('link') is-invalid @enderror" name="tipe"  required id="tipeselect">
                            <option disabled selected value=""> Pilih Tipe</option>
                            @if (old('tipe'))
                                 <option selected>{{old('tipe')}}</option>
                            @else
                                <option selected>{{$data->tipe}}</option>
                            @endif
                            <option>Link</option>
                            <option>Upload</option>

                          </select>

                          @error('link')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror
                          @error('file')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                    </div>
                  </div>

                  <script>
                    $(document).ready(function () {
                        var inputan=$('#inputan');
                        var tipe=$('#tipe');
                        var tipeselect=$('#tipeselect');
                        var inputanklink=`
                            <label for="site-title" class="form-control-label col-sm-3 text-md-right">Link </label>
                            <div class="col-sm-6 col-md-9">
                                <input type="text" name="link" id="link" class="form-control @error('link') is-invalid @enderror" value="{{old('link') ? old('link') : $data->link}}" required>
                                @error('link')<div class="invalid-feedback"> {{$message}}</div>
                                @enderror
                            </div>

                            `;
                            var inputanupload=`


                            <label for="site-title" class="form-control-label col-sm-3 text-md-right">Pilih File </label>
                            <div class="col-sm-6 col-md-9">
                                <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" >
                                @error('file')<div class="invalid-feedback"> {{$message}}</div>
                                @enderror
                                </div>
                            `;
                            @if ($data->tipe=='Link')
                                 inputan.html(inputanklink);
                            @else
                                inputan.html(inputanupload);
                            @endif

                            tipeselect.change(function(e) {
                            if (tipeselect.val()=='Link'){
                                inputan.html(inputanklink);
                            }else{
                                inputan.html(inputanupload);
                            }
                        });


                    });
                </script>

                <div class="form-group row align-items-center" id="inputan">

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
