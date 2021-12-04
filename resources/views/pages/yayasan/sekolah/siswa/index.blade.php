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
            <div class="breadcrumb-item">{{ $sekolah->nama }}</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">{{$sekolah->nama}}</h2>

        <div id="output-status"></div>
        <div class="row">
          <div class="col-md-3">
              @include('pages.yayasan.sekolah.component.sidebarsekolah')
          </div>
          <div class="col-md-9">

            <div class="card" id="settings-card">
                {{-- <div class="card-header">
                  <h4>Siswa </h4>
                </div> --}}
                <div class="card-body">
                  <div class="d-flex bd-highlight mb-0 align-items-center">
                      <div class="p-2 bd-highlight">

                          <form action="{{route('yayasan.sekolah.siswa.cari',$sekolah->id)}}" method="GET">
                              <input type="text" class="babeng babeng-select  ml-0" name="cari">
                      </div>
                      <div class="p-2 bd-highlight">
                              <span>
                                  <input class="btn btn-info ml-1 mt-2 mt-sm-0" type="submit" id="babeng-submit"
                                      value="Cari">
                              </span>
                          </div>
                      <div class="ml-auto p-2 bd-highlight">

                          </form>
                      </div>
                  </div>
                  @if($datas->count()>0)
                      <x-jsdatatable/>
                  @endif

          <table id="example" class="table table-striped table-bordered mt-1 table-sm" style="width:100%">
              <thead>
                  <tr>
                      <th  class="text-center babeng-min-row">
                          No</th>
                      <th>Nama siswa</th>
                      <th>Kelas</th>
                  </tr>
              </thead>
              <tbody>
              @forelse ($datas as $data)
                      <tr id="sid{{ $data->id }}">
                              <td class="text-center">
                                  {{ ((($loop->index)+1)+(($datas->currentPage()-1)*$datas->perPage())) }}</td>
                              <td>{{$data->nomerinduk}} - {{Str::limit($data->nama,25,' ...')}}
                              </td>
                              <td>
                                  {{ $data->kelas!=null ? $data->kelas->nama : 'Data tidak ditemukan' }}
                              </td>
                          </tr>
              @empty
                          <tr>
                              <td colspan="5" class="text-center">Data tidak ditemukan</td>
                          </tr>
              @endforelse

              </tbody>
          </table>

                      </div>
                  </div>
                </div>
              </div>


          </div>
        </div>
    </div>
</section>
@endsection
