@extends('layouts.default')

@section('title')
Catatan Kasus Siswa
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




                <form id="setting-form" method="POST" action="{{route('bk.catatankasussiswa.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card" id="settings-card">

                      <div class="card-body">

                          <div class="form-group row align-items-center">
                            <label for="site-title" class="form-control-label col-sm-3 text-md-right">Siswa</label>
                            <div class="col-sm-6 col-md-9">

                                <select class="js-example-basic-single form-control-sm @error('siswa_id')
                                    is-invalid
                                @enderror" name="siswa_id"  style="width: 75%" required>
                                    <option disabled selected value=""> Pilih Siswa</option>
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
                                    <option disabled selected value=""> Pilih Kelas</option>
                                    @foreach ($kelas as $k)
                                        <option value="{{ $k->id }}"> {{ $k->nama }}</option>
                                    @endforeach
                                  </select>

                              @error('kelas_id')<div class="invalid-feedback"> {{$message}}</div>
                              @enderror

                            </div>
                          </div>


                          <div class="form-group row align-items-center">
                            <label for="site-title" class="form-control-label col-sm-3 text-md-right">Tanggal Kasus
                                </label>
                            <div class="col-sm-6 col-md-9">
                                <div class="form-group">
                                    <input type="date" class="form-control datepicker" value="{{old('tanggal')}}"
                                    name="tanggal">
                                </div>
                            </div>
                        </div>


                          <div class="form-group row align-items-center">
                            <label for="site-title" class="form-control-label col-sm-3 text-md-right">Kasus </label>
                            <div class="col-sm-6 col-md-9">

                              <input type="text" class="form-control  @error('kasus') is-invalid @enderror" name="kasus" required  value="{{old('kasus')}}">

                              @error('kasus')<div class="invalid-feedback"> {{$message}}</div>
                              @enderror

                            </div>
                          </div>


                          <div class="form-group row align-items-center">
                            <label for="site-title" class="form-control-label col-sm-3 text-md-right">Pengambilan Data </label>
                            <div class="col-sm-6 col-md-9">

                              <input type="text" class="form-control  @error('pengambilandata') is-invalid @enderror" name="pengambilandata" required  value="{{old('pengambilandata')}}">

                              @error('pengambilandata')<div class="invalid-feedback"> {{$message}}</div>
                              @enderror

                            </div>
                          </div>


                          <div class="form-group row align-items-center">
                            <label for="site-title" class="form-control-label col-sm-3 text-md-right"> Sumber Kasus </label>
                            <div class="col-sm-6 col-md-9">

                              <input type="text" class="form-control  @error('sumberkasus') is-invalid @enderror" name="sumberkasus" required  value="{{old('sumberkasus')}}">

                              @error('sumberkasus')<div class="invalid-feedback"> {{$message}}</div>
                              @enderror

                            </div>
                          </div>


                          <div class="form-group row align-items-center">
                            <label for="site-title" class="form-control-label col-sm-3 text-md-right">Golongan Kasus </label>
                            <div class="col-sm-6 col-md-9">

                              <input type="text" class="form-control  @error('golkasus') is-invalid @enderror" name="golkasus" required  value="{{old('golkasus')}}">

                              @error('golkasus')<div class="invalid-feedback"> {{$message}}</div>
                              @enderror

                            </div>
                          </div>


                          <div class="form-group row align-items-center">
                            <label for="site-title" class="form-control-label col-sm-3 text-md-right">Penyebab Timbul Kasus </label>
                            <div class="col-sm-6 col-md-9">

                              <input type="text" class="form-control  @error('penyebabtimbulkasus') is-invalid @enderror" name="penyebabtimbulkasus" required  value="{{old('penyebabtimbulkasus')}}">

                              @error('penyebabtimbulkasus')<div class="invalid-feedback"> {{$message}}</div>
                              @enderror

                            </div>
                          </div>


                          <div class="form-group row align-items-center">
                            <label for="site-title" class="form-control-label col-sm-3 text-md-right">Teknik Konseling </label>
                            <div class="col-sm-6 col-md-9">

                              <input type="text" class="form-control  @error('teknikkonseling') is-invalid @enderror" name="teknikkonseling" required  value="{{old('teknikkonseling')}}">

                              @error('teknikkonseling')<div class="invalid-feedback"> {{$message}}</div>
                              @enderror

                            </div>
                          </div>


                          <div class="form-group row align-items-center">
                            <label for="site-title" class="form-control-label col-sm-3 text-md-right">Keberhasilan Penangan Kasus </label>
                            <div class="col-sm-6 col-md-9">

                              <input type="text" class="form-control  @error('keberhasilanpenanganankasus') is-invalid @enderror" name="keberhasilanpenanganankasus" required  value="{{old('keberhasilanpenanganankasus')}}">

                              @error('keberhasilanpenanganankasus')<div class="invalid-feedback"> {{$message}}</div>
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
