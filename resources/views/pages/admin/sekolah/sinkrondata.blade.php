@extends('layouts.default')

@section('title')
Sinkron Data ke Database Siswa
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
            {{-- <div class="breadcrumb-item"><a href="#">Layout</a></div> --}}
            <div class="breadcrumb-item">@yield('title')</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            @push('after-style')
            <meta name="csrf-token" content="{{ csrf_token() }}" />
            @endpush
    @push('before-script')
    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>

    <script>
jQuery(document).ready(function() {
let sukses=0;
let gagal=0;
let jmlProgress=0;
let progess=0;


//

//fungsi
function storeData(id=0,username=0){
    let data=[
        {
        id : id,
        username : username,
    }
    ];
    $.ajax({

            url: '{{route('api.sinkronfestore')}}',
            type: 'GET',
            enctype: 'multipart/form-data',
            data: {data : data},
            success: function (result) {
//   console.log(data);
                console.log(result);
                if(result.success){
             sukses++;
            document.getElementById('sukses').innerText = sukses;
                }else{
             gagal++;
            document.getElementById('gagalData').innerText = gagal;

                }
                updateProgress(1);
            }
        });
}
        function updateProgress($item=1){
                    jmlProgress++;
                    // console.log(jmlProgress);
                    progess=jmlProgress/{{count($datas)}}*100;
                    document.getElementById('progress1').innerText = progess.toFixed(2)+'%';
                    document.getElementById('progress1').style.width= progess+'%';
                }


// call
@foreach ($datas as $data)
storeData('{{$data->id}}','{{$data->username}}');
@endforeach

});

    </script>
    @endpush

            <div class="card-body">
                <div>

                    <a href="{{route('sekolah')}}" class="btn btn-warning">Kembali</a>

                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                              <div class="card-icon bg-primary">
                                <i class="fas fa-database"></i>
                              </div>
                              <div class="card-wrap">
                                <div class="card-header">
                                  <h4>Total Data</h4>
                                </div>
                                <div class="card-body">
                                  {{count($datas)}}
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                              <div class="card card-statistic-1">
                                <div class="card-icon bg-success">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="card-wrap">
                                  <div class="card-header">
                                    <h4>Berhasil disimpan</h4>
                                  </div>
                                  <div class="card-body" id="sukses">
                                    0
                                  </div>
                                </div>
                              </div>
                            </div>
                          <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                              <div class="card card-statistic-1">
                                <div class="card-icon bg-danger">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <div class="card-wrap">
                                  <div class="card-header">
                                    <h4>Total Data Gagal di muat</h4>
                                  </div>
                                  <div class="card-body" id="gagalData">
                                   0
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    <div class="progress" style="height: 40px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-info " id="progress1" role="progressbar" style="width:0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                      </div>




                </div>


        </div>
    </div>
</section>
@endsection

