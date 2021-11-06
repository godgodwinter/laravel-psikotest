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

                    <div id="babeng-bar" class="d-flex bd-highlight mb-0 align-items-center">
                        <div id="p-2 bd-highlight ">


                        <form action="{{ route('informasipsikologi.cari') }}" method="GET" class="d-inline">
                            {{-- <label for="">Urutkan </label>
                            <select class="babeng babeng-select  ml-2" name="pelajaran_nama">

                                <option>Terbaru</option>
                                <option>Terlama</option>

                                <option>A - Z</option>
                                <option>Z - A</option>
                            </select> --}}

                            <input type="text" class="babeng babeng-select  ml-0" name="cari">
                        </div>
                            <div id="p-2 bd-highlight ">

                            <span>
                                <input class="btn btn-info ml-1 mt-2 mt-sm-0" type="submit" id="babeng-submit"
                                    value="Cari">
                            </span>
                        </div>
                        </form>
                    <div class="ml-auto p-2 bd-highlight ">

                        <button class="btn btn-info"
                        data-toggle="modal" data-target="#modalsettings">Setting</button>
                    </div>
                    </div>
                </div>

                @if($datas->count()>0)
                    <x-jsdatatable/>
                @endif
                <div class="card-body babengcontainer">
                    <table id="example" class="table table-striped table-bordered mt-1" >
                        <thead>
                            <tr id="mastertr">
                                <th class="text-center " width="5%">  No</th>
                                <th class="th-table" >Nama </th>

                            </tr>
                        </thead>
                        <tbody id="masterbody">
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
                              <input type="checkbox" name="masterdata" value="KB%" class="selectgroup-input masterdata">
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
                              <input type="checkbox" name="masterdata" value="KS%" class="selectgroup-input masterdata"  >
                              <span class="selectgroup-button">KS%</span>
                            </label>
                          </div>
                      </div>
                      @push('before-script')
<script>
    $( document ).ready(function() {

        let masterdata=$('.masterdata');
        let tampildatath='';
        let datamaster='';
        let tampildatabody='';

        function datamasterth(){

            let tampildatath=`
            <th class="text-center"> No </th>
            <th> Nama </th>`;

            masterdata.each(function () {
                    datamaster='';
                    tampildatabody='';
                    var namamaster = (this.checked ? $(this).val() : "");
                // console.log(namamaster);
                if($(this).prop('checked')==true){
                    tampildatath+=`<th class="text-center">`+namamaster+`</th>`;
                }
                });


                var allids=[];
                    $("input:checkbox[name=masterdata]:checked").each(function(){
                        allids.push($(this).val());
                    });

            $.ajax({
                url:"{{ route('api.inputnilaipsikologibk') }}",
                type:"GET",
                data:{
                    _token:$("input[name=_token]").val(),
                    ids:allids
                },
                success:function(response){
                    tampildatabody=response.datas;
                    $('#masterbody').html(tampildatabody);
                    $('.cetakdatamaster').val(response.first);
                    $('.cetakdatamaster').val(response.first);
                            Swal.fire({
                                icon: 'success',
                                title: 'Data berhasil dimuat!',
                                // text: 'Something went wrong!',
                                showConfirmButton: true,
                                timer: 1000
                            })
                if($('#cetakdatamaster').val()!=''){
                    $('.cetakgraph').prop('disabled',false);
                    $('.cetakgraph').prop('type','submit');
                }else{
                    // $('.cetakgraph').prop('disabled',true);
                    // $('.cetakgraph').prop('type','button');
                }
                },
                error:function(msg)
                {
                    $('.cetakgraph').prop('disabled',true);
                    $('.cetakgraph').prop('type','button');
                // alert(msg);
                }
            });

                // console.log(allids);
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

                      <form action="{{route('bk.cetak.nilaipsikologi')}}" method="get" class="d-inline">
                        <input type="hidden" name="cetakdatamaster" id="cetakdatamaster"  class="cetakdatamaster">
                            <button type="submit" class="btn btn-success cetakgraph" disabled> <i class="fas fa-print"></i> Cetak</button>
                      </form>
                        <form action="{{route('bk.grafik.nilaipsikologi')}}" method="get" class="d-inline">
                            <input type="hidden" name="cetakdatamaster" id="cetakdatamaster2" class="cetakdatamaster">
                            <button type="submit" class="btn btn-success cetakgraph"  disabled> <i class="fas fa-chart-line"></i> Grafik</button>
                        </form>
                      </div>
                    </div>
                </div>
              </div>

@endsection
