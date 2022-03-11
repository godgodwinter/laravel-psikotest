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
            @if (Auth::user()->tipeuser=='admin')
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



                    document.getElementById('iq').innerText = dataSertifikat.iq+ ' ';
                    document.getElementById('iqket').innerText =iqket(dataSertifikat.iq);
                    document.getElementById('eq_persen').innerText = dataSertifikat.eq_persen+ ' %';
                    document.getElementById('eq_persen_keterangan').innerText = kepanjangan(dataSertifikat.eq_persen_keterangan);
                    document.getElementById('scq_persen').innerText = dataSertifikat.scq_persen+ ' %';
                    document.getElementById('scq_persen_keterangan').innerText = kepanjangan(dataSertifikat.scq_persen_keterangan);
                    // document.getElementById('iq_persen').innerText = 'IV. IQ (KM) 8 Kecerdasan <br>'+ dataSertifikat.iq_persen+' % <br>' + kepanjangan(dataSertifikat.iqh);
                    let iq_persenString=`<div width="100%">IV. IQ (KM) 8 Kecerdasan </div><div> ${dataSertifikat.iq_persen} % </div> <div>Keterangan :  <b>${kepanjangan(dataSertifikat.iqh)}</b></div>`;
                    $('#iq_persen').html(iq_persenString);


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


    var aspekKepribadianRank =[
        {nama:'Faktor Sikap Dingin',rank:dataSertifikat.hspq_a_kr_rank,positif_diungkap:dataSertifikat.hspq_a_kr_aspek_positif_di_ungkap,negatif_diungkap:dataSertifikat.hspq_a_kr_aspek_negatif_di_ungkap
        },
        {nama:'Faktor Sikap Emosi Labil',rank:dataSertifikat.hspq_c_kr_rank,positif_diungkap:dataSertifikat.hspq_c_kr_aspek_positif_di_ungkap,negatif_diungkap:dataSertifikat.hspq_c_kr_aspek_negatif_di_ungkap
        },
        {nama:'Faktor Sikap Sulit Bergairah',rank:dataSertifikat.hspq_d_kr_rank,positif_diungkap:dataSertifikat.hspq_d_kr_aspek_positif_di_ungkap,negatif_diungkap:dataSertifikat.hspq_d_kr_aspek_negatif_di_ungkap
        },
        {nama:'Faktor Patuh atau Tunduk',rank:dataSertifikat.hspq_e_kr_rank,positif_diungkap:dataSertifikat.hspq_e_kr_aspek_positif_di_ungkap,negatif_diungkap:dataSertifikat.hspq_d_kr_aspek_negatif_di_ungkap
        },
        {nama:'Faktor Sungguh-sungguh',rank:dataSertifikat.hspq_f_kr_rank,positif_diungkap:dataSertifikat.hspq_f_kr_aspek_positif_di_ungkap,negatif_diungkap:dataSertifikat.hspq_f_kr_aspek_negatif_di_ungkap
        },
        {nama:'Faktor Menolak Peraturan',rank:dataSertifikat.hspq_g_kr_rank,positif_diungkap:dataSertifikat.hspq_g_kr_aspek_positif_di_ungkap,negatif_diungkap:dataSertifikat.hspq_g_kr_aspek_negatif_di_ungkap
        },
        {nama:'Faktor Sikap Keras Hati',rank:dataSertifikat.hspq_h_kr_rank,positif_diungkap:dataSertifikat.hspq_h_kr_aspek_positif_di_ungkap,negatif_diungkap:dataSertifikat.hspq_h_kr_aspek_negatif_di_ungkap
        },
        {nama:'Faktor Sikap Pemalu',rank:dataSertifikat.hspq_i_kr_rank,positif_diungkap:dataSertifikat.hspq_i_kr_aspek_positif_di_ungkap,negatif_diungkap:dataSertifikat.hspq_i_kr_aspek_negatif_di_ungkap
        },
        {nama:'Faktor Sikap Bersemangat',rank:dataSertifikat.hspq_j_kr_rank,positif_diungkap:dataSertifikat.hspq_j_kr_aspek_positif_di_ungkap,negatif_diungkap:dataSertifikat.hspq_j_kr_aspek_negatif_di_ungkap
        },
        {nama:'Faktor Sikap Percaya Diri',rank:dataSertifikat.hspq_o_kr_rank,positif_diungkap:dataSertifikat.hspq_o_kr_aspek_positif_di_ungkap,negatif_diungkap:dataSertifikat.hspq_o_kr_aspek_negatif_di_ungkap
        },
        {nama:'Faktor Sikap Kurang Mandiri',rank:dataSertifikat.hspq_q2_kr_rank,positif_diungkap:dataSertifikat.hspq_q2_kr_aspek_positif_di_ungkap,negatif_diungkap:dataSertifikat.hspq_q2_kr_aspek_negatif_di_ungkap
        },
        {nama:'Faktor Sikap Kurang Disiplin',rank:dataSertifikat.hspq_q3_kr_rank,positif_diungkap:dataSertifikat.hspq_q3_kr_aspek_positif_di_ungkap,negatif_diungkap:dataSertifikat.hspq_q3_kr_aspek_negatif_di_ungkap
        },
        {nama:'Faktor Sikap Rileks atau santai',rank:dataSertifikat.hspq_q4_kr_rank,positif_diungkap:dataSertifikat.hspq_q4_kr_aspek_positif_di_ungkap,negatif_diungkap:dataSertifikat.hspq_q4_kr_aspek_negatif_di_ungkap
        },
        {nama:'Faktor Sikap Hangat',rank:dataSertifikat.hspq_a_kn_rank,positif_diungkap:dataSertifikat.hspq_a_kn_aspek_positif_di_ungkap,negatif_diungkap:dataSertifikat.hspq_a_kn_aspek_negatif_di_ungkap
        },
        {nama:'Faktor Sikap Emosi Stabil',rank:dataSertifikat.hspq_c_kn_rank,positif_diungkap:dataSertifikat.hspq_c_kn_aspek_positif_di_ungkap,negatif_diungkap:dataSertifikat.hspq_c_kn_aspek_negatif_di_ungkap
        },
        {nama:'Faktor Sikap Bergairah',rank:dataSertifikat.hspq_d_kn_rank,positif_diungkap:dataSertifikat.hspq_d_kn_aspek_positif_di_ungkap,negatif_diungkap:dataSertifikat.hspq_d_kn_aspek_negatif_di_ungkap
        },
        {nama:'Faktor Sikap Dominasi',rank:dataSertifikat.hspq_e_kn_rank,positif_diungkap:dataSertifikat.hspq_e_kn_aspek_positif_di_ungkap,negatif_diungkap:dataSertifikat.hspq_e_kn_aspek_negatif_di_ungkap
        },
        {nama:'Faktor Sikap Keceriaan',rank:dataSertifikat.hspq_f_kn_rank,positif_diungkap:dataSertifikat.hspq_f_kn_aspek_positif_di_ungkap,negatif_diungkap:dataSertifikat.hspq_f_kn_aspek_negatif_di_ungkap
        },
        {nama:'Faktor Sikap Taat Peraturan',rank:dataSertifikat.hspq_g_kn_rank,positif_diungkap:dataSertifikat.hspq_g_kn_aspek_positif_di_ungkap,negatif_diungkap:dataSertifikat.hspq_g_kn_aspek_negatif_di_ungkap
        },
        {nama:'Faktor Sikap Lembut Hati / Peka',rank:dataSertifikat.hspq_h_kn_rank,positif_diungkap:dataSertifikat.hspq_h_kn_aspek_positif_di_ungkap,negatif_diungkap:dataSertifikat.hspq_h_kn_aspek_negatif_di_ungkap
        },
        {nama:'Faktor Sikap Pemberani',rank:dataSertifikat.hspq_i_kn_rank,positif_diungkap:dataSertifikat.hspq_i_kn_aspek_positif_di_ungkap,negatif_diungkap:dataSertifikat.hspq_i_kn_aspek_negatif_di_ungkap
        },
        {nama:'Faktor Sikap Menarik Diri',rank:dataSertifikat.hspq_j_kn_rank,positif_diungkap:dataSertifikat.hspq_j_kn_aspek_positif_di_ungkap,negatif_diungkap:dataSertifikat.hspq_j_kn_aspek_negatif_di_ungkap
        },
        {nama:'Faktor Sikap Ketakutan',rank:dataSertifikat.hspq_o_kn_rank,positif_diungkap:dataSertifikat.hspq_o_kn_aspek_positif_di_ungkap,negatif_diungkap:dataSertifikat.hspq_o_kn_aspek_negatif_di_ungkap
        },
        {nama:'Faktor Sikap Mandiri',rank:dataSertifikat.hspq_q2_kn_rank,positif_diungkap:dataSertifikat.hspq_q2_kn_aspek_positif_di_ungkap,negatif_diungkap:dataSertifikat.hspq_q2_kn_aspek_negatif_di_ungkap
        },
        {nama:'Faktor Sikap Disiplin',rank:dataSertifikat.hspq_q3_kn_rank,positif_diungkap:dataSertifikat.hspq_q3_kn_aspek_positif_di_ungkap,negatif_diungkap:dataSertifikat.hspq_q3_kn_aspek_negatif_di_ungkap
        },
        {nama:'Faktor Sikap Tegang',rank:dataSertifikat.hspq_q4_kn_rank,positif_diungkap:dataSertifikat.hspq_q4_kn_aspek_positif_di_ungkap,negatif_diungkap:dataSertifikat.hspq_q4_kn_aspek_negatif_di_ungkap
        },
        ];
        aspekKepribadianRank.sort(function (a,b) {
        return a.rank - b.rank;
     })
    //  console.log(aspekKepribadianRank);

        for(let i=0;i<aspekkepribadian.length;i++){
                    document.getElementById(aspekkepribadian[i]).innerText = dataSertifikat[aspekkepribadian[i]];
        }

                    document.getElementById('hspq_rank_1').innerText = '1. '+aspekKepribadianRank[0].nama;
                    document.getElementById('hspq_rank_2').innerText = '2. '+aspekKepribadianRank[1].nama;
                    document.getElementById('hspq_rank_3').innerText = '3. '+aspekKepribadianRank[2].nama;
                    document.getElementById('hspq_rank_4').innerText = '4. '+aspekKepribadianRank[3].nama;
                    document.getElementById('hspq_rank_5').innerText = '5. '+aspekKepribadianRank[4].nama;

                    document.getElementById('hspq_rank_1_positif').innerText += ' 1. '+aspekKepribadianRank[0].positif_diungkap;
                    document.getElementById('hspq_rank_2_positif').innerText += ' 2. '+aspekKepribadianRank[1].positif_diungkap;
                    document.getElementById('hspq_rank_3_positif').innerText += ' 3. '+aspekKepribadianRank[2].positif_diungkap;
                    document.getElementById('hspq_rank_4_positif').innerText += ' 4. '+aspekKepribadianRank[3].positif_diungkap;
                    document.getElementById('hspq_rank_5_positif').innerText += ' 5. '+aspekKepribadianRank[4].positif_diungkap;

                    document.getElementById('hspq_rank_1_negatif').innerText += ' 1. '+aspekKepribadianRank[0].negatif_diungkap;
                    document.getElementById('hspq_rank_2_negatif').innerText += ' 2. '+aspekKepribadianRank[1].negatif_diungkap;
                    document.getElementById('hspq_rank_3_negatif').innerText += ' 3. '+aspekKepribadianRank[2].negatif_diungkap;
                    document.getElementById('hspq_rank_4_negatif').innerText += ' 4. '+aspekKepribadianRank[3].negatif_diungkap;
                    document.getElementById('hspq_rank_5_negatif').innerText += ' 5. '+aspekKepribadianRank[4].negatif_diungkap;

                    document.getElementById('tipe_bakat_1').innerText = '- '+dataSertifikat.tipe_bakat_1;
                    document.getElementById('tipe_bakat_2').innerText = '- '+dataSertifikat.tipe_bakat_2;
                    document.getElementById('tipe_bakat_3').innerText = '- '+dataSertifikat.tipe_bakat_3;

                    document.getElementById('minat_pekerjaan_1').innerText = '- '+dataSertifikat.minat_pekerjaan_1 +' '+dataSertifikat.minat_pekerjaan_1_persen;
                    document.getElementById('minat_pekerjaan_2').innerText = '- '+dataSertifikat.minat_pekerjaan_2 +' '+dataSertifikat.minat_pekerjaan_2_persen;
                    document.getElementById('minat_pekerjaan_3').innerText = '- '+dataSertifikat.minat_pekerjaan_3 +' '+dataSertifikat.minat_pekerjaan_3_persen;

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
    var temp = kecerdasan.slice(0);
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

