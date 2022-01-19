@extends('layouts.default')

@section('title')
Catatan Pengembangan Diri Siswa
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







        <div class="p-2 bd-highlight">
        </div>

        <div class="ml-auto p-2 bd-highlight">
            <a href="{{route('bk.catatanpengembangandirisiswa.create')}}" type="submit" value="Import"
                class="btn btn-icon btn-primary btn-sm ml-2"><span class="pcoded-micon"> <i
                        class="fas fa-download"></i> Tambah </span></a>
            {{-- <button type="button" class="btn btn-icon btn-primary btn-sm ml-0 ml-sm-0"
            data-toggle="modal" data-target="#importExcel"><i class="fas fa-upload"></i>
            Import
        </button> --}}
        {{-- <a href="{{ route('bk.catatanpengembangandirisiswa.export') }}" type="submit" value="Import"
            class="btn btn-icon btn-primary btn-sm mr-0"><span class="pcoded-micon"> <i
                    class="fas fa-download"></i> Export </span></a> --}}


</div>

<div class="card" id="settings-card">
{{-- <div class="card-header">
    <h4>Hasil Psikologi </h4>
</div> --}}
<div class="card-body babengcontainer">


    <div class="card-header">
        <h4>Catatan Pengembangandiri Siswa : {{ $data!=null?$data->nama:'Kelas tidak ditemukan' }}</h4>
        </div>
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
                    <td class="babeng-min-row"> {{Fungsi::tanggalindo($data->tanggal)}}
                    </td>

                     <td class="text-center">
                        {{$data->idedanimajinasi}}
                     </td>

                    <td class="text-center babeng-min-row">
                        {{-- <a class="btn btn-sm btn-info" href="{{ route('bk.catatanpengembangandirisiswa.cetakpersiswa',[$data->id])}}"><i class="fas fa-print"></i></a> --}}
                        <x-button-edit link="{{ route('bk.catatanpengembangandirisiswa.edit',[$data->id])}}" />
                        <x-button-delete link="{{ route('bk.catatanpengembangandirisiswa.destroy',[$data->id])}}" />
                    </td>
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

@section('containermodal')
<!-- Import Excel -->
<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  {{-- <form method="post" action="{{ route('bk.catatanpengembangandirisiswa.import') }}" enctype="multipart/form-data"> --}}
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
