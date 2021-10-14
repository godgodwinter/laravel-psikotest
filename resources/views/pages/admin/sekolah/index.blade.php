@extends('layouts.default')

@section('title')
Sekolah
@endsection

@push('before-script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
            <div class="card-header">

                <div id="babeng-bar" class="text-center mt-2">

                    <div id="babeng-row ">

                        <form action="{{ route('sekolah.cari') }}" method="GET">
                            {{-- <label for="">Urutkan </label>
                            <select class="babeng babeng-select  ml-2" name="pelajaran_nama">

                                <option>Terbaru</option>
                                <option>Terlama</option>

                                <option>A - Z</option>
                                <option>Z - A</option>
                            </select> --}}



                            {{-- <span>
                                <input class="btn btn-info ml-2 mt-2 mt-sm-0" type="submit" id="babeng-submit"
                                    value="Cari">
                            </span> --}}

                            <a href="{{route('sekolah.create')}}" type="submit" value="Import"
                                class="btn btn-icon btn-primary btn-sm mr-0"><span class="pcoded-micon"> <i
                                        class="fas fa-download"></i> Tambah </span></a>
                            {{-- <button type="button" class="btn btn-icon btn-primary btn-sm ml-0 ml-sm-0"
                                data-toggle="modal" data-target="#importExcel"><i class="fas fa-upload"></i>
                                Import
                            </button>
                            <a href="/admin/sekolah/export" type="submit" value="Import"
                                class="btn btn-icon btn-primary btn-sm mr-2"><span class="pcoded-micon"> <i
                                        class="fas fa-download"></i> Export </span></a> --}}
                        </form>

                    </div>
                </div>
            </div>
            <div class="card-body">
                <script>
                    $(document).ready(function() {
                        $('#example').DataTable({
                            paging: false,
                            info: false,
                            searching: false,
                        });
                    } );
                </script>

                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center">No</th>
                            <th width="20%">Nama</th>
                            <th>Alamat</th>
                            <th width="10%" class="text-center">Status</th>
                            <th width="10%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $data)
                            <tr>
                                <td class="text-center"> {{ ((($loop->index)+1)+(($datas->currentPage()-1)*$datas->perPage())) }}</td>
                                <td>{{$data->nama}}</td>
                                <td>{{$data->alamat}}</td>
                                <td class="text-center">{{$data->status}}</td>
                                <td class="text-center">
                                    {{-- <x-button-reset-pass link="/admin/{{ $pages }}/{{$data->id}}/reset" /> --}}
                                    <x-button-edit link="/admin/{{ $pages }}/{{$data->id}}" />
                                    <x-button-delete link="/admin/{{ $pages }}/{{$data->id}}" />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Data tidak ditemukan</td>
                            </tr>

                        @endforelse
                    </tbody>
                </table>

@php
$cari=$request->cari;
$tapel_nama=$request->tapel_nama;
$kelas_nama=$request->kelas_nama;
@endphp
{{-- {{ $datas->appends(['cari'=>$request->cari,'yearmonth'=>$request->yearmonth,'kategori_nama'=>$request->kategori_nama])->links() }} --}}
{{ $datas->onEachSide(1)
//   ->appends(['cari'=>$cari])
//   ->appends(['tapel_nama'=>$tapel_nama])
//   ->appends(['kelas_nama'=>$kelas_nama])
  ->links() }}
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
    <li class="breadcrumb-item"><i class="fas fa-paste"></i> {{ $datas->total() }} Data ditemukan</li>

</ol>
</nav>
            </div>
        </div>
    </div>
</section>
@endsection
