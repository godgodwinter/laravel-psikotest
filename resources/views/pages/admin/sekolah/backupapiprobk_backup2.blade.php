@extends('layouts.default')

@section('title')
Getting Data from APIPROBK
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
            @push('after-style')
            <meta name="csrf-token" content="{{ csrf_token() }}" />
            @endpush
    @push('before-script')
    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>

    <script>

var dataAkhirDeteksi = [];
var dataAkhir = [];
let jmlDeteksi=0;
let jml=0;
let jmlTersimpan=0;
let jmlDeteksiTersimpan=0;
let progess=0;
let jmlProgress=0;

            // //CONTOH DATA
                let datas = [
                    @foreach ($datas as $data)
                    {
                    id : {{$data->id}},
                    username : '{{$data->username}}',
                    sertifikat :'{{$data->sertifikat}}',
                    sertifikat_tgl : '{{$data->sertifikat_tgl}}',
                    deteksi : '{{$data->deteksi}}',
                    deteksi_tgl : '{{$data->deteksi_tgl}}',
                },
                    @endforeach
                ];

                console.log(datas.length);
                if(datas.length>0){

                    console.log(typeof(datas));


Object.keys(datas).forEach(key => {
//   console.log(datas[key].username);
                    // datas.forEach(function(item){
                        // console.log(item);
                    // }
                // console.log('test');


                (async () => {
                    // POST request using fetch with async/await
                    // const element = document.getElementById('testing');
                    const requestOptions = {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ username: datas[key].username })
                    };
                    const response = await fetch('http://161.97.84.91:9001/api/probk/DataDeteksi_Get', requestOptions);
                    if (response.ok){
                        console.log('ok');
                    }else{
                        console.log('error!')
                    }

                    let data = await response.json();
                    let username = [ datas[key].username ];
                    data.username = datas[key].username;
                    data.apiprobk_id = datas[key].id;
                    console.log(data);
                    jmlDeteksi++;
                    updateProgress(1);

//   console.log(datas[key].username);
                    // $("#Inputan1").html(`
                    // <input type="hidden" value="" name="dataDeteksi" id="dataFormDeteksi">`);

                    // $('#dataFormDeteksi').val(JSON.stringify(dataAkhirDeteksi));

                    // $("#btnsimpan").append(`<input type="button" value="Show list" onclick="console.log(dataAkhir)">`);
                    document.getElementById('jmldataDeteksi').innerText = jmlDeteksi;
            // $.ajax({
            //         url: '{{route('api.apibackupdatafromfedeteksi')}}',
            //         type: 'POST',
            //         enctype: 'multipart/form-data',
            //         data: {data : data},
            //         success: function (result) {
            //             jmlDeteksiTersimpan++;
            //             document.getElementById('dataDeteksiTersimpan').innerText = jmlDeteksiTersimpan;
            //             console.log(result);
            //              updateProgress(1);
            //         }
            //     });
                })();

                //sertifikat
                        (async () => {
                    // POST request using fetch with async/await
                    // const element = document.getElementById('testing');
                    const requestOptions = {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ username: datas[key].username })
                    };
                    const response = await fetch('http://161.97.84.91:9001/api/probk/DataSertifikat_Get', requestOptions);
                    let data = await response.json();
                    data.username = datas[key].username;
                    data.apiprobk_id = datas[key].id;
                    // element.innerHTML = data;
                    console.log(data);
                    jml++;
                    // $("#Inputan2").html(`
                    // <input type="hidden" value="" name="data" id="dataForm">
                    // <button class="btn btn-rounded btn-success">Simpan</button>`);
                    document.getElementById('jmldataSertifikat').innerText = jml;

                    updateProgress(1);
            // $.ajax({
            //         url: '{{route('api.apibackupdatafromfe')}}',
            //         type: 'POST',
            //         enctype: 'multipart/form-data',
            //         data: {data : data},
            //         success: function (result) {
            //             jmlTersimpan++;
            //             document.getElementById('dataSertifikatTersimpan').innerText = jmlTersimpan;
            //             // console.log(result);
            //              updateProgress(1);
            //         }
            //     });

                })();

                function updateProgress($item=1){
                    jmlProgress++;
                    // console.log(jmlProgress);
                    progess=jmlProgress/{{count($datas)*4}}*100;
                    document.getElementById('progress1').innerText = progess.toFixed(2)+'%';
                    document.getElementById('progress1').style.width= progess+'%';
                }

});

                }
console.log(dataAkhir);
    // element.innerHTML = 'tees';

    </script>
    @endpush

            <div class="card-body">
                <div>

                    <a href="{{route('sekolah')}}" class="btn btn-warning">Kembali</a>
                    <div class="mb-5 mt-3" id='Inputan0'>
                        <h4>Total {{count($datas)}} data</h4>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" id="progress1" role="progressbar" style="width:0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                      </div>
                <h1>Proses Get Data From API</h1>
                <div class="row ml-5">
                    <h2 id="jmldataDeteksi" class="mr-3">0 </h2> <h2> Data</h2>
                </div>
                <div class="row ml-5">
                    <h2 id="jmldataSertifikat" class="mr-3">0 </h2>  <h2> Data</h2>
                </div>



                <h1>Proses Backup Data ke Server</h1>
                <div class="row  ml-5">
                    <h2 id="dataDeteksiTersimpan" class="mr-3">0 </h2> <h2> Data</h2>
                </div>
                <div class="row ml-5">
                    <h2 id="dataSertifikatTersimpan" class="mr-3">0 </h2>  <h2> Data</h2>
                </div>


                </div>
                <form method="post" action="{{route('detailsekolah.backuptempfe.store')}}">
                    @csrf
                <div class="mb-5" id='Inputan1'></div>
                <div class="mb-5" id='Inputan2'></div>
            </form>

            <table id="example" class="table table-striped table-bordered " style="width:100%">
                <thead>
                    <tr>
                        <th class="babeng-min-row">No</th>
                        <th>Username</th>
                        <th>Sertifikat</th>
                        <th>Tanggal Backup</th>
                        <th>Deteksi</th>
                        <th>Tanggal Backup</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($datas as $data)
                    <tr>
                        <td class="text-center">{{$loop->index+1}}</td>
                        <td>{{$data->username}}</td>
                        <td>{{$data->sertifikat}}</td>
                        <td>{{$data->sertifikat_tgl}}</td>
                        <td>{{$data->deteksi}}</td>
                        <td>{{$data->deteksi_tgl}}</td>
                        <td></td>
                    </tr>

                    @empty

                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</section>
@endsection

