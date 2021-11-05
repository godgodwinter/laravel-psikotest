@extends('layouts.default')

@section('title')
Detail Minat Bakat
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
            <div class="breadcrumb-item">@yield('title')</div>
        </div>
    </div>


    <div class="card-body">
        <div class="d-flex bd-highlight mb-0 align-items-center">

            <div class="p-0 bd-highlight">

            <form action="{{route('bk.inputminatbakat.cari',$id->id)}}" method="GET" class="babeng-form">
                {{-- <input type="text" class="babeng babeng-select  ml-0" name="cari"> --}}
            </div>
            <div class="p-0 bd-highlight">
                <select class="js-example-basic-single mx-5 form-control-sm @error('kelas_id')
                is-invalid
            @enderror" name="kelas_id"  style="width: 75%" required>
                <option disabled selected value=""> Pilih kelas</option>
                @foreach ($kelas as $t)
                    <option value="{{ $t->id }}"> {{ $t->nama }}</option>
                @endforeach
              </select>

            </div>
            <div class="p-2 bd-highlight">
                <span>
                    <input class="btn btn-info ml-1 mt-2 mt-sm-0" type="submit" id="babeng-submit" value="Pilih">
                </span>
            </div>
            <div class="ml-auto p-2 bd-highlight">
                <button type="button" class="btn btn-icon btn-primary btn-sm ml-0 ml-sm-0"
                data-toggle="modal" data-target="#importExcel"><i class="fas fa-upload"></i>
                Import
            </button>
            <a href="#" type="submit" value="Import"
                class="btn btn-icon btn-primary btn-sm mr-0"><span class="pcoded-micon"> <i
                        class="fas fa-download"></i> Export </span></a>
            </form>
        </div>

    </div>

<div class="card" id="settings-card">
    <div class="card-header">
        <h4>Bakat dan Cita-cita kelas : {{ $kelaspertama!=null?$kelaspertama->nama:'Kelas tidak ditemukan' }} </h4>
    </div>
    <div class="card-body babengcontainer">


        <table id="example" class="table table-striped table-bordered mt-1 table-sm" >
            <thead>
                <tr>
                    <th class="text-center babeng-min-row">
                        No</th>
                    <th class="text-center">
                        Aksi</th>
                    <th class="th-table" >Nama </th>

                    @foreach ($master as $m)
                    <th class="text-center" style="width:5px">
                        {{$m->nama}}
                    </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @forelse ($collectionpenilaian as $data)
                <tr id="sid{{ $loop->index+1 }}">
                    <td class="text-center">
                        {{$loop->index+1}}
                    </td>
                    <td class="text-center babeng-min-row">
                        <x-button-edit link="{{ route('bk.inputminatbakat.edit',[$data->nomerinduk]) }}" />
                    </td>
                    <td class="babeng-td">
                        {{$data->nama}}
                    </td>
                    @foreach ($data->master as $m)
                    <td class="text-center">
                        {{$m->nilai}}
                        {{-- <input class="babenginputnilai text-center text-info " id="inputnilai{{$data->id}}_{{$m->id}}" value="{{$m->nilai}}"
                        readonly type="text"> --}}
                        <input class="babenginputnilai text-center text-info " id="siswa{{$data->id}}_{{$m->id}}" value="{{$data->id}}"
                        readonly type="hidden">
                        <input class="babenginputnilai text-center text-info " id="master{{$data->id}}_{{$m->id}}" value="{{$m->id}}"
                            readonly type="hidden">

                    </td>
                    <script>
                        $(document).ready(function () {
                                function changeHandler(val)
                                {
                                    if (Number(val) > 100)
                                    {
                                    val = 100
                                    }

                                    if (Number(val) < 0){
                                        val = 0
                                    }
                                    return val;
                                }

                        var nilai=0;
                        var siswa=0;
                        var master=0;
                        var inputnilai{{$data->id}}{{ $m->id }}=$("#inputnilai{{$data->id}}_{{$m->id}}");
                        var siswa{{$data->id}}{{ $m->id }}=$("#siswa{{$data->id}}_{{$m->id}}");
                        var master{{$data->id}}{{ $m->id }}=$("#master{{$data->id}}_{{$m->id}}");
                        var nilailawas=inputnilai{{$data->id}}{{ $m->id }}.val();

                            inputnilai{{$data->id}}{{ $m->id }}.click(function (e) {
                                                        e.preventDefault(e);
                                                        inputnilai{{$data->id}}{{ $m->id }}.prop('readonly',false);
                                                        // alert(inputnilai{{$data->id}}{{ $m->id }});
                                                        console.log('klik inputan');

                                                    });


                            inputnilai{{$data->id}}{{ $m->id }}.focusout(function (e) {
                                let nilai=0;
                                nilai=changeHandler(inputnilai{{$data->id}}{{ $m->id }}.val());

                                if(nilailawas!=inputnilai{{$data->id}}{{ $m->id }}.val()){
                                console.log('kirim update'+nilai);
                                inputnilai{{$data->id}}{{ $m->id }}.val(nilai);

                        fetch_customer_data(inputnilai{{$data->id}}{{ $m->id }}.val(),siswa{{$data->id}}{{ $m->id }}.val(),master{{$data->id}}{{ $m->id }}.val());


                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Data berhasil diubah!',
                                            // text: 'Something went wrong!',
                                            showConfirmButton: true,
                                            timer: 1000
                                        })
                                    }
                                inputnilai{{$data->id}}{{ $m->id }}.prop('readonly',true);

                            });


                            inputnilai{{$data->id}}{{ $m->id }}.keypress(function (e) {
                                if (e.which == 13) {

                                        if(nilailawas!=inputnilai{{$data->id}}{{ $m->id }}.val()){
                                        nilai=changeHandler(inputnilai{{$data->id}}{{ $m->id }}.val());
                                                inputnilai{{$data->id}}{{ $m->id }}.val(nilai);

                                                fetch_customer_data(inputnilai{{$data->id}}{{ $m->id }}.val(),siswa{{$data->id}}{{ $m->id }}.val(),master{{$data->id}}{{ $m->id }}.val());
                                }
                                }
                                console.log('kirim update');

                            });

                                //reqex untuk number only
                            // inputnilai{{$data->id}}{{ $m->id }}.inputFilter(function(value) {
                            //                         return /^\d*$/.test(value);    // Allow digits only, using a RegExp
                            //                     });


                            //fungsi kirim data
                            function fetch_customer_data(query = '',siswa='',master='') {
                            console.log(query);
                                $.ajax({
                                    url: "{{ route('api.inputnilaipsikologi') }}",
                                    method: 'GET',
                                    data: {
                                        "_token": "{{ csrf_token() }}",
                                    nilai:query,
                                    siswa:siswa,
                                    master:master,
                                    },
                                    dataType: 'json',
                                    success: function (data) {
                                        console.log(query);
                                        // console.log(data.output);
                                        // $("#datasiswa").html(data.output);
                                        // console.log(data.output);
                                        // console.log(data.datas);
                                    }
                                })
                            }
                        });
                    </script>
                    @endforeach
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
      <form method="post" action="#" enctype="multipart/form-data">
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
</section>
@endsection
