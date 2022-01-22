@extends('layouts.default')

@section('title')
Beranda
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
                {{-- <div class="breadcrumb-item"><a href="#">Layout</a></div> --}}
                {{-- <div class="breadcrumb-item">Default Layout</div> --}}
            </div>
            </div>

            <div class="section-body">
            <h2 class="section-title">Beranda</h2>
            <p class="section-lead">Halaman awal setelah login.</p>
            <div class="card">
                <div class="card-header">
                <h4>Data Web BK</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                          <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                              <i class="far fa-user"></i>
                            </div>
                            <div class="card-wrap">
                              <div class="card-header">
                                <h4>Total Sekolah2</h4>
                              </div>
                              <div class="card-body">
                                {{$jmlsekolah}}
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                          <div class="card card-statistic-1">
                            <div class="card-icon bg-danger">
                              <i class="far fa-newspaper"></i>
                            </div>
                            <div class="card-wrap">
                              <div class="card-header">
                                <h4>Total Yayasan</h4>
                              </div>
                              <div class="card-body">
                                {{$jmlyayasan}}
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                          <div class="card card-statistic-1">
                            <div class="card-icon bg-warning">
                              <i class="far fa-file"></i>
                            </div>
                            <div class="card-wrap">
                              <div class="card-header">
                                <h4>Total BK</h4>
                              </div>
                              <div class="card-body">
                                {{$jmlbk}}
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                <div class="card-footer bg-whitesmoke">

                        <div class="card">
                          <div class="card-header">
                            <h4>Aktivitas Terakhir dari Sekolah</h4>
                          </div>
                          <div class="card-body">
                            <ul class="list-unstyled list-unstyled-border">
                              <li class="media">
                                <img class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-1.png" alt="avatar">
                                <div class="media-body">
                                  <div class="float-right text-primary">Now</div>
                                  <div class="media-title">Farhan A Mujib</div>
                                  <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                                </div>
                              </li>
                              <li class="media">
                                <img class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-2.png" alt="avatar">
                                <div class="media-body">
                                  <div class="float-right">12m</div>
                                  <div class="media-title">Ujang Maman</div>
                                  <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                                </div>
                              </li>
                            </ul>
                            <div class="text-center pt-1 pb-1">
                              <a href="#" class="btn btn-primary btn-lg btn-round">
                                View All
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>

                </div>
            </div>
            </div>
        </section>
@endsection
