@extends('layouts.default')

@section('title')
Sekolah
@endsection

@push('before-script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('status'))
<script>
    Swal.fire({
        icon: '{{session('
        tipe ')}}',
        title: '{{session('
        status ')}}',
        // text: 'Something went wrong!',
        showConfirmButton: true,
        timer: 1500
    })

</script>
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
            <div class="card-header">
                <h5>Tambah</h5>
            </div>
            <div class="card-body">

                <form action="{{route('sekolah.store')}}" method="post">
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
