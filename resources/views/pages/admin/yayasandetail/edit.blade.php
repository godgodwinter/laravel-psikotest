@extends('layouts.default')

@section('title')
Yayasan
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
            <div class="breadcrumb-item"><a href="{{route('yayasan')}}">Yayasan</a></div>
            <div class="breadcrumb-item"><a href="{{route('yayasandetail',$yayasan->id)}}">Detail</a></div>
            <div class="breadcrumb-item">Edit</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h5>Edit</h5>
            </div>
            <div class="card-body">








           <form id="setting-form" method="POST" action="{{route('yayasandetail.update',[$yayasan->id,$data->id])}}">
            @method('put')
            @csrf
            <div class="card" id="settings-card">

              <div class="card-body">


                <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Nama Sekolah</label>
                    <div class="col-sm-6 col-md-9">

                        <select class="js-example-basic-single form-control-sm @error('sekolah_id')
                        is-invalid
                    @enderror" name="sekolah_id"  style="width: 75%" id="datasekolah_id" required>
                        <option  selected value="{{$data->sekolah_id}}">{{$data->sekolah!=null?$data->sekolah->nama:'Data tidak ditemukan'}}</option>
                        @foreach ($sekolah as $data)
                            <option value="{{$data->id}}">{{$data->nama}}</option>
                        @endforeach

                      </select>

                  @error('sekolah_id')<div class="invalid-feedback"> {{$message}}</div>
                  @enderror


                    </div>




                  </div>
                  @push('before-script')
                  <script type="text/javascript">
                  $(document).ready(function() {

                      //Select2
                      $(document).ready(function() {
                          $('.js-example-basic-single').select2({
                          // theme: "classic",
                          // allowClear: true,
                          width: "resolve"
                          });
                      });
                  });

                  </script>
                  @endpush


                  </div>




              <div class="card-footer bg-whitesmoke text-md-right">
                <button class="btn btn-primary" id="save-btn">Simpan</button>
              </div>
            </div>
          </form>




            </div>
        </div>
    </div>
</section>
@endsection
