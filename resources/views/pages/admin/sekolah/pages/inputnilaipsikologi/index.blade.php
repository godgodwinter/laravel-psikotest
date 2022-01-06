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
              @include('pages.admin.sekolah.component.sidebarsekolah')
          </div>
          <div class="col-md-9">


    <div class="card-body">

        <form action="{{route('sekolah.inputnilaipsikologi.cari',$id->id)}}" method="GET" class="babeng-form">
            <div class="row mb-2">

                <div class="col-12 col-md-3 col-sm-5">
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
                <div class="col-12 col-md-3 col-sm-5">
                    <span>
                        <input class="btn btn-info ml-1 mt-2 mt-sm-0" type="submit" id="babeng-submit" value="Pilih">
                    </span>
                </div>
            </div>
        </form>

    </div>

<div class="card" id="settings-card">
    <div class="card-header">
        <h4>Master Nilai Psikologi kelas :  {{ $kelaspertama!=null?$kelaspertama->nama:'Kelas tidak ditemukan' }} </h4>
    </div>
    <div class="card-body babengcontainer">


        <table id="example" class="table table-striped table-bordered mt-0 table-sm" >
            <thead>
                <tr>
                    <th class="text-center babeng-min-row"> No</th>
                    <th class="th-table" >Nama </th>
                    @php
                    $master=DB::table('masternilaipsikologi')->whereNull('deleted_at')->get();
                    @endphp
                    @foreach ($master as $m)
                    <th class="text-center" style="width:5px">
                        {{$m->singkatan}}
                    </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @forelse ($datas as $data)
                <tr id="sid{{ $loop->index+1 }}">
                    <td class="text-center">
                        {{$loop->index+1}}
                    </td>
                    <td class="babeng-td">
                        {{$data->nama}}
                    </td>
                    {{-- @foreach ($master as $m) --}}
                    @php
                        $hasil='';
                        $getData=\App\Models\apiprobk_sertifikat::select('isi')
                        // ->where('kunci',$m->nama)
                        ->where('apiprobk_id',$data->apiprobk_id)
                        ->get();
                        // $hasil=$getData->isi;
                        // dd($getData);
                    @endphp
                    <td>
                        {{$hasil}}
                    </td>
                    {{-- @endforeach --}}
                    {{-- {{dd($hasil)}} --}}
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

          </div>
        </div>
    </div>
</section>
@endsection
