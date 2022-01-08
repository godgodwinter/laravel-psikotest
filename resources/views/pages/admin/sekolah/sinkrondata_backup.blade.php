@extends('layouts.default')

@section('title')
Sinkron Data ke Database Siswa
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
        jQuery(document).ready(function() {

let jml=0;
let jmlDeteksiTersimpan=0;
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
    let data=[{
        id : datas[key].id,
        username : datas[key].username,
    }];
   data.id = datas[key].id;
   data.username = datas[key].username;
    $.ajax({

            url: '{{route('api.sinkronfestore')}}',
            type: 'POST',
            enctype: 'multipart/form-data',
            data: {data : data},
            success: function (result) {
  console.log(data);
                jmlDeteksiTersimpan++;
                document.getElementById('jmlDataDeteksi').innerText = jmlDeteksiTersimpan;
                console.log(result);
                updateProgress(1);
            }
        });
});

                }


        });
        let jmlProgress=0;
        let progess=0;
        function updateProgress($item=1){
                    jmlProgress++;
                    // console.log(jmlProgress);
                    progess=jmlProgress/{{count($datas)}}*100;
                    document.getElementById('progress1').innerText = progess.toFixed(2)+'%';
                    document.getElementById('progress1').style.width= progess+'%';
                }

    </script>
    @endpush

            <div class="card-body">
                <div>

                    <a href="{{route('sekolah')}}" class="btn btn-warning">Kembali</a>
                    <div class="mb-5 mt-3" id='Inputan0'>
                        <h4>Total {{count($datas)}} data</h4>
                    </div>
                <h1>Sinkron data </h1>
                <div class="row ml-5">
                    <h2 id="jmlDataDeteksi" class="mr-3">0 </h2> <h2> Data</h2>
                </div>
                <div class="progress">
                    <div class="progress-bar" id="progress1" role="progressbar" style="width:0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
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
                        <th>Sinkron</th>
                        <th>Tanggal Sinkron</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($datas as $data)
                    <tr>
                        <td class="text-center">{{$loop->index+1}}</td>
                        <td>{{$data->username}}</td>
                        <td>{{$data->sinkron}}</td>
                        <td>{{$data->sinkron_tgl}}</td>
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

