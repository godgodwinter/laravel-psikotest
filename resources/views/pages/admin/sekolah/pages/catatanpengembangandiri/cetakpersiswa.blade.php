<x-cetak-css></x-cetak-css>
<body>
<x-cetak-kop></x-cetak-kop>

    <div style="margin-bottom: 0;text-align:center" id="judul">
        <h2>CATATAN PENGEMBANGANDIRI SISWA</h2>
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
            <td class="babeng-min-row">Ide dan Imajinasi</td>
            <td>:</td>
            <td> {{$datas->idedanimajinasi}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">Ketrampilan</td>
            <td>:</td>
            <td> {{$datas->ketrampilan}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">Kreatif</td>
            <td>:</td>
            <td> {{$datas->kreatif}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">Organisasi</td>
            <td>:</td>
            <td> {{$datas->organisasi}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">Kelanjutan Studi</td>
            <td>:</td>
            <td> {{$datas->kelanjutanstudi}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">Hobi</td>
            <td>:</td>
            <td> {{$datas->hobi}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">Cita-Cita</td>
            <td>:</td>
            <td> {{$datas->citacita}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">Kemampuan Khusus</td>
            <td>:</td>
            <td> {{$datas->kemampuankhusus}}</td>
        </tr>
    </table>



</body>

</html>
