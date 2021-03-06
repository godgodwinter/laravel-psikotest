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

    @push('before-script')
    <script>

var dataAkhirDeteksi = [];
var dataAkhir = [];
let jmlDeteksi=0;
let jml=0;
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
  console.log(datas[key].username);
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
                    let data = await response.json();
                    let username = [ datas[key].username ];
                    Array.prototype.push.apply(data,username);
                    // element.innerHTML = data;
                    // console.log(data);
                    dataAkhirDeteksi.push( data );
                    jmlDeteksi++;
                    $("#Inputan1").html(`
                    <input type="text" value="" name="dataDeteksi" id="dataFormDeteksi">`);

                    $('#dataFormDeteksi').val(JSON.stringify(dataAkhirDeteksi));

                    // $("#btnsimpan").append(`<input type="button" value="Show list" onclick="console.log(dataAkhir)">`);
                    document.getElementById('jmldataDeteksi').innerText = jmlDeteksi;
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
                    let username = [ datas[key].username ];
                    Array.prototype.push.apply(data,username);
                    // element.innerHTML = data;
                    // console.log(data);
                    dataAkhir.push( data );
                    jml++;
                    $("#Inputan2").html(`
                    <input type="hidden" value="" name="data" id="dataForm">
                    <button class="btn btn-rounded btn-success">Simpan</button>`);

                    $('#dataForm').val(JSON.stringify(dataAkhir));

                    // $("#btnsimpan").append(`<input type="button" value="Show list" onclick="console.log(dataAkhir)">`);
                    document.getElementById('jmldataSertifikat').innerText = jml;
                })();

});

                }
console.log(dataAkhir);
    // element.innerHTML = 'tees';
    </script>
    @endpush

            <div class="card-body">
                <div>
                <h2 id="jmldataDeteksi">Jumlah Data</h2>
                <h2 id="jmldataSertifikat">Jumlah Data</h2>
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

