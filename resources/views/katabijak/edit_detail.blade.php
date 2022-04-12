@extends('layouts.default')

@section('title')
Kata-kata Bijak
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
           <form id="setting-form" method="POST" action="{{route('katabijakdetail.update',[$katas->id,$data->id])}}" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="card" id="settings-card">
              <div class="card-header">
                <h4>katabijak </h4>
              </div>
              <div class="card-body">


                
                <div class="form-group row align-items-center">
                            <label for="site-title" class="form-control-label col-sm-3 text-md-right">Penjelasan </label>
                            <div class="col-sm-6 col-md-9">

                            
                              <textarea  class="form-control" style=" min-width:500px; max-width:100%;min-height:50px;height:100%;width:100%;" name="penjelasan" required rows="5" cols="50">{{old('penjelasan')!=null ? old('penjelasan') : $data->penjelasan}}</textarea>
                              @error('penjelasan')<div class="invalid-feedback"> {{$message}}</div>
                              @enderror

                            </div>
                          </div>
                
                          <input type="text" name="judul" value="" readonly>
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
