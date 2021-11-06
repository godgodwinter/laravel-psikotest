@extends('layouts.default')

@section('title')
Referensi Psikologi
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

                <div id="babeng-bar" class="text-center mt-2">

                    <div id="babeng-row ">
                        <div id="babeng-bar" class="d-flex bd-highlight mb-0 align-items-center">
                            <div id="p-2 bd-highlight ">


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
                            <div id="p-2 bd-highlight ">

                            <span>
                                <input class="btn btn-info ml-1 mt-2 mt-sm-0" type="submit" id="babeng-submit"
                                    value="Cari">
                            </span>
                            </div>

                        </form>

                    </div>
                </div>

                <x-jsmultidel link="{{route('referensi.multidel')}}" />
                @if($datas->count()>0)
                    <x-jsdatatable/>
                @endif

                <table id="example" class="table table-striped table-bordered mt-1" style="width:100%">
                    <thead>
                        <tr>
                            <th width="8%" class="text-center"> No</th>
                            <th >Nama</th>
                            <th class="text-center">File</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $data)
                        <tr id="sid{{ $data->id }}">
                            <td class="text-center">
                                {{ ((($loop->index)+1)+(($datas->currentPage()-1)*$datas->perPage())) }}</td>
                                <td> {{Str::limit($data->nama,25,' ...')}}
                                </td>
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
