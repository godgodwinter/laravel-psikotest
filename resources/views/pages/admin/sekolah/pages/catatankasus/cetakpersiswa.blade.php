<x-cetak-css></x-cetak-css>
<body>
<x-cetak-kop-png></x-cetak-kop-png>

    <div style="margin-bottom: 0;text-align:center" id="judul">
        CATATAN KASUS SISWA
        <p for=""></p>
    </div>

    <div id="judul2">
        <h4></h4>
    </div>
    {{-- <center><h2>@yield('title')</h2></center> --}}
    <table>
        <tr>
            <td>Nama </td> <td>:</td> <td>{{$data->nama}}</td>
        </tr>
        <tr>
            <td>Kelas </td> <td>:</td> <td>{{$data->kelas?$data->kelas->nama:'Data Kelas tidak ditemukan'}}</td>
        </tr>
    </table>
    <br>
    <table width="100%" id="tableBiasa2" border="1">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Kasus</th>
            <th>Pengambilan Data</th>
            <th>Sumber Kasus</th>
            <th>Golongan Kasus</th>
            <th>Penyebab</th>
            <th>Teknik Konseling</th>
            <th>Keberhasilan Penanganan</th>
            <th>Keterangan</th>
        </tr>
        @forelse($datas as $data)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{Fungsi::tanggalindo($data->tanggal)}}</td>
            <td>{{$data->kasus}}</td>
            <td>{{$data->pengambilandata}}</td>
            <td>{{$data->sumberkasus}}</td>
            <td>{{$data->golkasus}}</td>
            <td>{{$data->penyebabtimbulkasus}}</td>
            <td>{{$data->teknikkonseling}}</td>
            <td>{{$data->keberhasilanpenanganankasus}}</td>
            <td>{{$data->keterangan}}</td>
        </tr>
        @empty

        @endforelse
    </table>



</body>

</html>
