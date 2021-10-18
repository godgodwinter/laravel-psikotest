@extends('layouts.default')

@section('title')
Detail Sekolah
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
            <div class="breadcrumb-item"><a href="{{route('sekolah')}}">Sekolah</a></div>
            <div class="breadcrumb-item">{{ $id->nama }}</div>
        </div>
    </div>

    <div class="section-body">

        <div id="output-status"></div>
        <div class="row">
          <div class="col-md-3">
              @include('pages.admin.sekolah.component.sidebarsekolah')
          </div>
          <div class="col-md-9">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-12">
                  <div class="card profile-widget">
                    <div class="profile-widget-header">                     
                      <img alt="image" src="https://ui-avatars.com/api/?name={{ $id->nama }}&color=7F9CF5&background=EBF4FF" class="rounded-circle profile-widget-picture">
                      <div class="profile-widget-items">
                       
                        <div class="profile-widget-item">
                          {{-- <div class="profile-widget-item-label">Following</div> --}}
                          <div class="profile-widget-item-value py-2">{{$id->nama}}</div>
                        </div>
                      </div>
                    </div>
                    <div class="profile-widget-description">
                        <div class="row">
                            <div class="col-11 col-lg-3 offset-1 py-3">
                                <img alt="image" src="https://ui-avatars.com/api/?name={{ $id->nama }}&color=7F9CF5&background=EBF4FF" class="img-thumbnail profile-widget-picture">
                                <div class="clearfix"></div>
                                <a href="#" class="btn btn-primary ml-5 mt-3 follow-btn" data-follow-action="alert('follow clicked');" data-unfollow-action="alert('unfollow clicked');">Follow</a>
                                
                                <div class="clearfix"></div>
                                <a href="#" class="btn btn-success ml-5 mt-3 follow-btn" data-follow-action="alert('follow clicked');" data-unfollow-action="alert('unfollow clicked');">Status</a>
                              
                            </div>
                            <div class="col-11 col-lg-8 py-3">
                                <div class="form-group row align-items-center">
                                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Nama Sekolah</label>
                                    <div class="col-sm-3 col-md-9">
                                      <input type="text" name="site_title" class="form-control " id="site-title" readonly>
                                    </div>
                                  </div>
                                  
                                <div class="form-group row align-items-center">
                                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Alamat Sekolah</label>
                                    <div class="col-sm-3 col-md-9">
                                      <input type="text" name="site_title" class="form-control " id="site-title" readonly>
                                    </div>
                                  </div>
                                  
                                <div class="form-group row align-items-center">
                                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Nama Kepala Sekolah</label>
                                    <div class="col-sm-3 col-md-9">
                                      <input type="text" name="site_title" class="form-control " id="site-title" readonly>
                                    </div>
                                  </div>
                            </div>
                        </div>
                        
                    </div>
                
                  </div>
                </div>
                
          </div>
        </div>
    </div>
</section>
@endsection
