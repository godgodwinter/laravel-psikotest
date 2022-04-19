@extends('layouts.default')

@section('title')
    Terapis Karakter Positif
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
                {{-- <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{route('sekolah')}}">Sekolah</a></div>
            <div class="breadcrumb-item">{{ $id->nama }}</div> --}}
            </div>
        </div>

        <div class="section-body">

            <div id="output-status"></div>
            <div class="row">
                @if (Auth::user()->tipeuser == 'admin')
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
                @push('before-script')
                    <script>
                        var tampilkanData = [];
                        let dataSertifikat = {};
                        let testData = null;
                        // console.log(iqket(113));
                        // console.log(iqket(111));
                        (async () => {
                            const requestOptions = {
                                method: 'POST',
                                headers: {
                                    "Content-Type": "application/json",
                                    "Accept": "application/json",
                                    "X-Requested-With": "XMLHttpRequest",
                                    "X-CSRF-Token": $('input[name="_token"]').val()
                                },
                            };
                            const response = await fetch(
                                "{{ route('sekolah.hasilpsikologi.sertifikat_lihatapi', [$datasiswa->sekolah_id, $datasiswa->id]) }}",
                                requestOptions);
                            let data = await response.json();
                            if (response.ok) {
                                // console.log(data);
                                // document.getElementById('sukses').innerText = sukses;

                                setData(data);
                            } else {
                                console.log('error!');
                            }
                        })();

                        function setData(datas = null) {
                            // console.log(datas);
                            datas.data.forEach(element => {
                                // console.log(element.kunci);
                                testData = !!document.getElementById(element.kunci);
                                dataSertifikat[element.kunci] = element.isi;
                            });


                            //kepribadian
                            let aspekkepribadian = [
                                'hspq_a_kr_persen', 'hspq_a_kr_keterangan', 'hspq_a_kr_rank',
                                'hspq_c_kr_persen', 'hspq_c_kr_keterangan', 'hspq_c_kr_rank',
                                'hspq_d_kr_persen', 'hspq_d_kr_keterangan', 'hspq_d_kr_rank',
                                'hspq_e_kr_persen', 'hspq_e_kr_keterangan', 'hspq_e_kr_rank',
                                'hspq_f_kr_persen', 'hspq_f_kr_keterangan', 'hspq_f_kr_rank',
                                'hspq_g_kr_persen', 'hspq_g_kr_keterangan', 'hspq_g_kr_rank',
                                'hspq_h_kr_persen', 'hspq_h_kr_keterangan', 'hspq_h_kr_rank',
                                'hspq_i_kr_persen', 'hspq_i_kr_keterangan', 'hspq_i_kr_rank',
                                'hspq_j_kr_persen', 'hspq_j_kr_keterangan', 'hspq_j_kr_rank',
                                'hspq_o_kr_persen', 'hspq_o_kr_keterangan', 'hspq_o_kr_rank',
                                'hspq_q2_kr_persen', 'hspq_q2_kr_keterangan', 'hspq_q2_kr_rank',
                                'hspq_q3_kr_persen', 'hspq_q3_kr_keterangan', 'hspq_q3_kr_rank',
                                'hspq_q4_kr_persen', 'hspq_q4_kr_keterangan', 'hspq_q4_kr_rank',
                                'hspq_a_kn_persen', 'hspq_a_kn_keterangan', 'hspq_a_kn_rank',
                                'hspq_c_kn_persen', 'hspq_c_kn_keterangan', 'hspq_c_kn_rank',
                                'hspq_d_kn_persen', 'hspq_d_kn_keterangan', 'hspq_d_kn_rank',
                                'hspq_e_kn_persen', 'hspq_e_kn_keterangan', 'hspq_e_kn_rank',
                                'hspq_f_kn_persen', 'hspq_f_kn_keterangan', 'hspq_f_kn_rank',
                                'hspq_g_kn_persen', 'hspq_g_kn_keterangan', 'hspq_g_kn_rank',
                                'hspq_h_kn_persen', 'hspq_h_kn_keterangan', 'hspq_h_kn_rank',
                                'hspq_i_kn_persen', 'hspq_i_kn_keterangan', 'hspq_i_kn_rank',
                                'hspq_j_kn_persen', 'hspq_j_kn_keterangan', 'hspq_j_kn_rank',
                                'hspq_o_kn_persen', 'hspq_o_kn_keterangan', 'hspq_o_kn_rank',
                                'hspq_q2_kn_persen', 'hspq_q2_kn_keterangan', 'hspq_q2_kn_rank',
                                'hspq_q3_kn_persen', 'hspq_q3_kn_keterangan', 'hspq_q3_kn_rank',
                                'hspq_q4_kn_persen', 'hspq_q4_kn_keterangan', 'hspq_q4_kn_rank',
                            ];


                            var aspekKepribadianRank = [{
                                    nama: 'Faktor Sikap Dingin',
                                    rank: dataSertifikat.hspq_a_kr_rank,
                                    positif_diungkap: dataSertifikat.hspq_a_kr_aspek_positif_di_ungkap,
                                    negatif_diungkap: dataSertifikat.hspq_a_kr_aspek_negatif_di_ungkap
                                },
                                {
                                    nama: 'Faktor Sikap Emosi Labil',
                                    rank: dataSertifikat.hspq_c_kr_rank,
                                    positif_diungkap: dataSertifikat.hspq_c_kr_aspek_positif_di_ungkap,
                                    negatif_diungkap: dataSertifikat.hspq_c_kr_aspek_negatif_di_ungkap
                                },
                                {
                                    nama: 'Faktor Sikap Sulit Bergairah',
                                    rank: dataSertifikat.hspq_d_kr_rank,
                                    positif_diungkap: dataSertifikat.hspq_d_kr_aspek_positif_di_ungkap,
                                    negatif_diungkap: dataSertifikat.hspq_d_kr_aspek_negatif_di_ungkap
                                },
                                {
                                    nama: 'Faktor Patuh atau Tunduk',
                                    rank: dataSertifikat.hspq_e_kr_rank,
                                    positif_diungkap: dataSertifikat.hspq_e_kr_aspek_positif_di_ungkap,
                                    negatif_diungkap: dataSertifikat.hspq_d_kr_aspek_negatif_di_ungkap
                                },
                                {
                                    nama: 'Faktor Sungguh-sungguh',
                                    rank: dataSertifikat.hspq_f_kr_rank,
                                    positif_diungkap: dataSertifikat.hspq_f_kr_aspek_positif_di_ungkap,
                                    negatif_diungkap: dataSertifikat.hspq_f_kr_aspek_negatif_di_ungkap
                                },
                                {
                                    nama: 'Faktor Menolak Peraturan',
                                    rank: dataSertifikat.hspq_g_kr_rank,
                                    positif_diungkap: dataSertifikat.hspq_g_kr_aspek_positif_di_ungkap,
                                    negatif_diungkap: dataSertifikat.hspq_g_kr_aspek_negatif_di_ungkap
                                },
                                {
                                    nama: 'Faktor Sikap Keras Hati',
                                    rank: dataSertifikat.hspq_h_kr_rank,
                                    positif_diungkap: dataSertifikat.hspq_h_kr_aspek_positif_di_ungkap,
                                    negatif_diungkap: dataSertifikat.hspq_h_kr_aspek_negatif_di_ungkap
                                },
                                {
                                    nama: 'Faktor Sikap Pemalu',
                                    rank: dataSertifikat.hspq_i_kr_rank,
                                    positif_diungkap: dataSertifikat.hspq_i_kr_aspek_positif_di_ungkap,
                                    negatif_diungkap: dataSertifikat.hspq_i_kr_aspek_negatif_di_ungkap
                                },
                                {
                                    nama: 'Faktor Sikap Bersemangat',
                                    rank: dataSertifikat.hspq_j_kr_rank,
                                    positif_diungkap: dataSertifikat.hspq_j_kr_aspek_positif_di_ungkap,
                                    negatif_diungkap: dataSertifikat.hspq_j_kr_aspek_negatif_di_ungkap
                                },
                                {
                                    nama: 'Faktor Sikap Percaya Diri',
                                    rank: dataSertifikat.hspq_o_kr_rank,
                                    positif_diungkap: dataSertifikat.hspq_o_kr_aspek_positif_di_ungkap,
                                    negatif_diungkap: dataSertifikat.hspq_o_kr_aspek_negatif_di_ungkap
                                },
                                {
                                    nama: 'Faktor Sikap Kurang Mandiri',
                                    rank: dataSertifikat.hspq_q2_kr_rank,
                                    positif_diungkap: dataSertifikat.hspq_q2_kr_aspek_positif_di_ungkap,
                                    negatif_diungkap: dataSertifikat.hspq_q2_kr_aspek_negatif_di_ungkap
                                },
                                {
                                    nama: 'Faktor Sikap Kurang Disiplin',
                                    rank: dataSertifikat.hspq_q3_kr_rank,
                                    positif_diungkap: dataSertifikat.hspq_q3_kr_aspek_positif_di_ungkap,
                                    negatif_diungkap: dataSertifikat.hspq_q3_kr_aspek_negatif_di_ungkap
                                },
                                {
                                    nama: 'Faktor Sikap Rileks atau santai',
                                    rank: dataSertifikat.hspq_q4_kr_rank,
                                    positif_diungkap: dataSertifikat.hspq_q4_kr_aspek_positif_di_ungkap,
                                    negatif_diungkap: dataSertifikat.hspq_q4_kr_aspek_negatif_di_ungkap
                                },
                                {
                                    nama: 'Faktor Sikap Hangat',
                                    rank: dataSertifikat.hspq_a_kn_rank,
                                    positif_diungkap: dataSertifikat.hspq_a_kn_aspek_positif_di_ungkap,
                                    negatif_diungkap: dataSertifikat.hspq_a_kn_aspek_negatif_di_ungkap
                                },
                                {
                                    nama: 'Faktor Sikap Emosi Stabil',
                                    rank: dataSertifikat.hspq_c_kn_rank,
                                    positif_diungkap: dataSertifikat.hspq_c_kn_aspek_positif_di_ungkap,
                                    negatif_diungkap: dataSertifikat.hspq_c_kn_aspek_negatif_di_ungkap
                                },
                                {
                                    nama: 'Faktor Sikap Bergairah',
                                    rank: dataSertifikat.hspq_d_kn_rank,
                                    positif_diungkap: dataSertifikat.hspq_d_kn_aspek_positif_di_ungkap,
                                    negatif_diungkap: dataSertifikat.hspq_d_kn_aspek_negatif_di_ungkap
                                },
                                {
                                    nama: 'Faktor Sikap Dominasi',
                                    rank: dataSertifikat.hspq_e_kn_rank,
                                    positif_diungkap: dataSertifikat.hspq_e_kn_aspek_positif_di_ungkap,
                                    negatif_diungkap: dataSertifikat.hspq_e_kn_aspek_negatif_di_ungkap
                                },
                                {
                                    nama: 'Faktor Sikap Keceriaan',
                                    rank: dataSertifikat.hspq_f_kn_rank,
                                    positif_diungkap: dataSertifikat.hspq_f_kn_aspek_positif_di_ungkap,
                                    negatif_diungkap: dataSertifikat.hspq_f_kn_aspek_negatif_di_ungkap
                                },
                                {
                                    nama: 'Faktor Sikap Taat Peraturan',
                                    rank: dataSertifikat.hspq_g_kn_rank,
                                    positif_diungkap: dataSertifikat.hspq_g_kn_aspek_positif_di_ungkap,
                                    negatif_diungkap: dataSertifikat.hspq_g_kn_aspek_negatif_di_ungkap
                                },
                                {
                                    nama: 'Faktor Sikap Lembut Hati / Peka',
                                    rank: dataSertifikat.hspq_h_kn_rank,
                                    positif_diungkap: dataSertifikat.hspq_h_kn_aspek_positif_di_ungkap,
                                    negatif_diungkap: dataSertifikat.hspq_h_kn_aspek_negatif_di_ungkap
                                },
                                {
                                    nama: 'Faktor Sikap Pemberani',
                                    rank: dataSertifikat.hspq_i_kn_rank,
                                    positif_diungkap: dataSertifikat.hspq_i_kn_aspek_positif_di_ungkap,
                                    negatif_diungkap: dataSertifikat.hspq_i_kn_aspek_negatif_di_ungkap
                                },
                                {
                                    nama: 'Faktor Sikap Menarik Diri',
                                    rank: dataSertifikat.hspq_j_kn_rank,
                                    positif_diungkap: dataSertifikat.hspq_j_kn_aspek_positif_di_ungkap,
                                    negatif_diungkap: dataSertifikat.hspq_j_kn_aspek_negatif_di_ungkap
                                },
                                {
                                    nama: 'Faktor Sikap Ketakutan',
                                    rank: dataSertifikat.hspq_o_kn_rank,
                                    positif_diungkap: dataSertifikat.hspq_o_kn_aspek_positif_di_ungkap,
                                    negatif_diungkap: dataSertifikat.hspq_o_kn_aspek_negatif_di_ungkap
                                },
                                {
                                    nama: 'Faktor Sikap Mandiri',
                                    rank: dataSertifikat.hspq_q2_kn_rank,
                                    positif_diungkap: dataSertifikat.hspq_q2_kn_aspek_positif_di_ungkap,
                                    negatif_diungkap: dataSertifikat.hspq_q2_kn_aspek_negatif_di_ungkap
                                },
                                {
                                    nama: 'Faktor Sikap Disiplin',
                                    rank: dataSertifikat.hspq_q3_kn_rank,
                                    positif_diungkap: dataSertifikat.hspq_q3_kn_aspek_positif_di_ungkap,
                                    negatif_diungkap: dataSertifikat.hspq_q3_kn_aspek_negatif_di_ungkap
                                },
                                {
                                    nama: 'Faktor Sikap Tegang',
                                    rank: dataSertifikat.hspq_q4_kn_rank,
                                    positif_diungkap: dataSertifikat.hspq_q4_kn_aspek_positif_di_ungkap,
                                    negatif_diungkap: dataSertifikat.hspq_q4_kn_aspek_negatif_di_ungkap
                                },
                            ];
                            aspekKepribadianRank.sort(function(a, b) {
                                return a.rank - b.rank;
                            })
                            //  console.log(aspekKepribadianRank);
                            // document.getElementById('hspq_rank_1_positif').innerHTML += ' <i>1.</i> ' + aspekKepribadianRank[0]
                            //     .positif_diungkap;
                            // document.getElementById('hspq_rank_2_positif').innerHTML += ' 2. ' + aspekKepribadianRank[1].positif_diungkap;
                            // document.getElementById('hspq_rank_3_positif').innerHTML += ' 3. ' + aspekKepribadianRank[2].positif_diungkap;
                            // document.getElementById('hspq_rank_4_positif').innerHTML += ' 4. ' + aspekKepribadianRank[3].positif_diungkap;
                            // document.getElementById('hspq_rank_5_positif').innerHTML += ' 5. ' + aspekKepribadianRank[4].positif_diungkap;
                            getPenjelasanFaktorKepribadian('1', 'hspq_rank_1_positif', aspekKepribadianRank[0].positif_diungkap)
                            getPenjelasanFaktorKepribadian('2', 'hspq_rank_2_positif', aspekKepribadianRank[1].positif_diungkap)
                            getPenjelasanFaktorKepribadian('3', 'hspq_rank_3_positif', aspekKepribadianRank[2].positif_diungkap)
                            getPenjelasanFaktorKepribadian('4', 'hspq_rank_4_positif', aspekKepribadianRank[3].positif_diungkap)
                            getPenjelasanFaktorKepribadian('5', 'hspq_rank_5_positif', aspekKepribadianRank[4].positif_diungkap)
                            console.log(tampilkanData);

                        }

                        //fungsi
                        function splitNamaKarakter(namakarakter = '') {
                            let tempHasil = '';
                            let hasil = '';
                            // tempHasil = namakarakter.split(':');
                            if (namakarakter != 'Sikap Positif Tidak ada') {
                                tempHasil = namakarakter.replace('Sikap', '');
                                tempHasil = tempHasil.replace(':', '');
                                hasil = tempHasil.split(',');
                            }
                            return hasil
                        }

                        function getPenjelasanFaktorKepribadian(nomer = '1', hspq = 'hspq_rank_1_positif', namakarakter = '') {

                            // console.log(splitNamaKarakter(namakarakter));
                            let fetchData = splitNamaKarakter(namakarakter);
                            document.getElementById(hspq).innerHTML = ` <div class="card-header">
                        <h4>${namakarakter}</h4>
                    </div>`;
                            let detailData = [];
                            for (let i = 0; i < fetchData.length; i++) {
                                let tempDetailData = {
                                    id: i,
                                    nama: fetchData[i],
                                    pemahaman: '',
                                    tujuan: '',
                                    pembiasaan: '',
                                };
                                // console.log(fetchData[0]);
                                //fetch data
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
                                            namakarakter: fetchData[i],
                                        })
                                    };
                                    const response = await fetch("{{ route('api.penjelasan_faktorkepribadian') }}",
                                        requestOptions);
                                    let data = await response.json();
                                    // console.log(response);
                                    if (response.ok) {
                                        // tempDetailData = {
                                        //     id: i,
                                        //     nama: fetchData[i],
                                        //     pemahaman: data.data.pemahaman ? data.data.pemahaman : '',
                                        //     tujuan: data.data.tujuandanmanfaat ? data.data.tujuandanmanfaat : '',
                                        //     pembiasaan: data.data.pembiasaansikap ? data.data.pembiasaansikap : '',
                                        // };
                                        document.getElementById(hspq).innerHTML += `
                                    <div class="px-4">
                                        <div class="card-header">
                                    <h4 class="text-capitalize"><i class="fas fa-tag"></i> ${fetchData[i]}</h4>
                                    </div>
                                        <div class="container">
                                            <h5>Pemahaman dan Pengertian</h5>
                                    <p>${data.data.pemahaman}</p>
                                    <h5>Tujuan dan Manfaat</h5>
                                    <p>${data.data.tujuandanmanfaat}</p>
                                    <h5>Pembiasaan Sikap dan Penerapan</h5>
                                    <p>${data.data.pembiasaansikap}</p>
                                    </div>

                                    </div>

                                    `;
                                        // console.log(data.data);


                                        // detailData.push(tempDetailData);
                                        detailData[i].pemahaman = data.data.pemahaman;
                                        detailData[i].tujuandanmanfaat = data.data.tujuandanmanfaat;
                                        detailData[i].pembiasaansikap = data.data.pembiasaansikap;
                                    } else {
                                        console.log('error!');
                                    }

                                    let dataInputanCetak = '';
                                    for (let i = 0; i < tampilkanData.length; i++) {
                                        dataInputanCetak +=
                                            `<input type="hidden" name="data[${i}][id]"  value="${tampilkanData[i].id}">`;
                                        dataInputanCetak +=
                                            `<input type="hidden" name="data[${i}][nama]"  value="${tampilkanData[i].nama}">`;
                                        for (let j = 0; j < tampilkanData[i].detailData.length; j++) {
                                            dataInputanCetak +=
                                                `<input type="hidden" name="data[${i}][detailData][id]"  value="${tampilkanData[i].detailData[j].id}">`;
                                            dataInputanCetak +=
                                                `<input type="hidden" name="data[${i}][detailData][nama]"  value="${tampilkanData[i].detailData[j].nama}">`;
                                            dataInputanCetak +=
                                                `<input type="hidden" name="data[${i}][detailData][pemahaman]"  value="${tampilkanData[i].detailData[j].pemahaman}">`;
                                            dataInputanCetak +=
                                                `<input type="hidden" name="data[${i}][detailData][tujuandanmanfaat]"  value="${tampilkanData[i].detailData[j].tujuandanmanfaat}">`;
                                            dataInputanCetak +=
                                                `<input type="hidden" name="data[${i}][detailData][pembiasaansikap]"  value="${tampilkanData[i].detailData[j].pembiasaansikap}">`;

                                        }
                                    }
                                    document.getElementById('inputanCetak').innerHTML = dataInputanCetak;
                                })();



                                detailData.push(tempDetailData);
                                // console.log(tempDetailData);

                            }
                            tampilkanData.push({
                                id: nomer - 1,
                                nama: namakarakter,
                                detailData: detailData
                            });
                        }
                    </script>
                @endpush
                @push('after-style')
                    <style>
                        td {
                            padding: 2px 2px 2px 2px;
                        }

                    </style>
                @endpush
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
                            <label for="loadLabel" id="loadLabel"></label>
                        </form>
                        {{-- <a href="{{route('sekolah.hasilpsikologi.deteksi_cetak',[$id->id,$datasiswa->id])}}" class="btn btn-primary"> Cetak </a> --}}
                    </div>
                    <div class="ml-4">
                        <div id="hspq_rank_1_positif">
                        </div>


                        <div id="hspq_rank_2_positif">
                        </div>
                        <div id="hspq_rank_3_positif">
                        </div>
                        <div id="hspq_rank_4_positif">
                        </div>
                        <div id="hspq_rank_5_positif">
                        </div>
                    </div>

                    <div class="card-body babengcontainer">




                    </div>



                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
