@extends('layouts.default')

@section('title')
Sekolah
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
            <div class="breadcrumb-item">@yield('title')</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-body">

                <div class="d-flex bd-highlight mb-0 align-items-center">

                    <div class="p-2 bd-highlight">

                        <form action="{{ route('yayasan.sekolah.cari') }}" method="GET">
                            {{-- <label for="">Urutkan </label>
                            <select class="babeng babeng-select  ml-2" name="pelajaran_nama">

                                <option>Terbaru</option>
                                <option>Terlama</option>

                                <option>A - Z</option>
                                <option>Z - A</option>
                            </select> --}}

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

                <x-jsmultidel link="{{route('yayasan.multidel')}}" />
                @if($datas->count()>0)
                    <x-jsdatatable/>
                @endif

                <table id="example" class="table table-striped table-bordered mt-1 table-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center babeng-min-row">  No</th>
                            <th  class="text-center">Aksi</th>
                            <th >Nama Sekolah</th>
                            <th>Alamat</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Logo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $data)
                        <tr id="sid{{ $data->id }}">
                                <td class="text-center babeng-min-row">

                                    {{ ((($loop->index)+1)+(($datas->currentPage()-1)*$datas->perPage())) }}</td>
                                <td class="babeng-min-row text-center"> <a href="{{route('yayasandetail',$data->id)}}" class="btn btn-info btn-sm "><i class="fas fa-angle-double-right"></i></a>
                                </td>
                                <td>
                                        {{$data->sekolah!=null?$data->sekolah->nama:'Data tidak ditemukan'}}
                                </td>
                                <td >
                                    {{$data->sekolah!=null?Str::limit($data->sekolah->alamat,40,' ...'):'Data tidak ditemukan'}}</td>
                                <td class="text-center babeng-min-row">
                                    @php
                                        $warna='danger';
                                        $status='Tidak Aktif';
                                        if($data->status=='Aktif'){
                                            $warna='success';
                                            $status='Aktif';
                                        }
                                    @endphp
                                    <button class="btn btn-{{$warna}} btn-sm ">{{$status}}</button>
                                </td>
                                <td class="text-center">

                        <img alt="image" src="{{$data->sekolah!=null?'https://ui-avatars.com/api/?name=Yayasan&amp&color=7F9CF5&amp&background=EBF4FF' : 'https://ui-avatars.com/api/?name=Yayasan&amp&color=7F9CF5&amp&background=EBF4FF'}}" class="img-thumbnail" data-toggle="tooltip" title="Yayasan Photo" width="100px" height="100px" style="object-fit:cover;">
                                </td>
                            </tr>
                @empty
                            <tr>
                                <td colspan="6" class="text-center">Data tidak ditemukan</td>
                            </tr>
                @endforelse
                    </tbody>
                </table>


            </div>
        </div>
    </div>
</section>
@endsection
