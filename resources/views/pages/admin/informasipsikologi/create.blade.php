@extends('layouts.default')

@section('title')
Buletin Psikologi
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




                <form id="setting-form" method="POST" action="{{route('informasipsikologi.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card" id="settings-card">

                      <div class="card-body">

                        <div class="form-group row align-items-center">
                            <label for="site-title" class="form-control-label col-sm-3 text-md-right">Judul </label>
                            <div class="col-sm-6 col-md-9">

                                <textarea  class="form-control" style=" min-width:500px; max-width:100%;min-height:50px;height:100%;width:100%;" name="nama" required rows="5" cols="50">{{old('nama')}}</textarea>
                                @error('nama')<div class="invalid-feedback"> {{$message}}</div>
                                @enderror


                            </div>
                          </div>
                          <div class="form-group row align-items-center">
                            <label for="site-title" class="form-control-label col-sm-3 text-md-right">Tipe </label>
                            <div class="col-sm-6 col-md-9">




                                <select class="form-control @error('file') is-invalid @enderror @error('link') is-invalid @enderror" name="tipe"  required id="tipeselect">
                                    <option disabled selected value=""> Pilih Tipe</option>
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
                                        <input type="text" name="link" id="link" class="form-control @error('link') is-invalid @enderror" value="{{old('link')}}" required>
                                        @error('link')<div class="invalid-feedback"> {{$message}}</div>
                                        @enderror
                                    </div>

                                    `;
                                    var inputanupload=`


                                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Pilih File </label>
                                    <div class="col-sm-6 col-md-9">
                                        <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" required>
                                        @error('file')<div class="invalid-feedback"> {{$message}}</div>
                                        @enderror
                                        </div>
                                    `;

                                    inputan.html(inputanklink);
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


            </div>
        </div>
    </div>
</section>
@endsection
