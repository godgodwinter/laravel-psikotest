@section('title')Cetak Data
@endsection
<html>

<head>
    <title>@yield('title')</title>
</head>

<body>
    <style type="text/css">
        table {
            border-spacing: 0;
            margin: 2px;
        }

        th {
            padding: 5px;
        }

        td {
            padding: 5px;
            height: 10px;
            /* border: 1px black solid; */
            padding: 5px;
        }

        table tr td,
        table tr th {
            font-size: 12px;
            font-family: Georgia, 'Times New Roman', Times, serif;
        }


        body {
            font-size: 12px;
            font-family: Georgia, 'Times New Roman', Times, serif;
        }

        h1 h2 h3 h4 h5 {
            margin: auto;
            display: inline-block;
            /* line-height: 1.2; */
        }

        label {
            padding: 0;
        }

        .spa {
            letter-spacing: 3px;
        }

        hr.style2 {}


        .rotate {
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            width: 1.5em;
        }

        .rotate div {
            -moz-transform: rotate(90.0deg);
            /* FF3.5+ */
            -o-transform: rotate(90.0deg);
            /* Opera 10.5 */
            -webkit-transform: rotate(90.0deg);
            /* Saf3.1+, Chrome */
            filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083);
            /* IE6,IE7 */
            -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083)";
            /* IE8 */
            margin-left: -10em;
            margin-right: -10em;
            /* text-orientation: upright; */
        }

        table#tableKop,
        table#tableKop>tr>th,
        table#tableKop>tr>td {
            /* background-color: red; */
            border: 0px black solid;
            border-collapse: collapse;
            /* padding: 0; */
            margin-bottom: 0;
            padding-bottom: 0;
            /* margin: 0; */
        }

        table#tableKop {
            border-bottom: 3px double #8c8b8b;
        }

        table#tableBiasa,
        tr,
        th {
            border: 1px black solid;
            border-collapse: collapse;
            margin-top: 0px;
            height: 30px;
        }
        table#tableBiasa tr td{
            border: 1px black solid;
            border-collapse: collapse;
            margin-top: 0px;
        }

        div#judul,
        h2,
        p {
            padding: 0;
            margin: 0;
        }

        div#judul2,
        h4 {
            display: inline-block;
            padding: 0;
            margin: 0;
        }

    </style>
    <table width="100%" id="tableKop">
        <tr>
            <td width="13%" align="right" style="padding-bottom:15px"><img src="{{Fungsi::lembaga_logo()}}" width="70" height="70"></td>
            <td width="80%" align="center">
                <p><b>
                        <font size="18px">{{Fungsi::lembaga_nama()}} </font>
                    </b><br>
                    <font size="16px"> {{Fungsi::lembaga_jalan()}} Telp. {{Fungsi::lembaga_telp()}} {{Fungsi::lembaga_kota()}}</font>



            </td>
        </tr>

    </table>

    <div style="margin-bottom: 0;text-align:center" id="judul">
        <h2>REKAP CATATAN KASUS SISWA</h2>
        <p for=""></p>
    </div>

    <div id="judul2">
        <h4></h4>
    </div>

    {{-- <center><h2>@yield('title')</h2></center> --}}


    <br>
    <table width="100%" id="tableBiasa">
        <tr>
            <th align="center" class='rotate'>No</th>
            <th align="center">Tanggal</th>
            <th align="center">Nama</th>
            <th align="center">Kelas</th>
            <th align="center">Kasus</th>
            <th align="center">Pengambilan Data</th>
            <th align="center">Sumber Kasus</th>
            <th align="center">Golongan Kasus</th>
            <th align="center">Penyebab Timbul Kasus</th>
            <th align="center">Teknik Konseling</th>
            <th align="center">Keberhasilan Penanganan Kasus</th>
            <th align="center">Keterangan</th>

        </tr>
        @forelse ($datas as $data)
        <tr>
            <td align="center">
                {{$loop->index+1}}
            </td>
            <td align="center">{{$data->tanggal}}</td>
            <td>{{$data->siswa->nama}}</td>

            <td align="center"> {{$data->kelas->nama}}</td>
            <td align="center"> {{$data->kasus}}</td>
            <td align="center"> {{$data->pengambilandata}}</td>
            <td align="center"> {{$data->sumberkasus}}</td>
            <td align="center"> {{$data->golkasus}}</td>
            <td align="center"> {{$data->penyebabtimbulkasus}}</td>
            <td align="center"> {{$data->teknikkonseling}}</td>
            <td align="center"> {{$data->keberhasilanpenanganankasus}}</td>
            <td align="center"> {{$data->keterangan}}</td>
        </tr>

        @empty
        <tr>
            <td> - </td>
        </tr>

        @endforelse

    </table>



</body>

</html>
