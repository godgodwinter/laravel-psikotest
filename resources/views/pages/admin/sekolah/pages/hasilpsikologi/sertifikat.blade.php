@extends('layouts.default')

@section('title')
Hasil Deteksi Psikologi
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
        <h2 class="section-title">{{$id->nama}}</h2>

        <div id="output-status"></div>
        <div class="row">
          <div class="col-md-3">
              @include('pages.admin.sekolah.component.sidebarsekolah')
          </div>
          <div class="col-md-9">


<div class="card" id="settings-card">
    <div class="card-header">
        <h4>Laporan Deteksi Psikologis   </h4>
        <button class="btn btn-primary"> Cetak </button>
    </div>
    <div class="card-header">
        <h4>Gangguan Masalah dan Perkembangan Siswa </h4>
    </div>
    <div class="card-body babengcontainer">
    <table border="0" width="60%">
        <tr><td>No Induk</td><td>:</td><td>{{$datasiswa->nomerinduk}}</td>
        <tr><td>Nama</td><td>:</td><td>{{$datasiswa->nama}}</td>
        </tr>
    </table>
    </div>
    <div class="card-body babengcontainer">
        <h3>I. Deteksi Gangguan Masalah</h3>

        <table id="example" class="table table-striped table-bordered mt-1 table-sm" >
            <thead>
                <tr>
                    <th class="text-center babeng-min-row">
                        No</th>
                    <th class="text-center " > Gangguan Karakter </th>
                    <th class="text-center babeng-min-row" > Rank </th>
                    <th class="text-center babeng-min-row" > % </th>
                    <th class="text-center babeng-min-row" > Ket </th>
                    <th class="text-center" width="40%"> </th>

                </tr>
            </thead>
            <tbody>
            </tbody>

        </table>



    </div>



</div>
          </div>
        </div>
    </div>
</section>
@endsection
