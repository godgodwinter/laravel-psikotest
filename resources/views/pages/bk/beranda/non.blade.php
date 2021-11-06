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
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Sekolah</a></div>

        </div>
    </div>

    <div class="section-body">

        <div id="output-status"></div>
        <div class="row">
          <div class="col-md-12">

            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-12">
                  <div class="card profile-widget">
                    <div class="profile-widget-header">
                        @php

                        $randomimg='https://ui-avatars.com/api/?name=nonaktif&color=7F9CF5&background=EBF4FF';
                        // dd($sekolah_logo)
                        @endphp
                      <img alt="image" src="{{$randomimg}}" class="rounded-circle profile-widget-picture" style="object-fit:cover;" >
                      <div class="profile-widget-items">

                        <div class="profile-widget-item">
                          {{-- <div class="profile-widget-item-label">Following</div> --}}
                          <div class="profile-widget-item-value py-2"></div>
                        </div>
                      </div>
                    </div>

                <form action="#" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="profile-widget-description">
                        <div class="row">
                            <div class="col-11 col-lg-3  col-md-11 offset-0 py-3 ">
                                <div class="row d-flex justify-content-center" >


                                <div class="user-details py-1 px-4 ml-0 text-center">

                                <img alt="image" src="{{$randomimg}}" class="img-thumbnail" data-toggle="tooltip"  width="150px" height="150px" style="object-fit:cover;">
                                    <div class="user-name mt-2"><h4></h4></div>
                                    <div class="text-job text-muted">Kepala Sekolah</div>
                                    <div class="user-cta">
                                        <button class="btn btn-danger  mt-3 follow-btn"  disabled>Tidak Aktif</button>
                                    </div>

                                  </div>
                                </div>
                            </div>
                            <div class="col-11 col-lg-8 py-0 col-md-12">
                                <div class="form-group row align-items-center">
                                    <p><h1>Sekolah anda dalam kondisi non-aktif. Untuk lebih lanjut hubungi admin </h1></p>
                                  </div>
                            </div>
                        </div>

                    </div>

                </form>

                  </div>
                </div>

          </div>
        </div>
    </div>
</section>
@endsection


