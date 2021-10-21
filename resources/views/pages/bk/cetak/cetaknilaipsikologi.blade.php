@section('title')Cetak Data
{{-- Laporan Pemasukan dan Pengeluaran di {{ $settings->sekolahnama }} --}}
@endsection

@section('kepsek')
asda
@endsection

@section('alamat')
asd23
@endsection

@section('telp')
qwe
@endsection

@section('namasekolah')
zxc
@endsection

@section('logo','logoyayasan.png')

{{-- DATATABLE --}}



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
                display: flex;
                padding: 2em;
            }
        td {
                padding: 5px;
            }
            table tr td,
            table tr th{
                font-size: 12px;
                font-family: Georgia, 'Times New Roman', Times, serif;
            }
            td{
                height:10px;
            }
            body {
                font-size: 12px;
                font-family:Georgia, 'Times New Roman', Times, serif;
                }
            h1 h2 h3 h4 h5{
                line-height: 1.2;
            }
            .spa{
              letter-spacing:3px;
            }
          hr.style2 {
            border-top: 3px double #8c8b8b;
          }
          .miring{
            text-orientation: upright;
                writing-mode: vertical-rl;
            /* writing-mode: vertical-rl; */
          }
        </style>
        @php
            $logo='assets/upload/logotutwuri.png';
        @endphp
        <table width="100%" border="0">
            <tr>
            <td width="13%" align="right"><img src="{{$logo}}" width="70" height="70"></td>
            <td width="80%" align="center"><p><b><font size="18px">LEMBAGA PSIKOLOGI PELITA WACANA </font></b><br>
              <font size="16px"> Jl.Simpang Wilis 2 Kav. B Telp. 0341-581777 Malang</font>



                                        </td>
            </tr>
            <tr>
                <td colspan="3"><hr  class="style2">
                </td>
            </tr>
            </table>
            <center>
                <h2>Judul</h2>
                <label for="">Tapel 2019-2020</label>
            </center>
            {{-- <center><h2>@yield('title')</h2></center> --}}

                <table width="100%" border="0">
                    <tr>
                        <td align="left" width="60%"><b>Kelas :Nama Kelas

                         </b></td>

                    </tr>
                </table>
                <br>
                <table width="100%" border="1">
                    <tr>
                        <td align="center"><b>No</b></td>
                        <td align="left"><b>No Induk</b></td>
                        <td align="center"><b>Nama</b></td>
                        <td align="center"><h3 class="miring">KK</h3></td>
                        <td align="center"><b>KB</b></td>
                        <td align="center"><b>LB</b></td>

                    </tr>

                </table>


                <br>

                <table width="100%" border="0">
                    <tr>
                        <td align="left" width="70%">

                        </td>
                        <td align="left" width="30%"><b>Denda per hari : <br>
                         </b></td>

                    </tr>
                </table>

                <br>
                <br>
                <br>

    <table width="100%" border="0">
        <tr>
            <th width="3%"></th>
            <th width="30%" align="center">
                <br>
               <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <br><br><br><br><br><br><br><br>
                {{-- <hr style="width:70%; border-top:2px dotted; border-style: none none dotted;  "> --}}

            </th>

            <th width="34%"></th>

            <th width="30%" align="center">

                <img src="data:image/png;base64,{{DNS2D::getBarcodePNG('asdads', 'QRCODE')}}" alt="barcode" width="150px" height="150px"/>


            </th>
            <th width="3%"></th>

        </tr>

    </table>

    </body>
    </html>
