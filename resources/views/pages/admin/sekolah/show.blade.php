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
            <div class="breadcrumb-item"><a href="{{route('sekolah')}}">@yield('title')</a></div>
            <div class="breadcrumb-item">{{ $id->nama }}</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h5>{{$id->nama}}</h5>
            </div>
            <div class="card-body">


            </div>
        </div>
    </div>
</section>
@endsection
