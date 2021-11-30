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








           <form id="setting-form" method="POST" action="{{route('yayasan.update',$data->id)}}">
            @method('put')
            @csrf
            <div class="card" id="settings-card">

              <div class="card-body">

                <div class="form-group row align-items-center">
                    <label for="nama" class="form-control-label col-sm-3 text-md-right">Nama Yayasan</label>
                    <div class="col-sm-6 col-md-9">

                      <input type="text" class="form-control  @error('nama') is-invalid @enderror" name="nama" required  value="{{old('nama') ? old('nama') : $data->nama}}">

                      @error('nama')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror

                    </div>
                  </div>


                  <div class="form-group row align-items-center">
                      <label for="kepala" class="form-control-label col-sm-3 text-md-right">Nama Kepala Yayasan</label>
                      <div class="col-sm-6 col-md-9">

                        <input type="text" class="form-control  @error('kepala') is-invalid @enderror" name="kepala" required  value="{{old('kepala') ? old('kepala') : $data->kepala}}">

                        @error('kepala')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror

                      </div>
                    </div>


                  <div class="form-group row align-items-center">
                    <label for="alamat" class="form-control-label col-sm-3 text-md-right">Nama Alamat Yayasan</label>
                    <div class="col-sm-6 col-md-9">

                      <input type="text" class="form-control  @error('alamat') is-invalid @enderror" name="alamat" required  value="{{old('alamat')? old('alamat') : $data->alamat}}">

                      @error('alamat')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror

                    </div>
                  </div>

                  <div class="form-group row align-items-center">
                    <label for="telp" class="form-control-label col-sm-3 text-md-right">Nama Telp Yayasan</label>
                    <div class="col-sm-6 col-md-9">

                      <input type="text" class="form-control  @error('telp') is-invalid @enderror" name="telp" required  value="{{old('telp')? old('telp') : $data->telp}}">

                      @error('telp')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror

                    </div>
                  </div>



                <div class="form-group row align-items-center">
                    <label for="status" class="form-control-label col-sm-3 text-md-right">Status</label>
                    <div class="col-sm-6 col-md-9">

                      <select class="form-control  @error('status') is-invalid @enderror" name="status" required>
                        <option>Aktif</option>
                        <option>Tidak Aktif</option>
                    </select>
                    @error('status')<div class="invalid-feedback"> {{$message}}</div>
                    @enderror

                    </div>
                  </div>


                  <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Username</label>
                    <div class="col-sm-6 col-md-9">

                      <input type="text" class="form-control  @error('username') is-invalid @enderror" name="username" required  value="{{old('username')? old('username') : $data->users->username}}">

                      @error('username')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror

                    </div>
                  </div>

                <div class="form-group row align-items-center">
                  <label for="site-title" class="form-control-label col-sm-3 text-md-right">Email</label>
                  <div class="col-sm-6 col-md-9">

                    <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email" required  value="{{old('email')? old('email') : $data->users->email}}">

                    @error('email')<div class="invalid-feedback"> {{$message}}</div>
                    @enderror

                  </div>
                </div>


                <div class="form-group row align-items-center">
                  <label for="site-title" class="form-control-label col-sm-3 text-md-right">Password</label>
                  <div class="col-sm-6 col-md-9">

                    <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password" >

                    @error('password')<div class="invalid-feedback"> {{$message}}</div>
                    @enderror

                  </div>
                </div>
                <div class="form-group row align-items-center">
                  <label for="site-title" class="form-control-label col-sm-3 text-md-right">Konfirmasi Password</label>
                  <div class="col-sm-6 col-md-9">

                    <input type="password" class="form-control  @error('password2') is-invalid @enderror" name="password2" >

                    @error('password2')<div class="invalid-feedback"> {{$message}}</div>
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
