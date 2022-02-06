<x-cetak-css></x-cetak-css>
<body>
<x-cetak-kop-png></x-cetak-kop-png>

    <div style="margin-bottom: 0;text-align:center" id="judul">
        CATATAN PRESTASI SISWA
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
            <th>Prestasi</th>
            <th>Teknik Belajar</th>
            <th>Sarana Belajar</th>
            <th>Penunjang Belajar</th>
            <th>Kesimpulan dan Saran</th>
        </tr>
        @forelse($datas as $data)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{Fungsi::tanggalindo($data->tanggal)}}</td>
            <td>{{$data->prestasi}}</td>
            <td>{{$data->teknikbelajar}}</td>
            <td>{{$data->saranabelajar}}</td>
            <td>{{$data->penunjangbelajar}}</td>
            <td>{{$data->kesimpulandansaran}}</td>
        </tr>
        @empty

        @endforelse
    </table>



</body>

</html>
