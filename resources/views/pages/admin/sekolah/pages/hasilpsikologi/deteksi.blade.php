@extends('layouts.default')

@section('title')
Hasil Deteksi Psikologi
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
            <div class="breadcrumb-item"><a href="{{route('sekolah')}}">Sekolah</a></div>
            <div class="breadcrumb-item">{{ $id->nama }}</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">{{$id->nama}}</h2>

        <div id="output-status"></div>
        <div class="row">
            @if (Auth::user()->tipeuser == 'admin' || Auth::user()->tipeuser == 'owner')
          <div class="col-md-3">
            @include('pages.admin.sekolah.component.sidebarsekolah')
        </div>
        <div class="col-md-9">
            @elseif (Auth::user()->tipeuser=='yayasan')
            <div class="col-md-3">
                @include('pages.yayasan.sekolah.component.sidebarsekolah')
          </div>
          <div class="col-md-9">
            @else
        <div class="col-md-12">
            @endif


<div class="card" id="settings-card">
    <div class="card-header">
        <h4>Laporan Deteksi Psikologis   </h4>
        {{-- <form action="{{route('sekolah.hasilpsikologi.deteksi_cetak',[$id->id,$datasiswa->id])}}" method="get" class="d-inline"> --}}
            {{-- @csrf --}}
            <div id="inputanCetak"></div>
            <button class="btn btn-icon btn-warning btn-sm"
                 data-toggle="tooltip" data-placement="top" title="Sedang memuat, Tunggu!"  id="btnCetak" disabled><span
                    class="pcoded-micon"> Menyiapkan Data</span></button>
                    <label for="loadLabel" id="loadLabel"> 0/{{count($masterdeteksi)}}</label>
        {{-- </form> --}}
        {{-- <a href="{{route('sekolah.hasilpsikologi.deteksi_cetak',[$id->id,$datasiswa->id])}}" class="btn btn-primary"> Cetak </a> --}}
    </div>
    <div class="card-header">
        <h4>Gangguan Masalah dan Perkembangan Siswa </h4>
    </div>
    <div class="card-body babengcontainer">
    <table border="0" width="60%">
        <tr><td>No Induk</td><td>:</td><td>{{$datasiswa->nomerinduk}}</td>
        <tr><td>Nama</td><td>:</td><td>{{$datasiswa->nama}}</td>
        <tr><td>Umur</td><td>:</td><td>{{$datasiswa->usia}}</td>
        <tr><td>Jenis Kelamin</td><td>:</td><td>{{$datasiswa->jeniskelamin}}</td>
        <tr><td>Sekolah</td><td>:</td><td>{{$datasiswa->sekolah->nama}}</td>
        </tr>
    </table>
    </div>
    <div class="card-body babengcontainer">
        <h3>I. Deteksi Gangguan Masalah</h3>

        <table id="example" class="table table-striped table-bordered mt-1 table-sm" >
            <thead>
                <tr>
                    <th class="text-center babeng-min-row">
                        No</th>
                    <th class="text-center " > Gangguan Karakter </th>
                    <th class="text-center babeng-min-row" > Rank </th>
                    <th class="text-center babeng-min-row" > % </th>
                    <th class="text-center babeng-min-row" > Ket </th>
                    <th class="text-center" width="40%"> </th>

                </tr>
            </thead>
            <tbody>
                @push('before-script')
                    <script>
                        //deklar var
                            var formCetak=[];
                            var jmlData={{count($masterdeteksi)}};
                            var jmlLoadData=0;
                            var tempData={};
                        //getdata

                        //fungsi/metod
                function gettData(nama=null,id=null){
                (async()=>{
                    const requestOptions = {
                    method: 'POST',
                    headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-Token": $('input[name="_token"]').val()
                    },
                    body: JSON.stringify({nama:nama,})
                    };
                    const response = await fetch("{{route('api.deteksi_lihat_api',[$datasiswa->id])}}", requestOptions);
                    let data = await response.json();
                    if (response.ok){
                    // console.log(data.data);
                    setData(id+"_rank",data.data.rank)
                    setData(id+"_persen",data.data.score)
                    setData(id+"_ket",data.data.keterangan)
                    setGraph(id+"_grap",data.data.score)


                    $("#dataCetak").val(JSON.stringify(formCetak));
                    }else{
                    console.log('error!');
                    }
                    jmlLoadData++;
                    document.getElementById('loadLabel').innerText = jmlLoadData+"/"+jmlData;
                    if(jmlLoadData==jmlData){
                    //  $("#btnCetak").prop('disabled', false);
                     $("#btnCetak").text('Data Berhasil dimuat');
                     $("#btnCetak").removeClass("btn-warning").addClass("btn-info");
                     $("#btnCetak").title('Data Berhasil dimuat');
                    }
                    })();
                }
                function setData(id=null,isi=null){
                    document.getElementById(id).innerText = isi;
                }
                function setGraph(id=null,isi=null){
                     $("#"+id).width(isi+"%");
                  }
                //create function to push data to array formCetak
                // function pushData(id=null,nama=null,rank=null,persen=null,ket=null){
                //     formCetak.push({
                //         id:id,
                //         nama:nama,
                //         rank:rank,
                //         persen:persen,
                //         ket:ket,
                //     });
                // }
                // function cetak(){
                    // console.log(formCetak);
                    // console.log(formCetak[0].id);
                    // console.log(formCetak[0].nama);
                    //
                    </script>

