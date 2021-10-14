@extends('layouts.default')

@section('title')
Pengaturan
@endsection

@push('before-script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('status'))
    <script>
        Swal.fire({
            icon: '{{session('tipe')}}',
            title: '{{session('status')}}',
            // text: 'Something went wrong!',
            showConfirmButton: true,
            timer: 1500
        }
        )
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
                <h4>Pengaturan Website</h4>
                </div>
                <div class="card-body">

              <form action="/admin/settings/1" method="post">
                @method('put')
                @csrf

                <div class="row">

                  <div class="form-group col-md-5 col-5 mt-0 ml-5">
                    <label for="app_nama">Nama Aplikasi <code>*)</code></label>
                    <input type="text" name="app_nama" id="app_nama" class="form-control @error('app_nama') is-invalid @enderror" value="{{$datas->app_nama}}" required>
                    @error('app_nama')<div class="invalid-feedback"> {{$message}}</div>
                    @enderror
                  </div>

                  <div class="form-group col-md-5 col-5 mt-0 ml-5">
                    <label for="app_namapendek">Singkatan Aplikasi <code>*)</code></label>
                    <input type="text" name="app_namapendek" id="app_namapendek" class="form-control @error('app_namapendek') is-invalid @enderror" value="{{$datas->app_namapendek}}" required>
                    @error('app_namapendek')<div class="invalid-feedback"> {{$message}}</div>
                    @enderror
                  </div>

                  <div class="form-group col-md-5 col-5 mt-0 ml-5">
                    <label for="paginationjml">Singkatan Aplikasi <code>*)</code></label>
                    <input type="number" name="paginationjml" id="paginationjml" class="form-control @error('paginationjml') is-invalid @enderror" value="{{$datas->paginationjml}}" required min="3" max="100">
                    @error('paginationjml')<div class="invalid-feedback"> {{$message}}</div>
                    @enderror
                  </div>


                </div>

                <div class="card-footer text-right mr-5">
                    <button class="btn btn-primary">Simpan</button>
                  </div>
              </form>

                </div>
                <div class="card-footer bg-whitesmoke">
                This is card footer
                </div>
            </div>
            </div>
        </section>
@endsection
