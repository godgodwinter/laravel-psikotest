
                <div class="card" id="settings-card">
                  <div class="card-header">
                    <h4>Referensi Studi & Kerja </h4>
                  </div>
                  <div class="card-body">
                    <div id="babeng-bar" class="text-right mt-2">

                        <div id="babeng-row ">

                            <form action="{{route('sekolah.referensi.cari',$id->id)}}" method="GET">
                                <input type="text" class="babeng babeng-select  ml-0" name="cari">

                                <span>
                                    <input class="btn btn-info ml-1 mt-2 mt-sm-0" type="submit" id="babeng-submit"
                                        value="Cari">
                                </span>

                                <a href="{{route('sekolah.referensi.create',$id->id)}}" type="submit" value="Import"
                                    class="btn btn-icon btn-primary btn-sm ml-2"><span class="pcoded-micon"> <i
                                            class="fas fa-download"></i> Tambah </span></a>
                                            <button type="button" class="btn btn-icon btn-primary btn-sm ml-0 ml-sm-0"
                                                data-toggle="modal" data-target="#importExcel"><i class="fas fa-upload"></i>
                                                Import
                                            </button>
                                            <a href="/admin/sekolah/export" type="submit" value="Import"
                                                class="btn btn-icon btn-primary btn-sm mr-2"><span class="pcoded-micon"> <i
                                                        class="fas fa-download"></i> Export </span></a>
                            </form>
                        </div>
                    </div>


            <table id="example" class="table table-striped table-bordered mt-1" style="width:100%">
                <thead>
                    <tr>
                        <th width="8%" class="text-center"> <input type="checkbox" id="chkCheckAll"> All</th>
                        <th>Judul </th>
                        <th class="text-center">File</th>
                        <th class="text-center">Jenis</th>
                        <th width="150px" class="text-center">Aksi</th>
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
                                <td class="text-center">
                                    @php
                                        if($data->link!=null){
                                            $alamat=$data->link;
                                        }else{
                                            $alamat=url('/'.$data->file);
                                        }
                                    @endphp
<a href="{{ $alamat }}" class="btn btn-icon btn-dark btn-sm ml-1"  data-toggle="tooltip" data-placement="top" title="File!" target="_blank" ><i class="fas fa-atlas"></i></a>

                                </td>

                                <td class="text-center">
                                    {{-- <x-button-reset-pass link="/admin/{{ $pages }}/{{$data->id}}/reset" /> --}}
                                    <x-button-edit link="{{ route('sekolah.referensi.edit',[$id->id,$data->id])}}" />
                                    <x-button-delete link="{{ route('sekolah.referensi.destroy',[$id->id,$data->id])}}" />
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
