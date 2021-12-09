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


            <form action="{{route('yayasan.sekolah.hasilpsikologicari',$id->id)}}" method="GET" class="babeng-form">
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
                    </div>
                </div>
            </form>


            <div class="card" id="settings-card">
                <div class="card-header">
                    <h4>Hasil Psikologi kelas : {{ $kelaspertama!=null?$kelaspertama->nama:'Kelas tidak ditemukan' }}</h4>
                </div>
                <div class="card-body babengcontainer">
                    <div id="babeng-bar" class="text-right mt-2">

                    </div>


                    <table id="example" class="table table-striped table-bordered mt-1 table-sm" >
                        <thead>
                            <tr>
                                <th class="text-center babeng-min-row">
                                    No</th>
                                <th class="text-center" > Nama </th>
                                <th class="text-center" > Hasil Deteksi </th>
                                <th class="text-center" > Sertifikat </th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($datas as $data)
                            <tr id="sid{{ $loop->index+1 }}">
                                <td class="text-center ">
                                    {{$loop->index+1}}
                                </td>
                                <td >
                                    {{$data->siswa!=null ? $data->siswa->nama : 'Data tidak ditemukan'}}
                                </td>
                                <td class="text-center">
                                    {{$data->nilai?$data->nilai:'Data tidak ditemukan'}}
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-info"> Lihat </button>

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
