<x-cetak-css></x-cetak-css>
<body>
<x-cetak-kop-png></x-cetak-kop-png>

    <div style="margin-bottom: 0;text-align:center" id="judul">
        <h2>CATATAN PENGEMBANGANDIRI SISWA</h2>
        <p for=""></p>
    </div>

    <div id="judul2">
        <h4></h4>
    </div>

    {{-- <center><h2>@yield('title')</h2></center> --}}


    <br>
    <table width="100%" id="tableBiasa2" border="1">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Ide dan Imajinasi</th>
            <th>Ketrampilan</th>
            <th>Kreatif</th>
            <th>Organisasi</th>
            <th>Kelanjutan Studi</th>
            <th>Hobi</th>
            <th>Cita - cita</th>
            <th>Kemampuan Khusus</th>
            <th>Keterangan</th>
        </tr>
        @forelse($datas as $data)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{Fungsi::tanggalindo($data->tanggal)}}</td>
            <td>{{$data->idedanimajinasi}}</td>
            <td>{{$data->ketrampilan}}</td>
            <td>{{$data->kreatif}}</td>
            <td>{{$data->organisasi}}</td>
            <td>{{$data->kelanjutanstudi}}</td>
            <td>{{$data->hobi}}</td>
            <td>{{$data->citacita}}</td>
            <td>{{$data->kemampuankhusus}}</td>
            <td>{{$data->keterangan}}</td>
        </tr>
        @empty

        @endforelse
    </table>



</body>

</html>
