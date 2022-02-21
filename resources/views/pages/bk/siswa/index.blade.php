@extends('layouts.default')

@section('title')
Siswa
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


                    <div id="babeng-bar" class="d-flex bd-highlight mb-0 align-items-center">
                        <div id="p-2 bd-highlight ">

                        <form action="{{ route('bk.siswa.cari') }}" method="GET">
                            {{-- <label for="">Urutkan </label>
                            <select class="babeng babeng-select  ml-2" name="pelajaran_nama">

                                <option>Terbaru</option>
                                <option>Terlama</option>

                                <option>A - Z</option>
                                <option>Z - A</option>
                            </select> --}}

                            <input type="text" class="babeng babeng-select  ml-0" name="cari">
                        </div>
                        <div id="p-2 bd-highlight">
                            <span>
                                <input class="btn btn-info ml-1 mt-2 mt-sm-0" type="submit" id="babeng-submit"
                                    value="Cari">
                            </span>

                        </form>

                    </div>
                    {{-- <div class="ml-auto p-2 bd-highlight"> --}}

                        {{-- <a href="{{route('bk.siswa.create')}}" type="submit" value="Import" --}}
                           {{-- class="btn btn-icon btn-primary btn-sm ml-2"><span class="pcoded-micon"> <i --}}
                                   {{-- class="fas fa-download"></i> Tambah </span></a> --}}
                       {{--            <button type="button" class="btn btn-icon btn-primary btn-sm ml-0 ml-sm-0"
                                       data-toggle="modal" data-target="#importExcel"><i class="fas fa-upload"></i>
                                       Import
                                   </button>
                                   <a href="/admin/sekolah/export" type="submit" value="Import"
                                       class="btn btn-icon btn-primary btn-sm mr-2"><span class="pcoded-micon"> <i
                                               class="fas fa-download"></i> Export </span></a> --}}
                   </form>
               {{-- </div> --}}
                </div>

                <x-jsmultidel link="{{route('bk.siswa.multidel')}}" />
                @if($datas->count()>0)
                    <x-jsdatatable/>
                @endif

                <table id="example" class="table table-striped table-bordered table-sm mt-1" style="width:100%">
                    <thead>
                        <tr>
                            <th width="8%" class="text-center babeng-min-row"><input type="checkbox" id="chkCheckAll">No</th>
                            <th>Aksi</th>
                            <th>Nama siswa</th>
                            <th>Kelas</th>
                            <th>Username</th>
                            <th>PasswordDefault</th>

                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($datas as $data)
                    <tr id="sid{{ $data->id }}">
                        <td class="text-center">
                            <input type="checkbox" name="ids" class="checkBoxClass " value="{{ $data->id }}">
                            {{ ((($loop->index)+1)+(($datas->currentPage()-1)*$datas->perPage())) }}</td>
                            <td class="text-center babeng-min-row">
                                {{-- <x-button-reset-pass link="/admin/{{ $pages }}/{{$data->id}}/reset" /> --}}
                                <x-button-edit link="{{ route('bk.siswa.edit',[$data->id])}}" />
                                {{-- <x-button-delete link="{{ route('bk.siswa.destroy',[$data->id])}}" /> --}}
                            </td>
                                    <td>{{$data->nomerinduk}} - {{Str::limit($data->nama,25,' ...')}}
                                    </td>
                                    <td>
                                      {{ $data->kelas!=null ? $data->kelas->nama : 'Data tidak ditemukan' }}
                                    </td>
                                    <td>
                                        {{ $data->users_id!=null ? $data->users->username : 'Data tidak ditemukan' }}
                                    </td>
                                    <td>
                                        {{ $data->users_id!=null ? $data->passworddefault : 'Data tidak ditemukan' }}
                                    </td>



                                </tr>
                    @empty
                                <tr>
                                    <td colspan="6" class="text-center">Data tidak ditemukan</td>
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

                {{-- <a href="#" class="btn btn-sm  btn-danger mb-2" id="deleteAllSelectedRecord" --}}
                            {{-- onclick="return  confirm('Anda yakin menghapus data ini? Y/N')"  data-toggle="tooltip" data-placement="top" title="Hapus Terpilih"> --}}
                            {{-- <i class="fas fa-trash-alt mr-2"></i> Hapus Terpilih</i> --}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

