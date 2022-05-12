@extends('layouts.default')

@section('title')
Detail Sekolah
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
              {{-- content --}}

              <div class="card" id="settings-card">
                {{-- <div class="card-header">
                  <h4>Siswa </h4>
                </div> --}}
                <div class="card-body">
                  <div class="d-flex bd-highlight mb-0 align-items-center">
                      <div class="p-2 bd-highlight">

                          <form action="{{route('sekolah.siswa.cari',$id->id)}}" method="GET">
                      </div>
                      <div class="p-2 bd-highlight d-flex ">
                          <h4 class="px-2">Proses</h4>
                          <h4 class="px-1" id="loadData">1</h4>
                          <h4 class="px-1">/</h4>
                          <h4 class="px-1" id="totalData">0</h4>
                          </div>
                      <div class="ml-auto p-2 bd-highlight">
                          @if (Auth::user()->tipeuser == 'admin')
                          <a href="{{route('sekolah.siswa.generateakun',$id->id)}}" class="btn btn-warning btn-sm">Generate Akun</a>
                          <a href="{{route('sekolah.siswa',$id->id)}}" class="btn btn-secondary btn-sm">Kembali</a>
                          @endif

                          </form>
                      </div>
                  </div>


                  <div class="container">
                        <div class="row" id="content">
                        </div>
                  </div>


@push('before-script')
<script>
    let loadData = 0;
    let totalData = {{ $totaldata }};
    let dataSiswa =null;


    document.getElementById('loadData').innerText =loadData;
    document.getElementById('totalData').innerText =totalData;
    getData();
    // function
    function getData(datas = null) {
    (async () => {
                            const requestOptions = {
                                method: 'GET',
                                headers: {
                                    "Content-Type": "application/json",
                                    "Accept": "application/json",
                                    "X-Requested-With": "XMLHttpRequest",
                                    "X-CSRF-Token": $('input[name="_token"]').val()
                                },
                            };
                            const response = await fetch(
                                "{{ route('sekolah.siswa.generateakun.api.getsiswa', [$id->id]) }}",
                                requestOptions);
                            let data = await response.json();
                            if (response.ok) {
                                // console.log(data);
                                // document.getElementById('sukses').innerText = sukses;
                                dataSiswa = data.data;
                                for (let i = 0; i < dataSiswa.length; i++) {
                                    // console.log(dataSiswa[i]);
                                    generateAkunSiswa(dataSiswa[i].id);
                                }

                            } else {
                                console.log('error!');
                            }
                        })();
                    }

    function generateAkunSiswa(siswa_id = null) {

        (async () => {
                            const requestOptions = {
                                method: 'POST',
                                headers: {
                                    "Content-Type": "application/json",
                                    "Accept": "application/json",
                                    "X-Requested-With": "XMLHttpRequest",
                                    "X-CSRF-Token": $('input[name="_token"]').val()
                                },
                            };
                            const response = await fetch(
                                `{{ url('/') }}/admin/api/sekolah/{{ $id->id }}/datasiswa/generateakun/api/generate/${siswa_id}`,
                                requestOptions);
                            let data = await response.json();
                            if (response.ok) {
                                // console.log(data);
                                // console.log( data.data);
                                loadData++;
                                document.getElementById('loadData').innerText =loadData;
                                console.log(siswa_id);

                            } else {
                                console.log('error!');
                            }
                        })();

    }

    // function
</script>
@endpush

                      </div>

                      <div class="container">
                          <h5>Catatan : </h5>
                          {{-- <p>PasswordDefault hanya bisa digunakan jika belum diganti user.</p> --}}
                          <p>Tunggu Proses Selesai</p>
                      </div>

                  </div>
                </div>
              </div>

              {{-- content --}}
          </div>
        </div>
    </div>
</section>
@endsection
