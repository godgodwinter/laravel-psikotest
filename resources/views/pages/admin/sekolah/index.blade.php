@extends('layouts.default')

@section('title')
Sekolah
@endsection

@push('before-script')

@if (session('status'))
<x-sweetalertsession tipe="{{session('tipe')}}" status="{{session('status')}}"/>
@endif
@endpush


@section('content')
<section class="section">
    <div class="section-header">
        <h1>@yield('title')</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></div>
            {{-- <div class="breadcrumb-item"><a href="#">Layout</a></div> --}}
            <div class="breadcrumb-item">@yield('title')</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-body">

                <div class="d-flex bd-highlight mb-0 align-items-center">

                    <div class="p-2 bd-highlight">

                        <form action="{{ route('sekolah.cari') }}" method="GET">
                            {{-- <label for="">Urutkan </label>
                            <select class="babeng babeng-select  ml-2" name="pelajaran_nama">

                                <option>Terbaru</option>
                                <option>Terlama</option>

                                <option>A - Z</option>
                                <option>Z - A</option>
                            </select> --}}

                            <input type="text" class="babeng babeng-select  ml-0" name="cari">
                        </div>
                    <div class="p-2 bd-highlight">
                            <span>
                                <input class="btn btn-info ml-1 mt-2 mt-sm-0" type="submit" id="babeng-submit"
                                    value="Cari">
                            </span>
                        </div>
                    <div class="ml-auto p-2 bd-highlight">

            <button type="button" class="btn btn-icon btn-primary btn-sm ml-0 ml-sm-0"
            data-toggle="modal" data-target="#importExcel"><i class="fas fa-upload"></i>
            Import Data ProBK
        </button>

        <button type="button" class="btn btn-icon btn-success btn-sm ml-0 ml-sm-0"
        data-toggle="modal" data-target="#sinkron"><i class="fas fa-upload"></i>
        Sinkron
    </button>

        <a href="{{ route('apitesting') }}" type="submit" value="Import"
            class="btn btn-icon btn-danger btn-sm mr-0"><span class="pcoded-micon"> <i
                    class="fas fa-download"></i> Testing </span></a>

                            <a href="{{route('sekolah.create')}}" type="submit" value="Import"
                                class="btn btn-icon btn-primary btn-sm ml-2"><span class="pcoded-micon"> <i
                                        class="fas fa-download"></i> Tambah </span></a>
                            <button type="button" class="btn btn-icon btn-primary btn-sm ml-0 ml-sm-0"
                                data-toggle="modal" data-target="#importExcel"><i class="fas fa-upload"></i>
                                Import
                            </button>
                            <a href="{{route('sekolah.export')}}" type="submit" value="Export"
                                class="btn btn-icon btn-primary btn-sm mr-2"><span class="pcoded-micon"> <i
                                        class="fas fa-download"></i> Export </span></a>
                        </form>

                    </div>
                </div>

                <x-jsmultidel link="{{route('sekolah.multidel')}}" />
                @if($datas->count()>0)
                    <x-jsdatatable/>
                @endif

                <table id="example" class="table table-striped table-bordered table-sm mt-1" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center babeng-min-row"> <input type="checkbox" id="chkCheckAll"> All</th>
                            <th >Nama</th>
                            <th>Alamat</th>
                            <th width="10%" class="text-center">Status</th>
                            <th width="10%" class="text-center">Logo</th>
                            <th width="10%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $data)
                        <tr id="sid{{ $data->id }}">
                                <td class="text-center">
                                    <input type="checkbox" name="ids" class="checkBoxClass " value="{{ $data->id }}">
                                    {{ ((($loop->index)+1)+(($datas->currentPage()-1)*$datas->perPage())) }}</td>
                                <td>
                                    <x-button-detail link="/admin/{{ $pages }}/{{$data->id}}/detail" text="{{Str::limit($data->nama,25,' ...')}}"/>
                                </td>
                                <td>{{Str::limit($data->alamat,25,' ...')}}</td>
                                <td class="text-center">
                                    @php
                                        if($data->status=='Aktif'){
                                                $warna='success';
                                        }else{
                                                $warna='danger';

                                        }
                                    @endphp
                                    <div class="badge badge-{{$warna}}">{{$data->status}}</div>

                                </td>
                                <td class="babeng-min-row">

                        <img alt="image" src="{{$data->sekolah_logo!=null?asset('storage/'.$data->sekolah_logo):'https://ui-avatars.com/api/?name=Yayasan&amp&color=7F9CF5&amp&background=EBF4FF'}}" class="img-thumbnail" data-toggle="tooltip" title="Yayasan Photo" width="60px" height="60px" style="object-fit:cover;">
                                </td>
                                <td class="text-center babeng-min-row">
                                    {{-- <x-button-reset-pass link="/admin/{{ $pages }}/{{$data->id}}/reset" /> --}}
                                    <x-button-edit link="/admin/{{ $pages }}/{{$data->id}}" />
                                    <x-button-delete link="/admin/{{ $pages }}/{{$data->id}}" />
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
                    {{ $datas->onEachSide(1)
                    ->links() }}
        </div>
        <div>
            <a href="#" class="btn btn-sm  btn-danger mb-2" id="deleteAllSelectedRecord"
                        onclick="return  confirm('Anda yakin menghapus data ini? Y/N')"  data-toggle="tooltip" data-placement="top" title="Hapus Terpilih">
                        <i class="fas fa-trash-alt mr-2"></i> Hapus Terpilih</i></a>
        </div>
    </div>
            </div>
        </div>
    </div>
