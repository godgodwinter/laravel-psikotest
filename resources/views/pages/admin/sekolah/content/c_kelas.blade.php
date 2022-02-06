
                <div class="card" id="settings-card">
                  {{-- <div class="card-header">
                    <h4>Kelas </h4>
                  </div> --}}
                  <div class="card-body">
                    <div class="d-flex bd-highlight mb-0 align-items-center">
                        <div class="p-2 bd-highlight">

                            <form action="{{route('sekolah.kelas.cari',$id->id)}}" method="GET">
                                <input type="text" class="babeng babeng-select  ml-0" name="cari">
                            </div>
                            <div class="p-2 bd-highlight">
                                <span>
                                    <input class="btn btn-info ml-1 mt-2 mt-sm-0" type="submit" id="babeng-submit"
                                        value="Cari">
                                </span>
                            </div>
                            <div class="ml-auto p-2 bd-highlight">
                                <a href="{{route('sekolah.kelas.create',$id->id)}}" type="submit" value="Import"
                                    class="btn btn-icon btn-primary btn-sm ml-2"><span class="pcoded-micon"> <i
                                            class="fas fa-download"></i> Tambah </span></a>
                                           {{--  <button type="button" class="btn btn-icon btn-primary btn-sm ml-0 ml-sm-0"
                                                data-toggle="modal" data-target="#importExcel"><i class="fas fa-upload"></i>
                                                Import
                                            </button>
                                            <a href="/admin/sekolah/export" type="submit" value="Import"
                                                class="btn btn-icon btn-primary btn-sm mr-2"><span class="pcoded-micon"> <i
                                                        class="fas fa-download"></i> Export </span></a> --}}
                            </form>
                        </div>
                    </div>

                    <x-jsmultidel link="{{route('sekolah.kelas.multidel',$id)}}" />
                    @if($datas->count()>0)
                        <x-jsdatatable/>
                    @endif
            <table id="example" class="table table-striped table-bordered mt-1 table-sm" style="width:100%">
                <thead>
                    <tr>
                        <th  class="text-center babeng-min-row"> <input type="checkbox" id="chkCheckAll"> All</th>
                        <th>Nama kelas</th>
                        <th>Wali kelas</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($datas as $data)
                        <tr id="sid{{ $data->id }}">
                                <td class="text-center">
                                    <input type="checkbox" name="ids" class="checkBoxClass " value="{{ $data->id }}">
                                    {{ ((($loop->index)+1)+(($datas->currentPage()-1)*$datas->perPage())) }}</td>
                                <td> {{Str::limit($data->nama,25,' ...')}}
                                </td>
                                <td>
                                    {{$data->walikelas!=null ? $data->walikelas->nama : 'Data tidak ditemukan'}}
                                    {{-- {{$data->walikelas->nama}} --}}
                                </td>

                                <td class="text-center babeng-min-row">
                                    {{-- <x-button-reset-pass link="/admin/{{ $pages }}/{{$data->id}}/reset" /> --}}
                            <a class="btn btn-sm btn-info" href="{{route('sekolah.kelas.cetak',[$id->id,$data->id])}}"><i class="fas fa-print"></i></a>
                                    <x-button-edit link="{{ route('sekolah.kelas.edit',[$id->id,$data->id])}}" />
                                    <x-button-delete link="{{ route('sekolah.kelas.edit',[$id->id,$data->id])}}" />
                                </td>
                            </tr>
                @empty
                            <tr>
                                <td colspan="5" class="text-center">Data tidak ditemukan</td>
                            </tr>
                @endforelse

                </tbody>
            </table>
            <div class="d-flex justify-content-between flex-row-reverse mt-3">
                <div >
            @php
$cari=$request->cari;
$tapel_nama=$request->tapel_nama;
$kelas_nama=$request->kelas_nama;
@endphp
{{-- {{ $datas->appends(['cari'=>$request->cari,'yearmonth'=>$request->yearmonth,'kategori_nama'=>$request->kategori_nama])->links() }} --}}
{{ $datas->onEachSide(1)
//   ->appends(['cari'=>$cari])
//   ->appends(['tapel_nama'=>$tapel_nama])
//   ->appends(['kelas_nama'=>$kelas_nama])
  ->links() }}
                </div>
                <div>
{{-- <nav aria-label="breadcrumb">
<ol class="breadcrumb">
    <li class="breadcrumb-item"><i class="fas fa-paste"></i> {{ $datas->total() }} Data ditemukan</li>

</ol>
</nav> --}}
<a href="#" class="btn btn-sm  btn-danger mb-2" id="deleteAllSelectedRecord"
            onclick="return  confirm('Anda yakin menghapus data ini? Y/N')"  data-toggle="tooltip" data-placement="top" title="Hapus Terpilih">
            <i class="fas fa-trash-alt mr-2"></i> Hapus Terpilih</i>
        </a>
    </div>
</div>


                        </div>
                    </div>
                  </div>
                </div>
