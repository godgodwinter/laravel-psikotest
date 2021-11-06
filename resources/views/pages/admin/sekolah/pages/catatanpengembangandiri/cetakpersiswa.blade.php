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
            border: 1px white solid;
            border-collapse: collapse;
            margin-top: 0px;
            height: 30px;
        }
        table#tableBiasa tr td{
            border: 1px white solid;
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

        .babeng-min-row{
    width: 1%;
    white-space: nowrap;
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
