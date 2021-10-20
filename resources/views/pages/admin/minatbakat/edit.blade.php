@extends('layouts.default')

@section('title')
Master Minat, Bakat, Cita-cita dan Penjurusan
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
                <h5>Edit</h5>
            </div>
            <div class="card-body">




               



           <form id="setting-form" method="POST" action="{{route('minatbakat.update',$data->id)}}">
            @method('put')
            @csrf
            <div class="card" id="settings-card">
           
              <div class="card-body">

                <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Nama</label>
                    <div class="col-sm-6 col-md-9">

                      <input type="text" class="form-control  @error('nama') is-invalid @enderror" name="nama" required  value="{{old('nama') ? old('nama') : $data->nama}}">

                      @error('nama')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror

                    </div>
                  </div>
                  <div class="form-group row align-items-center">
                      <label for="site-title" class="form-control-label col-sm-3 text-md-right">Kategori</label>
                      <div class="col-sm-6 col-md-9">
  
                        <select class="form-control  @error('kategori') is-invalid @enderror" name="kategori" required>
                            @if (old('kategori'))
                            <option>{{old('kategori')}}</option>
                            @else
                            <option>{{$data->kategori}}</option>
                            @endif
                                
                          <option>Minat</option>
                          <option>Bakat</option>
                          <option>Cita-cita</option>
                          <option>Penjuruan</option>
                      </select>
                      @error('kategori')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror
  
                      </div>
                    </div>

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