</section>
@endsection


@section('containermodal')

              <!-- Import Excel -->
              {{-- <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <form method="post" action="{{ route('sekolah.import') }}" enctype="multipart/form-data">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                      </div>
                      <div class="modal-body">

                        {{ csrf_field() }}

                        <label>Pilih file excel(.xlsx)</label>
                        <div class="form-group">
                          <input type="file" name="file" required="required">
                        </div>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div> --}}


              <!-- Import Excel -->
              <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <form method="post" action="{{ route('detailsekolah.importusername') }}" enctype="multipart/form-data">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Data ProBK</h5>
                      </div>
                      <div class="modal-body">

                        {{ csrf_field() }}

                        <label>Pilih file excel(.xlsx)</label>
                        <div class="form-group">
                          <input type="file" name="file" required="required">
                        </div>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>


              <!-- Sinkron -->
              <div class="modal fade" id="sinkron" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <form method="post" action="{{ route('detailsekolah.backuptemp') }}" enctype="multipart/form-data">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Sinkron API ProBK</h5>
                      </div>
                      {{-- <div class="modal-header">
                        <label >Proses perubahan dari backup apiprobk ke dalam data masing-masing sekolah</label>
                      </div> --}}
                      <div class="modal-body">

                        {{ csrf_field() }}


                        <label class="custom-switch">
                            <input type="checkbox" name="replace" value="1" class="custom-switch-input" checked>
                            <span class="custom-switch-indicator"></span>
                            <span class="custom-switch-description">Update data sudah ada (yang sudah pernah disinkron)</span>
                          </label>


                        <label class="custom-switch">
                            <input type="checkbox" name="insertsekolah" value="1" class="custom-switch-input" checked>
                            <span class="custom-switch-indicator"></span>
                            <span class="custom-switch-description">Tambahkan data sekolah yang belum ada</span>
                          </label>


                        <label class="custom-switch">
                            <input type="checkbox" name="insertsiswa" value="1" class="custom-switch-input" checked>
                            <span class="custom-switch-indicator"></span>
                            <span class="custom-switch-description">Tambahkan data Siswa yang belum ada</span>
                          </label>

                        <label class="custom-switch">
                            <input type="checkbox" name="refreshall" value="1" class="custom-switch-input" >
                            <span class="custom-switch-indicator"></span>
                            <span class="custom-switch-description">Refresh semua data API (yang sudah dan belum disinkron)</span>
                          </label>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Simpan dan Sinkron data</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>

@endsection
