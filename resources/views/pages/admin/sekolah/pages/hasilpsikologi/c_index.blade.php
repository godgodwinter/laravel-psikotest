
                <div class="d-flex bd-highlight mb-0 align-items-center">

                    <div class="p-2 bd-highlight">

            <form action="{{route('sekolah.hasilpsikologi.cari',$id->id)}}" method="GET" class="babeng-form">
                <input type="text" class="babeng babeng-select  ml-0" name="cari">
            </div>

            <div class="p-2 bd-highlight">
                    <input class="btn btn-info ml-1 mt-2 mt-sm-0" type="submit" id="babeng-submit" value="Cari">
            </div>

            <div class="ml-auto p-2 bd-highlight">
                <a href="{{route('sekolah.hasilpsikologi.create',$id->id)}}" type="submit" value="Import"
                    class="btn btn-icon btn-primary btn-sm ml-2"><span class="pcoded-micon"> <i
                            class="fas fa-download"></i> Tambah </span></a>
                {{-- <button type="button" class="btn btn-icon btn-primary btn-sm ml-0 ml-sm-0" data-toggle="modal"
                    data-target="#importExcel"><i class="fas fa-upload"></i>
                    Import
                </button>
                <a href="/admin/sekolah/export" type="submit" value="Import"
                    class="btn btn-icon btn-primary btn-sm mr-2"><span class="pcoded-micon"> <i
                            class="fas fa-download"></i> Export </span></a> --}}
            </form>
        </div>

    </div>

<div class="card" id="settings-card">
    <div class="card-header">
        <h4>Hasil Psikologi </h4>
    </div>
    <div class="card-body babengcontainer">
        <div id="babeng-bar" class="text-right mt-2">

        </div>


        <table id="example" class="table table-striped table-bordered mt-1 table-sm" >
            <thead>
                <tr>
                    <th class="text-center babeng-min-row"> <input type="checkbox" id="chkCheckAll"> All</th>
                    <th class="text-center" > Nama </th>
                    <th class="text-center" > Hasil Deteksi </th>
                    <th class="text-center" > Sertifikat </th>
                    <th class="text-center" > Aksi </th>

                </tr>
            </thead>
            <tbody>
                @forelse ($datas as $data)
                <tr id="sid{{ $loop->index+1 }}">
                    <td class="text-center ">
                        {{$loop->index+1}}
                    </td>
                    <td >
                        {{$data->siswa!=null ? $data->siswa->nama : 'Data tidak ditemukan'}}
                    </td>
                    <td class="text-center">
                        {{$data->nilai}}
                    </td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-info"> Lihat </button>

                    </td>
                    <td class="text-center babeng-min-row">
                        <x-button-edit link="#" />
                        <x-button-delete link="#" />



                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Data tidak ditemukan</td>
                </tr>
                @endforelse

            </tbody>
        </table>

    </div>
</div>
</div>
</div>