kesimpulansekolahlanjutan=`Kelanjutan studi disarankan masuk Fakultas <b> ${dataSertifikat.saran_fakultas_1} </b> dengan Prodi <b> ${dataSertifikat.saran_fakultas_1_prodi}</b>, Fakultas <b> ${dataSertifikat.saran_fakultas_2} </b> dengan Prodi <b> ${dataSertifikat.saran_fakultas_2_prodi}</b>.`;
let isKelas9 = '{{$iskelas9}}';
if(isKelas9=='ya'){
kesimpulansekolahlanjutan=`Kelanjutan studi disarankan masuk Sekolah <b> ${dataSertifikat.saran_fakultas_1} </b> dengan Jurusan <b> ${dataSertifikat.saran_fakultas_1_prodi}</b>, Sekolah <b> ${dataSertifikat.saran_fakultas_2} </b> dengan Jurusan <b> ${dataSertifikat.saran_fakultas_2_prodi}</b>.`;
}


kesimpulanIq=getKesimpulanIq(dataSertifikat.iq);
// kesimpulanEqSq=getKesimpulanEqSq((dataSertifikat.eq_persen+dataSertifikat.sq_persen)/2);
kesimpulanEqSq=getKesimpulanEqSq(dataSertifikat.iq);
kesimpulankelasakhir='';
if({{$filterkelas}}>0){
    kesimpulankelasakhir=`Dalam kelanjutan studi <b>${kesimpulanIq}</b> tapi perlu ditunjang oleh EQ dan SQ <b>${kesimpulanEqSq}</b> dari potensi kecerdasan yang dimiliki subyek dan menunjukkan adanya upaya keseimbangan antara potensi kecerdasan koqnitif - usaha / semangat didukung oleh emosi positif - kematangan kemampuan sosialnya. ${kesimpulansekolahlanjutan}`;
}

        kesimpulandansaran=`<label>
                        Potensi kecerdasan subyek yang dapat digunakan saat ini <b> ${iqket(dataSertifikat.iq)} </b>,(IQ=<b>${dataSertifikat.iq} </b>, IST KM=<b>${dataSertifikat.km_persen}%)</b> artinya dengan tingkat kemampuan menggunakan kecerdasan majemuk tergolong <b>${kepanjangan(dataSertifikat.kmh)}</b>. Dalam belajar subyek disarankan menggunakan  <b> ${temp[0].nama}, ${temp[1].nama}, ${temp[2].nama}</b>, sedangkan yang perlu dilatih dan dibiasakan yaitu  <b> ${temp[6].nama} dan ${temp[7].nama}</b>. Kecerdasan Emosi nya <b>${kepanjangan(dataSertifikat.eq_persen_keterangan)},(${dataSertifikat.eq_persen}%)</b>. Kecerdasan Sosialnya <b>${kepanjangan(dataSertifikat.scq_persen_keterangan)} (ScQ=${dataSertifikat.scq_persen}%)</b>. Karakter kepribadian subyek yang terkuat dan mempengaruhi aktivitas sehari-hari yaitu <b> ${aspekKepribadianRank[0].nama}, ${aspekKepribadianRank[1].nama}, ${aspekKepribadianRank[2].nama}, ${aspekKepribadianRank[3].nama}, dan ${aspekKepribadianRank[4].nama}  </b> terdiri dari aspek positif dan perlu ditingkatkan, dikembangkan, dan dipertahankan, sedangkan aspek negatif perlu dirubah dan dikendalikan supaya tidak menghambat prestasi subyek. ${kesimpulankelasakhir}
                    </label>`;
                    $( "#kesimpulandansaran" ).append(kesimpulandansaran);

    }

    function kepanjangan(item=null) {
        let hasil="Sangat Baik Sekali";
        if(item=='SBS'){
            hasil="Sangat Baik Sekali";
        }else if(item=='BS'){
            hasil="Baik Sekali";
        }else if(item=='B'){
            hasil="Baik";
        }else if(item=='CB'){
            hasil="Cukup Baik";
        }else if(item=='C'){
            hasil="Cukup";
        }else if(item=='HC'){
            hasil="Hampir Cukup";
        }else if(item=='K'){
            hasil="Kurang";
        }else if(item=='KS'){
            hasil="Kurang Sekali";
        }else if(item=='SKS'){
            hasil="Sangat Kurang Sekali";
        }
        return hasil;
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

    function getKesimpulanIq(item=null){
        hasil="Kurang Lancar";
        if(item>119){
            hasil="Sangat Lancar Sekali";
        }else if((120>item) && (item>=110)){
            hasil="Lancar Sekali";
        }else if((110>item) && (item>=105)){
            hasil="Lancar";
        }else if((105>item) && (item>=90)){
            hasil="Cukup Lancar";
        }else if((90>item) && (item>=80)){
            hasil="Kurang Lancar";
        }else{
            hasil="Sangat Kurang Lancar";
        }
        return hasil;
    }


    function getKesimpulanEqSq(item=null){
        hasil="Lebih Tinggi";
        if(item>119){
            hasil="Seimbang dan Lebih Tinggi";
        }else if((120>item) && (item>=110)){
            hasil="Seimbang dan Lebih Tinggi";
        }else if((110>item) && (item>=105)){
            hasil="Seimbang dan Lebih Tinggi";
        }else if((105>item) && (item>=90)){
             hasil="Lebih Tinggi";
        }else if((90>item) && (item>=80)){
            hasil="Lebih Tinggi";
        }else{
              hasil="Lebih Tinggi";
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
        {{-- <button class="btn btn-primary"> Cetak </button> --}}
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


    <table border="0" width="60%" >
        <tr><td>I. IQ (Intelegence Quotient) / IST </td><td>:</td><td id="iq"></td><td>/</td><td id="iqket"></td></tr>
        <tr><td>II. EQ (Emotional Quotient)  </td><td>:</td><td id="eq_persen"></td><td>/</td><td id="eq_persen_keterangan"></td></tr>
        <tr><td>III. Sc.Q (Social Quotient) </td><td>:</td><td id="scq_persen"></td><td>/</td><td id="scq_persen_keterangan"></td></tr>
    </table>

    <table border="1" width="100%" id="kecerdasanTable" class="table table-striped table-bordered mt-1 table-sm">
        <tr>
            <td id="iq_persen" class="babeng-min-row">IV. IQ (KM) 8 Kecerdasan </td>
            <td>Rank Nilai</td><td>Sangat Kurang Sekali</td><td>Kurang Sekali</td><td>Kurang</td><td>Hampir Cukup</td><td>Cukup</td><td>Kurang Baik</td>
            <td>Baik</td><td>Baik Sekali</td><td>Sangat Baik Sekali</td>
        </tr>
    </table>

    <table border="1" width="100%" id="kepribadianTable"  class="mt-2 table table-striped table-bordered table-sm">
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

    <table border="1" width="100%" id="kepribadianTable"  class="mt-2 table table-striped table-bordered table-sm" >
        <tr>
            <td><strong>IX. Tipe Bakat yang disukai</strong> </td>
        </tr>
        <tr><td id="tipe_bakat_1">-</td></tr>
        <tr><td id="tipe_bakat_2">-</td></tr>
        <tr><td id="tipe_bakat_3">-</td></tr>
    </table>

    <table border="1" width="100%" id="kepribadianTable"  class="mt-2 table table-striped table-bordered table-sm">
        <tr>
            <td><strong>X. Minat Pekerjaan Terkuat</strong> </td>
        </tr>
        <tr><td id="minat_pekerjaan_1">-</td></tr>
        <tr><td id="minat_pekerjaan_2">-</td></tr>
        <tr><td id="minat_pekerjaan_3">-</td></tr>
    </table>


    <div class=" babengcontainer mt-2">
        <h5>X. Kesimpulan dan Saran </h5>
        <div id="kesimpulandansaran"></div>
    </div>

    </div>



</div>
          </div>
        </div>
    </div>
</section>
@endsection
