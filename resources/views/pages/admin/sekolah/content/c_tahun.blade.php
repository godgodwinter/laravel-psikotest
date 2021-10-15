
                <div class="card" id="settings-card">
                  <div class="card-header">
                    <h4>Tahun Ajaran</h4>
                  </div>
                  <div class="card-body">
                    <div id="babeng-bar" class="text-center mt-2">

                        <div id="babeng-row ">

                            <form action="{{route('sekolah.tahun.cari',$id->id)}}" method="GET">
                                <input type="text" class="babeng babeng-select  ml-0" name="cari">

                                <span>
                                    <input class="btn btn-info ml-1 mt-2 mt-sm-0" type="submit" id="babeng-submit"
                                        value="Cari">
                                </span>

                                <a href="{{route('sekolah.tahun.create',$id->id)}}" type="submit" value="Import"
                                    class="btn btn-icon btn-primary btn-sm ml-2"><span class="pcoded-micon"> <i
                                            class="fas fa-download"></i> Tambah </span></a>
                                            {{-- <button type="button" class="btn btn-icon btn-primary btn-sm ml-0 ml-sm-0"
                                                data-toggle="modal" data-target="#importExcel"><i class="fas fa-upload"></i>
                                                Import
                                            </button>
                                            <a href="/admin/sekolah/export" type="submit" value="Import"
                                                class="btn btn-icon btn-primary btn-sm mr-2"><span class="pcoded-micon"> <i
                                                        class="fas fa-download"></i> Export </span></a> --}}
                            </form>



            <table id="example" class="table table-striped table-bordered mt-1" style="width:100%">
                <thead>
                    <tr>
                        <th width="8%" class="text-center"> <input type="checkbox" id="chkCheckAll"> All</th>
                        <th>Nama Tahun</th>
                        <th width="10%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>

                        </div>
                    </div>
                  </div>
                </div>
