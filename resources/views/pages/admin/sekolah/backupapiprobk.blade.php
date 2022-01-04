@extends('layouts.default')

@section('title')
Backup Data from APIPROBK
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

let progess=0;
let jmlProgress=0;
let diproses=0;
let sukses=0;
let gagal=0;
//fungsi
function getApiDeteksi(id=0,username=0){
    (async () => {
        const requestOptions = {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ username: username })
        };
        const response = await fetch('http://161.97.84.91:9001/api/probk/DataDeteksi_Get', requestOptions);
        let data = await response.json();
        if (response.ok){
            // console.log('ok');
             updateProgress(1);
            data.username = username;
            data.apiprobk_id = id;
            // console.log(data);
             sukses++;
            document.getElementById('sukses').innerText = sukses;
             //getApiSertifikat
        }else{
            // console.log('error!');
             gagal+=4;
            document.getElementById('gagal').innerText = gagal;
            //addObjectKeGagal
            //add 4progress gagal
             updateProgress(1);
             updateProgress(1);
             updateProgress(1);
             updateProgress(1);

        }


    })();

    // console.log('getDeteksi '+ id + '======' + username);
}

function getApiSertifikat(id=0,username=0){

    console.log('getSertifikat');
}

function updateProgress($item=1){
    // console.log('progress');
    jmlProgress++;
    diproses++;
    // console.log(jmlProgress);
    // console.log('Total '+{{count($datas)*4}});
    progess=jmlProgress/{{count($datas)*4}}*100;
    document.getElementById('progress1').innerText = progess.toFixed(2)+'%';
    document.getElementById('progress1').style.width= progess+'%';
    document.getElementById('diproses').innerText = diproses;
}

@foreach ($datas as $data)
getApiDeteksi('{{$data->id}}','{{$data->username}}');
@endforeach


});
    </script>
    @endpush

            <div class="card-body">
                <div>

                    <a href="{{route('sekolah')}}" class="btn btn-warning mb-5">Kembali</a>
                    {{-- <div class="mb-5 mt-3" id='Inputan0'>
                        <h4>Total {{count($datas)}} data</h4>
                    </div> --}}
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                              <div class="card-icon bg-primary">
                                <i class="far fa-user"></i>
                              </div>
                              <div class="card-wrap">
                                <div class="card-header">
                                  <h4>Total Data</h4>
                                </div>
                                <div class="card-body">
                                  {{count($datas)}}
                                </div>
                              </div>
                            </div>
                          </div>
                    <div class="progress" style="height: 40px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-info " id="progress1" role="progressbar" style="width:0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                      </div>
                      <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                          <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                              <i class="far fa-user"></i>
                            </div>
                            <div class="card-wrap">
                              <div class="card-header">
                                <h4>Total Proses</h4>
                              </div>
                              <div class="card-body">
                                {{count($datas)*4}}
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                          <div class="card card-statistic-1">
                            <div class="card-icon bg-danger">
                              <i class="far fa-newspaper"></i>
                            </div>
                            <div class="card-wrap">
                              <div class="card-header">
                                <h4>Telah Diproses</h4>
                              </div>
                              <div class="card-body" id="diproses">
                                0
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                          <div class="card card-statistic-1">
                            <div class="card-icon bg-warning">
                              <i class="far fa-file"></i>
                            </div>
                            <div class="card-wrap">
                              <div class="card-header">
                                <h4>Berhasil</h4>
                              </div>
                              <div class="card-body" id="sukses">
                                0
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                          <div class="card card-statistic-1">
                            <div class="card-icon bg-warning">
                              <i class="far fa-file"></i>
                            </div>
                            <div class="card-wrap">
                              <div class="card-header">
                                <h4>Gagal</h4>
                              </div>
                              <div class="card-body" id="gagal">
                                0
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                {{-- <h1>Proses Get Data From API</h1>
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
            </form> --}}

            {{-- <table id="example" class="table table-striped table-bordered " style="width:100%">
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
            </table> --}}

        </div>
    </div>
</section>
@endsection