<script>
    $(function () {

@forelse ($masterdeteksi as $master)
        gettData("{{$master->nama}}",{{$master->id}});

    @empty

@endforelse

});
                    </script>

                @endpush
                @forelse ($masterdeteksi as $master)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$master->nama}}</td>

                    <td class="text-center" id="{{$master->id}}_rank">0</td>
                    <td class="text-center" id="{{$master->id}}_persen">0</td>
                    <td class="text-center" id="{{$master->id}}_ket">0</td>
                    <td >
                        <div class="grey_bg" style="width:0%;background-color: #00FFFF"  id="{{$master->id}}_grap">
                            &nbsp;
                        </div>
                    </td>

                    {{-- @php
                        $getdeteksi_list=\App\Models\apiprobk_deteksi_list::where('nama',$master->nama)->where('apiprobk_id',$datasiswa->apiprobk_id)->first();
                    @endphp
                    <td class="text-center">{{$getdeteksi_list->rank}}</td>
                    <td class="text-center">{{$getdeteksi_list->score}}</td>
                    <td class="text-center">{{$getdeteksi_list->keterangan}}</td>
                    <td >
                        <div class="grey_bg" style="width:{{$getdeteksi_list->score}}%;background-color: #00FFFF">
                            &nbsp;
                        </div>
                    </td> --}}
                </tr>
                @empty

                @endforelse
                <tr>
                    <td colspan="2">RATA - RATA NILAI NEGATIF </td>
                    <td> - </td>
                    <td> {{$datas['deteksi_total_persen']}}</td>
                    <td> {{$datas['deteksi_total_keterangan']}}</td>
                    <td >
                        <div class="grey_bg" style="width:{{$datas['deteksi_total_persen']}}%;background-color: #00FFFF">
                            &nbsp;
                        </div>

                    </td>
                </tr>
            </tbody>

        </table>



    </div>

    <div class="card-body babengcontainer">
        <h5>KETERANGAN NEGATIF</h5>
        <table border="0" width="60%">
            <tr><td>91-99</td><td>:</td><td>Sangat Tinggi Sekali / Sangat Mengganggu Sekali (STS)</td>
            <tr><td>81-90</td><td>:</td><td>Tinggi Sekali / Mengganggu Sekali (TS)</td>
            <tr><td>71-80</td><td>:</td><td>Tinggi  / Mengganggu  (T)</td>
            <tr><td>61-70</td><td>:</td><td>Cukup Tinggi  / Cukup Mengganggu (CT)</td>
            <tr><td>41-60</td><td>:</td><td>Cukup / Terkendali (C)</td>
            <tr><td>31-40</td><td>:</td><td>Agak Rendah / Cukup Terkendali (AR)</td>
            <tr><td>21-30</td><td>:</td><td>Rendah / Terkendali Baik (R)</td>
            <tr><td>11-20</td><td>:</td><td>Rendah Sekali / Terkendali Baik Sekali (RS)</td>
            <tr><td>01-10</td><td>:</td><td>Sangat Rendah Sekali / Sangan Terkendali Baik Sekali (SRS)</td>
            </tr>
        </table>
        </div>


    <div class="card-body babengcontainer">
        <h5>KESIMPULAN DAN SARAN</h5>
    </div>

    <div class="card-body babengcontainer">
        <h5>II. EQ (Emotional Quotient): {{$datas['deteksi_eq_total_persen']}} {{$datas['deteksi_eq_total_keterangan']}} </h5>
    </div>

    <div class="card-body babengcontainer">
        <h5>III. SCQ (Social Quotient):  {{$datas['deteksi_scq_total_persen']}} {{$datas['deteksi_scq_total_keterangan']}} </h5>
    </div>


    <div class="card-body babengcontainer">
        <h5>Saat ini anda memiliki Gangguan Karakter :  {{$datas['deteksi_total_persen']}} {{$datas['deteksi_total_keterangan']}} yang dapat menimbulkan masalah dan mengganggu aktivitas
            usaha anda dalam mencapai keberhasilan. Sedangkan karakter negatif yang perlu anda kendalikan dan bersifat merugikan di antaranya yaitu dalam
            Posisi Nilai Cukup Tinggi ke atas sampai nilai Sangat Tinggi Sekali, nilai Cukup perlu diperhatikan dikhawatirkan suatu saat akan mengalami
            perubahan meningkat. </h5>
    </div>

</div>
          </div>
        </div>
    </div>
</section>
@endsection
