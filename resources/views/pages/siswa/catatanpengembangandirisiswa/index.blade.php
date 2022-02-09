@extends('layouts.default')

@section('title')
Catatan Pengembangandiri Siswa
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
            <div class="breadcrumb-item">{{ $id->nama }}</div>
        </div>
    </div>


    <div class="card" id="settings-card">
        {{-- <div class="card-header">
            <h4>Hasil Psikologi </h4>
        </div> --}}
        <div class="card-body babengcontainer">


            <div class="card-header">
                <h4>Catatan Kasus Siswa : {{ $data!=null?$data->nama:'Kelas tidak ditemukan' }}</h4>
                <a class="btn btn-sm btn-info" href="{{ route('siswa.catatanpengembangandiri.cetak')}}"><i class="fas fa-print"></i></a>

                </div>

    <table id="example" class="table table-striped table-bordered mt-1 table-sm" >
        <thead>
            <tr>
                <th class="text-center babeng-min-row">
                    No</th>
                <th >Tanggal</th>
                <th class="text-center">Ide dan Imajinasi</th>

            </tr>
        </thead>
        <tbody>
            @forelse ($datas as $data)
            <tr id="sid{{ $data->id }}">
                    <td class="text-center">
                        {{ ((($loop->index)+1)+(($datas->currentPage()-1)*$datas->perPage())) }}</td>
                    <td> {{Fungsi::tanggalindo($data->tanggal)}}
                    </td>

                     <td class="text-center">
                        {{$data->idedanimajinasi}}
                     </td>

                </tr>
    @empty
                <tr>
                    <td colspan="5" class="text-center">Data tidak ditemukan</td>
                </tr>
    @endforelse

        </tbody>
    </table>


        </div>
        </div>
        </div>
        </div>



</div>
          </div>
        </div>
    </div>
</section>
@endsection
