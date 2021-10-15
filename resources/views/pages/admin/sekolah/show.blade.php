@extends('layouts.default')

@section('title')
Detail Sekolah
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
            <div class="breadcrumb-item"><a href="{{route('sekolah')}}">Sekolah</a></div>
            <div class="breadcrumb-item">{{ $id->nama }}</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">{{$id->nama}}</h2>

        <div id="output-status"></div>
        <div class="row">
          <div class="col-md-3">
              @include('pages.admin.sekolah.component.sidebarsekolah')
          </div>
          <div class="col-md-9">
                @include('pages.admin.sekolah.content.c_tahun')
          </div>
        </div>
    </div>
</section>
@endsection
