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

var dataAkhir = [];
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
                    const element = document.getElementById('testing');
                    const requestOptions = {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ username: datas[key].username })
                    };
                    const response = await fetch('http://161.97.84.91:9001/api/probk/DataSertifikat_Get', requestOptions);
                    const data = await response.json();
                    // element.innerHTML = data;
                    // console.log(data);
                    dataAkhir.push( data );
                    jml++;
                    document.getElementById('jmldata').innerText
                = jml;
                })();

});

                }
console.log(dataAkhir);
    // element.innerHTML = 'tees';
    </script>
    @endpush

            <div class="card-body">
                <div>
                <h2 id="jmldata">Jumlah Data</h2>
                </div>
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

