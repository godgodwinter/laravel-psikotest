@extends('layouts.default')

@section('title')
Yayasan/Dinas
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

                        <form action="{{ route('yayasan.cari') }}" method="GET">
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
                            <a href="{{route('yayasan.create')}}" type="submit" value="Import"
                                class="btn btn-icon btn-primary btn-sm ml-2"><span class="pcoded-micon"> <i
                                        class="fas fa-download"></i> Tambah </span></a>
                            {{-- <button type="button" class="btn btn-icon btn-primary btn-sm ml-0 ml-sm-0"
                                data-toggle="modal" data-target="#importExcel"><i class="fas fa-upload"></i>
                                Import
                            </button>
                            <a href="/admin/yayasan/export" type="submit" value="Import"
                                class="btn btn-icon btn-primary btn-sm mr-2"><span class="pcoded-micon"> <i
                                        class="fas fa-download"></i> Export </span></a> --}}
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
                            <th class="text-center babeng-min-row"> <input type="checkbox" id="chkCheckAll"> All</th>
                            <th >Nama Yayasan/Dinas</th>
                            <th class="text-center">Username</th>
                            <th class="text-center">Nama Kepala Yayasan/Dinas</th>
                            <th class="text-center">Telp</th>
                            <th class="text-center babeng-min-row">Jumlah Sekolah</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Logo</th>
                            <th  class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $data)
                        <tr id="sid{{ $data->id }}">
                                <td class="text-center">
                                    <input type="checkbox" name="ids" class="checkBoxClass " value="{{ $data->id }}">
                                    {{ ((($loop->index)+1)+(($datas->currentPage()-1)*$datas->perPage())) }}</td>
                                <td> {{Str::limit($data->nama,25,' ...')}}
                                </td>
                                <td class="text-center">
                                    {{$data->users!=null?$data->users->username:'Data tidak ditemukan'}}
                                </td>
                                <td class="text-center">
                                    {{Str::limit($data->kepala,25,' ...')}}
                                </td>
                                <td class="text-center">{{$data->telp}}</td>
                                <td class=" text-center">{{\App\Models\yayasandetail::where('yayasan_id',$data->id)->count()}}</td>
                                <td class="text-center">
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
                                <td class="babeng-min-row">

                        <img alt="image" src="{{$data->yayasan_photo!=null?asset('storage/'.$data->yayasan_photo):'https://ui-avatars.com/api/?name=Yayasan&amp&color=7F9CF5&amp&background=EBF4FF'}}" class="img-thumbnail" data-toggle="tooltip" title="Yayasan Photo" width="60px" height="60px" style="object-fit:cover;">
                                </td>
                                <td class="text-center babeng-min-row">
                                    <a href="{{route('yayasandetail',$data->id)}}" class="btn btn-info btn-sm "><i class="fas fa-angle-double-right"></i></a>
                                    <x-button-edit link="{{ route('yayasan.edit',$data->id)}}" />
                                    <x-button-delete link="{{ route('yayasan.destroy',$data->id)}}" />
                                </td>
                            </tr>
                @empty
                            <tr>
                                <td colspan="9" class="text-center">Data tidak ditemukan</td>
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
//   ->appends(['cari'=>$cari])
//   ->appends(['tapel_nama'=>$tapel_nama])
//   ->appends(['kelas_nama'=>$kelas_nama])
  ->links() }}
                    </div>
                    <div>

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
        </div>
    </div>
</section>
@endsection
