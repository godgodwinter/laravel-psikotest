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
                      <div class="profile-widget-name">Status : {{$id->status}} 
                        {{-- <div class="text-muted d-inline font-weight-normal">
                          <div class="slash"></div> Web Developer</div> --}}
                        </div>
                      Ujang maman is a superhero name in <b>Indonesia</b>, especially in my family. He is not a fictional character but an original hero in my family, a hero for his children and for his wife. So, I use the name as a user in this template. Not a tribute, I'm just bored with <b>'John Doe'</b>.
                    </div>
                
                  </div>
                </div>
                
          </div>
        </div>
    </div>
</section>
@endsection
