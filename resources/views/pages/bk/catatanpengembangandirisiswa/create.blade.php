@extends('layouts.default')

@section('title')
Catatan Pengembangan Diri Siswa
@endsection

@push('before-script')

@if (session('status'))
<x-sweetalertsession tipe="{{session('tipe')}}" status="{{session('status')}}"/>
@endif
@endpush


@section('content')
<section class="section">
    <div class="section-header">
        <h1>@yield('title')</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{route('sekolah')}}">@yield('title')</a></div>
            <div class="breadcrumb-item">Tambah</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h5>Tambah</h5>
            </div>
            <div class="card-body">




                <form id="setting-form" method="POST" action="{{route('bk.catatanpengembangandirisiswa.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card" id="settings-card">

                      <div class="card-body">

                          <div class="form-group row align-items-center">
                            <label for="site-title" class="form-control-label col-sm-3 text-md-right">Siswa</label>
                            <div class="col-sm-6 col-md-9">

                                <select class="js-example-basic-single form-control-sm @error('siswa_id') is-invalid
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
                    </div>
                </div>
            </div>



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
                            <label for="site-title" class="form-control-label col-sm-3 text-md-right">Ide dan Imajinasi </label>
                            <div class="col-sm-6 col-md-9">

                              <input type="text" class="form-control  @error('idedanimajinasi') is-invalid @enderror" name="idedanimajinasi" required  value="{{old('idedanimajinasi')}}">

                              @error('idedanimajinasi')<div class="invalid-feedback"> {{$message}}</div>
                              @enderror

                            </div>
                          </div>


                          <div class="form-group row align-items-center">
                            <label for="site-title" class="form-control-label col-sm-3 text-md-right">Ketrampilan </label>
                            <div class="col-sm-6 col-md-9">

                              <input type="text" class="form-control  @error('ketrampilan') is-invalid @enderror" name="ketrampilan" required  value="{{old('ketrampilan')}}">

                              @error('ketrampilan')<div class="invalid-feedback"> {{$message}}</div>
                              @enderror

                            </div>
                          </div>


                          <div class="form-group row align-items-center">
                            <label for="site-title" class="form-control-label col-sm-3 text-md-right"> Kreatif </label>
                            <div class="col-sm-6 col-md-9">

                              <input type="text" class="form-control  @error('kreatif') is-invalid @enderror" name="kreatif" required  value="{{old('kreatif')}}">

                              @error('kreatif')<div class="invalid-feedback"> {{$message}}</div>
                              @enderror

                            </div>
                          </div>


                          <div class="form-group row align-items-center">
                            <label for="site-title" class="form-control-label col-sm-3 text-md-right">Organisasi </label>
                            <div class="col-sm-6 col-md-9">

                              <input type="text" class="form-control  @error('organisasi') is-invalid @enderror" name="organisasi" required  value="{{old('organisasi')}}">

                              @error('organisasi')<div class="invalid-feedback"> {{$message}}</div>
                              @enderror

                            </div>
                          </div>


                          <div class="form-group row align-items-center">
                            <label for="site-title" class="form-control-label col-sm-3 text-md-right">Kelanjutan Studi </label>
                            <div class="col-sm-6 col-md-9">

                              <input type="text" class="form-control  @error('kelanjutanstudi') is-invalid @enderror" name="kelanjutanstudi" required  value="{{old('kelanjutanstudi')}}">

                              @error('kelanjutanstudi')<div class="invalid-feedback"> {{$message}}</div>
                              @enderror

                            </div>
                          </div>


                          <div class="form-group row align-items-center">
                            <label for="site-title" class="form-control-label col-sm-3 text-md-right">Hobi </label>
                            <div class="col-sm-6 col-md-9">

                              <input type="text" class="form-control  @error('hobi') is-invalid @enderror" name="hobi" required  value="{{old('hobi')}}">

                              @error('hobi')<div class="invalid-feedback"> {{$message}}</div>
                              @enderror

                            </div>
                          </div>


                          <div class="form-group row align-items-center">
                            <label for="site-title" class="form-control-label col-sm-3 text-md-right">Cita - cita </label>
                            <div class="col-sm-6 col-md-9">

                              <input type="text" class="form-control  @error('citacita') is-invalid @enderror" name="citacita" required  value="{{old('citacita')}}">

                              @error('citacita')<div class="invalid-feedback"> {{$message}}</div>
                              @enderror

                            </div>
                          </div>

                          <div class="form-group row align-items-center">
                            <label for="site-title" class="form-control-label col-sm-3 text-md-right">Kemampuan Khusus </label>
                            <div class="col-sm-6 col-md-9">

                              <input type="text" class="form-control  @error('kemampuankhusus') is-invalid @enderror" name="kemampuankhusus" required  value="{{old('kemampuankhusus')}}">

                              @error('kemampuankhusus')<div class="invalid-feedback"> {{$message}}</div>
                              @enderror

                            </div>
                          </div>

                          <div class="form-group row align-items-center">
                            <label for="site-title" class="form-control-label col-sm-3 text-md-right">Keterangan </label>
                            <div class="col-sm-6 col-md-9">

                              <input type="text" class="form-control  @error('keterangan') is-invalid @enderror" name="keterangan" required  value="{{old('keterangan')}}">

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


            </div>
        </div>
    </div>
</section>
@endsection
