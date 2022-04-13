@extends('layouts.default')

@section('title')
    Penanganan Deteksi Masalah
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

                            <form action="{{ route('pemecahanmasalahdeteksi.cari') }}" method="GET">

                                <input type="text" class="babeng babeng-select  ml-0" name="cari">
                        </div>
                        <div class="p-2 bd-highlight">
                            <span>
                                <input class="btn btn-info ml-1 mt-2 mt-sm-0" type="submit" id="babeng-submit" value="Cari">
                            </span>

                        </div>
                        <div class="ml-auto p-2 bd-highlight">

                            </form>

                        </div>
                    </div>

                    @if ($datas->count() > 0)
                        <x-jsdatatable />
                    @endif

                    <table id="example" class="table table-striped table-bordered mt-1 table-sm" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center babeng-min-row"> No</th>
                                <th>Nama</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($datas as $data)
                                <tr id="sid{{ $data->id }}">
                                    <td class="text-center">
                                        {{ $loop->index + 1 + ($datas->currentPage() - 1) * $datas->perPage() }}
                                    </td>
                                    <td> {{ Str::limit($data->nama, 25, ' ...') }}
                                    </td>


                                    <td class="text-center babeng-min-row">
                                        {{-- <x-button-reset-pass link="/admin/{{ $pages }}/{{$data->id}}/reset" /> --}}
                                        <x-button-edit link="{{ route('pemecahanmasalahdeteksi.edit', $data->id) }}" />
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
                        <div>
                            @php
                                $cari = $request->cari;
                                $tapel_nama = $request->tapel_nama;
                                $kelas_nama = $request->kelas_nama;
                            @endphp
                            {{ $datas->onEachSide(1) }}
                        </div>
                        <div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
