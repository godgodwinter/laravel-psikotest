



           <form id="setting-form" method="POST" action="{{route('sekolah.hasilpsikologi.update',[$id->id,$data->id])}}">
            @method('put')
            @csrf
            <div class="card" id="settings-card">
              <div class="card-header">
                <h4>Edit </h4>
              </div>
              <div class="card-body">



                <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Wali Kelas</label>
                    <div class="col-sm-6 col-md-9">

                        <select class="js-example-basic-single form-control-sm @error('siswa_id')
                            is-invalid
                        @enderror" name="siswa_id"  style="width: 75%" required readonly>
                            {{-- <option disabled  value=""> Pilih siswa</option> --}}
                            @php
                                if(old('nilai'!=null)){

                                }else{
                            @endphp
                                <option value="{{ $data->siswa_id }}" selected> {{ $data->siswa->nama }}</option>
                            @php

                                }
                            @endphp
                            {{-- @foreach ($siswa as $t)
                                <option value="{{ $t->id }}"> {{ $t->nama }}</option>
                            @endforeach --}}
                          </select>

                      @error('siswa_id')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror

                    </div>
                  </div>

                <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Hasil Deteksi</label>
                    <div class="col-sm-6 col-md-9">

                      <input type="number" class="form-control  @error('nilai') is-invalid @enderror" name="nilai" required  value="{{old('nilai')!=null?old('nilai'):$data->nilai}}" min="0">

                      @error('nilai')<div class="invalid-feedback"> {{$message}}</div>
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
