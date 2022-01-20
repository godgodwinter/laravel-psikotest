@extends('layouts.default')

@section('title')
Klasifikasi Akademis & Profesi
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
            <div class="breadcrumb-item">Edit</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h5>Tambah</h5>
            </div>
            <div class="card-body">
           <form id="setting-form" method="POST" action="{{route('klasifikasijabatan.update',[$data->id])}}" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="card" id="settings-card">
              <div class="card-header">
                <h4>klasifikasijabatan </h4>
              </div>
              <div class="card-body">


                <div class="form-group row align-items-center">
                    <label for="bidang" class="form-control-label col-sm-3 text-md-right">Bidang </label>
                    <div class="col-sm-6 col-md-9">

                      <input type="text" class="form-control  @error('bidang') is-invalid @enderror" name="bidang" required  value="{{old('bidang')!=null ? old('bidang') : $data->bidang}}">

                      @error('bidang')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror

                    </div>
                </div>
                <div class="form-group row align-items-center">
                    <label for="pekerjaan" class="form-control-label col-sm-3 text-md-right">Akademis </label>
                    <div class="col-sm-6 col-md-9">

                      <input type="text" class="form-control  @error('pekerjaan') is-invalid @enderror" name="pekerjaan" required  value="{{old('pekerjaan')!=null?old('pekerjaan'):$data->pekerjaan}}">

                      @error('pekerjaan')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror

                    </div>
                </div>
                <div class="form-group row align-items-center">
                    <label for="pekerjaan" class="form-control-label col-sm-3 text-md-right">Profesi </label>
                    <div class="col-sm-6 col-md-9">

                      <input type="text" class="form-control  @error('pekerjaan') is-invalid @enderror" name="pekerjaan" required  value="{{old('pekerjaan')!=null?old('pekerjaan'):$data->pekerjaan}}">

                      @error('pekerjaan')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror

                    </div>
                </div>

                <div class="form-group row align-items-center">
                    <label for="nilaistandart" class="form-control-label col-sm-3 text-md-right">Nilai Standart </label>
                    <div class="col-sm-6 col-md-9">

                      <input type="text" class="form-control  @error('nilaistandart') is-invalid @enderror" name="nilaistandart" required  value="{{old('nilaistandart')!=null?old('nilaistandart'):$data->nilaistandart}}">

                      @error('nilaistandart')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror

                    </div>
                </div>

                <div class="form-group row align-items-center">
                    <label for="iqstandart" class="form-control-label col-sm-3 text-md-right">IQ Standart </label>
                    <div class="col-sm-6 col-md-9">

                      <input type="text" class="form-control  @error('iqstandart') is-invalid @enderror" name="iqstandart" required  value="{{old('iqstandart')!=null?old('iqstandart'):$data->iqstandart}}">

                      @error('iqstandart')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror

                    </div>
                </div>

                <div class="form-group row align-items-center">
                    <label for="jurusan" class="form-control-label col-sm-3 text-md-right">Jurusan </label>
                    <div class="col-sm-6 col-md-9">

                      <input type="text" class="form-control  @error('jurusan') is-invalid @enderror" name="jurusan" required  value="{{old('jurusan')!=null?old('jurusan'):$data->jurusan}}">

                      @error('jurusan')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror

                    </div>
                </div>


                <div class="form-group row align-items-center">
                    <label for="bidangstudi" class="form-control-label col-sm-3 text-md-right">Bidang Studi yang ditekuni </label>
                    <div class="col-sm-6 col-md-9">

                      <input type="text" class="form-control  @error('bidangstudi') is-invalid @enderror" name="bidangstudi" required  value="{{old('bidangstudi')!=null?old('bidangstudi'):$data->bidangstudi}}">

                      @error('bidangstudi')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror

                    </div>
                </div>


                <div class="form-group row align-items-center">
                    <label for="ket" class="form-control-label col-sm-3 text-md-right">Link </label>
                    <div class="col-sm-6 col-md-9">

                      <input type="text" class="form-control  @error('ket') is-invalid @enderror" name="ket" required  value="{{old('ket')!=null?old('ket'):$data->ket}}">

                      @error('ket')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror

                    </div>
                </div>

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
