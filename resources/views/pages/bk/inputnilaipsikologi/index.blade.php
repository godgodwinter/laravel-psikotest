@extends('layouts.default')

@section('title')
Data Nilai Psikologi Siswa
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

                        <form action="{{ route('informasipsikologi.cari') }}" method="GET" class="d-inline">
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

                        </form>
                        <button class="btn btn-info"
                        data-toggle="modal" data-target="#modalsettings">Setting</button>

                    </div>
                </div>

                <x-jsmultidel link="{{route('informasipsikologi.multidel')}}" />
                @if($datas->count()>0)
                    <x-jsdatatable/>
                @endif
                <input type="text" name="inputdata">
                <div class="card-body babengcontainer">
                    <table id="example" class="table table-striped table-bordered mt-1" >
                        <thead>
                            <tr id="mastertr">
                                <th class="text-center " width="5%">  No</th>
                                <th class="th-table" >Nama </th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($collectionpenilaian as $data)
                            <tr id="sid{{ $loop->index+1 }}">
                                <td class="text-center">
                                    {{$loop->index+1}}
                                </td>
                                <td class="babeng-td">
                                    {{$data->nama}}
                                </td>
                                @foreach ($data->master as $m)
                                <td class="text-center">
                                    <input class="babenginputnilai text-center text-info " id="inputnilai{{$data->id}}_{{$m->id}}" value="{{$m->nilai}}"
                                    readonly type="text">

                                </td>
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
</section>
@endsection

@section('containermodal')

              <!-- Import Excel -->
              <div class="modal fade" id="modalsettings" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tampilkan</h5>
                      </div>
                      <div class="modal-body">
                        <div class="selectgroup selectgroup-pills">
                            <label class="selectgroup-item">
                              <input type="checkbox" name="masterdata" value="KB" class="selectgroup-input masterdata" >
                              <span class="selectgroup-button">KB</span>
                            </label>
                            <label class="selectgroup-item">
                              <input type="checkbox" name=masterdata" value="KB%" class="selectgroup-input masterdata">
                              <span class="selectgroup-button">KB%</span>
                            </label>
                            <label class="selectgroup-item">
                              <input type="checkbox" name="masterdata" value="KBH" class="selectgroup-input masterdata" >
                              <span class="selectgroup-button">KBH</span>
                            </label>
                            <label class="selectgroup-item">
                              <input type="checkbox" name="masterdata" value="LM" class="selectgroup-input masterdata"  >
                              <span class="selectgroup-button">LM</span>
                            </label>
                            <label class="selectgroup-item">
                              <input type="checkbox" name="masterdata" value="LM%" class="selectgroup-input masterdata"  >
                              <span class="selectgroup-button">LM%</span>
                            </label>
                            <label class="selectgroup-item">
                              <input type="checkbox" name="masterdata" value="LMH" class="selectgroup-input masterdata" >
                              <span class="selectgroup-button">LMH</span>
                            </label>
                            <label class="selectgroup-item">
                              <input type="checkbox" name="masterdata" value="KS" class="selectgroup-input masterdata" >
                              <span class="selectgroup-button">KS</span>
                            </label>
                            <label class="selectgroup-item">
                              <input type="checkbox" name="KS%" value="KS%" class="selectgroup-input masterdata"  >
                              <span class="selectgroup-button">KS%</span>
                            </label>
                          </div>
                      </div>
                      @push('before-script')
<script>
    $( document ).ready(function() {

        let inputdata = $("input[name=inputdata]").val();
        let masterdata=$('.masterdata');
        let tampildatath='';
        let datamaster='';

        function datamasterth(){

            let tampildatath=`
            <th class="text-center"> No </th>
            <th> Nama </th>`;

            masterdata.each(function () {
                    datamaster='';
                    var namamaster = (this.checked ? $(this).val() : "");
                // console.log(namamaster);
                if($(this).prop('checked')==true){
                    tampildatath+=`<th class="text-center">`+namamaster+`</th>`;
                    datamaster+=namamaster;
                }
                $("input[name=inputdata]").val(namamaster);


                });


            $('#mastertr').html(tampildatath);
        }

        masterdata.click(function () {
            if($(this).prop('checked')==true){
                datamasterth();
                // console.log($(this).val()+'=true');
            }else{
                datamasterth();
            }
        });
    });
</script>
                      @endpush
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" >Reset</button>
                      </div>
                    </div>
                </div>
              </div>

@endsection
