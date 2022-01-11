
    <div class="card-body">
        <form action="{{route('sekolah.inputminatbakat.cari',$id->id)}}" method="GET" class="babeng-form">
        <div class="row">

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
                        <a class="btn btn-sm btn-info" href="{{ route('sekolah.inputminatbakat.cetakpersiswa',[$id->id,$data->id])}}"><i class="fas fa-print"></i></a>
                        <x-button-edit link="{{ route('sekolah.inputminatbakat.edit',[$id->id,$data->id]) }}" />
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
      <form method="post" action="{{ route('sekolah.inputminatbakat.import',$id->id) }}" enctype="multipart/form-data">
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
