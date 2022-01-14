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
            {{-- <div class="breadcrumb-item"><a href="{{route('sekolah')}}">Sekolah</a></div> --}}
            <div class="breadcrumb-item">{{ $id->nama }}</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">{{$id->nama}}</h2>

        <div id="output-status"></div>
        <div class="row">
          <div class="col-md-12">
            @push('before-script')
                <script>
                let dataSertifikat={};
                let testData=null;
                // console.log(iqket(113));
                // console.log(iqket(111));
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
                    const response = await fetch("{{route('siswa.hasilpsikologi.sertifikat_lihatapi')}}", requestOptions);
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
            dataSertifikat[element.kunci]=element.isi;
            // console.log(dataSertifikat[element.kunci]);
            // if (testData===true){
            //     console.log(element.kunci);
            //     (async () => {
            //             item = element.isi;
            //         document.getElementById(element.kunci).innerText = await item;
            //         if(element.kunci==='iq'){
            //             itemket = iqket(element.isi);
            //         document.getElementById('iqket').innerText = await itemket;
            //         }

            //     })();

            // }
        });



                    document.getElementById('iq').innerText = dataSertifikat.iq+ ' %';
                    document.getElementById('iqket').innerText =iqket(dataSertifikat.iq);
                    document.getElementById('eq_persen').innerText = dataSertifikat.eq_persen+ ' %';
                    document.getElementById('eq_persen_keterangan').innerText = dataSertifikat.eq_persen_keterangan;
                    document.getElementById('scq_persen').innerText = dataSertifikat.scq_persen+ ' %';
                    document.getElementById('scq_persen_keterangan').innerText = dataSertifikat.scq_persen_keterangan;
                    document.getElementById('iq_persen').innerText = 'IV. IQ (KM) 8 Kecerdasan '+ dataSertifikat.iq_persen+' % ' + dataSertifikat.iqh;


                    //kepribadian
