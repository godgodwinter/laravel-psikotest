<x-cetak-css></x-cetak-css>
<body>
<x-cetak-kop></x-cetak-kop>

    <div style="margin-bottom: 0;text-align:center" id="judul">
        <h2>CATATAN PRESTASI SISWA</h2>
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
            <td class="babeng-min-row">Prestasi</td>
            <td>:</td>
            <td> {{$datas->prestasi}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">Teknik Belajar</td>
            <td>:</td>
            <td> {{$datas->teknikbelajar}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">Kesimpulan dan Saran</td>
            <td>:</td>
            <td> {{$datas->kesimpulandansaran}}</td>
        </tr>
    </table>



</body>

</html>
