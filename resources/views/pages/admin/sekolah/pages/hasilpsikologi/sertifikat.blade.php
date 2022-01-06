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
            @push('before-script')
                <script>
                let dataSertifikat=null;
                let testData=null;
                console.log(iqket(111));
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
                    const response = await fetch("{{route('sekolah.hasilpsikologi.sertifikat_lihatapi',[$datasiswa->sekolah_id,$datasiswa->id])}}", requestOptions);
                    let data = await response.json();
                    if (response.ok){
                    // console.log(data);
                    // document.getElementById('sukses').innerText = sukses;
                    setData(data);
                    }else{
                    console.log('error!');
                    }
                    })();


    function setData(datas=null){
        // console.log(datas);
        datas.data.forEach(element => {
            // console.log(element.kunci);
            testData = !!document.getElementById(element.kunci);
            if (testData===true){
                // console.log(element.kunci);
                (async () => {
                        item = element.isi;
                    document.getElementById(element.kunci).innerText = await item;
                })();
            }
        });
    }

    function iqket(item=null){
        hasil="Moron";
        if(item>139){
            hasil="Genius";
        }else if((140<item) && (item>=130)){
            hasil="Berbakat";
        }else if((130<item) && (item>=120)){
            hasil="Superior";
        }else if((120<item) && (item>=110)){
            hasil="Di Atas Rata - Rata";
        }else if((110<item) && (item>=105)){
            hasil="Rata - Rata Atas";
        }else if((105<item) && (item>=100)){
            hasil="Rata - Rata";
        }else if((100<item) && (item>=90)){
            hasil="Rata - Rata Bawah";
        }else if((90<item) && (item>=80)){
            hasil="Lambat Belajar";
        }else if((80<item) && (item>=60)){
            hasil="Borderline";
        }else{
            hasil="Moron";
        }
        return hasil;

    }
                </script>
            @endpush

<div class="card" id="settings-card">
    <div class="card-header">
        <h4>Laporan Sertifikat Psikologis   </h4>
        <button class="btn btn-primary"> Cetak </button>
    </div>
    <div class="card-header">
        <h4>Identitas </h4>
    </div>
    <div class="card-body babengcontainer">
    <table border="0" width="60%">
        <tr><td>Nama</td><td>:</td><td>{{$datasiswa->nama}}</td>
        <tr><td>Umur</td><td>:</td><td>{{$datasiswa->usia}}</td>
        <tr><td>Pendidikan</td><td>:</td><td>{{$datasiswa->sekolah->nama}}</td>
        {{-- <tr><td>Tanggal Pemeriksaan</td><td>:</td><td>{{$datasiswa->nama}}</td> --}}
        </tr>
    </table>
    </div>
    <div class="card-body babengcontainer">
        <h3>ASPEK PSIKOLOGIS YANG DIUNGKAP</h3>


    <table border="0" width="60%">
        <tr><td>IQ (Intelegence Quotient) / IST </td><td>:</td><td id="iq"></td>
        <tr><td>IQ (Intelegence Quotient) / IST </td><td>:</td><td id="iq"></td>
        {{-- <tr><td>Tanggal Pemeriksaan</td><td>:</td><td>{{$datasiswa->nama}}</td> --}}
        </tr>
    </table>



    </div>



</div>
          </div>
        </div>
    </div>
</section>
@endsection
