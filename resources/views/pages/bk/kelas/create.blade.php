@extends('layouts.default')

@section('title')
Catatan Kasus Siswa
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








           <form id="setting-form" method="POST" action="{{route('bk.kelas.store',$id->id)}}">
            @csrf
            <div class="card" id="settings-card">
              <div class="card-header">
                <h4>Kelas </h4>
              </div>
              <div class="card-body">

                <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Nama Kelas</label>
                    <div class="col-sm-6 col-md-9">

                      <input type="text" class="form-control  @error('nama') is-invalid @enderror" name="nama" required  value="{{old('nama')}}">

                      @error('nama')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror

                    </div>
                  </div>
                  {{-- <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Tipe Kelas</label>
                    <div class="col-sm-6 col-md-9">




                        <select class="form-control @error('tipe')
                            is-invalid
                        @enderror" name="tipe"  required>
                            <option disabled selected value=""> Pilih Tipe</option>
                            <option>Umum</option>
                            <option>Khusus</option>

                          </select>

                      @error('tipe')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror

                    </div>
                  </div> --}}
                  <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Wali Kelas</label>
                    <div class="col-sm-6 col-md-9">

                        <select class="js-example-basic-single form-control-sm @error('walikelas_id')
                            is-invalid
                        @enderror" name="walikelas_id"  style="width: 75%" >
                            <option disabled selected value=""> Pilih Walikelas</option>
                            @foreach ($walikelas as $t)
                                <option value="{{ $t->id }}"> {{ $t->nama }}</option>
                            @endforeach
                          </select>

                      @error('walikelas_id')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror

                    </div>
                  </div>
                  </div>




              <div class="card-footer bg-whitesmoke text-md-right">
                <button class="btn btn-primary" id="save-btn">Simpan</button>
              </div>
            </div>
          </form>

          <script type="text/javascript">
            $(document).ready(function() {

                // In your Javascript (external .js resource or <script> tag)
                    $(document).ready(function() {
                        $('.js-example-basic-single').select2({
                            // theme: "classic",
                            // allowClear: true,
                            width: "resolve"
                        });
                    });
            });
           </script>



            </div>
        </div>
    </div>
</section>
@endsection