let aspekkepribadian=[
            'hspq_a_kr_persen','hspq_a_kr_keterangan','hspq_a_kr_rank',
            'hspq_c_kr_persen','hspq_c_kr_keterangan','hspq_c_kr_rank',
            'hspq_d_kr_persen','hspq_d_kr_keterangan','hspq_d_kr_rank',
            'hspq_e_kr_persen','hspq_e_kr_keterangan','hspq_e_kr_rank',
            'hspq_f_kr_persen','hspq_f_kr_keterangan','hspq_f_kr_rank',
            'hspq_g_kr_persen','hspq_g_kr_keterangan','hspq_g_kr_rank',
            'hspq_h_kr_persen','hspq_h_kr_keterangan','hspq_h_kr_rank',
            'hspq_i_kr_persen','hspq_i_kr_keterangan','hspq_i_kr_rank',
            'hspq_j_kr_persen','hspq_j_kr_keterangan','hspq_j_kr_rank',
            'hspq_o_kr_persen','hspq_o_kr_keterangan','hspq_o_kr_rank',
            'hspq_q2_kr_persen','hspq_q2_kr_keterangan','hspq_q2_kr_rank',
            'hspq_q3_kr_persen','hspq_q3_kr_keterangan','hspq_q3_kr_rank',
            'hspq_q4_kr_persen','hspq_q4_kr_keterangan','hspq_q4_kr_rank',
            'hspq_a_kn_persen','hspq_a_kn_keterangan','hspq_a_kn_rank',
            'hspq_c_kn_persen','hspq_c_kn_keterangan','hspq_c_kn_rank',
            'hspq_d_kn_persen','hspq_d_kn_keterangan','hspq_d_kn_rank',
            'hspq_e_kn_persen','hspq_e_kn_keterangan','hspq_e_kn_rank',
            'hspq_f_kn_persen','hspq_f_kn_keterangan','hspq_f_kn_rank',
            'hspq_g_kn_persen','hspq_g_kn_keterangan','hspq_g_kn_rank',
            'hspq_h_kn_persen','hspq_h_kn_keterangan','hspq_h_kn_rank',
            'hspq_i_kn_persen','hspq_i_kn_keterangan','hspq_i_kn_rank',
            'hspq_j_kn_persen','hspq_j_kn_keterangan','hspq_j_kn_rank',
            'hspq_o_kn_persen','hspq_o_kn_keterangan','hspq_o_kn_rank',
            'hspq_q2_kn_persen','hspq_q2_kn_keterangan','hspq_q2_kn_rank',
            'hspq_q3_kn_persen','hspq_q3_kn_keterangan','hspq_q3_kn_rank',
            'hspq_q4_kn_persen','hspq_q4_kn_keterangan','hspq_q4_kn_rank',
        ];
        for(let i=0;i<aspekkepribadian.length;i++){
                    document.getElementById(aspekkepribadian[i]).innerText = dataSertifikat[aspekkepribadian[i]];
        }

                    document.getElementById('hspq_rank_1').innerText += ' '+dataSertifikat.hspq_rank_1;
                    document.getElementById('hspq_rank_2').innerText += ' '+dataSertifikat.hspq_rank_2;
                    document.getElementById('hspq_rank_3').innerText += ' '+dataSertifikat.hspq_rank_3;
                    document.getElementById('hspq_rank_4').innerText += ' '+dataSertifikat.hspq_rank_4;
                    document.getElementById('hspq_rank_5').innerText += ' '+dataSertifikat.hspq_rank_5;

                    document.getElementById('hspq_rank_1_positif').innerText += ' 1. '+dataSertifikat.hspq_rank_1_positif;
                    document.getElementById('hspq_rank_2_positif').innerText += ' 2. '+dataSertifikat.hspq_rank_2_positif;
                    document.getElementById('hspq_rank_3_positif').innerText += ' 3. '+dataSertifikat.hspq_rank_3_positif;
                    document.getElementById('hspq_rank_4_positif').innerText += ' 4. '+dataSertifikat.hspq_rank_4_positif;
                    document.getElementById('hspq_rank_5_positif').innerText += ' 5. '+dataSertifikat.hspq_rank_5_positif;

                    document.getElementById('hspq_rank_1_negatif').innerText += ' 1. '+dataSertifikat.hspq_rank_1_negatif;
                    document.getElementById('hspq_rank_2_negatif').innerText += ' 2. '+dataSertifikat.hspq_rank_2_negatif;
                    document.getElementById('hspq_rank_3_negatif').innerText += ' 3. '+dataSertifikat.hspq_rank_3_negatif;
                    document.getElementById('hspq_rank_4_negatif').innerText += ' 4. '+dataSertifikat.hspq_rank_4_negatif;
                    document.getElementById('hspq_rank_5_negatif').innerText += ' 5. '+dataSertifikat.hspq_rank_5_negatif;

                    // document.getElementById('hspq_a_kr_persen').innerText = dataSertifikat.hspq_a_kr_persen;
                    // document.getElementById('hspq_a_kr_keterangan').innerText = dataSertifikat.hspq_a_kr_keterangan;
                    // document.getElementById('hspq_a_kr_rank').innerText = dataSertifikat.hspq_a_kr_rank;
                    // document.getElementById('hspq_rank_1').innerText = dataSertifikat.hspq_rank_1;

        let kecerdasan=[
            {
            nama:"Kecerdasan Linguistik",
            persen:dataSertifikat.kb_persen,
            ket:dataSertifikat.kbh
            },
            {
            nama:"Kecerdasan Logis - Matematis",
            persen:dataSertifikat.lm_persen,
            ket:dataSertifikat.lmh
            },
            {
            nama:"Kecerdasan Spasial",
            persen:dataSertifikat.ks_persen,
            ket:dataSertifikat.ksh
            },
            {
            nama:"Kecerdasan Musikal",
            persen:dataSertifikat.km_persen,
            ket:dataSertifikat.kmh
            },
            {
            nama:"Kecerdasan Kinetik",
            persen:dataSertifikat.kk_persen,
            ket:dataSertifikat.kkh
            },
            {
            nama:"Kecerdasan Interpersonal",
            persen:dataSertifikat.ki_persen,
            ket:dataSertifikat.kih
            },
            {
            nama:"Kecerdasan Intrapersonal",
            persen:dataSertifikat.ka_persen,
            ket:dataSertifikat.kah
            },
            {
            nama:"Kecerdasan Natural",
            persen:dataSertifikat.kn_persen,
            ket:dataSertifikat.knh
            },
    ];
    let temp = kecerdasan.slice(0);
    temp.sort(function (a,b) {
        return b.persen - a.persen;
     })
     for(let i=0;i<temp.length;i++){
        // console.log(JSON.stringify(temp[i])+ ' = ' +(i+1));
        temp[i].rank=i+1;
        silang=getSilang(temp[i].ket);
        $('#kecerdasanTable').append(`
        <tr>
            <td > ${temp[i].nama} </td>
            <td class="text-center">${temp[i].rank}</td>  ${silang}
        </tr>`);
     }
    //  console.log(temp);

    // console.log(kecerdasan);

    silang=getSilang(dataSertifikat.km_p1_keterangan);
    $('#kecerdasanTable').append(`
        <tr>
            <td colspan="2">V. Pengetahuan Umum </td>
           ${silang}
        </tr>`);
    silang=getSilang(dataSertifikat.km_kr_keterangan);
    $('#kecerdasanTable').append(`
        <tr>
            <td colspan="2">VI. Kreativitas </td>
           ${silang}
        </tr>`);
    silang=getSilang(dataSertifikat.km_p9_keterangan);
    $('#kecerdasanTable').append(`
        <tr>
            <td colspan="2">VII. Kemampuan Mengingat </td>
           ${silang}
        </tr>`);


    }

    function iqket(item=null){
        hasil="Moron";
        if(item>139){
            hasil="Genius";
        }else if((140>item) && (item>=130)){
            hasil="Berbakat";
        }else if((130>item) && (item>=120)){
            hasil="Superior";
        }else if((120>item) && (item>=110)){
            hasil="Di Atas Rata - Rata";
        }else if((110>item) && (item>=105)){
            hasil="Rata - Rata Atas";
        }else if((105>item) && (item>=100)){
            hasil="Rata - Rata";
        }else if((100>item) && (item>=90)){
            hasil="Rata - Rata Bawah";
        }else if((90>item) && (item>=80)){
            hasil="Lambat Belajar";
        }else if((80>item) && (item>=60)){
            hasil="Borderline";
        }else{
            hasil="Moron";
        }
        return hasil;

    }
    function getSilang(item='SBS'){
         silang=`<td> </td><td> </td><td> </td><td> </td><td> </td><td> </td>
            <td> </td><td>  </td><td>  </td>`;
        if(item==='SBS'){
         silang=`<td> </td><td> </td><td> </td><td> </td><td> </td><td> </td>
            <td> </td><td>  </td><td class="text-center align-middle"><i class="fas fa-times"></i></td>`;
        }else if(item==='BS'){
         silang=`<td> </td><td> </td><td> </td><td> </td><td> </td><td> </td>
            <td> </td><td class="text-center align-middle"><i class="fas fa-times"></i></td><td>  </td>`;
        }else if(item==='B'){
         silang=`<td> </td><td> </td><td> </td><td> </td><td> </td><td> </td>
         <td class="text-center align-middle"><i class="fas fa-times"></i></td> <td> </td><td>  </td>`;
        }else if(item==='KB'){
         silang=`<td> </td><td> </td><td> </td><td> </td><td> </td><td class="text-center align-middle"><i class="fas fa-times"></i></td><td> </td>
          <td> </td><td>  </td>`;
        }else if(item==='C' || item==='CB'){
         silang=`<td> </td><td> </td><td> </td><td> </td><td class="text-center align-middle"><i class="fas fa-times"></i></td><td> </td><td> </td>
          <td> </td><td>  </td>`;
        }else if(item==='HC' ){
         silang=`<td> </td><td> </td><td> </td><td class="text-center align-middle"><i class="fas fa-times"></i></td><td> </td><td> </td>
          <td> </td><td>  </td><td>  </td>`;
        }else if(item==='K'){
         silang=`<td> </td><td> </td><td class="text-center align-middle"><i class="fas fa-times"></i></td><td> </td><td> </td><td> </td>
          <td> </td><td>  </td><td>  </td>`;
        }else if(item==='KS'){
            silang=`<td> </td><td class="text-center align-middle"><i class="fas fa-times"></i></td><td> </td><td> </td><td> </td><td> </td><td> </td>
            <td> </td><td>  </td>`;
        }else if(item==='SKS'){
         silang=`<td class="text-center align-middle"><i class="fas fa-times"></i></td><td> </td><td> </td><td> </td><td> </td><td> </td><td> </td>
          <td> </td><td>  </td><td>  </td>`;
        }
        return silang;
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
        <tr><td>I. IQ (Intelegence Quotient) / IST </td><td>:</td><td id="iq"></td><td>/</td><td id="iqket"></td></tr>
        <tr><td>II. EQ (Emotional Quotient)  </td><td>:</td><td id="eq_persen"></td><td>/</td><td id="eq_persen_keterangan"></td></tr>
        <tr><td>III. Sc.Q (Social Quotient) </td><td>:</td><td id="scq_persen"></td><td>/</td><td id="scq_persen_keterangan"></td></tr>
    </table>

    <table border="1" width="100%" id="kecerdasanTable" >
        <tr>
            <td id="iq_persen">IV. IQ (KM) 8 Kecerdasan </td>
            <td>Rank Nilai</td><td>Sangat Kurang Sekali</td><td>Kurang Sekali</td><td>Kurang</td><td>Hampir Cukup</td><td>Cukup</td><td>Kurang Baik</td>
            <td>Baik</td><td>Baik Sekali</td><td>Sangat Baik Sekali</td>
        </tr>
    </table>

    <table border="1" width="100%" id="kepribadianTable"  class="mt-2">
        <tr>
            <td>VIII. ASPEK KEPRIBADIAN </td>
            <td class="text-center babeng-min-row">&nbsp; % &nbsp;</td><td class="babeng-min-row">Keterangan</td><td class="babeng-min-row">Rank</td><td width="50%"><strong>Analisa Kepribadian Terkuat</strong></td>
        </tr>
        <tr>
            <td >- Faktor Sikap Dingin </td>
            <td class="text-center" id="hspq_a_kr_persen"> 0 </td>
            <td class="text-center babeng-min-row" id="hspq_a_kr_keterangan"> 0 % </td><td id="hspq_a_kr_rank"> 0 </td>
            <td id="hspq_rank_1"> 1. Faktor Sikap  </td>
        </tr>
        <tr>
            <td >- Faktor Sikap Emosi Labil </td>
            <td class="text-center" id="hspq_c_kr_persen"> 0 </td>
            <td class="text-center" id="hspq_c_kr_keterangan"> 0 % </td><td id="hspq_c_kr_rank"> 0 </td>
            <td id="hspq_rank_2"> 2. Faktor Sikap   </td>
        </tr>
        <tr>
            <td >- Faktor Sikap Sulit Bergairah </td>
            <td class="text-center" id="hspq_d_kr_persen"> 0 </td>
            <td class="text-center" id="hspq_d_kr_keterangan"> 0 % </td><td id="hspq_d_kr_rank"> 0 </td>
            <td id="hspq_rank_3"> 3. Faktor Sikap </td>
        </tr>
        <tr>
            <td >- Faktor Patuh atau Tunduk </td>
            <td class="text-center" id="hspq_e_kr_persen"> 0 </td>
            <td class="text-center" id="hspq_e_kr_keterangan"> 0 % </td><td id="hspq_e_kr_rank"> 0 </td>
            <td id="hspq_rank_4"> 4. Faktor Sikap </td>
        </tr>
        <tr>
            <td >- Faktor Sungguh-sungguh </td>
            <td class="text-center" id="hspq_f_kr_persen"> 0 </td>
            <td class="text-center" id="hspq_f_kr_keterangan"> 0 % </td><td id="hspq_f_kr_rank"> 0 </td>
            <td id="hspq_rank_5"> 5. Faktor Sikap </td>
        </tr>
        <tr>
            <td >- Faktor Menolak Peraturan </td>
            <td class="text-center" id="hspq_g_kr_persen"> 0 </td>
            <td class="text-center" id="hspq_g_kr_keterangan"> 0 % </td><td id="hspq_g_kr_rank"> 0 </td>
            <td > <strong>Faktor Kepribadian Subyek Terkuat Positif (+)</strong>  </td>
        </tr>
        <tr>
            <td >- Faktor Sikap Keras Hati </td>
            <td class="text-center" id="hspq_h_kr_persen"> 0 </td>
            <td class="text-center" id="hspq_h_kr_keterangan"> 0 % </td><td id="hspq_h_kr_rank"> 0 </td>
            <td id="hspq_rank_1_positif">  </td>
        </tr>
        <tr>
            <td >- Faktor Sikap Pemalu </td>
            <td class="text-center" id="hspq_i_kr_persen"> 0 </td>
            <td class="text-center" id="hspq_i_kr_keterangan"> 0 % </td><td id="hspq_i_kr_rank"> 0 </td>
            <td id="hspq_rank_2_positif">  </td>
        </tr>
        <tr>
            <td >- Faktor Sikap Bersemangat </td>
            <td class="text-center" id="hspq_j_kr_persen"> 0 </td>
            <td class="text-center" id="hspq_j_kr_keterangan"> 0 % </td><td id="hspq_j_kr_rank"> 0 </td>
            <td id="hspq_rank_3_positif">  </td>
        </tr>
        <tr>
            <td >- Faktor Sikap Percaya Diri </td>
            <td class="text-center" id="hspq_o_kr_persen"> 0 </td>
            <td class="text-center" id="hspq_o_kr_keterangan"> 0 % </td><td id="hspq_o_kr_rank"> 0 </td>
            <td id="hspq_rank_4_positif">  </td>
        </tr>
        <tr>
            <td >- Faktor Sikap Kurang Mandiri </td>
            <td class="text-center" id="hspq_q2_kr_persen"> 0 </td>
            <td class="text-center" id="hspq_q2_kr_keterangan"> 0 % </td><td id="hspq_q2_kr_rank"> 0 </td>
            <td id="hspq_rank_5_positif">  </td>
        </tr>
        <tr>
            <td >- Faktor Sikap Kurang Disiplin </td>
            <td class="text-center" id="hspq_q3_kr_persen"> 0 </td>
            <td class="text-center" id="hspq_q3_kr_keterangan"> 0 % </td><td id="hspq_q3_kr_rank"> 0 </td>
            <td > <strong>Faktor Kepribadian Subyek Terkuat Negatif (-)</strong>  </td>
        </tr>
        <tr>
            <td >- Faktor Sikap Rileks atau santai </td>
            <td class="text-center" id="hspq_q4_kr_persen"> 0 </td>
            <td class="text-center" id="hspq_q4_kr_keterangan"> 0 % </td><td id="hspq_q4_kr_rank"> 0 </td>
            <td id="hspq_rank_1_negatif">  </td>
        </tr>
        <tr>
            <td >- Faktor Sikap Hangat   </td>
            <td class="text-center" id="hspq_a_kn_persen"> 0 </td>
            <td class="text-center" id="hspq_a_kn_keterangan"> 0 % </td><td id="hspq_a_kn_rank"> 0 </td>
            <td id="hspq_rank_2_negatif">  </td>
        </tr>
        <tr>
            <td >- Faktor Sikap Emosi Stabil   </td>
            <td class="text-center" id="hspq_c_kn_persen"> 0 </td>
            <td class="text-center" id="hspq_c_kn_keterangan"> 0 % </td><td id="hspq_c_kn_rank"> 0 </td>
            <td id="hspq_rank_3_negatif">  </td>
        </tr>
        <tr>
            <td >- Faktor Sikap Bergairah   </td>
            <td class="text-center" id="hspq_d_kn_persen"> 0 </td>
            <td class="text-center" id="hspq_d_kn_keterangan"> 0 % </td><td id="hspq_d_kn_rank"> 0 </td>
            <td id="hspq_rank_4_negatif">  </td>
        </tr>
        <tr>
            <td >- Faktor Sikap Dominasi   </td>
            <td class="text-center" id="hspq_e_kn_persen"> 0 </td>
            <td class="text-center" id="hspq_e_kn_keterangan"> 0 % </td><td id="hspq_e_kn_rank"> 0 </td>
            <td id="hspq_rank_5_negatif">  </td>
        </tr>
        <tr>
            <td >- Faktor Sikap Keceriaan   </td>
            <td class="text-center" id="hspq_f_kn_persen"> 0 </td>
            <td class="text-center" id="hspq_f_kn_keterangan"> 0 % </td><td id="hspq_f_kn_rank"> 0 </td>
            <td id="hspq_rank_1">  </td>
        </tr>
        <tr>
            <td >- Faktor Sikap Taat Peraturan   </td>
            <td class="text-center" id="hspq_g_kn_persen"> 0 </td>
            <td class="text-center" id="hspq_g_kn_keterangan"> 0 % </td><td id="hspq_g_kn_rank"> 0 </td>
            <td id="hspq_rank_1">  </td>
        </tr>
        <tr>
            <td >- Faktor Sikap Lembut Hati / Peka   </td>
            <td class="text-center" id="hspq_h_kn_persen"> 0 </td>
            <td class="text-center" id="hspq_h_kn_keterangan"> 0 % </td><td id="hspq_h_kn_rank"> 0 </td>
            <td id="hspq_rank_1">  </td>
        </tr>
        <tr>
            <td >- Faktor Sikap Pemberani   </td>
            <td class="text-center" id="hspq_i_kn_persen"> 0 </td>
            <td class="text-center" id="hspq_i_kn_keterangan"> 0 % </td><td id="hspq_i_kn_rank"> 0 </td>
            <td id="hspq_rank_1">  </td>
        </tr>
        <tr>
            <td >- Faktor Sikap Menarik Diri   </td>
            <td class="text-center" id="hspq_j_kn_persen"> 0 </td>
            <td class="text-center" id="hspq_j_kn_keterangan"> 0 % </td><td id="hspq_j_kn_rank"> 0 </td>
            <td id="hspq_rank_1">  </td>
        </tr>
        <tr>
            <td >- Faktor Sikap Ketakutan   </td>
            <td class="text-center" id="hspq_o_kn_persen"> 0 </td>
            <td class="text-center" id="hspq_o_kn_keterangan"> 0 % </td><td id="hspq_o_kn_rank"> 0 </td>
            <td id="hspq_rank_1">  </td>
        </tr>
        <tr>
            <td >- Faktor Sikap Mandiri    </td>
            <td class="text-center" id="hspq_q2_kn_persen"> 0 </td>
            <td class="text-center" id="hspq_q2_kn_keterangan"> 0 % </td><td id="hspq_q2_kn_rank"> 0 </td>
            <td id="hspq_rank_1">  </td>
        </tr>
        <tr>
            <td >- Faktor Sikap Disiplin   </td>
            <td class="text-center" id="hspq_q3_kn_persen"> 0 </td>
            <td class="text-center" id="hspq_q3_kn_keterangan"> 0 % </td><td id="hspq_q3_kn_rank"> 0 </td>
            <td id="hspq_rank_1">  </td>
        </tr>
        <tr>
            <td >- Faktor Sikap Tegang   </td>
            <td class="text-center" id="hspq_q4_kn_persen"> 0 </td>
            <td class="text-center" id="hspq_q4_kn_keterangan"> 0 % </td><td id="hspq_q4_kn_rank"> 0 </td>
            <td id="hspq_rank_1">  </td>
        </tr>
    </table>


    </div>



</div>
          </div>
        </div>
    </div>
</section>
@endsection
