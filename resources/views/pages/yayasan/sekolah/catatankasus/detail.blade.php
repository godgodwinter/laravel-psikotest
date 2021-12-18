@extends('layouts.default')

@section('title')
Catatan Kasus
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
            @include('pages.yayasan.sekolah.component.sidebarsekolah')
          </div>
          <div class="col-md-9">


            <div class="d-flex bd-highlight mb-0 align-items-center">

                <div class="p-2 bd-highlight">

        </div>

        <div class="p-2 bd-highlight">
        </div>

        <div class="ml-auto p-2 bd-highlight">

    </div>

</div>

<div class="card" id="settings-card">
{{-- <div class="card-header">
    <h4>Hasil Psikologi </h4>
</div> --}}
<div class="card-body babengcontainer">


    <div class="card-header">
        <h4>Catatan Kasus Siswa : {{ $data!=null?$data->nama:'Kelas tidak ditemukan' }}</h4>
        </div>
    <table id="example" class="table table-striped table-bordered mt-1 table-sm" >
        <thead>
            <tr>
                <th class="text-center babeng-min-row">
                    No</th>
                <th >Tanggal</th>
                <th class="text-center">Kasus</th>

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
                        {{$data->kasus}}
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
  {{-- <form method="post" action="{{ route('sekolah.catatankasus.import',$id->id) }}" enctype="multipart/form-data"> --}}
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
