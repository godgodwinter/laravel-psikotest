@extends('layouts.default')

@section('title')
Detail Sekolah
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



            <form action="{{route('yayasan.sekolah.catatanpengembangandiricari',$id->id)}}" method="GET" class="babeng-form">
                <div class="row mb-2">

                    <div class="col-6 col-md-3 col-sm-4">
                        {{-- <input type="text" class="babeng babeng-select  ml-0" name="cari"> --}}
                        <select class="js-example-basic-single  form-control @error('kelas_id')
                        is-invalid
                    @enderror" name="kelas_id"  style="width: 75%"  style="width: 100%" required>
                        <option disabled selected value=""> Pilih kelas</option>
                        @foreach ($kelas as $t)
                            <option value="{{ $t->id }}"> {{ $t->nama }}</option>
                        @endforeach
                      </select>
                    </div>
                    @push('before-script')
                    <script type="text/javascript">
                        $(document).ready(function() {

                            // In your Javascript (external .js resource or <script> tag)
                                $(document).ready(function() {
                                    $('.js-example-basic-single').select2({
                                        // theme: "classic",
                                        // allowClear: true,
                                        width: "resolve"
                                    });
                                });
                        });
                       </script>
                    @endpush
                    <div class="col-6 col-md-3 col-sm-4">
                        <span>
                            <input class="btn btn-info ml-1 mt-2 mt-sm-0" type="submit" id="babeng-submit" value="Pilih">
                        </span>
                    </div>

                    <div class="col-12 col-md-6 col-sm-4  text-right">
                        <a href="{{route('sekolah.catatanpengembangandiri.create',$id->id)}}" type="submit" value="Import"
                            class="btn btn-icon btn-primary btn-sm ml-2"><span class="pcoded-micon"> <i
                                    class="fas fa-download"></i> Tambah </span></a>
                    </div>
                </div>
            </form>

<div class="card" id="settings-card">
{{-- <div class="card-header">
    <h4>Hasil Psikologi </h4>
</div> --}}
<div class="card-body babengcontainer">



        <div class="card-header">
        <h4>Catatan Kasus Kelas : {{ $kelaspertama!=null?$kelaspertama->nama:'Kelas tidak ditemukan' }}</h4>
        </div>
        <table id="example" class="table table-striped table-bordered mt-1 table-sm" >
            <thead>
                <tr>
                    <th class="text-center babeng-min-row">
                        No</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Catatan</th>
                    <th class="text-center" > Aksi </th>

                </tr>
            </thead>
            <tbody>
                @forelse ($datas as $data)
                <tr id="sid{{ $data->id }}">
                        <td class="text-center">
                            {{ ((($loop->index)+1)) }}</td>
                        </td>
                        <td class="text-center">
                            {{$data->siswa!=null?Str::limit($data->siswa->nama,25,' ...'):''}}
                        </td>

                         <td class="text-center">

                            <a class="btn btn-sm btn-light px-3" href="{{ route('yayasan.sekolah.catatanpengembangandiridetail',[$id->id,$data->id])}}"> {{$data->jmldata}}</a>

                         </td>

                        <td class="text-center babeng-min-row">
                            <a class="btn btn-sm btn-info" href="{{ route('sekolah.catatanpengembangandiri.cetakpersiswa',[$id->id,$data->id])}}"><i class="fas fa-print"></i></a>

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
</div>

@section('containermodal')
<!-- Import Excel -->
<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <form method="post" action="{{ route('sekolah.hasilpsikologi.import',$id->id) }}" enctype="multipart/form-data">
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

          </div>
        </div>
    </div>
</section>
@endsection
