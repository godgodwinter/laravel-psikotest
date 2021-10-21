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
        <h2>Judul</h2>
        <p for="">Tapel 2019-2020</p>
    </div>

    <div id="judul2">
        <h4>Kelas : VII</h4>
    </div>

    {{-- <center><h2>@yield('title')</h2></center> --}}


    <br>
    <table width="100%" id="tableBiasa">
        <tr>
            <th align="center" class='rotate'>No</th>
            <th align="center">No Induk</th>
            <th align="center">Nama</th>


            @forelse ($masters as $m)
            <th align="center" class='rotate'>
                <div>{{Str::limit($m->nama,3,' ')}}</div>
            </th>

            @empty
            <th> - </th>
            @endforelse

        </tr>
        @forelse ($datas as $data)
        <tr>
            <td align="center">
                {{$loop->index+1}}
            </td>
            <td align="center">{{$data->nomerinduk}}</td>
            <td>{{$data->nama}}</td>
            @forelse ($data->master as $m)
            <td align="center">
                {{$m->nilai}}
            </td>

            @empty
            <td> - </td>

            @endforelse
        </tr>

        @empty
        <tr>
            <td> - </td>
        </tr>

        @endforelse
        <tr>
            <td colspan="3">Rata - rata</td>
            @forelse ($masters as $m)
            <th align="center" class='rotate'>
                {{$m->avg!=0 ? number_format($m->avg,2) : '-' }}
            </th>

            @empty
            <th> - </th>
            @endforelse
        </tr>
        <tr>
            <td colspan="3">Standart Deviasi</td>
            @forelse ($masters as $m)
            <th align="center" class='rotate'>
               -
            </th>

            @empty
            <th> - </th>
            @endforelse
        </tr>
        <tr>
            <td colspan="3">Nilai Terendah</td>
            @forelse ($masters as $m)
            <th align="center" class='rotate'>
                {{$m->min}}
            </th>

            @empty
            <th> - </th>
            @endforelse
        </tr>
        <tr>
            <td colspan="3">Nilai Tertinggi</td>
            @forelse ($masters as $m)
            <th align="center" class='rotate'>
                {{$m->max}}
            </th>

            @empty
            <th> - </th>
            @endforelse
        </tr>
        <tr>
            <td colspan="3">Varian</td>
            @forelse ($masters as $m)
            <th align="center" class='rotate'>
                -
            </th>

            @empty
            <th> - </th>
            @endforelse
        </tr>
        <tr>
            <td colspan="3">Frekuensi</td>
            @forelse ($masters as $m)
            <th align="center" class='rotate'>
                {{$m->frekuensi}}
            </th>

            @empty
            <th> - </th>
            @endforelse
        </tr>

    </table>



</body>

</html>
