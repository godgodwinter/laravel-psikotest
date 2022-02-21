@extends('layouts.default')

@section('title')
Klasifikasi Akademis dan Profesi
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

                        <form action="{{ route('yayasan.klasifikasijabatan.cari') }}" method="GET">
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

                            {{-- <a href="{{route('yayasan.klasifikasijabatan.create')}}" type="submit" value="Import"
                                class="btn btn-icon btn-primary btn-sm ml-2"><span class="pcoded-micon"> <i
                                        class="fas fa-download"></i> Tambah </span></a> --}}
                            {{-- <button type="button" class="btn btn-icon btn-primary btn-sm ml-0 ml-sm-0"
                                data-toggle="modal" data-target="#importExcel"><i class="fas fa-upload"></i>
                                Import
                            </button>
                            <a href="/admin/klasifikasijabatan/export" type="submit" value="Import"
                                class="btn btn-icon btn-primary btn-sm mr-2"><span class="pcoded-micon"> <i
                                        class="fas fa-download"></i> Export </span></a> --}}
                        </form>

                    </div>
                </div>

                {{-- <x-jsmultidel link="{{route('yayasan.klasifikasijabatan.multidel')}}" />
                @if($datas->count()>0)
                    <x-jsdatatable/>
                @endif --}}

                <table id="example" class="table table-striped table-bordered mt-1 table-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center babeng-min-row"> <input type="checkbox" id="chkCheckAll"> All</th>
                            <th >Bidang</th>
                            <th >Akademis</th>
                            <th >Profesi</th>
                            <th >Nilai Standart</th>
                            <th >IQ Standart</th>
                            <th >Jurusan & Bidang Studi yang ditekuni</th>
                            <th >Pekerjaan & Keterangan</th>
                            <th >Link</th>
                            {{-- <th class="text-center">Aksi</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $data)
                        <tr id="sid{{ $data->id }}">
                                <td class="text-center">
                                    <input type="checkbox" name="ids" class="checkBoxClass " value="{{ $data->id }}">
                                    {{ ((($loop->index)+1)+(($datas->currentPage()-1)*$datas->perPage())) }}</td>
                                <td> {{Str::limit($data->bidang,25,' ...')}}
                                </td>
                                <td class="text-center">
                                    {{Str::limit($data->akademis,25,' ...')}}
                                </td>
                                <td class="text-center">
                                    {{Str::limit($data->pekerjaan,25,' ...')}}
                                </td>
                                <td class="text-center">
                                    {{Str::limit($data->nilaistandart,25,' ...')}}
                                </td>
                                <td class="text-center">
                                    {{Str::limit($data->iqstandart,25,' ...')}}
                                </td>
                                <td class="text-center">
                                    {{Str::limit($data->jurusan,25,' ...')}}
                                </td>
                                <td class="text-center">
                                    {{Str::limit($data->bidangstudi,25,' ...')}}
                                </td>
                                <td class="text-center">
                                    {{Str::limit($data->ket,25,' ...')}}
                                </td>

                                {{-- <td class="text-center babeng-min-row">
                                    <x-button-reset-pass link="/admin/{{ $pages }}/{{$data->id}}/reset" />
                                    <x-button-edit link="{{ route('yayasan.klasifikasijabatan.edit',$data->id)}}" />
                                    <x-button-delete link="{{ route('bk.klasifikasijabatan.destroy',$data->id)}}" />
                                </td> --}}
                            </tr>
                @empty
                            <tr>
                                <td colspan="8" class="text-center">Data tidak ditemukan</td>
                            </tr>
                @endforelse
                    </tbody>
                </table>

                {{-- <div class="d-flex justify-content-between flex-row-reverse mt-3">
                    <div >
@php
$cari=$request->cari;
$tapel_nama=$request->tapel_nama;
$kelas_nama=$request->kelas_nama;
@endphp

{{ $datas->onEachSide(1)

  ->links() }}
                    </div>
{
<div>
<a href="#" class="btn btn-sm  btn-danger mb-2" id="deleteAllSelectedRecord"
            onclick="return  confirm('Anda yakin menghapus data ini? Y/N')"  data-toggle="tooltip" data-placement="top" title="Hapus Terpilih">
            <i class="fas fa-trash-alt mr-2"></i> Hapus Terpilih</i>
        </a>
            </div>
            </div>
            </div> --}}
        </div>
    </div>
</section>
@endsection
