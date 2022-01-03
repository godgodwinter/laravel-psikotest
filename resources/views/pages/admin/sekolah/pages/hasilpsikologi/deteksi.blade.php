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
          <div class="col-md-3">
              @include('pages.admin.sekolah.component.sidebarsekolah')
          </div>
          <div class="col-md-9">


<div class="card" id="settings-card">
    <div class="card-header">
        <h4>Laporan Deteksi Psikologis   </h4>
        <button class="btn btn-primary"> Cetak </button>
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
                @forelse ($masterdeteksi as $master)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$master->nama}}</td>
                    @php
                        $getdeteksi_list=\App\Models\apiprobk_deteksi_list::where('nama',$master->nama)->where('apiprobk_id',$datasiswa->apiprobk_id)->first();
                    @endphp
                    <td class="text-center">{{$getdeteksi_list->rank}}</td>
                    <td class="text-center">{{$getdeteksi_list->score}}</td>
                    <td class="text-center">{{$getdeteksi_list->keterangan}}</td>
                    <td >
                        <div class="grey_bg" style="width:{{$getdeteksi_list->score}}%;background-color: #00FFFF">
                            &nbsp;
                        </div>
                    </td>
                     {{--
                    <td>{{$dl->nama}}</td>
                    <td class="text-center">{{$dl->rank}}</td>
                    <td class="text-center">{{$dl->score}}</td>
                    <td class="text-center">{{$dl->keterangan}}</td>
                    <td >
                        <div class="grey_bg" style="width:{{$dl->score}}%;background-color: #00FFFF">
                            &nbsp;
                          <h5>a</h5>
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
                            {{-- <h5>a</h5> --}}
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
        <h5>Saat ini anda memiliki Gangguan Karakter :  {{$datas['deteksi_total_persen']}} {{$datas['deteksi_total_keterangan']}} </h5>
    </div>

</div>
          </div>
        </div>
    </div>
</section>
@endsection
