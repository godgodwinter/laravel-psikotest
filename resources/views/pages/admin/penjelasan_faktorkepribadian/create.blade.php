@extends('layouts.default')

@section('title')
    Pengertian Karakter Positif
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
                <div class="breadcrumb-item">Tambah</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h5>Tambah</h5>
                </div>
                <div class="card-body">








                    <form id="setting-form" method="POST" action="{{ route('penjelasanfaktorkepribadian.store') }}">
                        @csrf
                        <div class="card" id="settings-card">

                            <div class="card-body">

                                <div class="form-group row align-items-center">
                                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Nama Karakter
                                        Kepribadian</label>
                                    <div class="col-sm-6 col-md-9">

                                        <input type="text" class="form-control  @error('namakarakter') is-invalid @enderror"
                                            name="namakarakter" required value="{{ old('namakarakter') }}">

                                        @error('namakarakter')
                                            <div class="invalid-feedback"> {{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Pemahaman dan
                                        Pengertian</label>
                                    <div class="col-sm-6 col-md-9">

                                        <textarea class="form-control" style=" min-width:500px; max-width:100%;min-height:50px;height:100%;width:100%;"
                                            name="pemahaman" required rows="5"
                                            cols="50">{{ old('pemahaman') }}</textarea>
                                        @error('pemahaman')
                                            <div class="invalid-feedback"> {{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Pembiasaan
                                        Sikap</label>
                                    <div class="col-sm-6 col-md-9">

                                        <textarea class="form-control" style=" min-width:500px; max-width:100%;min-height:50px;height:100%;width:100%;"
                                            name="pembiasaansikap" required rows="5"
                                            cols="50">{{ old('pembiasaansikap') }}</textarea>
                                        @error('pembiasaansikap')
                                            <div class="invalid-feedback"> {{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Tujuan dan
                                        Manfaat</label>
                                    <div class="col-sm-6 col-md-9">

                                        <textarea class="form-control" style=" min-width:500px; max-width:100%;min-height:50px;height:100%;width:100%;"
                                            name="tujuandanmanfaat" required rows="5"
                                            cols="50">{{ old('tujuandanmanfaat') }}</textarea>
                                        @error('tujuandanmanfaat')
                                            <div class="invalid-feedback"> {{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>

                                <div class="form-group row align-items-center">
                                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Tipe</label>
                                    <div class="col-sm-6 col-md-9">

                                        <select class="form-control  @error('tipekarakter') is-invalid @enderror"
                                            name="tipekarakter" required>
                                            <option>Positif</option>
                                            <option>Negative</option>
                                        </select>
                                        @error('tipekarakter')
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
