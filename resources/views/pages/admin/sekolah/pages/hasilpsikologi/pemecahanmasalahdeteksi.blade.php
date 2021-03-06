@extends('layouts.default')

@section('title')
    Penanganan Deteksi Masalah
@endsection

@push('before-script')
    @if (session('status'))
        <x-sweetalertsession tipe="{{ session('tipe') }}" status="{{ session('status') }}" />
    @endif
@endpush


@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@yield('title')</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('sekolah') }}">Sekolah</a></div>
                <div class="breadcrumb-item">{{ $id->nama }}</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">{{ $id->nama }}</h2>

            <div id="output-status"></div>
            <div class="row">
                @if (Auth::user()->tipeuser == 'admin' || Auth::user()->tipeuser == 'owner')
                    <div class="col-md-3">
                        @include(
                            'pages.admin.sekolah.component.sidebarsekolah'
                        )
                    </div>
                    <div class="col-md-9">
                    @elseif (Auth::user()->tipeuser == 'yayasan')
                        <div class="col-md-3">
                            @include(
                                'pages.yayasan.sekolah.component.sidebarsekolah'
                            )
                        </div>
                        <div class="col-md-9">
                        @else
                            <div class="col-md-12">
                @endif


                <div class="card" id="settings-card">
                    <div class="card-header">
                        <form action="{{ route('api.cetakPenangananDeteksiMasalah') }}" method="post"
                            class="d-inline">
                            @csrf
                            <div id="inputanCetak"></div>
                            <button class="btn btn-icon btn-warning btn-sm" data-toggle="tooltip" data-placement="top"
                                id="btnCetak" disabled><span class="pcoded-micon">
                                    Menyiapkan
                                    Data</span></button>
                            <label for="loadLabel" id="loadLabel"> 0/{{ count($masterdeteksi) }}</label>
                        </form>
                        {{-- <a href="{{route('sekolah.hasilpsikologi.deteksi_cetak',[$id->id,$datasiswa->id])}}" class="btn btn-primary"> Cetak </a> --}}
                    </div>
                    <div class="card-body babengcontainer">
                        <table border="0" width="60%">
                            <tr>
                                <td>No Induk</td>
                                <td>:</td>
                                <td>{{ $datasiswa->nomerinduk }}</td>
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>{{ $datasiswa->nama }}</td>
                            <tr>
                                <td>Umur</td>
                                <td>:</td>
                                <td>{{ $datasiswa->usia }}</td>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td>{{ $datasiswa->jeniskelamin }}</td>
                            <tr>
                                <td>Sekolah</td>
                                <td>:</td>
                                <td>{{ $datasiswa->sekolah->nama }}</td>
                            </tr>
                        </table>
                    </div>

                    @push('before-script')
                        <script>
                            function singkatan(item = 99) {
                                hasil = "Cukup";
                                if (item > 90) {
                                    hasil = "Sangat Tinggi Sekali / Sangat Mengganggu Sekali";
                                } else if ((91 > item) && (item >= 81)) {
                                    hasil = "Tinggi Sekali / Mengganggu Sekali (TS)";
                                } else if ((81 > item) && (item >= 71)) {
                                    hasil = "Tinggi / Mengganggu";
                                } else if ((71 > item) && (item >= 61)) {
                                    hasil = "Cukup Tinggi / Cukup Mengganggu";
                                } else if ((61 > item) && (item >= 41)) {
                                    hasil = "Cukup / Terkendali ";
                                } else if ((41 > item) && (item >= 31)) {
                                    hasil = "Agak Rendah / Cukup Terkendali ";
                                } else if ((31 > item) && (item >= 21)) {
                                    hasil = "Rendah / Terkendali Baik ";
                                } else if ((21 > item) && (item >= 11)) {
                                    hasil = "Rendah Sekali / Terkendali Baik Sekali";

                                } else {
                                    hasil = "Sangat Rendah Sekali / Sangan Terkendali Baik Sekali ";
                                }
                                return hasil;
                            }
                            //deklar var
                            var formCetak = [];
                            var jmlData = {{ count($masterdeteksi) }};
                            var jmlLoadData = 0;
                            var tempData = {};

                            var tampilkanData = [];
                            var tempTampilkanData = {};
                            //getdata

                            //fungsi/metod
                            function gettData(nama = null, id = null) {
                                (async () => {
                                    const requestOptions = {
                                        method: 'POST',
                                        headers: {
                                            "Content-Type": "application/json",
                                            "Accept": "application/json",
                                            "X-Requested-With": "XMLHttpRequest",
                                            "X-CSRF-Token": $('input[name="_token"]').val()
                                        },
                                        body: JSON.stringify({
                                            nama: nama,
                                        })
                                    };
                                    const response = await fetch("{{ route('api.deteksi_lihat_api', [$datasiswa->id]) }}",
                                        requestOptions);
                                    let data = await response.json();
                                    if (response.ok) {
                                        tempTampilkanData = {};
                                        if (data.data.score > 54.50) {

                                            let batasatas = 70.00;
                                            let batasbawah = 54.50;
                                            // console.log(data.data);
                                            tempTampilkanData['id'] = id;
                                            tempTampilkanData['nama'] = nama;
                                            tempTampilkanData['score'] = data.data.score;
                                            tempTampilkanData['rank'] = data.data.rank;
                                            tempTampilkanData['keterangan'] = data.data.keterangan;
                                            tempTampilkanData['pemecahanmasalah'] = '';


                                            // cari batasbawah dan atas
                                            if (70.00 > data.data.score && data.data.score > 54.50) {
                                                batasatas = 70.00;
                                                batasbawah = 54.50;
                                            } else if (80.00 > data.data.score && data.data.score > 71.00) {
                                                batasatas = 80.00;
                                                batasbawah = 71.00;
                                            } else {
                                                batasatas = 99.00;
                                                batasbawah = 81.00;
                                            }
                                            // console.log(batasatas);
                                            // console.log(batasbawah);
                                            // callfungtiongetKEterangan (id,batasatas,batasbawah)

                                            let jmlTampilkanData = tampilkanData.length;
                                            let tempPemecahanMasalah = getKetPemecahanmasalah(id, batasatas, batasbawah,
                                                jmlTampilkanData);
                                            tempTampilkanData['pemecahanmasalah'] = tempPemecahanMasalah;
                                            // console.log(tempPemecahanMasalah);
                                            tampilkanData.push(tempTampilkanData);



                                            let showTampilkanData = ``;
                                            let dataInputanCetak = '';
                                            dataInputanCetak +=
                                                `<input type="hidden" name="totalData" value="${jmlTampilkanData}">`;
                                            for (i = 0; i < jmlTampilkanData; i++) {
                                                showTampilkanData += `<div class="card-header">
                        <h4 class="text-capitalize">${i+1}.  ${babengCapitalize(tampilkanData[i].nama)} - ${tampilkanData[i].score} % - ${singkatan(tampilkanData[i].score)}</h4>
                    </div>`;
                                                showTampilkanData +=
                                                    `<div class="card-body"><div class="text-capitalize" id="keterangan_${tampilkanData[i].id}">${tampilkanData[i].pemecahanmasalah}</div></div>`;
                                                // append input ke cetak pdf

                                                dataInputanCetak +=
                                                    `<input type="hidden" name="data[${i}][id]"  value="${(tampilkanData[i].id)}">`;
                                                dataInputanCetak +=
                                                    `<input type="hidden" name="data[${i}][nama]"  value="${babengCapitalize(tampilkanData[i].nama)}">`;
                                                dataInputanCetak +=
                                                    `<input type="hidden" name="data[${i}][score]"  value="${(tampilkanData[i].score)}">`;
                                                dataInputanCetak +=
                                                    `<input type="hidden" name="data[${i}][scoresingkatan]"  value="${singkatan(tampilkanData[i].score)}">`;
                                                dataInputanCetak +=
                                                    `<input type="hidden" name="data[${i}][rank]"  value="${(tampilkanData[i].rank)}">`;
                                                dataInputanCetak +=
                                                    `<input type="hidden"  name="data[${i}][keterangan]"  value="${(tampilkanData[i].keterangan)}">`;
                                                dataInputanCetak +=
                                                    `<input type="hidden" name="data[${i}][pemecahanmasalah]"  value="">`;




                                            }
                                            document.getElementById('divTampilkanData').innerHTML = showTampilkanData;
                                            document.getElementById('inputanCetak').innerHTML = dataInputanCetak;

                                            // send to cetak pdf

                                            document.getElementById('inputanCetak').innerHTML +=
                                                `<input type="hidden" name="siswa[nomerinduk]"  value="{{ $datasiswa->nomerinduk }}">`;
                                            document.getElementById('inputanCetak').innerHTML +=
                                                `<input type="hidden" name="siswa[nama]"  value="{{ $datasiswa->nama }}">`;
                                            document.getElementById('inputanCetak').innerHTML +=
                                                `<input type="hidden" name="siswa[usia]"  value="{{ $datasiswa->usia }}">`;
                                            document.getElementById('inputanCetak').innerHTML +=
                                                `<input type="hidden" name="siswa[jeniskelamin]"  value="{{ $datasiswa->jeniskelamin }}">`;
                                            document.getElementById('inputanCetak').innerHTML +=
                                                `<input type="hidden" name="siswa[sekolah]"  value="{{ $datasiswa->sekolah->nama }}">`;
                                            // document.getElementById('inputanCetak').innerHTML +=
                                            //     `<input type="hidden" name="siswa[nama]"  value="${(hasil)}">`;

                                            // console.log(tampilkanData);

                                        }


                                        // $("#dataCetak").val(JSON.stringify(formCetak));
                                    } else {
                                        console.log('error!');
                                    }
                                    jmlLoadData++;
                                    document.getElementById('loadLabel').innerText = jmlLoadData + "/" + jmlData;
                                    if (jmlLoadData == jmlData) {
                                        $("#btnCetak").prop('disabled', false);
                                        $("#btnCetak").text('Cetak Data');
                                        $("#btnCetak").removeClass("btn-warning").addClass("btn-info");
                                        // $("#btnCetak").title('Data Berhasil dimuat');
                                    }
                                })();
                            }

                            function setData(id = null, isi = null) {
                                document.getElementById(id).innerText = isi;
                            }

                            function setGraph(id = null, isi = null) {
                                $("#" + id).width(isi + "%");
                            }

                            function getKetPemecahanmasalah(id = null, batasatas = null, batasbawah = null, jmlTampilkanData = 0) {
                                let hasil = '';
                                const requestOptions = {
                                    method: 'POST',
                                    headers: {
                                        "Content-Type": "application/json",
                                        "Accept": "application/json",
                                        "X-Requested-With": "XMLHttpRequest",
                                        "X-CSRF-Token": $('input[name="_token"]').val()
                                    },
                                    body: JSON.stringify({
                                        id: id,
                                        batasatas: batasatas,
                                        batasbawah: batasbawah,
                                    })
                                };
                                const address = fetch("{{ route('api.pemecahanmasalah') }}",
                                        requestOptions)
                                    .then((response) => response.json())
                                    .then((data) => {
                                        document.getElementById(`keterangan_${id}`).innerHTML = babengCapitalize(data.data);
                                        hasil = data.data;

                                        document.getElementById('inputanCetak').innerHTML +=
                                            `<input type="hidden" name="data[${jmlTampilkanData}][pemecahanmasalah]"  value="${babengCapitalize(hasil)}">`;
                                        // console.log(hasil);
                                        return hasil;
                                    });
                            }

                            function babengCapitalize(string) {
                                return string[0].toUpperCase() + string.slice(1).toLowerCase();
                            }
                        </script>

                        <script>
                            $(function() {
                                async function createObjTampil() {
                                    @forelse ($masterdeteksi as $master)
                                        await gettData("{{ $master->nama }}",{{ $master->id }});

                                    @empty
                                    @endforelse
                                }
                                createObjTampil().then(() => {
                                    //                         console.log(tampilkanData);
                                    //                         let jmlTampilkanData = tampilkanData.length;
                                    //                         let showTampilkanData = ``;
                                    //                         //                 for (i = 0; i < jmlTampilkanData; i++) {
                                    //                         //                     showTampilkanData += `<div class="card-header">
            // //     <h4>${tampilkanData[i].nama}</h4>
            // // </div>`;
                                    //                         //                 }
                                    //                         console.log(showTampilkanData);
                                    //                         document.getElementById('divTampilkanData').innerHTML = showTampilkanData;
                                });

                            });
                        </script>
                    @endpush
                    <div class="card-body babengcontainer">

                        <div id="divTampilkanData">
                        </div>


                    </div>



                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
