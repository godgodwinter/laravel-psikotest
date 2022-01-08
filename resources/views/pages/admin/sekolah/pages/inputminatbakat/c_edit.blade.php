


           <form id="setting-form" method="POST" action="{{route('sekolah.inputminatbakat.update',[$id->id,$data->id])}}">
            @method('put')
                @csrf
                <div class="card" id="settings-card">
                  <div class="card-header">
                    <h4>Wali kelas </h4>
                  </div>
                  <div class="card-body">

                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                    <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Nama</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('nama') is-invalid @enderror" name="nama"  disabled value="{{ $data->nama }}">

                          @error('nama')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>

                      @forelse ($master as $m)


                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">{{ $m->nama }}</label>
                        <div class="col-sm-6 col-md-9">
                            @php
                            $readonly='';
                                $isi='';
                                $periksadata=\App\Models\minatbakatdetail::where('siswa_id',$data->id)->where('sekolah_id',$id->id)->where('minatbakat_id',$m->id)->first();
                                // dd($periksadata);
                                if($periksadata!=null){
                                    $isi=$periksadata->nilai;
                                }
                                if($m->menukhusus!='bk'){
                                    $readonly='readonly';
                                }
                            @endphp
                          <input type="text" class="form-control  @error('nomerinduk') is-invalid @enderror" name="{{ $m->id }}" value="{{ $isi }}" {{$readonly}}>

                          @error('nomerinduk')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>
                      @empty

                      @endforelse

                      </div>

                    </div>

                  <div class="card-footer bg-whitesmoke text-md-right">
                    <button class="btn btn-primary" id="save-btn">Simpan</button>
                  </div>
                </div>
              </form>
