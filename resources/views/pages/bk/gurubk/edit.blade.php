@extends('layouts.default')

@section('title')
Guru BK
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


                <form id="setting-form" method="POST" action="{{route('bk.gurubk.update',[$data->id])}}">
                    @method('put')
                    @csrf
                    <div class="card" id="settings-card">
                      <div class="card-header">
                        <h4>Guru BK </h4>
                      </div>
                      <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Identitas Pribadi</a>
                          </li>
                         {{-- <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Orang Tua</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                          </li> --}}
                        </ul>
                        <div class="tab-content" id="myTabContent">
                          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                        <div class="form-group row align-items-center">
                            <label for="site-title" class="form-control-label col-sm-3 text-md-right">Nama</label>
                            <div class="col-sm-6 col-md-9">

                              <input type="text" class="form-control  @error('nama') is-invalid @enderror" name="nama" required value="{{old('nama') ? old('nama') : $data->nama}}">

                              @error('nama')<div class="invalid-feedback"> {{$message}}</div>
                              @enderror

                            </div>
                          </div>
                          <div class="form-group row align-items-center">
                            <label for="site-title" class="form-control-label col-sm-3 text-md-right">NIP</label>
                            <div class="col-sm-6 col-md-9">

                              <input type="text" class="form-control  @error('nomerinduk') is-invalid @enderror" name="nomerinduk" required value="{{old('nomerinduk') ? old('nomerinduk') : $data->nomerinduk}}">

                              @error('nomerinduk')<div class="invalid-feedback"> {{$message}}</div>
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
