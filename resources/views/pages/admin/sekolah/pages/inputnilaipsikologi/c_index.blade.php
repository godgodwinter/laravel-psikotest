
    <div class="card-body">
        <div id="babeng-row ">

            <form action="{{route('sekolah.masternilaibidangstudi.cari',$id->id)}}" method="GET" class="babeng-form">
                <input type="text" class="babeng babeng-select  ml-0" name="cari">

                <span>
                    <input class="btn btn-info ml-1 mt-2 mt-sm-0" type="submit" id="babeng-submit" value="Cari">
                </span>

                <a href="{{route('sekolah.masternilaibidangstudi.create',$id->id)}}" type="submit" value="Import"
                    class="btn btn-icon btn-primary btn-sm ml-2"><span class="pcoded-micon"> <i
                            class="fas fa-download"></i> Tambah </span></a>
                {{-- <button type="button" class="btn btn-icon btn-primary btn-sm ml-0 ml-sm-0" data-toggle="modal"
                    data-target="#importExcel"><i class="fas fa-upload"></i>
                    Import
                </button>
                <a href="/admin/sekolah/export" type="submit" value="Import"
                    class="btn btn-icon btn-primary btn-sm mr-2"><span class="pcoded-micon"> <i
                            class="fas fa-download"></i> Export </span></a> --}}
            </form>
        </div>

    </div>

<div class="card" id="settings-card">
    <div class="card-header">
        <h4>Master Nilai Psikologi </h4>
    </div>
    <div class="card-body babengcontainer">
        <div id="babeng-bar" class="text-right mt-2">

        </div>


        <table id="example" class="table table-striped table-bordered mt-1" >
            <thead>
                <tr>
                    <th class="text-center "> <input type="checkbox" id="chkCheckAll"> All</th>
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
