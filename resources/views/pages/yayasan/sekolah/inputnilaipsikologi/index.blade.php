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
        <h2 class="section-title">{{$id->nama}}</h2>

        <div id="output-status"></div>
        <div class="row">
          <div class="col-md-3">
              @include('pages.yayasan.sekolah.component.sidebarsekolah')
          </div>
          <div class="col-md-9">

    <div class="card-body">
        <div class="d-flex bd-highlight mb-0 align-items-center">

            <div class="p-0 bd-highlight">

            <form action="{{route('yayasan.sekolah.inputnilaipsikologi.cari',$id->id)}}" method="GET" class="babeng-form">
                {{-- <input type="text" class="babeng babeng-select  ml-0" name="cari"> --}}
            </div>
            <div class="p-0 bd-highlight">
                <select class="js-example-basic-single mx-5 form-control-sm @error('kelas_id')
                is-invalid
            @enderror" name="kelas_id"  style="width: 75%" required>
                <option disabled selected value=""> Pilih kelas</option>
                @foreach ($kelas as $t)
                    <option value="{{ $t->id }}"> {{ $t->nama }}</option>
                @endforeach

              </select>

            </div>
            <div class="p-2 bd-highlight">
                <span>
                    <input class="btn btn-info ml-1 mt-2 mt-sm-0" type="submit" id="babeng-submit" value="Pilih">
                </span>
            </div>
            <div class="ml-auto p-2 bd-highlight">




                 {{-- <a href="{{route('sekolah.masternilaibidangstudi.create',$id->id)}}" type="submit" value="Import"
                    class="btn btn-icon btn-primary btn-sm ml-2"><span class="pcoded-micon"> <i
                            class="fas fa-download"></i> Tambah </span></a> --}}
                {{--<button type="button" class="btn btn-icon btn-primary btn-sm ml-0 ml-sm-0" data-toggle="modal"
                    data-target="#importExcel"><i class="fas fa-upload"></i>
                    Import
                </button>
                <a href="/admin/sekolah/export" type="submit" value="Import"
                    class="btn btn-icon btn-primary btn-sm mr-2"><span class="pcoded-micon"> <i
                            class="fas fa-download"></i> Export </span></a> --}}
            </form>
        </div>

    </div>

    </div>

<div class="card" id="settings-card">
    <div class="card-header">
        <h4>Master Nilai Psikologi </h4>
    </div>
    <div class="card-body babengcontainer">
        <div id="babeng-bar" class="text-right mt-2">

        </div>


        <table id="example" class="table table-striped table-bordered mt-1 table-sm" >
            <thead>
                <tr>
                    <th class="text-center babeng-min-row"> No</th>
                    <th class="th-table" >Nama </th>
                    @php
                    $master=DB::table('masternilaipsikologi')->whereNull('deleted_at')->get();
                    @endphp
                    @foreach ($master as $m)
                    <th class="text-center" style="width:5px">
                        {{$m->singkatan}}
                    </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @forelse ($collectionpenilaian as $data)
                <tr id="sid{{ $loop->index+1 }}">
                    <td class="text-center">
                        {{$loop->index+1}}
                    </td>
                    <td class="babeng-td">
                        {{$data->nama}}
                    </td>
                    @foreach ($data->master as $m)
                    <td class="text-center">
                        <input class="babenginputnilai text-center text-info " id="inputnilai{{$data->id}}_{{$m->id}}" value="{{$m->nilai}}"
                        readonly type="text">
                        <input class="babenginputnilai text-center text-info " id="siswa{{$data->id}}_{{$m->id}}" value="{{$data->id}}"
                        readonly type="hidden">
                        <input class="babenginputnilai text-center text-info " id="master{{$data->id}}_{{$m->id}}" value="{{$m->id}}"
                            readonly type="hidden">

                    </td>
                    @endforeach
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
