@extends('layouts.default')

@section('title')
Catatan Prestasi Siswa
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

                        <form action="{{ route('bk.catatanprestasisiswa.cari') }}" method="GET">
                            {{-- <label for="">Urutkan </label>
                            <select class="babeng babeng-select  ml-2" name="pelajaran_nama">

                                <option>Terbaru</option>
                                <option>Terlama</option>

                                <option>A - Z</option>
                                <option>Z - A</option>
                            </select> --}}

                            <input type="text" class="babeng babeng-select  ml-0" name="cari">

                            <span>
                                <input class="btn btn-info ml-1 mt-2 mt-sm-0" type="submit" id="babeng-submit"
                                    value="Cari">
                            </span>

                            <a href="{{route('bk.catatanprestasisiswa.create')}}" type="submit" value="Import"
                                class="btn btn-icon btn-primary btn-sm ml-2"><span class="pcoded-micon"> <i
                                        class="fas fa-download"></i> Tambah </span></a>
                            {{-- <button type="button" class="btn btn-icon btn-primary btn-sm ml-0 ml-sm-0"
                                data-toggle="modal" data-target="#importExcel"><i class="fas fa-upload"></i>
                                Import
                            </button>
                            <a href="/admin/bk.catatanprestasisiswa/export" type="submit" value="Import"
                                class="btn btn-icon btn-primary btn-sm mr-2"><span class="pcoded-micon"> <i
                                        class="fas fa-download"></i> Export </span></a> --}}
                        </form>

                    </div>
                </div>

                <x-jsmultidel link="{{route('bk.catatanprestasisiswa.multidel')}}" />
                @if($datas->count()>0)
                    <x-jsdatatable/>
                @endif
                <div style="overflow:scroll">
                <table id="example" class="table table-striped table-bordered mt-1" style="width:100%">
                    <thead>
                        <tr>
                            <th width="8%" class="text-center"> <input type="checkbox" id="chkCheckAll"> All</th>
                            <th >Tanggal</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Kelas</th>
                            <th class="text-center">Prestasi</th>
                            <th class="text-center">Teknik Belajar</th>
                            <th class="text-center">Sarana Belajar</th>
                            <th class="text-center">Penunjang Belajar</th>
                            <th class="text-center">Kesimpulan dan Saran</th>

                            <th width="10%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $data)
                        <tr id="sid{{ $data->id }}">
                                <td class="text-center">
                                    <input type="checkbox" name="ids" class="checkBoxClass " value="{{ $data->id }}">
                                    {{ ((($loop->index)+1)+(($datas->currentPage()-1)*$datas->perPage())) }}</td>
                                <td> {{$data->tanggal}}
                                </td>
                                <td class="text-center">
                                    {{Str::limit($data->siswa->nama,25,' ...')}}
                                </td>
                                <td class="text-center">
                                    {{$data->kelas->nama}}
                                 </td>
                                 <td class="text-center">
                                    {{$data->prestasi}}
                                 </td>
                                 <td class="text-center">
                                    {{$data->teknikbelajar}}
                                 </td>
                                 <td class="text-center">
                                    {{$data->saranabelajar}}
                                 </td>
                                 <td class="text-center">
                                    {{$data->penunjangbelajar}}
                                 </td>
                                 <td class="text-center">
                                    {{$data->kesimpulandansaran}}
                                 </td>


                                <td class="text-center">
                                    {{-- <x-button-reset-pass link="/admin/{{ $pages }}/{{$data->id}}/reset" /> --}}
                                    <x-button-edit link="{{ route('bk.catatanprestasisiswa.edit',$data->id)}}" />
                                    <x-button-delete link="{{ route('bk.catatanprestasisiswa.destroy',$data->id)}}" />
                                </td>
                            </tr>
                @empty
                            <tr>
                                <td colspan="10" class="text-center">Data tidak ditemukan</td>
                            </tr>
                @endforelse
                    </tbody>
                </table>
                </div>

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
{{-- <nav aria-label="breadcrumb">
<ol class="breadcrumb">
    <li class="breadcrumb-item"><i class="fas fa-paste"></i> {{ $datas->total() }} Data ditemukan</li>

</ol>
</nav> --}}
<a href="#" class="btn btn-sm  btn-danger mb-2" id="deleteAllSelectedRecord"
            onclick="return  confirm('Anda yakin menghapus data ini? Y/N')"  data-toggle="tooltip" data-placement="top" title="Hapus Terpilih">
            <i class="fas fa-trash-alt mr-2"></i> Hapus Terpilih</i>
        </a>
            </div>
        </div>
    </div>
</section>
@endsection
