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

var dataAkhirDeteksi = [];
var dataAkhir = [];
let jmlDeteksi=0;
let jml=0;
let jmlTersimpan=0;
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
  console.log(datas[key].username);
});

                }
    </script>
    @endpush

            <div class="card-body">
                <div>
                    <div class="mb-5" id='Inputan0'>
                        <h4>Total {{count($datas)}} data</h4>
                    </div>
                <h1>Sinkron data Deteksi</h1>
                <div class="row ml-5">
                    <h2 id="jmlDataDeteksi" class="mr-3">0 </h2> <h2> Data</h2>
                </div>



                <h1>Sinkron data Sertifikat</h1>
                <div class="row  ml-5">
                    <h2 id="jmlDataSertifikat" class="mr-3">0 </h2> <h2> Data</h2>
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
                        <td>{{$data->sertifikatsinkron}}</td>
                        <td>{{$data->sertifikatsinkron_tgl}}</td>
                        <td>{{$data->deteksisinkron}}</td>
                        <td>{{$data->deteksisinkron_tgl}}</td>
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

