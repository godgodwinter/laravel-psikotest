@extends('layouts.default')

@section('title')
Walikelas
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

                    <div id="babeng-bar" class="d-flex bd-highlight mb-0 align-items-center">
                        <div id="p-2 bd-highlight ">

                        <form action="{{ route('bk.walikelas.cari') }}" method="GET">
                            {{-- <label for="">Urutkan </label>
                            <select class="babeng babeng-select  ml-2" name="pelajaran_nama">

                                <option>Terbaru</option>
                                <option>Terlama</option>

                                <option>A - Z</option>
                                <option>Z - A</option>
                            </select> --}}

                            <input type="text" class="babeng babeng-select  ml-0" name="cari">
                        </div>
                        <div id="p-2 bd-highlight ">
                            <span>
                                <input class="btn btn-info ml-1 mt-2 mt-sm-0" type="submit" id="babeng-submit"
                                    value="Cari">
                            </span>

                        </form>

                    </div>
                </div>

                <x-jsmultidel link="{{route('referensi.multidel')}}" />
                @if($datas->count()>0)
                    <x-jsdatatable/>
                @endif

                <table id="example" class="table table-striped table-bordered table-sm mt-1" style="width:100%">
                    <thead>
                        <tr>
                            <th width="8%" class="text-center babeng-min-row">No</th>
                            <th>Nama</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($datas as $data)
                            <tr id="sid{{ $data->id }}">
                                    <td class="text-center">
                                        {{ ((($loop->index)+1)+(($datas->currentPage()-1)*$datas->perPage())) }}</td>
                                    <td>{{$data->nomerinduk}} - {{Str::limit($data->nama,25,' ...')}}
                                    </td>


                                </tr>
                    @empty
                                <tr>
                                    <td colspan="5" class="text-center">Data tidak ditemukan</td>
                                </tr>
                    @endforelse

                    </tbody>
                </table>
                <div class="d-flex justify-content-between flex-row-reverse mt-3">
                    <div >
@php
$cari=$request->cari;
$tapel_nama=$request->tapel_nama;
$kelas_nama=$request->kelas_nama;
@endphp
{{-- {{ $datas->appends(['cari'=>$request->cari,'yearmonth'=>$request->yearmonth,'kategori_nama'=>$request->kategori_nama])->links() }} --}}
{{ $datas->onEachSide(1)

  ->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
