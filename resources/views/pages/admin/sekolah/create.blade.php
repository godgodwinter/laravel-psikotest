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
            <div class="breadcrumb-item"><a href="{{route('sekolah')}}">@yield('title')</a></div>
            <div class="breadcrumb-item">Tambah</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h5>Tambah</h5>
            </div>
            <div class="card-body">

                <form action="{{route('sekolah.store')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="nama">Nama Sekolah <code>*)</code></label>
                        <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{old('nama')}}" required>
                        @error('nama')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="alamat">Alamat  Sekolah <code></code></label>
                        <input type="text" name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{old('alamat')}}" >
                        @error('alamat')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="status">Status <code>*)</code></label>

                        <select class="form-control  @error('status') is-invalid @enderror" name="status" required>
                            <option>Aktif</option>
                            <option>Nonaktif</option>
                        </select>
                        @error('status')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="kepsek_nama">Nama  Kepala  Sekolah <code></code></label>
                        <input type="text" name="kepsek_nama" id="kepsek_nama" class="form-control @error('kepsek_nama') is-invalid @enderror" value="{{old('kepsek_nama')}}" >
                        @error('kepsek_nama')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="tahunajaran_nama">Tahun  Ajaran <code></code></label>
                        <input type="text" name="tahunajaran_nama" id="tahunajaran_nama" class="form-control @error('tahunajaran_nama') is-invalid @enderror" value="{{old('tahunajaran_nama')}}" >
                        @error('tahunajaran_nama')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="semester_nama">Semester <code></code></label>
                        <input type="text" name="semester_nama" id="kepsek_nama" class="form-control @error('semester_nama') is-invalid @enderror" value="{{old('semester_nama')}}" >
                        @error('semester_nama')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>
                    </div>

                    @push('after-script')
                                <script type="text/javascript">
                                    $(document).ready(function() {
                                      $.uploadPreview({
                                        input_field: "#image-upload",   // Default: .image-upload
                                        preview_box: "#image-preview",  // Default: .image-preview
                                        label_field: "#image-label",    // Default: .image-label
                                        label_default: "Logo Sekolah",   // Default: Choose File
                                        label_selected: "Ganti Logo Sekolah",  // Default: Change File
                                        no_label: false                 // Default: false
                                      });


                                      $.uploadPreview({
                                        input_field: "#image-upload2",   // Default: .image-upload
                                        preview_box: "#image-preview2",  // Default: .image-preview
                                        label_field: "#image-label2",    // Default: .image-label
                                        label_default: "Photo Kepala Sekolah",   // Default: Choose File
                                        label_selected: "Ganti Photo Kepala Sekolah",  // Default: Change File
                                        no_label: false                 // Default: false
                                      });
                                    });
                                    </script>
                                @endpush

                    <div class="form-group row mb-4 mt-3">
                        <div class="col-sm-4 col-md-4">
                          <div id="image-preview" class="image-preview">
                            <label for="image-upload" id="image-label2">Logo Sekolah</label>
                            <input type="file" name="sekolah_logo" id="image-upload" class="@error('sekolah_logo')
                            is_invalid
                        @enderror"  accept="image/png, image/gif, image/jpeg" />

                        @error('sekolah_logo')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                          </div>
                        </div>
                      </div>


                    <div class="form-group row mb-4 mt-3">
                        <div class="col-sm-4 col-md-4">
                          <div id="image-preview2" class="image-preview">
                            <label for="image-upload2" id="image-label">Foto Kepala Sekolah</label>
                            <input type="file" name="kepsek_photo" id="image-upload2" class="@error('kepsek_photo')
                                is_invalid
                            @enderror" accept="image/png, image/gif, image/jpeg" />

                        @error('kepsek_photo')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                          </div>
                        </div>
                      </div>


                    <div class="card-footer text-right mr-5">
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</section>
@endsection
