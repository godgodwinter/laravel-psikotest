<x-cetak-css></x-cetak-css>
<body>
<x-cetak-kop></x-cetak-kop>

    <div style="margin-bottom: 0;text-align:center" id="judul">
        <h2>MINAT DAN BAKAT SISWA</h2>
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

            <td > {{$datas->nomerinduk}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">Nama</td>
            <td>:</td>
            <td> {{$datas->nama}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">Cita cita / Minat 1</td>
            <td>:</td>
            <td> {{$datas->nilai1}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">Cita cita / Minat 2</td>
            <td>:</td>
            <td> {{$datas->nilai2}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">Cita cita / Minat 3</td>
            <td>:</td>
            <td> {{$datas->nilai3}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">Tambahan Cita cita 1</td>
            <td>:</td>
            <td> {{$datas->nilai4}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">Tambahan Cita cita 2</td>
            <td>:</td>
            <td> {{$datas->nilai5}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">Tambahan Cita cita 3</td>
            <td>:</td>
            <td> {{$datas->nilai6}}</td>
        </tr>
    </table>



</body>

</html>
