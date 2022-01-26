@extends('layouts.default')

@section('title')
Referensi Studi dan Kerja
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

                        <form action="{{ route('bk.referensi.cari') }}" method="GET">
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
                            {{-- <a href="{{route('bk.referensi.create')}}" type="submit" value="Import"
                                class="btn btn-icon btn-primary btn-sm ml-2"><span class="pcoded-micon"> <i
                                        class="fas fa-download"></i> Tambah </span></a> --}}
                            {{-- <button type="button" class="btn btn-icon btn-primary btn-sm ml-0 ml-sm-0"
                                data-toggle="modal" data-target="#importExcel"><i class="fas fa-upload"></i>
                                Import
                            </button>
                            <a href="/admin/referensi/export" type="submit" value="Import"
                                class="btn btn-icon btn-primary btn-sm mr-2"><span class="pcoded-micon"> <i
                                        class="fas fa-download"></i> Export </span></a> --}}
                        </form>

                    </div>
                </div>

                {{-- <x-jsmultidel link="{{route('bk.referensi.multidel')}}" />
                @if($datas->count()>0)
                    <x-jsdatatable/>
                @endif --}}

                <table id="example" class="table table-striped table-bordered mt-1 table-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center babeng-min-row"> <input type="checkbox" id="chkCheckAll"> All</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Jenis</th>
                            <th class="text-center">File</th>
                            {{-- <th class="text-center">Aksi</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $data)
                        <tr id="sid{{ $data->id }}">
                                <td class="text-center">
                                    <input type="checkbox" name="ids" class="checkBoxClass " value="{{ $data->id }}">
                                    {{ ((($loop->index)+1)+(($datas->currentPage()-1)*$datas->perPage())) }}</td>
                                <td class="text-center"> {{Str::limit($data->nama,25,' ...')}}
                                </td>
                                <td class="text-center">{{$data->jenis}}</td>
                                <td class="text-center">
                                    @php
                                        if($data->link!=null){
                                            $alamat=$data->link;
                                        }else{
                                            $alamat=url('/'.$data->file);
                                        }
                                    @endphp
<a href="{{ $alamat }}" class="btn btn-icon btn-dark btn-sm ml-1"  data-toggle="tooltip" data-placement="top" title="File!" target="_blank" ><i class="fas fa-atlas"></i></a>

                                </td>

                                {{-- <td class="text-center babeng-min-row">
                                     <x-button-reset-pass link="/admin/{{ $pages }}/{{$data->id}}/reset" />
                                    <x-button-edit link="{{ route('bk.referensi.edit',$data->id)}}" />
                                    <x-button-delete link="{{ route('bk.referensi.destroy',$data->id)}}" />
                                </td> --}}
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
</section>
@endsection
