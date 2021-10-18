
                <div class="card" id="settings-card">
                  <div class="card-header">
                    <h4>Master Nilai Bidang Studi </h4>
                  </div>
                  <div class="card-body">
                    <div id="babeng-bar" class="text-right mt-2">

                        <div id="babeng-row ">

                            <form action="{{route('sekolah.masternilaibidangstudi.cari',$id->id)}}" method="GET">
                                <input type="text" class="babeng babeng-select  ml-0" name="cari">

                                <span>
                                    <input class="btn btn-info ml-1 mt-2 mt-sm-0" type="submit" id="babeng-submit"
                                        value="Cari">
                                </span>

                                <a href="{{route('sekolah.masternilaibidangstudi.create',$id->id)}}" type="submit" value="Import"
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
                        <th>Nama </th>
                            @php
                                $master=DB::table('masternilaipsikologi')->whereNull('deleted_at')->get();
                            @endphp
                            @foreach ($master as $m)
                                <th class="text-center">
                                    {{$m->singkatan}}
                                </th>
                            @endforeach
                    </tr>
                </thead>
                <tbody>
                @forelse ($collectionpenilaian as $data)
                        <tr id="sid{{ $data->id }}">
                                <td class="text-center">
                                    {{$data->id}}
                                </td>
                                <td>
                                    {{$data->nama}} 
                                </td>
                                @foreach ($data->master as $m)
                                    <td class="text-center">   
                                        <input type="text" class="form-control form-control-plaintext text-center" value="{{$m->nilai}}" readonly id="inputan_{{$data->id}}_{{$m->id}}">
                                      
                                    </td>
                                @endforeach
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
