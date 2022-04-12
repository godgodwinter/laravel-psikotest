@extends('layouts.default')

@section('title')
    Pemecahan Masalah Deteksi
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
                <div class="breadcrumb-item"><a href="{{ route('sekolah') }}">@yield('title')</a></div>
                <div class="breadcrumb-item">Edit</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h5>Edit</h5>
                </div>
                <div class="card-body">
                    @php
                        $ket1 = '';
                        $ket2 = '';
                        $ket3 = '';
                        $cekKet1 = App\Models\masterdeteksi_pemecahanmasalah::where('batasbawah', 54.5)
                            ->where('batasatas', 70.0)
                            ->where('masterdeteksi_id', $data->id)
                            ->count();
                        if ($cekKet1 > 0) {
                            $getKet1 = \App\Models\masterdeteksi_pemecahanmasalah::where('batasbawah', 54.5)
                                ->where('batasatas', 70.0)
                                ->where('masterdeteksi_id', $data->id)
                                ->first();
                            $ket1 = $getKet1->keterangan;
                        }

                        $cekKet2 = App\Models\masterdeteksi_pemecahanmasalah::where('batasbawah', 71.0)
                            ->where('batasatas', 80.0)
                            ->where('masterdeteksi_id', $data->id)
                            ->count();
                        if ($cekKet2 > 0) {
                            $getKet2 = \App\Models\masterdeteksi_pemecahanmasalah::where('batasbawah', 71.0)
                                ->where('batasatas', 80.0)
                                ->where('masterdeteksi_id', $data->id)
                                ->first();
                            $ket2 = $getKet2->keterangan;
                        }

                        $cekKet3 = App\Models\masterdeteksi_pemecahanmasalah::where('batasbawah', 81.0)
                            ->where('batasatas', 99.0)
                            ->where('masterdeteksi_id', $data->id)
                            ->count();
                        if ($cekKet3 > 0) {
                            $getKet3 = \App\Models\masterdeteksi_pemecahanmasalah::where('batasbawah', 81.0)
                                ->where('batasatas', 99.0)
                                ->where('masterdeteksi_id', $data->id)
                                ->first();
                            $ket3 = $getKet3->keterangan;
                        }
                    @endphp

                    <form id="setting-form" method="POST"
                        action="{{ route('pemecahanmasalahdeteksi.update', $data->id) }}">
                        @method('put')
                        @csrf
                        <div class="card" id="settings-card">

                            <div class="card-body">

                                <div class="form-group row align-items-center">
                                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Nama</label>
                                    <div class="col-sm-6 col-md-9">

                                        <input type="text" class="form-control  @error('nama') is-invalid @enderror"
                                            name="nama" required value="{{ old('nama') ? old('nama') : $data->nama }}"
                                            readonly>

                                        @error('nama')
                                            <div class="invalid-feedback"> {{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Keterangan 1
                                        (54,5 - 70)</label>
                                    <div class="col-sm-6 col-md-9">

                                        <textarea class="form-control" style=" min-width:500px; max-width:100%;min-height:50px;height:100%;width:100%;"
                                            name="ket1" required rows="5"
                                            cols="50">{{ old('ket1') ? old('ket1') : $ket1 }}</textarea>
                                        @error('ket1')
                                            <div class="invalid-feedback"> {{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Keterangan 2
                                        (71 - 80)</label>
                                    <div class="col-sm-6 col-md-9">

                                        <textarea class="form-control" style=" min-width:500px; max-width:100%;min-height:50px;height:100%;width:100%;"
                                            name="ket2" required rows="5"
                                            cols="50">{{ old('ket2') ? old('ket2') : $ket2 }}</textarea>
                                        @error('ket2')
                                            <div class="invalid-feedback"> {{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Keterangan 3
                                        (81 - 99)</label>
                                    <div class="col-sm-6 col-md-9">

                                        <textarea class="form-control" style=" min-width:500px; max-width:100%;min-height:50px;height:100%;width:100%;"
                                            name="ket3" required rows="5"
                                            cols="50">{{ old('ket3') ? old('ket3') : $ket3 }}</textarea>
                                        @error('ket3')
                                            <div class="invalid-feedback"> {{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>

                            </div>




                            <div class="card-footer bg-whitesmoke text-md-right">
                                <button class="btn btn-primary" id="save-btn">Simpan</button>
                            </div>
                        </div>
                    </form>




                </div>
            </div>
        </div>
    </section>
@endsection
