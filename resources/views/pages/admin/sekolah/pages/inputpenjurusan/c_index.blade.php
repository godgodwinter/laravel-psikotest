
    <div class="card-body">


        <form action="{{route('sekolah.penjurusan.cari',$id->id)}}" method="GET" class="babeng-form">
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

<div class="card" id="settings-card">
    <div class="card-header">
        <h4>Bakat dan Penjurusan kelas 2: {{ $kelaspertama!=null?$kelaspertama->nama:'Kelas tidak ditemukan' }}</h4>
    </div>
    <div class="card-body babengcontainer">


        @push('before-script')
<script>
    function getData(link='#',id=null){
        // console.log(link);

        (async()=>{
        const requestOptions = {
        method: 'POST',
        headers: {
        "Content-Type": "application/json",
        "Accept": "application/json",
        "X-Requested-With": "XMLHttpRequest",
        "X-CSRF-Token": $('input[name="_token"]').val()
        },
        };
        const response = await fetch(link, requestOptions);
        let data = await response.json();
        if (response.ok){
        // console.log(data);
        // document.getElementById('sukses').innerText = sukses;
        setData(data,id);
        }else{
        console.log('error!');
        }
        })();
    }
    function setData(datas=null,id=null){
        // console.log(datas);
        datas.data.forEach(element => {

            testData = !!document.getElementById(id+'-'+element.kunci);
                            if (testData===true){
                                // console.log(id+'-'+element.kunci);
                        (async () => {
                             item = element.isi;
                          document.getElementById(id+'-'+element.kunci).innerText = await item;
                        })();
                            }
            // console.log(element.isi);
        });
    }
</script>
@endpush
        <table id="example" class="table table-striped table-bordered mt-1 table-sm" >
            <thead>
                <tr>
                    <th class="text-center babeng-min-row"> No</th>
                    <th class="text-center"> Aksi</th>
                    <th class="th-table" >Nama </th>

                    @foreach ($master as $m)
                    <th class="text-center" style="width:5px">
                        {{$m->nama}}
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
                    <td class="text-center babeng-min-row">
                        {{-- <a class="btn btn-sm btn-info" href="{{ route('sekolah.penjurusan.cetakpersiswa',[$id->id,$data->id])}}"><i class="fas fa-print"></i></a> --}}
                        <x-button-edit link="{{ route('sekolah.penjurusan.edit',[$id->id,$data->id]) }}" />
                    </td>
                    <td class="babeng-td">
                        {{$data->nama}}
                    </td>
                    @foreach ($master as $m)
                    @php
                    $datamenukhusus=null;
                        if($m->menukhusus=='bk'){
                            $jmldata=\App\Models\minatbakatdetail::where('minatbakat_id',$m->id)->where('siswa_id',$data->id)->count();
                            if($jmldata>0){
                            $getmenukhusus=\App\Models\minatbakatdetail::where('minatbakat_id',$m->id)->where('siswa_id',$data->id)->first();
                            $datamenukhusus=$getmenukhusus->nilai;
                            }
                        }
                    @endphp
                    <td id="{{$data->id}}-{{$m->nama}}">{{$datamenukhusus}}</td>
                    @endforeach
@push('before-script')
<script> getData('{{route('api.apiprobk_sertifikat',$data->apiprobk_id)}}',{{$data->id}}); </script>
@endpush
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
