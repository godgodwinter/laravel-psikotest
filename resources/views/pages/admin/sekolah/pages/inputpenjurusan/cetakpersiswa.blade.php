<x-cetak-css></x-cetak-css>
<body>
<x-cetak-kop></x-cetak-kop>

    <div style="margin-bottom: 0;text-align:center" id="judul">
        <h2>BAKAT DAN PENJURUSAN SISWA</h2>
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
            <td class="babeng-min-row">Tipe Bakat 1</td>
            <td>:</td>
            <td> {{$datas->nilai1}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">Tipe Bakat 2</td>
            <td>:</td>
            <td> {{$datas->nilai2}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">Tipe Bakat 3</td>
            <td>:</td>
            <td> {{$datas->nilai3}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">STUDI_LANJUT_SMP</td>
            <td>:</td>
            <td> {{$datas->nilai4}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">STUDI_LANJUT_SMA_SMK_1_FAKULTAS</td>
            <td>:</td>
            <td> {{$datas->nilai5}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">STUDI_LANJUT_SMA_SMK_1_PRODI</td>
            <td>:</td>
            <td> {{$datas->nilai6}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">STUDI_LANJUT_SMA_SMK_2_FAKULTAS</td>
            <td>:</td>
            <td> {{$datas->nilai7}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">STUDI_LANJUT_SMA_SMK_2_PRODI</td>
            <td>:</td>
            <td> {{$datas->nilai8}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">STUDI_LANJUT_SMA_SMK_KEDINASAN</td>
            <td>:</td>
            <td> {{$datas->nilai9}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">JURUSAN_LANJUT_SMA/MA</td>
            <td>:</td>
            <td> {{$datas->nilai10}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">JURUSAN_LANJUT_SMK1</td>
            <td>:</td>
            <td> {{$datas->nilai11}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">JURUSAN_LANJUT_SMK2</td>
            <td>:</td>
            <td> {{$datas->nilai12}}</td>
        </tr>
        </tr>
        <tr>
            <td class="babeng-min-row">JURUSAN_LANJUT_SMK3</td>
            <td>:</td>
            <td> {{$datas->nilai13}}</td>
        </tr>
        </tr>
        <tr>
            <td class="babeng-min-row">Disarankan studi SMA/MA/SMK</td>
            <td>:</td>
            <td> {{$datas->nilai14}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">Jurusan SMA/MA</td>
            <td>:</td>
            <td> {{$datas->nilai15}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">Jur SMK(BK/Bidg keahlian)</td>
            <td>:</td>
            <td> {{$datas->nilai16}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">SMK (PK/Program keahlian)</td>
            <td>:</td>
            <td> {{$datas->nilai17}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">Jur.Disarankan SMA/MA</td>
            <td>:</td>
            <td> {{$datas->nilai18}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">Jur.Dipertimbangkan SMA/MA</td>
            <td>:</td>
            <td> {{$datas->nilai19}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">Jur.Tdk.Disarankan SMA/MA</td>
            <td>:</td>
            <td> {{$datas->nilai20}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">D / S.1 Disarankan Fakultas</td>
            <td>:</td>
            <td> {{$datas->nilai21}}</td>
        </tr>
        <tr>
            <td class="babeng-min-row">D / S.1 Disarankan Prodi</td>
            <td>:</td>
            <td> {{$datas->nilai22}}</td>
        </tr>
    </table>



</body>

</html>
