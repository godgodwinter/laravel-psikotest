{{-- <style>
    .page-break {
        page-break-after: always;
    }

</style>
<h1>Page 1 {{ $siswa['nama'] }}</h1>
<div class="page-break"></div>
<h1>Page 2</h1> --}}
{{-- <x-cetak-css></x-cetak-css> --}}

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <x-cetak-kop-png></x-cetak-kop-png>
    <hr>
    <div style="margin-bottom: 0;text-align:center" id="judul">
        <h5>TERAPIS KARAKTER</h5>
    </div>



    <table width="80%" border="0">
        <tr>
            <td width="20%">Nama</td>
            <td width="5%">:</td>
            <td>{{ ucfirst($siswa['nama']) }}</td>
        </tr>
        <tr>
            <td width="20%">Usia</td>
            <td width="5%">:</td>
            <td>{{ ucfirst($siswa['usia']) }}</td>
        </tr>
        <tr>
            <td width="20%">Jenis Kelamin</td>
            <td width="5%">:</td>
            <td>{{ ucfirst($siswa['jeniskelamin']) }}</td>
        </tr>
        <tr>
            <td width="20%">Sekolah</td>
            <td width="5%">:</td>
            <td>{{ ucfirst($siswa['sekolah']) }}</td>
        </tr>
    </table>
    <br>

    {{-- @for ($i = 0; $i < $totalData; $i++)
        <div class="pt-4">
            <h5 class="text-capitalize">{{ $i + 1 }}. {{ ucfirst($data[$i]['nama']) }} -
                {{ ucfirst($data[$i]['score']) }} -
                {{ ucfirst($data[$i]['scoresingkatan']) }}</h5>
            <p class="ml-4">
                {{ $data[$i]['pemecahanmasalah'] != '' ? Str::ucfirst($data[$i]['pemecahanmasalah']) : '-' }}
            </p>
        </div>
    @endfor --}}



</body>

</html>
