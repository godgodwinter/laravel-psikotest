<x-cetak-css></x-cetak-css>
<body>
<x-cetak-kop></x-cetak-kop>

    <div style="margin-bottom: 0;text-align:center" id="judul">
        <h2>CATATAN KASUS SISWA</h2>
        <p for=""></p>
    </div>

    <div id="judul2">
        <h4></h4>
    </div>

    {{-- <center><h2>@yield('title')</h2></center> --}}


    <br>
    <table width="100%" id="tableBiasa">

        <tr>

            <td class="babeng-min-row">No Induk</td>
            <td class="babeng-min-row">:</td>

            <td > {{$datas->siswa->nomerinduk}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">Nama</td>
            <td>:</td>
            <td> {{$datas->siswa->nama}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">Tanggal</td>
            <td>:</td>
            <td> {{Fungsi::tanggalindo($datas->tanggal)}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">Kasus</td>
            <td>:</td>
            <td> {{$datas->kasus}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">Pengambilan Data</td>
            <td>:</td>
            <td> {{$datas->pengambilandata}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">Sumber Kasus</td>
            <td>:</td>
            <td> {{$datas->sumberkasus}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">Golongan Kasus</td>
            <td>:</td>
            <td> {{$datas->golkasus}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">Penyebab Timbul Kasus</td>
            <td>:</td>
            <td> {{$datas->penyebabtimbulkasus}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">Teknik Konseling</td>
            <td>:</td>
            <td> {{$datas->teknikkonseling}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">Keberhasilan Penanganan Kasus</td>
            <td>:</td>
            <td> {{$datas->keberhasilanpenanganankasus}}</td>
        </tr>
    </table>



</body>

</html>
