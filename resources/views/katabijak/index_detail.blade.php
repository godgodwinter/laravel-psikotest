@extends('layouts.default')

@section('title')
    Penjelasan Kata-kata Bijak
@endsection

@push('before-script')
    @if (session('status'))
        <x-sweetalertsession tipe="{{ session('tipe') }}" status="{{ session('status') }}" />
    @endif
@endpush


@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@yield('title')</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                {{-- <div class="breadcrumb-item"><a href="#">Layout</a></div> --}}
                <div class="breadcrumb-item">@yield('title')</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex bd-highlight mb-0 align-items-center">

                        <div class="p-2 bd-highlight">

                            <form action="{{ route('katabijak.cari') }}" method="GET">
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
                                <input class="btn btn-info ml-1 mt-2 mt-sm-0" type="submit" id="babeng-submit" value="Cari">
                            </span>
                        </div>
                        <div class="ml-auto p-2 bd-highlight">

                            <a href="{{ route('katabijakdetail.create', $katas->id) }}" type="submit" value="Import"
                                class="btn btn-icon btn-primary btn-sm ml-2"><span class="pcoded-micon"> <i
                                        class="fas fa-download"></i> Tambah </span></a>
                            </form>

                        </div>
                    </div>

                    <x-jsmultidel link="{{ route('katabijakdetail.multidel', $katas->id) }}" />
                    @if ($datas->count() > 0)
                        <x-jsdatatable />
                    @endif
                    Penjelasan dari Judul :
                    <table id="example" class="table table-striped table-bordered mt-1 table-sm" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center babeng-min-row"> <input type="checkbox" id="chkCheckAll"> All</th>

                                <th>Penjelasan</th>




                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($datas as $data)
                                <tr id="sid{{ $data->id }}">
                                    <td class="text-center">
                                        <input type="checkbox" name="ids" class="checkBoxClass "
                                            value="{{ $data->id }}">
                                        {{ $loop->index + 1 + ($datas->currentPage() - 1) * $datas->perPage() }}
                                    </td>

                                    <td> {{ Str::limit($data->penjelasan, 25, ' ...') }}
                                    </td>





                                    <td class="text-center babeng-min-row">

                                        <x-button-edit
                                            link="{{ route('katabijakdetail.edit', [$katas->id, $data->id]) }}" />
                                        <x-button-delete
                                            link="{{ route('katabijakdetail.destroy', [$katas->id, $data->id]) }}" />
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Data tidak ditemukan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-between flex-row-reverse mt-3">
                        <div>
                            @php
                                $cari = $request->cari;
                                $tapel_nama = $request->tapel_nama;
                                $kelas_nama = $request->kelas_nama;
                            @endphp
                            {{ $datas->onEachSide(1) }}
                        </div>
                        {{-- <nav aria-label="breadcrumb">
<ol class="breadcrumb">
    <li class="breadcrumb-item"><i class="fas fa-paste"></i> {{ $datas->total() }} Data ditemukan</li>

</ol>
</nav> --}}
                        <div>
                            <a href="#" class="btn btn-sm  btn-danger mb-2" id="deleteAllSelectedRecord"
                                onclick="return  confirm('Anda yakin menghapus data ini? Y/N')" data-toggle="tooltip"
                                data-placement="top" title="Hapus Terpilih">
                                <i class="fas fa-trash-alt mr-2"></i> Hapus Terpilih</i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
