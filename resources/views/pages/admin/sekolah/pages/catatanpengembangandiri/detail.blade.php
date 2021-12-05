@extends('layouts.default')

@section('title')
Catatan Pengembangan diri
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
              @include('pages.admin.sekolah.component.sidebarsekolah')
          </div>
          <div class="col-md-9">


            <div class="d-flex bd-highlight mb-0 align-items-center">

                <div class="p-2 bd-highlight">

        </div>

        <div class="p-2 bd-highlight">
        </div>

        <div class="ml-auto p-2 bd-highlight">
            <a href="{{route('sekolah.catatanpengembangandiri.create',$id->id)}}" type="submit" value="Import"
                class="btn btn-icon btn-primary btn-sm ml-2"><span class="pcoded-micon"> <i
                        class="fas fa-download"></i> Tambah </span></a>
            {{-- <button type="button" class="btn btn-icon btn-primary btn-sm ml-0 ml-sm-0"
            data-toggle="modal" data-target="#importExcel"><i class="fas fa-upload"></i>
            Import
        </button> --}}
        {{-- <a href="{{ route('sekolah.catatanpengembangandiri.export',$id->id) }}" type="submit" value="Import"
            class="btn btn-icon btn-primary btn-sm mr-0"><span class="pcoded-micon"> <i
                    class="fas fa-download"></i> Export </span></a> --}}
    </div>

</div>

<div class="card" id="settings-card">
{{-- <div class="card-header">
    <h4>Hasil Psikologi </h4>
</div> --}}
<div class="card-body babengcontainer">


    <table id="example" class="table table-striped table-bordered mt-1 table-sm" >
        <thead>
            <tr>
                <th class="text-center babeng-min-row">
                    No</th>
                <th >Tanggal</th>
                <th class="text-center">Ide dan Imajinasi</th>
                <th class="text-center" > Aksi </th>

            </tr>
        </thead>
        <tbody>
            @forelse ($datas as $data)
            <tr id="sid{{ $data->id }}">
                    <td class="text-center">
                        {{ ((($loop->index)+1)+(($datas->currentPage()-1)*$datas->perPage())) }}</td>
                    <td> {{Fungsi::tanggalindo($data->tanggal)}}
                    </td>

                     <td class="text-center">
                        {{$data->idedanimajinasi}}
                     </td>

                    <td class="text-center babeng-min-row">
                        <x-button-edit link="{{ route('sekolah.catatanpengembangandiri.edit',[$id->id,$data->id])}}" />
                        <x-button-delete link="{{ route('sekolah.catatanpengembangandiri.destroy',[$id->id,$data->id])}}" />
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

            <x-jsmultidel link="{{route('sekolah.catatanpengembangandiri.multidel',$id)}}" />
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
</a>
</div>
</div>

</div>
</div>
</div>
</div>

@section('containermodal')
<!-- Import Excel -->
<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  {{-- <form method="post" action="{{ route('sekolah.catatanpengembangandiri.import',$id->id) }}" enctype="multipart/form-data"> --}}
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import Nilai Siswa </h5>
      </div>
      <div class="modal-body">

        {{ csrf_field() }}

        <label>Pilih file excel(.xlsx)</label>
        <div class="form-group">
          <input type="file" name="file" required="required">
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Import</button>
      </div>
    </div>
  </form>
</div>
</div>
@endsection

          </div>
        </div>
    </div>
</section>
@endsection
